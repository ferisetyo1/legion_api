<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gym extends Model
{
    use HasFactory;
    protected $table = "legion_gym";
    protected $fillable = [
        'gym_user_id',
        'gym_nama',
        'gym_alamat',
        'gym_longitude',
        'gym_latitude',
        'gym_isActive',
        'gym_status',
        'gym_desc',
        'gym_image',
    ];

    public function trainer()
    {
        return $this->hasMany(trainer::class,"pt_gym_id","gym_id");
    }
}
