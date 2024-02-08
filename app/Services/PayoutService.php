<?php

namespace App\Services;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\Slip;
use App\Models\User;

class PayoutService
{
    protected User $admin_user;

    public function __construct(protected readonly WalletService $walletService)
    {
        $this->admin_user = User::adminUser();
    }

    public function transferPayout(Slip $slip, float $amount)
    {
        return $this->meta($slip, TransactionName::Payout);
        return $this->walletService->transfer(
            $this->admin_user,
            $slip->user,
            $amount,
            $this->meta($slip, TransactionName::Payout)
        );
    }

    public function transferCommission(Slip $slip, float $amount)
    {
        return $this->walletService->transfer(
            $this->admin_user,
            $slip->user,
            $amount,
            $this->meta($slip, TransactionName::Commission)
        );
    }

    private function meta(Slip $slip, TransactionName $transaction_name)
    {
        return [
            "name" => $transaction_name,
            "slip_id" => $slip->id,
            "from_opening_balance" => $this->admin_user->balanceFloat,
            "to_opening_balance" => $slip->user->balanceFloat,
        ];
    }
}
