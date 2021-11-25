<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukFoto extends Model
{
    use HasFactory;
    public $table = "legion_foto_produk";
    protected $primaryKey = "fp_id";
    protected $fillable = [
        'fp_produk_id',
        'fp_image_url',
    ];
}
