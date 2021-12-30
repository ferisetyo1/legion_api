<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMaster extends Model
{
    use HasFactory;
    protected $table = 'legion_data_masters';
    protected $primaryKey = "dm_id";
    public $timestamps = false;
    protected $fillable = [
        'dm_key',
        'dm_data',
    ];
}
