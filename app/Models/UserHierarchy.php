<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHierarchy extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "parent_id",
        "type",
        "rank_point"
    ];

    protected $casts = [
        "type" => UserType::class
    ];

    public function parent(){
        return $this->belongsTo(User::class, 'parent_id');
    }
}
