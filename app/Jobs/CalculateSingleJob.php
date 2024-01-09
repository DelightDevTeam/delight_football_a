<?php

namespace App\Jobs;

use App\Models\Fixture;
use App\Models\Slip;
use App\Services\Calculation\CalculateSingleService;
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
    public function handle(): void
    {
        $slips = Slip::with("bettable.fixture")->whereIsOngoing()->get();

        foreach ($slips as $slip) {
            // TODO: implement: db transaction

            $single = $slip->bettable;

            $calculateSingleService =  new CalculateSingleService($single);
            
            $data = [
                "win_percent" => $calculateSingleService->getWinPercent(),
                "status" => $calculateSingleService->getResult(),
                "profit" => $calculateSingleService->getProfit(),
                "payout" => $calculateSingleService->getPayout(),
            ];
            
            $single->update($data);
            
            $slip->update($data);
            
            // TODO: implement: commission share
            // TODO: implement: payout
        }
    }
}
