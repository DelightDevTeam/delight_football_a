<?php

namespace App\Models\Football;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMBet extends Model
{
    use HasFactory;
    protected $table = 'mmbet';

    protected $fillable = [
        'id',
        'voucher_id',
        'odd_id',
        'league_name',
        'home',
        'away',
        'bet',
        'rate',
        'amount',
        'result_h',
        'result_a',
        'p_id',
        'playerId',
        'created_at',
        'updated_at',
        'status',

    ];

}