<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistProduk extends Model
{
    use HasFactory;
    protected $primaryKey = "wp_id";
    protected $table="legion_wishlist_produks";
    public $timestamps = false;
    protected $fillable = [
        'wp_user_id',
        'wp_produk_id',
    ];

    public function wpProduk()
    {
        return $this->belongsTo(produk::class,'wp_produk_id','produk_id');
    }
}
