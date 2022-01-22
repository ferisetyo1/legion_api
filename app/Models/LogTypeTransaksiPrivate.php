<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTypeTransaksiPrivate extends Model
{
    use HasFactory;
    protected $table="legion_log_type_transaksi_privates";
    protected $primaryKey = "log_id";
    public $timestamps = false;
    protected $fillable = [
        'log_code',
        'log_title',
        'log_body',
        'log_red_flags',
    ];
}
