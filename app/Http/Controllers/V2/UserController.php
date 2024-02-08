<?php

namespace App\Http\Controllers\V2;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $commission_rules = [];

        $max_single_commission = 1;

        if (request()->user()->type == UserType::Admin) {
            $max_parlay_commission = config("system.max_parlay_commission");

            for ($i = 2; $i <= 11; $i++) {
                $column = "parlay_{$i}_commission";
                $commission_rules[$column] = ["required", "numeric", "max:{$max_parlay_commission}"];
            }

            $max_single_commission = config("system.max_single_commission");

            $commission_rules["single_commission"] = ["required", "numeric", "max:{$max_single_commission}"];
        } else {
            $parent = request()->user()->parent;

            for ($i = 2; $i <= 11; $i++) {
                $column = "parlay_{$i}_commission";
                $commission_rules[$column] = ["required", "numeric", "max:{$parent->$column}"];
            }

            $commission_rules["single_commission"] = ["required", "numeric", "max:{$parent->single_commission}"];
        }

        $rules = array_merge([
            'name' => ["required"],
            'username' => ["required"],
            'password' => ["required", "confirmed"],
            'phone' => ["required"],
            'max_for_mix_bet' => ["required"],
            'max_for_single_bet' => ["required"],
            'commission' => ["required", "numeric"],
            'high_commission' => ["required", "numeric"],
            'two_d_commission' => ["required", "numeric"],
            'three_d_commission' => ["required", "numeric"],
        ], $commission_rules);

        $data = $this->validate($request, $rules);

        if ($parent) {
            $data['parent_id'] = $parent->id;

            $data['type'] = UserService::childUserType($request->user()->type);
        }

        User::create($data);
    }
}
