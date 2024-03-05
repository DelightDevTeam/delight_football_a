<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use App\Models\FinicalReport;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WinLoseReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $from = $request->get("from", Carbon::today("Asia/Yangon")->subDay());
        $to = $request->get("to", Carbon::today("Asia/Yangon"));

        $user = $request->user();

        $child_user_type = UserService::childUserType($user->type);

        $reports = FinicalReport::with("user")
            ->whereIn('user_id', User::where('parent_id', $user->id)->select('id'))
            ->where("date", ">=", $from)
            ->where("date", "<=", $to)
            ->paginate();

        return view('v2_views.win_lose.index', compact('reports'));
    }
}
