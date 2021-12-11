<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKategori extends Model
{
    use HasFactory;
    protected $primaryKey = "pk_id";
    public $table = "legion_produk_kategoris";
    public $timestamps = false;
    protected $fillable = [
        'pk_nama',
        'pk_image'
    ];
}
