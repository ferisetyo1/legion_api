<?php

namespace Database\Seeders;

use App\Models\trainer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker::create('id_ID');
        trainer::insert([
            'pt_gym_id' => 1,
            'pt_user_id' => 2,
            'pt_nama' => 'feri',
            'pt_tanggal_lahir' => '1998-02-13',
            'pt_gender' => 'laki-laki',
            'pt_desc' => 'laki-laki jantan',
            'pt_image' => $faker->imageUrl(300,300,'person'),
        ]);
    }
}
