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
        'ht_kategory'
    ];
    protected $appends = ["ht_kategory_name"];

    public function getHtKategoryNameAttribute()
    {
        if ($this->ht_kategory==1) {
            return "Online (Zoom)";
        }
        if ($this->ht_kategory==2) {
            return "Offline (Di Tempat Gym)";
        }
        if ($this->ht_kategory==3) {
            return "Offline (By Request)";
        }
        return "";
    }

}
