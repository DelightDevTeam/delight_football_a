<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\FinicalReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WinLoseReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $from = $request->get("from", Carbon::today("Asia/Yangon")->subDay());
        $to = $request->get("to", Carbon::today("Asia/Yangon"));

        return FinicalReport::where("user_id", $request->user()->id)
        ->where("date", ">=", $from)
        ->where("date", "<=", $to)
        ->paginate();
    }
}
