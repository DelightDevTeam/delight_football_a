<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlipSummaryResource extends JsonResource
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
            "amount" => $this->amount,
            "uuid" => substr($this->uuid, -6),
            "bettable_type" => $this->bettable_type,
            "parlay_bets_count" => $this->bettable->parlay_bets_count,
            "payout" => $this->bettable->payout,
            "status" => $this->bettable->status,
        ];
    }
}
