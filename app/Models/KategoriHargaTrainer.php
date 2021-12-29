<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriHargaTrainer extends Model
{
    use HasFactory;
    protected $table="legion_kategori_harga_trainers";
    protected $primaryKey = "kht_id";
    public $timestamps = false;
    protected $fillable = [
        'kht_nama',
    ];
}
