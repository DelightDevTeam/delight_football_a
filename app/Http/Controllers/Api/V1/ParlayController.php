<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ParlayStoreRequest;
use App\Http\Resources\Api\V1\SlipResource;
use App\Models\Parlay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParlayController extends Controller
{
    public function __invoke(ParlayStoreRequest $request)
    {
        $parlay = Parlay::create([
            "user_id" => $request->user()->id,
            "amount" => $request->validated("amount"),
            // TODO
            // "possible_payout" => $eee,
        ]);

        foreach ($request->bets() as $bet) {
            $market = $bet["market"];

            $type = $bet["type"];

            $parlay->parlayBets()->create([
                "user_id" => $request->user()->id,
                "league_id" => $market->league_id,
                "fixture_id" => $market->fixture_id,
                "market_id" => $market->id,
                "type" => $bet["type"],
                "{$type}_obj" => [
                    "handicap" => $market->$type,
                    "odd" => $market->{"{$type}_odd"}
                ],
                "{$type}_selected_side" => $bet["selected_side"]
            ]);
        }

        $slip = $parlay->slip()->create([
            "uuid" => Str::uuid(),
            "user_id" => $request->user()->id,
            "amount" => $request->validated("amount")
        ]);

        return response()->success([
            "data" => [
                "slip" => new SlipResource($slip)
            ]
        ]);
    }
}
