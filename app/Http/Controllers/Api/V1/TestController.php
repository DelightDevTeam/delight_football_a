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
        $parlay_slip = Slip::where("bettable_type", Parlay::class)->with("bettable.parlayBets")->first();

        $parlay_service =  new CalculateParlayService($parlay_slip->bettable);

        $parlay_service->getResult();

        $single_slip = Slip::where("bettable_type", Single::class)->with("bettable")->first();

        $single_service =  new CalculateSingleService($single_slip->bettable);

        $single_service->getResult();
    }
}
