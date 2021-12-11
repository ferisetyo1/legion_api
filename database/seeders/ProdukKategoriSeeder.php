<?php

namespace Database\Seeders;

use App\Models\ProdukKategori;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');
        for ($i=0; $i < 31; $i++) { 
            ProdukKategori::create([
                "pk_nama"=>$faker->lastName,
                "pk_image"=>$faker->imageUrl(300, 300, 'person')
            ]);
        }
    }
}
