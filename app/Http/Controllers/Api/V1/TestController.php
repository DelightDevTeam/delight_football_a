<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\AbSelectableSide;
use App\Enums\OuSelectableSide;
use App\Http\Controllers\Controller;
use App\Models\League;
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
        $xx = new CalculateSingleBetService(OuSelectableSide::Over, 3, 2, [3, 3]);

        return $xx->getWinPercent();
    }
}
