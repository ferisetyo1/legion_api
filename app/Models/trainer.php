<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trainer extends Model
{
    use HasFactory;
    protected $table="legion_pt";
    protected $fillable = [
        'pt_gym_id',
        'pt_user_id',
        'pt_nama',
        'pt_tanggal_lahir',
        'pt_gender',
        'pt_desc',
        'pt_image',
    ];
}
