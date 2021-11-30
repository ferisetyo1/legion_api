<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker= Faker::create('id_ID');
        User::insert([
            [
                'email' => 'customer@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'customer',
                'foto' => $faker->imageUrl(300,300,'person'),
            ],
            [
                'email' => 'trainer@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'trainer',
                'foto' => $faker->imageUrl(300,300,'person'),
            ],
            [
                'email' => 'gymadmin@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'gym',
                'foto' => $faker->imageUrl(300,300,'person'),
            ],
            [
                'email' => 'superadmin@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'superadmin',
                'foto' => $faker->imageUrl(300,300,'person'),
            ],
        ]);
    }
}
