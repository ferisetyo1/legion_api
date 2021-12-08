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
        'tp_status',
        'tp_metode_pembayaran',
        'tp_waktu_expired'
    ];

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
    public function getTpStatusAttribute($s)
    {
        if (Date("d M Y H:i")>=Date($this->tp_tgl_private." ".$this->tp_jam_private)&&Date("d M Y H:i")<=Date('d M Y H:i',strtotime($this->tp_tgl_private." ".$this->tp_jam_private.' + 1 hours'))) {
            return 3;
        }
        if ( $s!=4 &&Date('d M Y H:i',strtotime($this->tp_tgl_private." ".$this->tp_jam_private.' + 1 hours')) < Date("d M Y H:i")) {
            return 5;
        }
        return $s;
    }
}
