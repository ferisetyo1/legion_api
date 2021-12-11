<?php

namespace Database\Seeders;

use App\Models\ProdukFoto;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukFoto::insert([[
            'fp_produk_id'=>1,
            'fp_image_url'=>'https://nutrition.thelegion.co.id/images/products/1635221170_aa4614582301df0b1a9f.jpg'
        ],[
            'fp_produk_id'=>1,
            'fp_image_url'=>'https://nutrition.thelegion.co.id/images/products/1636187230_fcc0d9804badd43fbc5c.png'
        ]]);
        $faker = Faker::create('id_ID');
        for ($i=1; $i < 100; $i++) { 
            ProdukFoto::insert([[
                'fp_produk_id'=>$i,
                'fp_image_url'=>$faker->imageUrl(300, 300, 'person')
            ],[
                'fp_produk_id'=>$i,
                'fp_image_url'=>$faker->imageUrl(300, 300, 'person')
            ]]);
        }
    }
}
