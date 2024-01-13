<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Admin\Role;
use App\Models\Football\MixBet;
use App\Models\Admin\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $fillable = [
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
        'balance',
        'status',
        'agent_id',
        'max_for_mix_bet',
        'max_for_single_bet',
        'commission',
        'high_commission',
        'two_d_commission',
        'three_d_commission',
        'm_c_two_commission',
        'm_c_three_commission',
        'm_c_four_commission',
        'm_c_five_commission',
        'm_c_six_commission',
        'm_c_seven_commission',
        'm_c_eight_commission',
        'm_c_nine_commission',
        'm_c_ten_commission',
        'm_c_eleven_commission',
        

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    // Other users that this user (a master) has created (agents)
    public function createdAgents()
    {
        return $this->hasMany(User::class, 'agent_id');
    }

    // The master that created this user (an agent)
    public function createdByMaster()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
    public function mixbets()
    {
        return $this->hasMany(MixBet::class, 'playerId');
    }
}