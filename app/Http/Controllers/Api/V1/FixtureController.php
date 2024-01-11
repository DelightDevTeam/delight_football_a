<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LeagueResource;
use App\Models\League;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function __invoke(Request $request)
    {
        $now = now();

        if ($request->get("type", 1) == 1) {
            $from = $now->clone()->startOfDay()->setTimezone("Asia/Yangon");
            $to = $now->clone()->endOfDay()->setTimezone("Asia/Yangon");
        } else {
            $from = $now->clone()->subDay()->startOfDay()->setTimezone("Asia/Yangon");
            $to = $now->clone()->subDay()->endOfDay()->setTimezone("Asia/Yangon");
        }

        $leagues = League::whereHas('fixtures', function ($q) use ($from, $to) {
            $q->has("markets");

            $q->whereBetween('date_time', [$from, $to]);
        })
            ->with(['fixtures' => function ($q) use ($from, $to) {

                $q->whereBetween('date_time', [$from, $to]);

                $q->with([
                    "homeTeam",
                    "awayTeam",
                ]);

                $q->orderBy("date_time");
                $q->orderBy("id");
            }])
            ->orderBy("name")
            ->get();

        return response()->success([
            "data" => [
                'leagues' => LeagueResource::collection($leagues)
            ]
        ]);
    }
}
