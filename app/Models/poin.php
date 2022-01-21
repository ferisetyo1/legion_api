<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poin extends Model
{
    use HasFactory;
    protected $table="legion_poins";
    protected $primaryKey = "poins_id";
    public $timestamps = false;
    protected $fillable = [
        'poins_user_id',
        'poins_from',
        'poins_value',
        'poins_expired',
    ];

}
