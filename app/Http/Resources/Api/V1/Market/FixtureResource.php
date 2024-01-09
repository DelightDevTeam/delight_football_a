<?php

namespace App\Http\Resources\Api\V1\Market;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FixtureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "home_team" => new TeamResource($this->homeTeam),
            "away_team" => new TeamResource($this->awayTeam),
            "date_time" => $this->date_time->format("Y-m-d g:i A"),
            "market" => new MarketResource($this->latestMarket)
        ];
    }
}
