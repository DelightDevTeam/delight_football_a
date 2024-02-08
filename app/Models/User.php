<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserType;
use App\Models\Admin\Role;
use App\Models\Football\MixBet;
use App\Models\Admin\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWalletFloat;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasWalletFloat;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'username',
        'profile',
        'email',
        'password',
        'profile',
        'profile_mime',
        'profile_size',
        'phone',
        'address',
        'kpay_no',
        'cbpay_no',
        'wavepay_no',
        'ayapay_no',
        'status',
        'max_for_mix_bet',
        'max_for_single_bet',
        'commission',
        'high_commission',
        'two_d_commission',
        'three_d_commission',
        'single_commission',
        'parlay_2_commission',
        'parlay_3_commission',
        'parlay_4_commission',
        'parlay_5_commission',
        'parlay_6_commission',
        'parlay_7_commission',
        'parlay_8_commission',
        'parlay_9_commission',
        'parlay_10_commission',
        'parlay_11_commission',
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type' => UserType::class
    ];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsMasterAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }

    public function getIsAgentAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }
    public function getIsUserAttribute()
    {
        return $this->roles()->where('id', 4)->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function hasRole($role)
    {
        return $this->roles->contains('title', $role);
    }

    public function hasPermission($permission)
    {
        return $this->roles->flatMap->permissions->pluck('title')->contains($permission);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Other users that this user (a master) has created (agents)
    public function createdAgents()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(User::class, "parent_id");
    }

    public function children(){
        return $this->hasMany(User::class, "parent_id");
    }

    // The master that created this user (an agent)
    public function createdByMaster()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function mixbets()
    {
        return $this->hasMany(MixBet::class, 'playerId');
    }

    public static function adminUser(){
        return User::where("type", UserType::Admin)->first();
    }
}
