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
            'dp_nama' => 'Orange Box',
            'dp_discount' => 25,
            'dp_harga' => '1000000',
            'dp_stok' => 1,
        ], [
            'dp_produk_id' => 1,
            'dp_nama' => 'Grape Box',
            'dp_discount' => 25,
            'dp_harga' => '1250000',
            'dp_stok' => 1,
        ],]);
        $faker = Faker::create('en_US');
        for ($i = 1; $i < 100; $i++) {
            ProdukDetail::insert([[
                'dp_produk_id' => $i,
                'dp_nama' => $faker->firstName,
                'dp_discount' => rand(1,100),
                'dp_harga' => rand(100000,1000000),
                'dp_stok' => rand(1,1000),
            ], [
                'dp_produk_id' => $i,
                'dp_nama' => $faker->firstName,
                'dp_discount' => rand(1,100),
                'dp_harga' => rand(100000,1000000),
                'dp_stok' => rand(1,1000),
            ],]);
        }
    }
}
