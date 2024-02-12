<?php

namespace App\Services;

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
}
