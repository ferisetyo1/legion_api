<?php

namespace Database\Seeders;

use App\Models\customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('id_ID');
        customer::insert([
            'customer_user_id'=>1,
            'customer_nama'=>'feri',
            'customer_tinggi'=>'172',
            'customer_berat'=>'55',
            'customer_tanggal_lahir'=>'2020-02-13',
            'customer_gender'=>'laki-laki',
            'customer_image'=>$faker->imageUrl(300,300,"person")
        ]);
    }
}
