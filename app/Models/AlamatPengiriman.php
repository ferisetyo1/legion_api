<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    use HasFactory;
    protected $primaryKey = "ap_id";
    public $table = "legion_alamat_pengiriman";
    public $timestamps = false;
    protected $fillable = [
        'ap_user_id',
        "ap_prov_id",
        "ap_prov_nama",
        "ap_kota_id",
        "ap_kota_nama",
        // "ap_kecamatan_id",
        // "ap_kecamatan_nama",
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
        if ($this->ap_type=="rumah") {
            return "Rumah";
        }
        if ($this->ap_type=="kantor") {
            return "Kantor";
        }
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
