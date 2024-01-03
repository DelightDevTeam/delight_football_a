<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'scraper_id',
        'league_id',
        'home_team_id',
        'away_team_id',
        'raw_date_time',
        'date_time',
        "ft_home_goal",
        "ft_away_goal",
        "ft_status",
        "confirmed",
        "active",
        "manually_updated",
        "stop_update",
    ];
}
