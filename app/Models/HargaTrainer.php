<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaTrainer extends Model
{
    use HasFactory;
    protected $table="legion_harga_trainer";
    protected $primaryKey = "ht_id";
    public $timestamps = false;
    protected $fillable = [
        'ht_pt_id',
        'ht_harga',
        'ht_waktu',
        'ht_kht_id'
    ];
    protected $appends = ["ht_kategory"];

    public function getHtKategoryAttribute()
    {
        return KategoriHargaTrainer::find($this->ht_kht_id);
    }

}
