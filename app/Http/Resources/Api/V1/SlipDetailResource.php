<?php

namespace App\Http\Resources\Api\V1;

use App\Enums\SlipType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlipDetailResource extends JsonResource
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
            "uuid" => substr($this->uuid, -6),
            "bettable_type" => $this->bettable_type,
            "bettable" => $this->bettable_type == SlipType::Single ? new SingleResource($this->bettable) : new ParlayResource($this->bettable)
        ];
    }
}
