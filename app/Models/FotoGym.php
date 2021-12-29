<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoGym extends Model
{
    use HasFactory;
    public $table = "legion_foto_gyms";
    protected $primaryKey = "fg_id";
    public $timestamps = false;
    protected $fillable = [
        'fg_gym_id',
        'fg_image_url',
    ];
}
