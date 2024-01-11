<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\TransactionRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "uuid",
    ];

    public function transactionable()
    {
        return $this->morphTo('transactionable');
    }
}
