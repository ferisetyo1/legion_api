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
        'tp_pt_id',
        'tp_ht_id',
        'tp_ap_id',
        'tp_invoice',
        'tp_tgl_private',
        'tp_jam_private',
        'tp_nama_gym',
        'tp_is_paid',
        'tp_is_confirm',
        'tp_is_cancel',
        'tp_metode_pembayaran',
        'tp_waktu_expired'
    ];

    protected $appends = ["tp_status"];

    public function trainer()
    {
        return $this->belongsTo(trainer::class,'tp_pt_id','pt_id');
    }

    public function hargaTrainer()
    {
        return $this->belongsTo(HargaTrainer::class,'tp_ht_id','ht_id');
    }

    public function alamatprivate()
    {
        return $this->belongsTo(AlamatPrivate::class,'tp_ap_id','ap_id');
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
                "text"=>"Dikonfirmasi",
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
}
