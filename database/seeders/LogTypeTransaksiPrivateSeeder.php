<?php

namespace Database\Seeders;

use App\Models\LogTypeTransaksiPrivate;
use Illuminate\Database\Seeder;

class LogTypeTransaksiPrivateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_cancel",
            'log_title'=>"Dibatalkan",
            'log_body'=>"Pesanan dibatalkan oleh trainer. Dana akan dikembalikan ke customer",
            'log_red_flags'=>true,
        ]);
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_new",
            'log_title'=>"System",
            'log_body'=>"Pesanan baru menunggu konfirmasi",
            'log_red_flags'=>false,
        ]);
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_confirm",
            'log_title'=>"Trainer",
            'log_body'=>"Pesanan diterima oleh trainer",
            'log_red_flags'=>false,
        ]);
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_onprogress",
            'log_title'=>"System",
            'log_body'=>"Training sedang berlangsung",
            'log_red_flags'=>false,
        ]);
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_finish",
            'log_title'=>"System",
            'log_body'=>"Training telah selesai",
            'log_red_flags'=>false,
        ]);
        LogTypeTransaksiPrivate::create([
            'log_code'=>"priv_complete",
            'log_title'=>"System",
            'log_body'=>"Transaksi selesai. Dana akan diteruskan ke Trainer.",
            'log_red_flags'=>false,
        ]);
    }
}
