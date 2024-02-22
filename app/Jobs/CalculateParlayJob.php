<?php

namespace App\Jobs;

use App\Enums\BetStatus;
use App\Models\Slip;
use App\Services\Calculation\CalculateCommissionService;
use App\Services\Calculation\CalculateParlayBetService;
use App\Services\Calculation\CalculateParlayService;
use App\Services\Calculation\CalculateSingleService;
use App\Services\PayoutService;
use App\Services\WalletService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateParlayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $slip_ids)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $slips = Slip::with(["bettable.parlayBets.fixture" => function ($q) {
            $q->whereIsFinished();
        }])->whereIsOngoing()->get();

        foreach ($slips as $slip) {
            // TODO: implement: db transaction

            // TODO: prevent double calculation

            $parlay = $slip->bettable;

            $parlay_bets = $parlay->parlayBets;

            $win_percents = [];

            $canceled_count = 0;

            foreach ($parlay_bets as $parlay_bet) {
                if (!$parlay_bet->fixture) {
                    continue;
                }

                if ($parlay_bet->fixture->isCanceled()) {
                    $win_percents[] = [
                        "parlay_bet_id" => $parlay_bet->id,
                        "win_percent" => 0
                    ];
    
                    $parlay_bet->update([
                        "win_percent" => 0,
                        "status" => BetStatus::Canceled,
                    ]);

                    $canceled_count++;

                    continue;
                }

                $calculateParlayBetService =  new CalculateParlayBetService($parlay);

                $win_percents[] = [
                    "parlay_bet_id" => $parlay_bet->id,
                    "win_percent" => $calculateParlayBetService->getWinPercent()
                ];

                $parlay_bet->update([
                    "win_percent" => $calculateParlayBetService->getWinPercent(),
                    "status" => $calculateParlayBetService->getResult()
                ]);
            }

            if (count($win_percents) != count($parlay_bets)) {
                continue;
            }

            if($canceled_count == count($parlay_bets)) {
                $data = [
                    "status" => BetStatus::Canceled,
                    "profit" => 0,
                    "payout" => $parlay->amount,
                ];
    
                $parlay->update($data);
    
                $slip->update($data);

                continue;
            }

            $calculateParlayService =  new CalculateParlayService($parlay);

            $calculateParlayService->setParlayBetWinPercents($win_percents);

            $data = [
                "status" => $calculateParlayService->getResult(),
                "profit" => $calculateParlayService->getProfit(),
                "payout" => $calculateParlayService->getPayout(),
            ];

            $parlay->update($data);

            $slip->update($data);

            if ($slip->payout) {
                $payout = app(PayoutService::class);

                $payout->transferPayout($slip, $slip->payout);

                $commission_percents = CalculateCommissionService::getCommissionPercents($parlay->commission_setting_obj);

                $commission_amounts = CalculateCommissionService::calcCommissionAmounts(
                    $commission_percents,
                    $parlay->amount
                );

                CalculateCommissionService::transfer($slip, $commission_amounts);
            }
        }
    }
}
