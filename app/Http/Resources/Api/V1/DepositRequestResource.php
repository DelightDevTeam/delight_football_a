<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepositRequestResource extends JsonResource
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
            "account_name" => $this->account_name,
            "account_username" => $this->account_username,
            "amount" => $this->amount,
            "external_transaction_id" => $this->external_transaction_id,
            "payment_method" => $this->payment_method,
            "status" => $this->status
        ];
    }
}
