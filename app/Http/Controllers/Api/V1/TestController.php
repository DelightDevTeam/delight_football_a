<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OuSelectableSide;
use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\Slip;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Calculation\CalculateCommissionService;
use App\Services\Calculation\CalculateSingleBetService;
use App\Services\PayoutService;
use App\Services\UserService;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
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

            if (count($transactions)) {
                $stake = 0;
                $payout = 0;
                $deposit = 0;
                $withdraw = 0;
                $closing_balance = 0;

                foreach ($transactions as $index => $transaction) {
                    if($index === 0){
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
            }

            $transaction_by_dates[] = $data;
        }

        $day = Carbon::today("Asia/Yangon")->setTime(12, 0, 0);

        if (Carbon::now()->lt($day)) {
            $day->subDay();
        }

        $start = $day->toDateTimeString();
        $end = $day->copy()->addDay()->toDateTimeString();

        return [$start, $end];

        $now = now()->setTimezone("Pacific/Wake");

        $xx = Transaction::where("payable_id", $request->user()->id)->get();

        return $xx;

        return UserService::childUserType(UserType::User)->value;

        return (new WalletService)->transfer(User::find(1), User::find(1), 100, TransactionName::CreditTransfer);
        $slip = Slip::find(1);
        $single = $slip->bettable;

        $commission_percents = CalculateCommissionService::getCommissionPercents($single->commission_setting_obj);

        $commission_amounts = CalculateCommissionService::calcCommissionAmounts(
            $commission_percents,
            $single->amount
        );

        CalculateCommissionService::transfer($slip, $commission_amounts);
    }
}
