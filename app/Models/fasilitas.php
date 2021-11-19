<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    use HasFactory;
    protected $table = 'legion_gym_fasilitas';
    protected $fillable = [
        'gf_gym_id',
        'gf_nama',
        'gf_image_url',
    ];
}
