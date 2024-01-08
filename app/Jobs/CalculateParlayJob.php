<?php

namespace App\Jobs;

use App\Models\Slip;
use App\Services\Calculation\CalculateParlayBetService;
use App\Services\Calculation\CalculateParlayService;
use App\Services\Calculation\CalculateSingleService;
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
        $slips = Slip::with(["bettable.parlayBets.fixture" => function($q){
            $q->whereIsFinished();
        }])->whereIsOngoing()->get();

        foreach ($slips as $slip) {
            // TODO: implement: db transaction

            $parlay = $slip->bettable;

            $parlay_bets = $parlay->parlayBets;

            $win_percents = [];

            foreach ($parlay_bets as $parlay_bet) {
                if($parlay_bet->fixture){
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

            if(count($win_percents) != count($parlay_bets)){
                continue;
            }

            $calculateParlayService =  new CalculateParlayService($parlay);

            $data = [
                "status" => $calculateParlayService->getResult(),
                "profit" => $calculateParlayService->getProfit(),
                "payout" => $calculateParlayService->getPayout(),
            ];

            $parlay->update($data);

            $slip->update($data);

            // TODO: implement: commission share
            // TODO: implement: payout
        }
    }
}
