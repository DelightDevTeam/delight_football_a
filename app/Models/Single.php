<?php

namespace App\Models;

use App\Enums\AbSelectableSide;
use App\Enums\BetStatus;
use App\Enums\BetType;
use App\Enums\OuSelectableSide;
use App\Models\Traits\SingleBetTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Single extends Model
{
    use HasFactory, SingleBetTrait;

    protected $fillable = [
        "user_id",
        "league_id",
        "fixture_id",
        "market_id",
        "home_team_id",
        "away_team_id",
        "upper_team_id",
        "lower_team_id",
        "handicap_team_id",
        "amount",
        "possible_payout",
        "profit",
        "payout",
        "commission_setting_obj",
        "status",
        "win_percent",
        "type",
        "ab_obj",
        "ab_selected_side",
        "ou_obj",
        "ou_selected_side",
        "calculated_at"
    ];

    protected $casts = [
        "status" => BetStatus::class,
        'commission_setting_obj' => 'json',
        "type" => BetType::class,
        'ab_obj' => 'json',
        'ab_selected_side' => AbSelectableSide::class,
        'ou_obj' => 'json',
        'ou_selected_side' => OuSelectableSide::class,
        "calculated_at" => "datetime"
    ];

    public function slip()
    {
        return $this->morphOne(Slip::class, 'bettable');
    }

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }
}
