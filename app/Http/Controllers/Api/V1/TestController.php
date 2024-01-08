<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\AbSelectableSide;
use App\Http\Controllers\Controller;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\Slip;
use App\Services\Calculation\CalculateParlayBetService;
use App\Services\Calculation\CalculateParlayService;
use App\Services\Calculation\CalculateSingleBetService;
use App\Services\Calculation\CalculateSingleService;
use App\Services\MarketService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $slip = Slip::where("bettable_type", Parlay::class)->with("bettable.parlayBets")->first();

        // foreach($slip->bettable->parlayBets as $parlay_bet){
        //     $xx = new CalculateParlayBetService($parlay_bet);

        //     return $xx->getWinPercent();
        // }

        $xx =  new CalculateParlayService($slip->bettable);

        return $xx->setParlayBetWinPercents([
            [
                "parlay_bet_id" => 1,
                "win_percent" => 100
            ],
            [
                "parlay_bet_id" => 1,
                "win_percent" => 100
            ],
        ])->getParlayBetWinPercents();
    }
}
