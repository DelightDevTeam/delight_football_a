<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Bavix\Wallet\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $id = auth()->id();

        $transfers = Transfer::with(["from.holder", "to.holder", "withdraw", "deposit"])
            ->where("from_id", $id)
            ->orWhere("to_id", $id)
            ->where(function ($q) use ($request) {
                $q->where("created_at", ">", $request->get("from", now()->startOfDay()));
                $q->where("created_at", "<=", $request->get("to", now()->endOfDay()));
            })
            ->paginate();

        // TODO: filter
        // TODO: pagination

        return view('v2_views.transfers.index', ["transfers" => $transfers]);
    }
}
