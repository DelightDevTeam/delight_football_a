<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParlayBetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $bet_type = $this->type;

        return [
            "id" => $this->id,
            "fixture_id" => $this->fixture_id,
            "status" => $this->status,
            "home_team" => new TeamResource($this->fixture->homeTeam),
            "away_team" =>  new TeamResource($this->fixture->awayTeam),
            "handicap_team_id" => $this->handicap_team_id,
            "type" => $bet_type->value,
            "{$bet_type->value}_obj" => $this->{"{$bet_type->value}_obj"},
            "{$bet_type->value}_selected_side" => $this->{"{$bet_type->value}_selected_side"}
        ];
    }
}
