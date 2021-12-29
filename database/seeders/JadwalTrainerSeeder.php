<?php

namespace Database\Seeders;

use App\Models\JadwalTrainer;
use Illuminate\Database\Seeder;

class JadwalTrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //jt_kategories input
        $array = [
            [
                "kht_id" => 1,
                "pt_confirm" => false,
            ],
            [
                "kht_id" => 2,
                "pt_confirm" => false,
            ],
            [
                "kht_id" => 3,
                "pt_confirm" => false,
            ],
        ];
        $kategories = json_encode($array);
        JadwalTrainer::insert([
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"senin",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"selasa",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"rabu",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"kamis",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"jum'at",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"sabtu",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>1,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"minggu",
                'jt_kategories'=>$kategories,
            ],
        ]);
    }
}
