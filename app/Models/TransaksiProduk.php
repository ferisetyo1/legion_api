<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiProduk extends Model
{
    use HasFactory;
    protected $primaryKey = "tp_id";
    protected $table="legion_transaksi_produks";
    public $timestamps = false;
    protected $fillable = [
        'tp_user_id',
        'tp_ap_id',
        'tp_invoice',
        'tp_jasa_pengiriman',
        'tp_token_payment',
        'tp_no_resi',
        'tp_nama_gym',
        'tp_is_paid',
        'tp_cart_temp',
        'tp_is_confirm',
        'tp_is_dikemas',
        'tp_is_cancel',
        'tp_is_done',
        'tp_metode_pembayaran',
        'tp_tgl_expired_payment',
        'tp_checkout_url',
        'tp_ongkir'
    ];

    protected $appends = ["tp_status","tp_sub_total"];

    public function tpAlamatPengiriman()
    {
        return $this->belongsTo(AlamatPengiriman::class,"tp_ap_id","ap_id");
    }

    public function tpCart()
    {
        return $this->hasMany(CartTemp::class,"ct_tp_id","tp_id");
    }

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

        if ($this->tp_is_dikemas) {
            return [
                "text"=>"Dikirim",
                "color"=>"#FFBA49"
            ];
        }
       
        if ($this->tp_is_dikemas) {
            return [
                "text"=>"Dikirim",
                "color"=>"#FFBA49"
            ];
        }

        if ($this->tp_is_confirm) {
            return [
                "text"=>"Dikemas",
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
        'tp_is_dikemas' => 'boolean',
        'tp_is_done' => 'boolean',
        'tp_is_confirm' => 'boolean',
    ];

    public function getTpJasaPengirimanAttribute($s){
        return strtoupper($s);
    }

    public function getTpSubTotalAttribute()
    {
        return $this->tpCart()->get()->sum('ct_harga');
    }
}
