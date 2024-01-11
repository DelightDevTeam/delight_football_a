<?php

namespace App\Http\Resources\Api\v1;

use App\Models\DepositRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionRequestResource extends JsonResource
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
            "transactionable_type" => $this->transactionable_type,
            "transactionable" => $this->transactionable instanceof DepositRequest ? new DepositRequestResource($this->transactionable) : new WithdrawRequestResource($this->transactionable),
            "updated_at" => $this->updated_at,
        ];
    }
}
