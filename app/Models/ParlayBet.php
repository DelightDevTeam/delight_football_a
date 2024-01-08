<?php

namespace App\Models;

use App\Enums\BetStatus;
use App\Enums\AbSelectableSide;
use App\Enums\BetType;
use App\Enums\OuSelectableSide;
use App\Models\Traits\SingleBetTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParlayBet extends Model
{
    use HasFactory, SingleBetTrait;

    protected $fillable = [
        "user_id",
        "parlay_id",
        "league_id",
        "fixture_id",
        "market_id",
        "home_team_id",
        "away_team_id",
        "upper_team_id",
        "lower_team_id",
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
        "type" => BetType::class,
        'ab_obj' => 'json',
        'ab_selected_side' => AbSelectableSide::class,
        'ou_obj' => 'json',
        'ou_selected_side' => OuSelectableSide::class,
    ];

    public function market(){
        return $this->belongsTo(Market::class);
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }
}
