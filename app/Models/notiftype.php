<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notiftype extends Model
{
    use HasFactory;
    protected $table="legion_notiftypes";
    protected $primaryKey = "notiftypes_id";
    public $timestamps = false;
    protected $fillable = [
        'notiftypes_code',
        'notiftypes_title',
        'notiftypes_body',
        'notiftypes_params',
        'notiftypes_icon',
        'notiftypes_forapps',
    ];
}
