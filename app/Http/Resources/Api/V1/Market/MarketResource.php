<?php

namespace App\Http\Resources\Api\V1\Market;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketResource extends JsonResource
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
            "upper_team_id" => $this->upper_team_id,
            "lower_team_id" => $this->lower_team_id,
            "handicap_team_id" => $this->handicap_team_id,
            "ab" => $this->ab, // TODO: + -
            "ou" => $this->ou, // TODO: + -
        ];
    }
}
