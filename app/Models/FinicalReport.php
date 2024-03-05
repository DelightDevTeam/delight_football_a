<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinicalReport extends Model
{
    use HasFactory;

    protected $fillable = [
        "date",
        "user_id",
        "turnover",
        "payout",
        "commission"
    ];

    public $timestamps = false;

    protected $casts = [
        "user_type" => UserType::class
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
