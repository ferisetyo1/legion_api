<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukTipe extends Model
{
    use HasFactory;
    protected $primaryKey = "pt_id";
    public $table = "legion_produk_tipes";
    public $timestamps = false;
    protected $fillable = [
        'pt_nama',
    ];
}
