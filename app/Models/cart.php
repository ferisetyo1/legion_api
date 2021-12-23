<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $primaryKey = "cart_id";
    public $table = "legion_carts";
    public $timestamps = false;
    protected $fillable = [
        'cart_user_id',
        'cart_produk_id',
        'cart_dp_id',
        'cart_jumlah',
    ];

    protected $appends = ["cart_harga","cart_berat"];

    public function cartProduk()
    {
        return $this->belongsTo(produk::class,"cart_produk_id","produk_id");
    }

    public function cartVarian()
    {
        return $this->belongsTo(ProdukDetail::class,"cart_dp_id","dp_id");
    }

    public function getCartHargaAttribute()
    {
        return $this->cartVarian->dp_harga_after_discount*$this->cart_jumlah;
    }
    
    public function getcartBeratAttribute()
    {
        return $this->cartProduk->produk_berat*$this->cart_jumlah;
    }
}
