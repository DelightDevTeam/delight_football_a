<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Market\LeagueResource;
use App\Services\MarketService;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = MarketService::ignoreTime()->getMarkets();

        return response()->success([
            "data" => LeagueResource::collection($data)
        ]);
    }
}
