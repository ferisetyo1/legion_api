<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPrivate extends Model
{
    use HasFactory;
    protected $primaryKey = "ap_id";
    public $table = "legion_alamat_privates";
    public $timestamps = false;
    protected $fillable = [
        'ap_user_id',
        'ap_nama',
        'ap_type',
        'ap_alamat',
        'ap_detail',
        'ap_nama_penerima',
        'ap_no_telpon',
        'ap_lat',
        'ap_lon',
    ];

    public function getApNamaAttribute($s)
    {
        return ucwords($s);
    }
    
    public function getApDetailAttribute($s)
    {
        return ucfirst($s);
    }
    
    public function getApNamaPenerimaAttribute($s)
    {
        return ucwords($s);
    }
}
