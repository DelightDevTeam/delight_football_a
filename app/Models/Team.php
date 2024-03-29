<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'scraper_id',
        'name',
        'name_my',
    ];

    public function leagues(){
        return $this->belongsToMany(League::class);
    }
}
