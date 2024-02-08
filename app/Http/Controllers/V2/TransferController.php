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
            ->where(function($q) use($id){
                $q->where("from_id", $id);
                $q->orWhere("to_id", $id);
            })
            ->whereDate("created_at", ">=", $request->get("from", now()->startOfDay()->format("Y-m-d")))
            ->whereDate("created_at", "<=", $request->get("to", now()->endOfDay()->format("Y-m-d")))
            ->paginate();

        // TODO: remove end user frontend
        // TODO: pagination

        return view('v2_views.transfers.index', ["transfers" => $transfers]);
    }
}
