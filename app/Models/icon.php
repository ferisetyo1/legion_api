<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class icon extends Model
{
    use HasFactory;
    protected $table="legion_icons";
    protected $primaryKey = "icon_id";
    public $timestamps = false;
    protected $fillable = [
        'icon_name',
        'icon_url',
    ];
}
