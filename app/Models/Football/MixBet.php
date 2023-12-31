<?php

namespace App\Models\Football;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MixBet extends Model
{
    use HasFactory;
    protected $table = 'mixbet';

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
    public function user()
    {
        return $this->belongsTo(User::class, 'playerId');
    }

}