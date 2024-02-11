<?php

namespace App\Models;

use Bavix\Wallet\Models\Transfer as BavixTransfer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends BavixTransfer
{
    /**
     * @return BelongsTo<Wallet, self>
     */
    public function from(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'from_id');
    }

    /**
     * @return BelongsTo<Wallet, self>
     */
    public function to(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'to_id');
    }

    /**
     * @return BelongsTo<Transaction, self>
     */
    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'deposit_id');
    }

    /**
     * @return BelongsTo<Transaction, self>
     */
    public function withdraw(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'withdraw_id');
    }
}
