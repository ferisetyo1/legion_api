<?php

namespace Database\Seeders;

use App\Models\produk;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        produk::insert([
            [
                'produk_nama' => "The Legion PRE BCAAs",
                'produk_pk_id' => 1,
                'produk_pt_id' => 1,
                'produk_merk' => "The Legion PRE BCAAs",
                'produk_berat' => "45 Kilogram",
                'produk_origin' => "Impor",
                'produk_detail' => "Sepeda Statis Air Bike versi OB-6401, Sepeda ini dibekali fasilitas untuk mendeteksi jumlah kecepatan, waktu, kalori yang dibakar, jarak tempuh, detak jantung pada saat berolahraga. Bukan hanya itu, Air-Bike juga mudah disimpan di ruangan yang sempit dan memberikan energik juga tantangan dalam berolahraga sepeda.",
            ],
        ]);


        $faker = Faker::create('fr_FR');
        for ($i=1; $i < 100; $i++) { 
            produk::insert([
                'produk_nama' => $faker->firstName,
                'produk_pk_id' => rand(1,30),
                'produk_pt_id' => rand(1,30),
                'produk_merk' => "The Legion PRE BCAAs",
                'produk_berat' => "45 Kilogram",
                'produk_origin' => "Impor",
                'produk_detail' => "Sepeda Statis Air Bike versi OB-6401, Sepeda ini dibekali fasilitas untuk mendeteksi jumlah kecepatan, waktu, kalori yang dibakar, jarak tempuh, detak jantung pada saat berolahraga. Bukan hanya itu, Air-Bike juga mudah disimpan di ruangan yang sempit dan memberikan energik juga tantangan dalam berolahraga sepeda.",
            ]);
        }
    }


}
