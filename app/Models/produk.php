<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $primaryKey = "produk_id";
    public $table = "legion_produk";
    public $timestamps = false;
    protected $fillable = [
        'produk_nama',
        'produk_pk_id',
        'produk_pt_id',
        'produk_merk',
        'produk_berat',
        'produk_origin',
        'produk_detail',
        'produk_image',
        'produk_discount',
        'produk_harga',
        'produk_stok',
    ];

    protected $appends = ["produk_star_count","produk_pk_nama","produk_pt_nama","produk_default_variant","produk_default_foto","produk_wishlist"];

    public function getProdukStarCountAttribute()
    {
        $review = RatingReview::where('rr_produk_id', $this->produk_id)->get();
        $star_count = 0;
        $i = 0;
        foreach ($review as $key => $value) {
            $star_count += $value->rr_star;
            $i++;
        }
        if ($i > 0 && $star_count > 0) return $star_count / $i;
        else return 0;
    }

    public function getProdukDefaultFotoAttribute()
    {
        return ProdukFoto::firstWhere("fp_produk_id",$this->produk_id);
    }

    public function getProdukDefaultVariantAttribute()
    {
        return ProdukDetail::firstWhere("dp_produk_id",$this->produk_id);
    }

    public function ProdukReview()
    {
        return  $this->hasMany(RatingReview::class,"rr_produk_id","produk_id")->take(2);
    }
    
    public function ProdukFoto()
    {
        return  $this->hasMany(ProdukFoto::class,"fp_produk_id","produk_id")->take(10);
    }
    
    public function ProdukVarian()
    {
        return  $this->hasMany(ProdukDetail::class,"dp_produk_id","produk_id");
    }

    public function getProdukWishlistAttribute()
    {
        return WishlistProduk::where('wp_user_id',auth()->user()->id)->where('wp_produk_id',$this->produk_id)->first();
    }

    public function getProdukPkNamaAttribute(){
        $pk=ProdukKategori::find($this->produk_pk_id);
        if ($pk!=null) {
            return $pk->pk_nama;
        }
        return "";
    }
    
    public function getProdukPtNamaAttribute(){
        $pt=ProdukTipe::find($this->produk_pt_id);
        if ($pt!=null) {
            return $pt->pt_nama;
        }
        return "";
    }
}
