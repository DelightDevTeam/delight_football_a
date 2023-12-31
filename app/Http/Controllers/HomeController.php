<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin\Game;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use App\Models\Admin\BannerText;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            return view('admin.profile.admin_profile');
        } elseif (auth()->user()->hasRole('Master')) {
        $agents = User::where('agent_id', Auth::user()->id)->count();

            return view('admin.master.master_dashboard', compact('agents'));
        } elseif (auth()->user()->hasRole('Agent')) {
        $userId = auth()->id(); // ID of the master user
        // Retrieve agents created by this master user
        $agentIds = User::where('agent_id', $userId)->pluck('id');
            return view('admin.agent.agent_dashboard', compact('agentIds'));
        } else {
            $banners = Banner::latest()->take(3)->get();
            $games = Game::latest()->get();
            $marqueeText = BannerText::latest()->first();
            return view('welcome', compact('banners', 'games', 'marqueeText'));
        }
    }

    public function profile(){
        $userId = auth()->id(); // Get logged in user's ID
        $user = User::find($userId); // Retrieve user by ID
        return view('frontend.auth.profile');
    }
}