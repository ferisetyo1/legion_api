<?php

namespace Database\Seeders;

use App\Models\HargaTrainer;
use Illuminate\Database\Seeder;

class HargaTrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HargaTrainer::insert([
            [
                'ht_pt_id'=>1,
                'ht_harga'=>160000,
                'ht_waktu'=>60,
                'ht_kht_id'=>1
            ],
            [
                'ht_pt_id'=>1,
                'ht_harga'=>180000,
                'ht_waktu'=>60,
                'ht_kht_id'=>2
            ],
            [
                'ht_pt_id'=>1,
                'ht_harga'=>180000,
                'ht_waktu'=>60,
                'ht_kht_id'=>3
            ],
        ]);
    }
}
