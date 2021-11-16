<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'email' => 'customer@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'customer'
            ],
            [
                'email' => 'trainer@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'trainer'
            ],
            [
                'email' => 'gymadmin@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'gym'
            ],
            [
                'email' => 'superadmin@gmail.com',
                'name' => 'feri',
                'password' => Hash::make('12345678'),
                'role' => 'superadmin'
            ],
        ]);
    }
}
