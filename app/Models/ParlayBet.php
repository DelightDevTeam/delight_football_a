<?php

namespace App\Models;

use App\Enums\BetStatus;
use App\Enums\AbSelectableSide;
use App\Enums\OuSelectableSide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlayBet extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "parlay_id",
        "league_id",
        "fixture_id",
        "market_id",
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
        'ab_obj' => 'json',
        'ab_selected_side' => AbSelectableSide::class,
        'ou_obj' => 'json',
        'ou_selected_side' => OuSelectableSide::class,
    ];
}
