<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\AbSelectableSide;
use App\Enums\BetStatus;
use App\Enums\BetType;
use App\Enums\OuSelectableSide;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ParlayStoreRequest;
use App\Http\Requests\Api\V1\SingleStoreRequest;
use App\Http\Resources\Api\V1\SlipResource;
use App\Models\Market;
use App\Models\Parlay;
use App\Models\ParlayBet;
use App\Models\Single;
use App\Models\Slip;
use App\Models\User;
use Illuminate\Support\Str;

class BetController extends Controller
{
    public function storeSingle(SingleStoreRequest $request)
    {
        $bet = $request->bet();

        $user = $request->user();
        $market = $bet["market"];
        $bet_type = $bet["type"];
        $selected_side = $bet["selected_side"];

        $single = Single::create([
            ...["amount" => $request->validated("amount")],
            ...$this->getBaseDataForBet($user, $market, $bet_type, $selected_side)
        ]);

        $slip = $this->storeSlip($single);

        return response()->success([
            "data" => [
                "slip" => new SlipResource($slip)
            ]
        ]);
    }

    public function confirmSingle(Slip $slip)
    {
        if (!$slip->isPending()) {
            return response()->error([
                "message" => "Slip can't confirm twice",
            ], 422);
        }

        $slip->load("bettable");

        if (!$this->validateMarketData($slip->bettable)) {
            return response()->error([
                "message" => "Market has been changed",
            ], 422);
        };

        $slip->bettable()->update([
            "status" => BetStatus::Ongoing
        ]);

        $slip->update([
            "status" => BetStatus::Ongoing
        ]);

        return response()->success([
            "data" => [
                "slip" => new SlipResource($slip)
            ]
        ]);
    }

    public function storeParlay(ParlayStoreRequest $request)
    {
        // TODO: possible_payout

        $parlay = Parlay::create([
            "user_id" => $request->user()->id,
            "amount" => $request->validated("amount"),
        ]);

        $user = $request->user();

        foreach ($request->bets() as $bet) {
            $market = $bet["market"];
            $bet_type = $bet["type"];
            $selected_side = $bet["selected_side"];

            $parlay->parlayBets()->create($this->getBaseDataForBet($user, $market, $bet_type, $selected_side));
        }

        $slip = $this->storeSlip($parlay);

        return response()->success([
            "data" => [
                "slip" => new SlipResource($slip)
            ]
        ]);
    }

    public function confirmParlay(Slip $slip)
    {
        if (!$slip->isPending()) {
            return response()->error([
                "message" => "Slip can't confirm twice",
            ], 422);
        }

        $slip->load("bettable.parlayBets");

        foreach ($slip->bettable->parlayBets as $bet) {
            if (!$this->validateMarketData($bet)) {
                return response()->error([
                    "message" => "Market has been changed",
                ], 422);
            };
        }

        $slip->bettable->parlayBets()->update([
            "status" => BetStatus::Ongoing
        ]);

        $slip->update([
            "status" => BetStatus::Ongoing
        ]);

        return response()->success([
            "data" => [
                "slip" => new SlipResource($slip)
            ]
        ]);
    }

    protected function storeSlip(Single | Parlay $bet)
    {
        return $bet->slip()->create([
            "uuid" => Str::uuid(),
            "user_id" => $bet->user_id,
            "amount" => $bet->amount
        ]);
    }

    protected function getBaseDataForBet(User $user, Market $market, BetType $bet_type, AbSelectableSide | OuSelectableSide $selected_side)
    {
        $fixture = $market->fixture;

        $upper_team_id = $fixture->home_team_id == $market->upper_team_id ? $fixture->home_team_id : $fixture->away_team_id;
        $lower_team_id = $fixture->home_team_id == $market->upper_team_id ? $fixture->away_team_id : $fixture->home_team_id;

        return [
            "user_id" => $user->id,
            "league_id" => $market->league_id,
            "fixture_id" => $market->fixture_id,
            "market_id" => $market->id,
            "type" => $bet_type->value,
            "{$bet_type->value}_obj" => [
                "handicap" => $market->{$bet_type->value},
                "odd" => $market->{"{$bet_type->value}_odd"}
            ],
            "home_team_id" => $fixture->home_team_id,
            "away_team_id" => $fixture->away_team_id,
            "upper_team_id" => $upper_team_id,
            "lower_team_id" => $lower_team_id,
            "{$bet_type->value}_selected_side" => $selected_side
        ];
    }

    private function validateMarketData(Single | ParlayBet $single_bet)
    {
        $market = $single_bet->load("market");

        if (!$market) {
            return false;
        }

        $now = now();

        if ($market->created_at->gt($now) && $market->created_at->diffInMinutes($now) > 3) {
            return false;
        }

        return true;
    }
}
