<?php

namespace App\Enums;

enum TransactionName: string
{
    case CapitalDeposit = "capital_deposit";

    case Stake = 'payout';
    case Payout = 'bet_win';
    case Commission = 'commission';
    case Refund = "refund";

    case CreditTransfer = 'credit_transfer';
    case DebitTransfer = 'debit_transfer';

    case CreditAdjustment = 'credit_adjustment';
    case DebitAdjustment = 'debit_adjustment';
}
