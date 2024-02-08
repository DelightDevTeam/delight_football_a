<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\Transter\TransferLog;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::where('agent_id', Auth::user()->id)->get();
        $masterId = auth()->id(); // ID of the master user
        $master = User::findOrFail($masterId);
        // Retrieve all agents created by this master
        // $users = $master->createdAgents;
        $users = User::where('agent_id', $masterId)->latest()->get();
        return view('admin.master.agent_list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.agent_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone'],
            'password' => 'required|min:6|confirmed',
        ]);
        $this->authorize('createMaster', User::class);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => '0',
            //'role' => "Agent",
            'agent_id' => Auth::user()->id,
            'max_for_mix_bet' => $request->max_for_mix_bet,
            'max_for_single_bet' => $request->max_for_single_bet,
            'commission' => $request->commission,
            'high_commission' => $request->high_commission,
            'two_d_commission' => $request->two_d_commission,
            'three_d_commission' => $request->three_d_commission,
            'parlay_2_commission' => $request->parlay_2_commission,
            'parlay_3_commission' => $request->parlay_3_commission,
            'parlay_4_commission' => $request->parlay_4_commission,
            'parlay_5_commission' => $request->parlay_5_commission,
            'parlay_6_commission' => $request->parlay_6_commission,
            'parlay_7_commission' => $request->parlay_7_commission,
            'parlay_8_commission' => $request->parlay_8_commission,
            'parlay_9_commission' => $request->parlay_9_commission,
            'parlay_10_commission' => $request->parlay_10_commission,
            'parlay_11_commission' => $request->parlay_11_commission,
        ]);
        //$user->roles()->sync('3');
        $agentRole = Role::where('title', 'Agent')->first();
        $user->roles()->sync($agentRole->id);
        return redirect(route('admin.agent-list'))->with('success', 'Master has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user_detail = User::find($id);
        return view('admin.master.agent_show', compact('user_detail'));
    }
    public function transfer(string $id)
    {
        $transfer_user = User::find($id);
        return view('admin.master.agent_transfer', compact('transfer_user'));
    }
    public function transferCashOut(string $id)
    {
        // Assuming $id is the user ID
        $transfer_user = User::findOrFail($id);

        // Assuming you want to find transfer logs related to the user
        $transfer_logs = TransferLog::where('from_user_id', $id)
            ->orWhere('to_user_id', $id)
            ->get();
        $logs = TransferLog::where('from_user_id', $id)
            ->orWhere('to_user_id', $id)
            ->orderBy('created_at', 'desc')->first();

        return view('admin.master.agent_cash_out', compact('transfer_user', 'transfer_logs', 'logs'));
    }

    public function AgenttransferStore(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'cash_in' => 'required|numeric',
        ]);
        if ($request->cash_in > Auth::user()->balance) {
            session()->flash('error', 'You do not have enough balance to transfer!');
            return redirect()->back()->with('error', 'You do not have enough balance to transfer!');
        }

        // Create a new TransferLog record
        $transfer_master = new TransferLog();
        $transfer_master->name = $request->name;
        $transfer_master->phone = $request->phone;
        $transfer_master->cash_in = $request->cash_in;
        $transfer_master->cash_balance = 0;
        $transfer_master->from_user_id = $request->from_user_id;
        $transfer_master->to_user_id = $request->to_user_id;
        $transfer_master->note = $request->note;
        $transfer_master->save();

        // Update user balance
        $user = User::find($request->to_user_id);
        $user->balance += $request->cash_in;
        $user->save();

        // Update cash_balance in TransferLog with the new user balance
        $transfer_master->cash_balance = $user->balance;
        $transfer_master->save();
        session()->flash('success', 'Money transfer request submitted successfully!');
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }

    public function AgentCashOutStore(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'cash_out' => 'required|numeric',
        ]);
        //dd($id);
        $cash_balance_data = $request->cash_balance;
        $cash_out_data = $request->cash_out;
        $cash_out_money = $cash_balance_data - $cash_out_data;

        $transfer_master = TransferLog::findOrFail($id);
        $transfer_master->name = $request->name;
        $transfer_master->phone = $request->phone;
        $transfer_master->cash_out = $request->cash_out;
        $transfer_master->cash_balance = $cash_out_money;
        $transfer_master->from_user_id = $request->from_user_id;
        $transfer_master->to_user_id = $request->to_user_id;
        $transfer_master->note = $request->note;
        $transfer_master->save();

        // user balance update
        $admin = User::find($request->from_user_id);
        $admin->balance += $request->cash_out; // Subtract cash_out from the balance of the from_user
        $admin->save();

        $master = User::find($request->to_user_id);
        $master->balance -= $request->cash_out; // Add cash_out to the balance of the to_user
        $master->save();


        // Redirect back with a success message
        session()->flash('success', 'Money transfer request submitted successfully!');
        return redirect()->back()->with('success', 'Money fill request submitted successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.master.agent_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone,' . $id],
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->agent_id = Auth::user()->id;
        //$user->roles()->sync('3');
        $agentRole = Role::where('title', 'Agent')->first();
        $user->roles()->sync($agentRole->id);
        $user->max_for_mix_bet = $request->max_for_mix_bet;
        $user->max_for_single_bet = $request->max_for_single_bet;
        $user->commission = $request->commission;
        $user->high_commission = $request->high_commission;
        $user->two_d_commission = $request->two_d_commission;
        $user->three_d_commission = $request->three_d_commission;
        $user->parlay_2_commission = $request->parlay_2_commission;
        $user->parlay_3_commission = $request->parlay_3_commission;
        $user->parlay_4_commission = $request->parlay_4_commission;
        $user->parlay_5_commission = $request->parlay_5_commission;
        $user->parlay_6_commission = $request->parlay_6_commission;
        $user->parlay_7_commission = $request->parlay_7_commission;
        $user->parlay_8_commission = $request->parlay_8_commission;
        $user->parlay_9_commission = $request->parlay_9_commission;
        $user->parlay_10_commission = $request->parlay_10_commission;
        $user->parlay_11_commission = $request->parlay_11_commission;
        $user->save();
        return redirect(route('admin.agent-list'))->with('success', 'Master has been updated successfully.');
    }

    //     public function update(Request $request, string $id)
    //     {
    //         $request->validate([
    //     'name' => 'required|min:3|unique:users,name,'.$id,
    //     'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'unique:users,phone,'.$id],
    //     'password' => 'nullable|min:6|confirmed',
    // ]);

    //         $user = User::find($id);
    //         $user->name = $request->name;
    //         $user->phone = $request->phone;

    //         if($request->password){
    //             $user->password = Hash::make( $request->password );
    //         }
    //         $user->agent_id = Auth::user()->id;
    //         $user->roles()->sync('3');
    //         $user->save();
    //         return redirect(route('admin.agent-list'))->with('success','Agent has been updated successfully.');
    //     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect(route('admin.agent-list'))->with('success', 'Agent has been deleted successfully.');
    }
}
