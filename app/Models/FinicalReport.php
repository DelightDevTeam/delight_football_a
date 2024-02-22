<?php

namespace App\Models;

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
}
