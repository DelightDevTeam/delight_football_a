<?php

namespace App\Models;

use App\Enums\FixtureStatus;
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

    protected $casts = [
        'date_time' => 'datetime',
        "ft_status" => FixtureStatus::class,
    ];

    public function markets()
    {
        return $this->hasMany(Market::class);
    }

    public function latestMarket()
    {
        return $this->hasOne(Market::class)->latestOfMany();
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function scopeWhereNotStarted()
    {
        return $this->where("ft_status", FixtureStatus::NS);
    }

    
}
