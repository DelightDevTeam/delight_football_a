<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        "scrapper_id",
        "league_id",
        "fixture_id",
        "upper_team_id",
        "lower_team_id",
        "handicap_team_id",
        "ab",
        "ab_odd",
        "ou",
        "ou_odd",
    ];

    protected $casts = [
        'ab' => 'json',
        'ab_odd' => 'decimal:2',
        'ou' => 'json',
        'ou_odd' => 'decimal:2',
    ];

    public function fixture(){
        return $this->belongsTo(Fixture::class);
    }
}
