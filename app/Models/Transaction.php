<?php

namespace App\Models;

use App\Enums\TransactionName;
use Bavix\Wallet\Models\Transaction as BavixTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends BavixTransaction
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'wallet_id' => 'int',
        'confirmed' => 'bool',
        'meta' => 'json',
        'name' => TransactionName::class
    ];
}
