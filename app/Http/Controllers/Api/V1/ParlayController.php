<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BetStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ParlayConfirmRequest;
use App\Http\Requests\Api\V1\ParlayStoreRequest;
use App\Http\Resources\Api\V1\SlipResource;
use App\Models\Parlay;
use App\Models\ParlayBet;
use App\Models\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// TODO: make common controller for single bet
class ParlayController extends Controller
{
    public function store(ParlayStoreRequest $request)
    {
        // TODO: possible_payout

        $parlay = Parlay::create([
            "user_id" => $request->user()->id,
            "amount" => $request->validated("amount"),
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

    public function confirm(Slip $slip){
        if(!$slip->isPending()){
            return response()->error([
                "message" => "Slip can't confirm twice",
            ], 422);
        }

        $slip->load("bettable.parlayBets");

            foreach($slip->bettable->parlayBets as $bet){
                if(!$this->validateMarketData($bet)){
                    return response()->error([
                        "message" => "Market has been changed",
                    ], 422);
                };

                $slip->update([
                    "status" => BetStatus::Ongoing
                ]);
            }

            return response()->success([
                "data" => [
                    "slip" => new SlipResource($slip)
                ]
                ]);
    }

    private function validateMarketData(ParlayBet $bet){
        $market = $bet->load("market");
        
        if(!$market){
            return false;
        }

        $now = now();

        if($market->created_at->gt($now) && $market->created_at->diffInMinutes($now) > 3){
            return false;
        }

        return true;
    }
}
