<?php

namespace Database\Seeders;

use App\Models\ProdukDetail;
use Illuminate\Database\Seeder;

class ProdukDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukDetail::insert([
            'dp_produk_id'=>1,
            'dp_nama'=>'orangebox',
            'dp_discount'=>'',
            'dp_harga'=>'',
            'dp_stok'=>1,
        ]);
    }
}
