<?php

namespace App\Http\Controllers\Admin\Agent;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\Admin\TwodWiner;
use App\Http\Controllers\Controller;

class GetEarlyMorning2DPlayUserByAgentController extends Controller
{
    public function playEarlyMorning()
{
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        // Return an error or a message that today is not a playing day
        return redirect()->back()->with('error', 'Today is not a playing day.');
    }
    $userId = auth()->id(); // ID of the master user

    // Retrieve agents created by this master user
    $agentIds = User::where('agent_id', $userId)->pluck('id');

    // Retrieve lotteries played by these agents in the early morning
    $lotteries = Lottery::whereIn('user_id', $agentIds)
                        ->with(['twoDigitsEarlyMorning', 'user'])
                        ->whereHas('lotteryMatch') // Assuming lotteryMatch is a relationship
                        ->get();    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(6), Carbon::now()->startOfDay()->addHours(10)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.agent.early_morning_play_digit', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}

public function playMorning()
{
   $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        // Return an error or a message that today is not a playing day
        return redirect()->back()->with('error', 'Today is not a playing day.');
    }
    $userId = auth()->id(); // ID of the master user

    // Retrieve agents created by this master user
    $agentIds = User::where('agent_id', $userId)->pluck('id');

    // Retrieve lotteries played by these agents in the early morning
    $lotteries = Lottery::whereIn('user_id', $agentIds)
                        ->with(['twoDigitsMorning', 'user'])
                        ->whereHas('lotteryMatch') // Assuming lotteryMatch is a relationship
                        ->get();    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(10), Carbon::now()->startOfDay()->addHours(13)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.agent.morning_play_digit', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}

public function playEarlyEvening()
{
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        // Return an error or a message that today is not a playing day
        return redirect()->back()->with('error', 'Today is not a playing day.');
    }
    $userId = auth()->id(); // ID of the master user

    // Retrieve agents created by this master user
    $agentIds = User::where('agent_id', $userId)->pluck('id');

    // Retrieve lotteries played by these agents in the early morning
    $lotteries = Lottery::whereIn('user_id', $agentIds)
                        ->with(['twoDigitsEarlyEvening', 'user'])
                        ->whereHas('lotteryMatch') // Assuming lotteryMatch is a relationship
                        ->get();    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(14)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.agent.early_evening_play_digit', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}

public function playEvening()
{
    $playDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    if (!in_array(strtolower(date('l')), $playDays)) {
        // Return an error or a message that today is not a playing day
        return redirect()->back()->with('error', 'Today is not a playing day.');
    }
    $userId = auth()->id(); // ID of the master user

    // Retrieve agents created by this master user
    $agentIds = User::where('agent_id', $userId)->pluck('id');

    // Retrieve lotteries played by these agents in the early morning
    $lotteries = Lottery::whereIn('user_id', $agentIds)
                        ->with(['twoDigitsEvening', 'user'])
                        ->whereHas('lotteryMatch') // Assuming lotteryMatch is a relationship
                        ->get();    $prize_no_morning = TwodWiner::whereDate('created_at', Carbon::today())
                                  ->whereBetween('created_at', [Carbon::now()->startOfDay()->addHours(12), Carbon::now()->startOfDay()->addHours(14)])
                                  ->orderBy('id', 'desc')
                                  ->first();

    $prize_no = TwodWiner::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();

    // Pass the retrieved data to the view
    return view('admin.agent.evening_play_digit', [
        'lotteries' => $lotteries,
        'prize_no' => $prize_no,
        'prize_no_morning' => $prize_no_morning
    ]);
}


}