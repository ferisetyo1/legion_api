<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'foto',
        'password',
        'free_password',
        'role',
        'is_delete',
    ];
    public $timestamps = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = ['gym'];

    // public function getDetailsAttribute()
    // {
    //     if ($this->role == "gym") {
    //         return gym::firstWhere('gym_user_id',$this->id);
    //     } else if ($this->role == "customer") {
    //         return "customer";
    //     } else if ($this->role == "trainer") {
    //         return trainer::firstWhere('pt_user_id',$this->id);
    //     } else {
    //         return null;
    //     }
    // }
    public function gym()
    {
        return $this->hasOne(gym::class,'gym_user_id');
    }
    
    public function trainer()
    {
        return $this->hasOne(trainer::class,'pt_user_id');
    }

    public function customer()
    {
        return $this->hasOne(customer::class,'customer_user_id');
    }

    public function getNameAttribute($s)
    {
        return ucwords($s);
    }

//     poin_id
// poin_customer_id
// poin_from
// poin_value
// poin_expired
// poin_create_at
// poin_update_at

// notif_id
// notif_user_id
// notif_title
// notif_body
// notif_tipe

// //notif_tipe
// ntipe_id
// ntipe_nama


}
