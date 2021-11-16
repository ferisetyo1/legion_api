<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(GymSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(TrainerSeeder::class);
    }
}
