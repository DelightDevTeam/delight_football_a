<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $fillable = [
        "scrapper_id",
        "fixture_id",
        "upper_team_id",
        "lower_team_id",
        "handicap_team_id",
        "hdp",
        "hdp_home",
        "hdp_away",
        "ou",
        "ou_over",
        "ou_under",
    ];

    protected $casts = [
        'hdp' => 'json',
        'ou' => 'json',
        'hdp_home' => 'decimal:2',
        'hdp_away' => 'decimal:2',
        'ou_over' => 'decimal:2',
        'ou_under' => 'decimal:2',
    ];
}
