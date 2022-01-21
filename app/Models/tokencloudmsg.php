<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tokencloudmsg extends Model
{
    use HasFactory;
    protected $table="legion_tokencloudmsgs";
    protected $primaryKey = "token_id";
    public $timestamps = false;
    protected $fillable = [
        'token_user_id',
        'token_value',
    ];
}
