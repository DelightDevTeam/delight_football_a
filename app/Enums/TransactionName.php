<?php

namespace App\Enums;

enum TransactionName: string
{
    case SystemDeposit = 'system_deposit';
    case SystemWithdraw = 'system_withdraw';

    case Refund = "refund";
    case Bet = 'bet';
    case BetWin = 'bet_win';
    case Commission = 'commission';

    case Transfer = 'transfer';

    case Adjustment = 'adjustment';

    public function text(): string
    {
        return match ($this) {
            self::SystemDeposit => "System Deposit",
            self::SystemWithdraw => "System Withdraw",
            self::Refund => "Refund",
            self::Bet => "Betting",
            self::BetWin => "Bet Outstanding",
            self::Transfer => "Point Transfer",
            self::Commission => "Commission",
            self::Adjustment => "Adjustment",
            default  => "",
        };
    }
}
