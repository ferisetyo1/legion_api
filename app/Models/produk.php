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

    protected $appends = ["produk_star_count"];

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

    public function review()
    {
        return  $this->hasMany(RatingReview::class,"rr_produk_id","produk_id");
    }
}