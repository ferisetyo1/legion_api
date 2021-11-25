<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'legion_customer';
    protected $primaryKey = "customer_id";
    protected $fillable = [
        'customer_user_id',
        'customer_nama',
        'customer_tinggi',
        'customer_berat',
        'customer_tanggal_lahir',
        'customer_gender',
        'customer_image',
    ];
}
