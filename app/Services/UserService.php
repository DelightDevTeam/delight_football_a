<?php

namespace App\Services;

use App\Enums\BetType;
use App\Enums\SlipType;
use App\Enums\UserType;
use App\Models\User;

class UserService
{
    public static function adminUser()
    {
        return User::where("type", UserType::Admin)->first();
    }

    public static function getUserHierarchy(User $user)
    {
        $agent = $user->parent()->first();
        $master = $agent->parent()->first();
        $admin = $master->parent()->first();

        return [
            UserType::Admin->rankPoint() => $admin,
            UserType::Master->rankPoint() => $master,
            UserType::Agent->rankPoint() => $agent,
            UserType::User->rankPoint() => $user,
        ];
    }

    public static function childUserType(UserType $current_user_type)
    {
        $user_types = [];

        foreach (UserType::cases() as $user_type) {
            $user_types[$user_type->rankPoint()] = $user_type;
        }

        return nearestLargerNumber($current_user_type->rankPoint(), $user_types);
    }

    public static function getCommissionSettings(SlipType $slip_type, array $hierarchy, int $parlay_count = 0)
    {
        $data = [];
        foreach ($hierarchy as $key => $user) {
            if ($slip_type == SlipType::Single) {
                $data[$key] = $user->single_commission;
            } else {
                $data[$key] = $user->{self::parlayCommissionName($parlay_count)};
            }
        }

        return $data;
    }

    public static function parlayCommissionName(int $parlay_count)
    {
        return "parlay_{$parlay_count}_commission";
    }
}
