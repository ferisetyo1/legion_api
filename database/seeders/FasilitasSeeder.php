<?php

namespace Database\Seeders;

use App\Models\fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        fasilitas::insert(
            [
                'gf_gym_id' => 1,
                'gf_nama' => 'Aerial Yoga',
                'gf_image_url' => ''
            ]
        );
    }
}
