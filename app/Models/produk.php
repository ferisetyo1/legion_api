<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    public $table = "legion_produk";
    protected $fillable = [
        'produk_nama',
        'produk_kategori',
        'produk_merk',
        'produk_berat',
        'produk_origin',
        'produk_detail',
        'produk_image',
        'produk_discount',
        'produk_harga',
        'produk_stok',
    ];
}
