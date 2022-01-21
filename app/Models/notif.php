<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notif extends Model
{
    use HasFactory;
    protected $table="legion_notifs";
    protected $primaryKey = "notif_id";
    public $timestamps = false;
    protected $fillable = [
        'notif_user_id',
        'notif_type_id',
        'notif_body',
        'notif_title',
        'notif_click_action',
        'notif_is_read',
    ];
}
