<?php

namespace Database\Seeders;

use App\Models\ProdukFoto;
use Illuminate\Database\Seeder;

class ProdukFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProdukFoto::insert([
            'fp_produk_id'=>1,
            'fp_image_url'=>'https://nutrition.thelegion.co.id/images/products/1635221170_aa4614582301df0b1a9f.jpg'
        ]);
    }
}
