<?php

namespace App\Models;

use App\Enums\BetStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parlay extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "amount",
        "possible_payout",
        "payout",
        "commission_setting_obj",
        "status",
    ];

    protected $casts = [
        "status" => BetStatus::class,
        'commission_setting_obj' => 'json',
    ];

    public function parlayBets(){
        return $this->hasMany(ParlayBet::class);
    }

    public function slip()
    {
        return $this->morphOne(Slip::class, 'bettable');
    }
}
