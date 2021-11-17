<?php

namespace Database\Seeders;

use App\Models\RatingReview;
use App\Models\ReviewFoto;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RatingReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            RatingReview::insert([
                'rr_user_id'=>1,
                'rr_gym_id'=>1,
                'rr_star'=>3.5,
                'rr_desc'=>"Gymnya bagus"
            ]);
            $faker=Faker::create('id_ID');
            $rrid = DB::getPdo()->lastInsertId();
            ReviewFoto::insert([
                'rf_rr_id'=>$rrid,
                'rf_image_url'=>$faker->imageUrl(300,300)
            ]);
            RatingReview::insert([
                'rr_user_id'=>1,
                'rr_produk_id'=>1,
                'rr_star'=>4.0,
                'rr_desc'=>"Produknya bagus"
            ]);

            RatingReview::insert([
                'rr_user_id'=>1,
                'rr_pt_id'=>1,
                'rr_star'=>4.5,
                'rr_desc'=>"trainernya bagus"
            ]);
    }
}
