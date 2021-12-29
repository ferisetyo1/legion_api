<?php

namespace Database\Seeders;

use App\Models\JadwalTrainer;
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
        $pt=trainer::create([
            'pt_gym_id' => 1,
            'pt_user_id' => 2,
            'pt_nama' => 'feri',
            'pt_tanggal_lahir' => '1998-02-13',
            'pt_gender' => 'laki-laki',
            'pt_desc' => 'laki-laki jantan',
            'pt_image' => $faker->imageUrl(300,300,'person'),
            'pt_kota' => 'malang',
            'pt_alamat'=>$faker->address
        ]);
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
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"senin",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"selasa",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"rabu",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"kamis",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"jum'at",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"sabtu",
                'jt_kategories'=>$kategories,
            ],
            [
                'jt_pt_id'=>$pt->pt_id,
                'jt_gym_id'=>1,
                'jt_pt_confirm'=>false,
                'jt_gym_confirm'=>false,
                'jt_hari'=>"minggu",
                'jt_kategories'=>$kategories,
            ],
        ]);
    }
}
