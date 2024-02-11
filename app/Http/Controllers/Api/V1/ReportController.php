<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TransactionName;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $transaction_by_dates = [];

        for ($i = 0; $i <= 6; $i++) {
            $day = Carbon::today("Asia/Yangon")->subDay($i)->setTime(12, 0, 0);

            $start = $day;
            $end = $day->copy()->addDay()->subMinute();

            $transactions = Transaction::where("payable_id", $request->user()->id)
                ->where("created_at", ">=", $start)
                ->where("created_at", "<=", $end)
                ->latest("id")
                ->get();

            $data = [];

            if (!count($transactions)) {
                continue;
            }

            $stake = 0;
            $payout = 0;
            $deposit = 0;
            $withdraw = 0;
            $closing_balance = 0;

            foreach ($transactions as $index => $transaction) {
                if ($index === 0) {
                    $closing_balance = ($transaction->amount + $transaction->opening_balance) / 100;
                }

                if ($transaction->name == TransactionName::Stake) {
                    $stake += $transaction->amountFloat;
                }
                if (in_array($transaction->name, [TransactionName::Payout, TransactionName::Commission, TransactionName::Refund])) {
                    $payout += $transaction->amountFloat;
                }
                if (in_array($transaction->name, [TransactionName::CreditTransfer, TransactionName::CreditAdjustment])) {
                    $deposit += $transaction->amountFloat;
                }
                if (in_array($transaction->name, [TransactionName::DebitTransfer, TransactionName::DebitAdjustment])) {
                    $withdraw += $transaction->amountFloat;
                }
            }

            $data = [
                "stake" => $stake * -1,
                "payout" => $payout,
                "deposit" => $deposit,
                "withdraw" => $withdraw * -1,
                "balance" => $closing_balance
            ];

            $transaction_by_dates[] = $data;
        }

        return response()->success([
            "data" => $transaction_by_dates
        ]);
    }
}
