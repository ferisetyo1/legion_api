<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundPrivate extends Model
{
    use HasFactory;
    protected $table="legion_refund_privates";
    protected $primaryKey = "refund_id";
    public $timestamps = false;
    protected $fillable = [
        'refund_invoice',
        'refund_nama_bank',
        'refund_no_rek',
        'refund_nama_rek',
        'refund_nohp',
    ];
}
