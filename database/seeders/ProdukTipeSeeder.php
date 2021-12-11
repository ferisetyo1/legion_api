<?php

namespace Database\Seeders;

use App\Models\ProdukTipe;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukTipeSeeder extends Seeder
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
            ProdukTipe::create([
                "pt_nama"=>$faker->lastName
            ]);
        }
    }
}
