<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\User;
use App\Models\UserHierarchy;

class UserService
{
    public static function adminUser()
    {
        return User::where("type", UserType::Admin)->first();
    }

    public static function getUserHierarchy(User $user)
    {
        $hierarchy = UserHierarchy::with("parent")
            ->orderBy("rank_point")
            ->where('user_id', $user->id)
            ->get();

        $data = [];

        foreach ($hierarchy as $user) {
            $data[$user->type->rankPoint()] = $user->parent;
        }

        return $data;
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
