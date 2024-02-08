<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OuSelectableSide;
use App\Enums\TransactionName;
use App\Http\Controllers\Controller;
use App\Models\Slip;
use App\Models\User;
use App\Services\Calculation\CalculateCommissionService;
use App\Services\Calculation\CalculateSingleBetService;
use App\Services\PayoutService;
use App\Services\WalletService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
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
