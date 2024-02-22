<?php

namespace App\Jobs;

use App\Enums\BetStatus;
use App\Models\Fixture;
use App\Models\Slip;
use App\Services\Calculation\CalculateCommissionService;
use App\Services\Calculation\CalculateSingleService;
use App\Services\PayoutService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateSingleJob implements ShouldQueue
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
    public function handle()
    {
        $slips = Slip::with("bettable.fixture")->whereIsOngoing()->get();

        foreach ($slips as $slip) {
            // TODO: implement: db transaction

            $single = $slip->bettable;

            if (!$single->fixture->canCalculate() || !$slip->isOngoing()) {
                continue;
            }

            if ($single->fixture->isCanceled()) {
                $data = [
                    "win_percent" => 0,
                    "status" => BetStatus::Canceled,
                    "profit" => 0,
                    "payout" => $single->amount,
                ];

                $single->update($data);

                $slip->update($data);

                $payout = app(PayoutService::class);

                $payout->transferRefund($slip, $slip->payout);

                continue;
            }

            $calculateSingleService =  new CalculateSingleService($single);

            $data = [
                "win_percent" => $calculateSingleService->getWinPercent(),
                "status" => $calculateSingleService->getResult(),
                "profit" => $calculateSingleService->getProfit(),
                "payout" => $calculateSingleService->getPayout(),
            ];

            $single->update($data);

            $slip->update($data);

            if ($slip->payout) {
                $payout = app(PayoutService::class);

                $payout->transferPayout($slip, $slip->payout);

                $commission_percents = CalculateCommissionService::getCommissionPercents($single->commission_setting_obj);

                $commission_amounts = CalculateCommissionService::calcCommissionAmounts(
                    $commission_percents,
                    $single->amount
                );

                CalculateCommissionService::transfer($slip, $commission_amounts);
            }
        }
    }
}
