<?php

namespace App\Http\Controllers\V2;

use App\Enums\TransactionName;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WalletService;
use Illuminate\Http\Request;

class TransferPointController extends Controller
{
    public function create(User $user)
    {
        return view("v2_views.transfer_points.create", ["user" => $user]);
    }

    public function store(User $user, Request $request)
    {
        $type = $request->get("type", "credit");

        if ($type == "debit") {
            $max = $user->balanceFloat;
        } else {
            $max = $request->user()->balanceFloat;
        }

        $this->validate($request, [
            "type" => ["required", "in:credit,debit"],
            "amount" => ["required", "numeric", "max:$max"],
            "note" =>  ["nullable"]
        ]);

        if ($type == "credit") {
            $from = $request->user();
            $to = $user;
        } else {
            $from = $user;
            $to = $request->user();
        }

        app(WalletService::class)->transfer($from, $to, $request->get("amount"), TransactionName::CreditTransfer, ["note" => $request->get("note")]);

        return redirect()->route("admin.transfer-logs.index");
    }
}
