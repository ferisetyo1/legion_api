<?php

namespace Database\Seeders;

use App\Models\gym;
use App\Models\trainer;
use App\Models\User;
use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstWhere('email', 'gymadmin@gmail.com');
        $faker = Faker::create('id_ID');
        gym::insert([
            'gym_user_id' => $user->id,
            'gym_nama' => "The Legion Gym",
            'gym_alamat' => "Malang kota",
            'gym_longitude' => -7.9680568,
            'gym_latitude' => 112.6196781,
            'gym_isActive' => "active",
            'gym_status' => "0",
            'gym_desc' => $faker->paragraph,
            'gym_image' => $faker->imageUrl(300, 300, 'cats'),
            'gym_kota' => "malang",
        ]);
        for ($i = 0; $i < 100; $i++) {
            $user = User::insert([
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => Hash::make('12345678'),
                'role' => 'gym',
                'foto' => $faker->imageUrl(300,300,'person'),
            ],);
            gym::insert([
                'gym_user_id' => DB::getPdo()->lastInsertId(),
                'gym_nama' => $faker->company,
                'gym_alamat' => $faker->address,
                'gym_longitude' => $faker->longitude(-8.046464, -7.919305),
                'gym_latitude' => $faker->latitude(112.607504, 112.612255),
                'gym_isActive' => "active",
                'gym_status' => "0",
                'gym_desc' => $faker->paragraph,
                'gym_image' => $faker->imageUrl(300, 300, 'cats'),
                'gym_kota' => "malang",
            ]);
            $gymid = DB::getPdo()->lastInsertId();
            for ($j = 0; $j < 2; $j++) {
                $name = $faker->name;
                $user = User::insert([
                    'email' => $faker->email,
                    'name' => $name,
                    'password' => Hash::make('12345678'),
                    'role' => 'trainer',
                    'foto' => $faker->imageUrl(300,300,'person'),
                ],);
                trainer::insert([
                    'pt_gym_id' => $gymid,
                    'pt_user_id' => DB::getPdo()->lastInsertId(),
                    'pt_nama' => $name,
                    'pt_tanggal_lahir' => '1998-02-13',
                    'pt_gender' => 'laki-laki',
                    'pt_desc' => $faker->paragraph,
                    'pt_image' => $faker->imageUrl(300, 300, 'person'),
                    'pt_kota' => 'malang',
                    'pt_alamat' => $faker->address
                ]);
            }
        }
    }
}
