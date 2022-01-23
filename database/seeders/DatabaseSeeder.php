<?php

namespace Database\Seeders;

use App\Models\fasilitas;
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
        $this->call(RatingReviewSeeder::class);
        $this->call(FasilitasSeeder::class);
        $this->call(AlamatPrivateSeeder::class);
        $this->call(HargaTrainerSeeder::class);
        $this->call(ProdukDetailSeeder::class);
        $this->call(ProdukFotoSeeder::class);
        $this->call(ProdukKategoriSeeder::class);
        $this->call(ProdukTipeSeeder::class);
        $this->call(KategoriHargaTrainerSeeder::class);
        $this->call(DataMasterSeeder::class);
        $this->call(NotiftypeSeeder::class);
        $this->call(LogTypeTransaksiPrivateSeeder::class);
    }
}
