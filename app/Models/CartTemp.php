<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartTemp extends Model
{
    use HasFactory;
    protected $primaryKey = "ct_id";
    public $table = "legion_cart_temps";
    public $timestamps = false;
    protected $fillable = [
        'ct_tp_id',
        'ct_user_id',
        'ct_produk_id',
        'ct_dp_id',
        'ct_jumlah',
        'ct_harga_varian',
        'ct_harga_varian_after_diskon',
        'ct_varian_diskon',
        'ct_produk_berat',
    ];

    protected $appends = ["ct_harga","ct_berat"];

    public function ctProduk()
    {
        return $this->belongsTo(produk::class,"ct_produk_id","produk_id");
    }

    public function ctVarian()
    {
        return $this->belongsTo(ProdukDetail::class,"ct_dp_id","dp_id");
    }

    public function getCtHargaAttribute()
    {
        return $this->ct_harga_varian_after_diskon*$this->ct_jumlah;
    }
    
    public function getctBeratAttribute()
    {
        return $this->ct_produk_berat*$this->ct_jumlah;
    }
}
