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
        "profit",
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

    public function scopeWhereIsOngoing()
    {
        return $this->where("status", BetStatus::Ongoing);
    }

    public function isPending(){
        return $this->status == BetStatus::Pending;
    }

    public function isOngoing(){
        return $this->status == BetStatus::Ongoing;
    }
}
