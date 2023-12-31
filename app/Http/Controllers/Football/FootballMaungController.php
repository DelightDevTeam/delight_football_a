<?php

namespace App\Http\Controllers\Football;

use Exception;
use PDOException;
use App\Models\Football\Odds;
use App\Models\Football\MMBet;
use App\Models\FootballA\siaBet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Football\MixBet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FootballMaungController extends Controller
{
    public function footballMaung()
    {
        $oddData = DB::table('odds')->where('status',1)->where('money_line_h','>',0)->where('money_line_a','>',0)->where('spreads_h','>',0)->where('spreads_a','>',0)->where('totals_point','>',0)->orderBy('starts')->orderBy('league_name')->get();

        return view('football.maung.index')->with(['oddData' => $oddData]);
    }
    // public function footballMaung()
    // {
    //     $oddData = Odd::where('status', 1)
    //         ->where('money_line_h', '>', 0)
    //         ->where('money_line_a', '>', 0)
    //         ->where('spreads_h', '>', 0)
    //         ->where('spreads_a', '>', 0)
    //         ->where('totals_point', '>', 0)
    //         ->orderBy('starts')
    //         ->orderBy('league_name')
    //         ->get();

    //     return view('football.maung')->with(['oddData' => $oddData]);
    // }

    public function mixparlayBet(Request $requestData)
    {
        $user = Auth::user();
        if ($user != null) {


            $user->balance -= $requestData->amount;

            if ($user->balance < 0) {
                return response()->json(array('resCode' => (int)'999', 'resDesc' => 'ယူနစ်မလောက်ပါသဖြင့် ဖြည့်သွင်းပေးပါ။'));
            }
            $mixparlay = array();
            $voucher_id = Carbon::now()->format('Y') . Carbon::now()->format('m') . Carbon::now()->format('d') . '_f_' . str_pad(random_int(99, 999), 3, "0", STR_PAD_LEFT);
            $user->balance -= $requestData->amount;

            if ($user->balance < 0) {
                return response()->json(array('resCode' => (int)'999', 'resDesc' => 'ယူနစ်မလောက်ပါသဖြင့် ဖြည့်သွင်းပေးပါ။'));
            }
            foreach ($requestData['values'] as $mixbet) {

                $mix = new MixBet();
                $mix->odd_id = $mixbet['odd_id'];
                $mix->voucher_id = $voucher_id;
                $mix->league_name = $mixbet['league_name'];
                $mix->home = $mixbet['home'];
                $mix->away = $mixbet['away'];
                $mix->bet = $mixbet['bet'];
                $mix->rate = $mixbet['rate'];
                $mix->amount = intval($requestData['amount']);
                // $mix->result_h = $requestData->result_h;
                // $mix->result_a = $requestData->result_a;
                $mix->p_id = $user->id;
                $mix->playerId = $user->id;
                $mix->created_at = Carbon::now();
                $mix->updated_at = Carbon::now();
                $mix->status = 1;

                array_push($mixparlay, $mix);
            }

            try {
                DB::beginTransaction();

                foreach ($mixparlay as $mb) {
                    $mb->save();
                }
                DB::statement("UPDATE users SET balance = balance -" . intval($requestData['amount']) . " where id = " . $user->id);
                DB::commit();

                return response()->json(array('resCode' => (int)'200', 'resDesc' => 'ဘောက်ချာအမှတ် - ' . $voucher_id . 'ဖြင့် မောင်း (' . count($mixparlay) . ') ပွဲကို  လောင်းခဲ့ပါသည်။'));
            } catch (ConnectionException $ex) {
                Log::error($ex);
                return response()->json(array('resCode' => (int)'400', 'resDesc' => 'Bad Request'));
            } catch (Exception $ex) {
                Log::error($ex);
                return response()->json(array('resCode' => (int)'500', 'resDesc' => 'Internal Server Error'));
            } catch (PDOException $e) {
                return response()->json(array('resCode' => (int)'502', 'resDesc' => 'Database Server Error'));
            }
        } else {
            return response()->json(array('resCode' => (int)'401', 'resDesc' => 'Please Login.'));
        }
    }

    // get mixparlay bet history specific user
    public function getMixparlayBetHistory()
    {
        $user = Auth::user();
        if ($user != null) {
            $mixparlay = MixBet::where('p_id', $user->id)->orderBy('created_at', 'desc')->get();
            return response()->json(array('resCode' => (int)'200', 'resDesc' => 'Success', 'data' => $mixparlay));
        } else {
            return response()->json(array('resCode' => (int)'401', 'resDesc' => 'Please Login.'));
        }
    }

}