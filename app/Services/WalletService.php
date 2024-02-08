<?php

namespace App\Services;

use App\Enums\TransactionName;
use App\Models\User;
use Bavix\Wallet\Models\Transaction;

class WalletService
{
    public function forceTransfer(User $from, User $to, float $amount, array $meta=[])
    {
        $transfer = $from->forceTransferFloat($to, $amount, $meta);
    }

    public function transfer(User $from, User $to, float $amount, array $meta=[])
    {
        $from->forceTransferFloat($to, $amount, $meta);
    }

    public function deposit(User $user, float $amount, array $meta=[])
    {
        $user->depositFloat($amount, $meta);
    }
}
