<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class TransaksiPrivat extends Model
{
    use HasFactory;
    protected $primaryKey = "tp_id";
    protected $table="legion_transaksi_privat";
    public $timestamps = false;
    protected $fillable = [
        'tp_user_id',
        'tp_pt_id',
        'tp_ht_id',
        'tp_ap_id',
        'tp_invoice',
        'tp_tgl_private',
        'tp_jam_private',
        'tp_nama_gym',
        'tp_is_paid',
        'tp_is_confirm',
        'tp_is_mulai',
        'tp_is_cancel',
        'tp_is_done',
        'tp_metode_pembayaran',
        'tp_waktu_expired',
        'tp_generate_url',
        "tp_token_payment",
        "tp_meet_url"
    ];

    protected $appends = ["tp_status","tp_jam_private_end"];

    public function trainer()
    {
        return $this->belongsTo(trainer::class,'tp_pt_id','pt_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(User::class,'tp_user_id','id');
    }

    public function getTpMetodePembayaranAttribute($s)
    {
        if ($s=="TCASH_QR") {
            return "QRIS";
        }
        
        if ($s=="PERMATA_VA") {
            return "VA PERMATA";
        }
        
        if ($s=="VA_BCA") {
            return "VA BCA";
        }
        return $s;
    }

    public function hargaTrainer()
    {
        return $this->belongsTo(HargaTrainer::class,'tp_ht_id','ht_id');
    }

    public function alamatprivate()
    {
        return $this->belongsTo(AlamatPrivate::class,'tp_ap_id','ap_id');
    }

    public function getTpJamPrivateEndAttribute()
    {
        $ht=HargaTrainer::find($this->tp_ht_id);
        return date('H:i', strtotime(Date($this->tp_jam_private) . ' ' . '+ '.$ht->ht_waktu.' minutes'));
    }

    /*
    0 = belum dibayar / menunggu pembayaran
    1 = sudah dibayar / menunggu konfirmasi
    2 = dikonfirmasi / sedang diproses
    3 = sedang berlangsung
    4 = dibatalkan
    5 = selesai
    */
    public function getTpStatusAttribute()
    {
        if ($this->tp_is_done) {
            return [
                "text"=>"Selesai",
                "color"=>"#55D85A"
            ];
        }

        if ($this->tp_is_cancel) {
            return [
                "text"=>"Dibatalkan",
                "color"=>"#FF5757"
            ];
        }

        if ($this->tp_is_confirm) {
            return [
                "text"=>auth()->user()->role=="customer"?"Dikonfirmasi":"Diterima",
                "color"=>"#FFBA49"
            ];
        }

        if ($this->tp_is_paid) {
            return [
                "text"=>"Menunggu Konfirmasi",
                "color"=>"#FFBA49"
            ];
        }
        return [
            "text"=>"Menunggu Pembayaran",
            "color"=>"#FFBA49"
        ];
    }

    protected $casts = [
        'tp_is_paid' => 'boolean',
        'tp_is_cancel' => 'boolean',
        'tp_is_done' => 'boolean',
        'tp_is_confirm' => 'boolean',
    ];
}
