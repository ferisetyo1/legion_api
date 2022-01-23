<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logTransaksiPrivate extends Model
{
    use HasFactory;
    protected $table="legion_log_transaksi_privates";
    protected $primaryKey = "log_id";
    public $timestamps = false;
    protected $fillable = [
        'log_transaksi_id',
        'log_type_id',
    ];

    public function type()
    {
        return $this->belongsTo(LogTypeTransaksiPrivate::class,'log_type_id','log_id');
    }
}
