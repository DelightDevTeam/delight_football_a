<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Market\LeagueResource;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use App\Services\MarketService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = MarketService::ignoreTime()->getMarkets();

        return response()->success([
            "data" => LeagueResource::collection($data)
        ]);
    }
}
