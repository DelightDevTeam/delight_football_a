<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\SlipDetailResource;
use App\Http\Resources\Api\V1\SlipSummaryResource;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\Slip;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

class SlipController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get("type", 1);

        $slips = Slip::with(['bettable' => function (MorphTo $morphTo) {
            $morphTo->morphWithCount([
                Parlay::class => ["parlayBets"]
            ]);
        }])
            ->where("user_id", auth()->id())
            ->when($status, function ($q, $status) {
                if ($status == 1) {
                    $q->whereIsOngoing();
                } else {
                    $q->whereIsCalculated();
                }
            })->latest()->paginate();

        return response()->success([
            "data" => [
                "slips" => SlipSummaryResource::collection($slips)
            ]
        ]);
    }

    public function show(Slip $slip)
    {
        // $slip->load(["bettable" => function ($q) {
        //     $q->with(["fixture.league", "fixture.homeTeam", "fixture.awayTeam"]);
        // }]);

        $slip->load(['bettable' => function (MorphTo $morphTo) {
            $morphTo->morphWith([
                Single::class => ["fixture" => function ($q) {
                    $q->with(["league", "homeTeam", "awayTeam"]);
                }],
                Parlay::class => ["parlayBets" => function ($q) {
                    $q->with(["fixture" => function ($q) {
                        $q->with(["league", "homeTeam", "awayTeam"]);
                    }]);
                }],
            ]);
        }]);

        return response()->success([
            "data" => [
                "slip" => new SlipDetailResource($slip)
            ]
        ]);
    }
}
