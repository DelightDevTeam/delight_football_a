<?php

namespace App\Services\Calculation;

use App\Enums\TransactionName;
use App\Enums\UserType;
use App\Models\Slip;
use App\Models\User;
use App\Services\PayoutService;
use App\Services\UserService;
use Illuminate\Support\Arr;

class CalculateCommissionService
{
    public static function getCommissionPercents(array $settings)
    {
        $admin_commission = $settings[UserType::Admin->rankPoint()];
        $master_commission = $settings[UserType::Master->rankPoint()];
        $agent_commission = $settings[UserType::Agent->rankPoint()];
        $user_commission = $settings[UserType::User->rankPoint()];

        return [
            UserType::Admin->rankPoint() => subtractBetweenTwoDecimalFloats($admin_commission, $master_commission),
            UserType::Master->rankPoint() => subtractBetweenTwoDecimalFloats($master_commission, $agent_commission),
            UserType::Agent->rankPoint() => subtractBetweenTwoDecimalFloats($agent_commission, $user_commission),
            UserType::User->rankPoint() => $user_commission,
        ];
    }

    public static function calcCommissionAmounts(array $percents, float $amount)
    {
        $data = [];
        foreach ($percents as $key => $percent) {
            $data[$key] = number_format((float) ($amount * ($percent / 100)), 2, '.', '');
        }

        return $data;
    }

    public static function transfer(Slip $slip, array $amounts,)
    {
        $hierarchy = UserService::getUserHierarchy($slip->user);

        foreach ($hierarchy as $key => $user) {
            $transfer_amount = Arr::get($amounts, $key);

            if ($transfer_amount != 0) {
                $payout = app(PayoutService::class);

                $payout->transferCommission($user, $slip, $transfer_amount);
            }
        }
    }
}
