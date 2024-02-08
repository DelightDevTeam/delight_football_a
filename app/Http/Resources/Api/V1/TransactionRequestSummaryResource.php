<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionRequestSummaryResource extends JsonResource
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
            "amount" => $this->transactionable->amount,
            "payment_method" => $this->transactionable->payment_method,
            "status" => $this->transactionable->status,
            "updated_at" => $this->updated_at,
        ];
    }
}
