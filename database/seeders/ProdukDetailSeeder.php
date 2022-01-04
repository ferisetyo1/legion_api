<?php

namespace Database\Seeders;

use App\Models\ProdukDetail;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukDetail::insert([[
            'dp_produk_id' => 1,
            'dp_nama' => 'BOX Grape',
            'dp_discount' => 25,
            'dp_harga' => '425000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 1,
            'dp_nama' => 'BOX Orange',
            'dp_discount' => 25,
            'dp_harga' => '425000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 1,
            'dp_nama' => 'STICK Grape',
            'dp_discount' => 25,
            'dp_harga' => '0',
            'dp_stok' => 0,
        ], [
            'dp_produk_id' => 2,
            'dp_nama' => 'BOX Cookies Cream',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 2,
            'dp_nama' => 'BOX Dark Choco',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 2,
            'dp_nama' => 'BOX Vanilla Cofee',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 2,
            'dp_nama' => 'SACHET Cookies Cream',
            'dp_discount' => 25,
            'dp_harga' => '0',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 2,
            'dp_nama' => 'SACHET Dark Chocolate',
            'dp_discount' => 25,
            'dp_harga' => '0',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 2,
            'dp_nama' => 'SACHET Vanilla Coffee',
            'dp_discount' => 25,
            'dp_harga' => '0',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'BOX Cookies Cream',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 999,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'BOX Dark Choco',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'BOX Vanilla Coffee',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 1000,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'SACHET Cookies Cream',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 0,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'SACHET Dark Chocolate',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 0,
        ],[
            'dp_produk_id' => 3,
            'dp_nama' => 'SACHET Vanilla Coffee',
            'dp_discount' => 25,
            'dp_harga' => '265000',
            'dp_stok' => 0,
        ],[
            'dp_produk_id' => 1,
            'dp_nama' => 'STICK Orange',
            'dp_discount' => 25,
            'dp_harga' => '0',
            'dp_stok' => 0,
        ],]);
    }
}
