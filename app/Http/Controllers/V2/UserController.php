<?php

namespace App\Http\Controllers\V2;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where("parent_id", auth()->id())->latest()->paginate();

        return view("v2_views.users.index", ["users" => $users]);
    }

    public function create()
    {
        $max_commissions = $this->getMaxCommissions();

        return view("v2_views.users.create", ["max_commissions" => $max_commissions]);
    }

    public function store(Request $request)
    {
        $max_commissions = $this->getMaxCommissions();

        $commission_rules = [];

        foreach ($max_commissions as $key => $max_commission) {
            $commission_rules[$key] = ["required", "numeric", "max:{$max_commission}"];
        }

        $rules = array_merge([
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

        $parent = auth()->user()->parent;

        if ($parent) {
            $data['parent_id'] = $parent->id;

            $data['type'] = UserService::childUserType($request->user()->type);
        }

        User::create($data);

        return redirect()->route("admin.users.index");
    }

    public function show(User $user){
        return view("v2_views.users.show", ["user" => $user]);
    }

    public function edit(User $user)
    {
        $max_commissions = $this->getMaxCommissions();

        return view("v2_views.users.edit", ["user" => $user, "max_commissions" => $max_commissions]);
    }

    public function update(User $user, Request $request)
    {
        $max_commissions = $this->getMaxCommissions();

        $commission_rules = [];

        foreach ($max_commissions as $key => $max_commission) {
            $commission_rules[$key] = ["required", "numeric", "max:{$max_commission}"];
        }

        $password_rule = [];

        if ($request->filled("password")) {
            $password_rule = ["required", "confirmed"];
        }

        $rules = array_merge([
            'username' => ["required"],
            'phone' => ["required"],
            'max_for_mix_bet' => ["required"],
            'max_for_single_bet' => ["required"],
            'commission' => ["required", "numeric"],
            'high_commission' => ["required", "numeric"],
            'two_d_commission' => ["required", "numeric"],
            'three_d_commission' => ["required", "numeric"],
        ], $commission_rules, $password_rule);

        $data = $this->validate($request, $rules);

        $parent = auth()->user()->parent;

        if ($parent) {
            $data['parent_id'] = $parent->id;

            $data['type'] = UserService::childUserType($request->user()->type);
        }

        $user->update($data);

        return redirect()->route("admin.users.index");
    }

    private function getMaxCommissions()
    {
        $commissions = [];

        if (auth()->user()->type == UserType::Admin) {
            $max_parlay_commission = config("system.max_parlay_commission");

            for ($i = 2; $i <= 11; $i++) {
                $column = "parlay_{$i}_commission";
                $commissions[$column] = $max_parlay_commission;
            }

            $max_single_commission = config("system.max_single_commission");

            $commissions["single_commission"] = $max_single_commission;
        } else {
            $parent = auth()->user()->parent;

            for ($i = 2; $i <= 11; $i++) {
                $column = "parlay_{$i}_commission";
                $commissions[$column] = $parent->$column;
            }

            $commissions["single_commission"] = $parent->single_commission;
        }

        return $commissions;
    }
}
