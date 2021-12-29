<?php

namespace Database\Seeders;

use App\Models\KategoriHargaTrainer;
use Illuminate\Database\Seeder;

class KategoriHargaTrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KategoriHargaTrainer::insert([
            [
                "kht_nama"=>"Online (Zoom)"
            ],
            [
                "kht_nama"=>"Offline (Di Tempat Gym)"
            ],
            [
                "kht_nama"=>"Offline (By Request)"
            ],
        ]);
    }
}
