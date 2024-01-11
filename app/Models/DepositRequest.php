<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\TransactionRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        "account_name",
        "account_username",
        "amount",
        "payment_method",
        "external_transaction_id",
        "status"
    ];

    protected $casts = [
        "payment_method" => PaymentMethod::class,
        "status" => TransactionRequestStatus::class,
    ];

    public function transactionRequest()
    {
        return $this->morphOne(TransactionRequest::class, 'transactionable');
    }
}
