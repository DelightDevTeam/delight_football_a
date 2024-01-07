<?php

namespace App\Models;

use App\Enums\AbSelectableSide;
use App\Enums\BetStatus;
use App\Enums\OuSelectableSide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "league_id",
        "fixture_id",
        "market_id",
        "amount",
        "possible_payout",
        "payout",
        "commission_setting_obj",
        "status",
        "win_percent",
        "type",
        "ab_obj",
        "ab_selected_side",
        "ou_obj",
        "ou_selected_side",
    ];

    protected $casts = [
        "status" => BetStatus::class,
        'commission_setting_obj' => 'json',
        'ab_obj' => 'json',
        'ab_selected_side' => AbSelectableSide::class,
        'ou_obj' => 'json',
        'ou_selected_side' => OuSelectableSide::class,
    ];

    public function slip()
    {
        return $this->morphOne(Slip::class, 'bettable');
    }

    public function market(){
        return $this->belongsTo(Market::class);
    }
}
