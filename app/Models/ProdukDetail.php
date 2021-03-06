<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDetail extends Model
{
    use HasFactory;
    public $table = "legion_detail_produk";
    protected $primaryKey = "dp_id";
    public $timestamps = false;
    protected $fillable = [
        'dp_produk_id',
        'dp_nama',
        'dp_discount',
        'dp_harga',
        'dp_stok',
    ];
    protected $appends = ["dp_harga_after_discount"];
    public function getDpHargaAfterDiscountAttribute()
    {
        return $this->dp_harga-(($this->dp_harga*$this->dp_discount)/100);
    }
}
