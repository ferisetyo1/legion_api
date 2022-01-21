<?php

namespace Database\Seeders;

use App\Models\notiftype;
use Illuminate\Database\Seeder;

class NotiftypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        notiftype::insert(
            [
                'notiftypes_code' => "prod_dikonfirmasi",
                'notiftypes_title' => "Produk Dikonfirmasi",
                'notiftypes_body' => "Pembayaran pesanan %s terkonfirmasi. Mohon menunggu produk dikirim oleh penjual. Cek detail transaksi",
                'notiftypes_params' => "invoice",
                'notiftypes_icon' => "",
            ]
        );
        notiftype::insert([
            [
                'notiftypes_code' => "prod_dikirim",
                'notiftypes_title' => "Produk Dikirim",
                'notiftypes_body' => "Pemesanan produk anda telah dikirim oleh penjual, silakan cek detail transaksi untuk melacak proses pengiriman.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "prod_telah_sampai",
                'notiftypes_title' => "Pesanan Telah Sampai",
                'notiftypes_body' => "Pesanan telah sampai, Segera periksa kelengkapan produk pada pesanan ini. jika produk sudah anda terima silakan ...",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "prod_telah_selesai",
                'notiftypes_title' => "Pesanan Produk selesai",
                'notiftypes_body' => "Pemesanan produk pada transaksi ini telah selesai dan produk sudah diterima oleh pembeli.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "prod_ditolak",
                'notiftypes_title' => "Pesanan Produk Ditolak",
                'notiftypes_body' => "Mohon maaf pemesanan produk pada transaksi ini telah ditolak / dibatalkan oleh penjual.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_dikonfirmasi",
                'notiftypes_title' => "Pesanan Trainer Dikonfirmasi",
                'notiftypes_body' => "Pemesanan private trainer telah dikonfirmasi, silakan cek detail transaksi untuk melihat jadwal private.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_ditolak",
                'notiftypes_title' => "Pesanan Trainer Ditolak",
                'notiftypes_body' => "Mohon maaf pemesanan private trainer pada transaksi ini telah ditolak / dibatalkan oleh trainer.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_mulai",
                'notiftypes_title' => "Private",
                'notiftypes_body' => "Private anda akan segera dimulai dalam 15 menit lagi. Persiapkan diri anda untuk segera memulai private",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_selesai",
                'notiftypes_title' => "Pesanan Selesai",
                'notiftypes_body' => "Selamat anda telah berhasil menyelesaikan private trainer, jangan lupa untuk memperi review pada trainer anda. ",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_baru",
                'notiftypes_title' => "Pesanan Baru",
                'notiftypes_body' => "Ada pesanan privat trainer baru. segera konfirmasi pesanan jika anda ingin mengambil pesanan ini.",
                'notiftypes_icon' => "",
            ],
            [
                'notiftypes_code' => "priv_mulai_pt",
                'notiftypes_title' => "Training",
                'notiftypes_body' => "Private anda akan segera dimulai dalam 15 menit lagi. Persiapkan diri anda untuk segera memulai private",
                'notiftypes_icon' => "",
            ],
        ]);
    }
}
