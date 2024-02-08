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
            "uuid" => $this->uuid,
            "amount" => $this->amount,
            "bettable_type" => $this->bettable_type,
            "parlay_bets_count" => $this->bettable->parlay_bets_count,
            "payout" => $this->bettable->payout,
            "status" => $this->bettable->status,
            "created_at" => $this->created_at->format("Y-m-d g:i A")
        ];
    }
}
