<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'scraper_id',
        'name',
        'name_my',
        'active',
    ];

    public function teams(){
        return $this->belongsToMany(Team::class);
    }
}
