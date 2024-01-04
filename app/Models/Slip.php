<?php

namespace App\Models;

use App\Enums\BetStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slip extends Model
{
    use HasFactory;

    protected $fillable = [
        "uuid",
        "user_id",
        "amount",
        "payout",
        "status",
    ];

    protected $casts = [
        "status" => BetStatus::class
    ];

    public function bettable()
    {
        return $this->morphTo('bettable');
    }
}
