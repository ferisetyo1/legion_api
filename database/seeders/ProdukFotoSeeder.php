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
        ProdukFoto::insert([
            [
                'fp_produk_id' => 1,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636187230_fcc0d9804badd43fbc5c.png'
            ], [
                'fp_produk_id' => 1,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636182643_de2ade557ed7f48ac56a.jpg'
            ], [
                'fp_produk_id' => 1,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636182643_5e21cee5b6ebe6ffc6fd.jpg'
            ], [
                'fp_produk_id' => 1,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636182643_2dfc295cd95dd0f0e7ed.jpg'
            ], [
                'fp_produk_id' => 1,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636182643_04a6813a78118e541040.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636187248_79d1123daa8260985d98.png'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_021b9f3034fa918a7cdc.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_b217f37392871b3499e4.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_aa4614582301df0b1a9f.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_78dad7a5af7707884ac6.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_fb64506849fd4707970c.jpg'
            ], [
                'fp_produk_id' => 2,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221170_70acc7d2f726f6ac225e.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1636187263_c909c6e121247f21fc6d.png'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_81f340a5eac3d3247e03.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_9a49daf8c2ff33426374.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_1d45ccf337298e173db7.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_639984aea37bbf7d158b.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_ab3f4cd0df4132c389f6.jpg'
            ], [
                'fp_produk_id' => 3,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635221547_3e0c6a23688f71e6d9df.jpg'
            ], [
                'fp_produk_id' => 4,
                'fp_image_url' => 'https://nutrition.thelegion.co.id/images/products/1635167524_619711ae8862bf9adb75.png'
            ]
        ]);
    }
}
