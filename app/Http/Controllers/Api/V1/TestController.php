<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\AbSelectableSide;
use App\Enums\OuSelectableSide;
use App\Enums\TransactionName;
use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Parlay;
use App\Models\Single;
use App\Models\Slip;
use App\Models\User;
use App\Services\Calculation\CalculateParlayBetService;
use App\Services\Calculation\CalculateParlayService;
use App\Services\Calculation\CalculateSingleBetService;
use App\Services\Calculation\CalculateSingleService;
use App\Services\MarketService;
use App\Services\PayoutService;
use App\Services\WalletService;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        $admin = User::create($hierarchy->except(["children"])->toArray());

        foreach ($hierarchy["children"] as $master) {
            dd($master);
            $master = $admin->children()->create($master->except("children")->toArray());

            foreach ($master["children"] as $agent) {
                $agent = $master->children()->create($agent->except("children")->toArray());

                foreach ($master["children"] as $user) {
                    $agent->children()->create($user);
                }
            }
        }

        $payout = app(PayoutService::class);

        return $payout->transferPayout(Slip::find(1), 100);
        return User::find(2)->balanceFloat;
        // return (new WalletService(User::find(1)))->deposit(1000, TransactionName::CapitalDeposit);
        $commissoin_amount = 1000;

        return (new WalletService())->forceTransfer(User::find(1), User::find(2), $commissoin_amount, []);
        $xx = new CalculateSingleBetService(OuSelectableSide::Over, 3, 2, [3, 3]);

        return $xx->getWinPercent();
    }
}
