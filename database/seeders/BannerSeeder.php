<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::insert([
            [
                "banner_gambar" => "https://www.creatopy.com/blog/wp-content/uploads/2016/06/images-for-banner-ads.png",
                "banner_kategori" => "home",
                "banner_detail" => "gambar gym"
            ],
            [
                "banner_gambar" => "https://www.creatopy.com/blog/wp-content/uploads/2016/06/images-for-banner-ads.png",
                "banner_kategori" => "home",
                "banner_detail" => "gambar gym"
            ],
            [
                "banner_gambar" => "https://www.creatopy.com/blog/wp-content/uploads/2016/06/images-for-banner-ads.png",
                "banner_kategori" => "home",
                "banner_detail" => "gambar gym"
            ],
            [
                "banner_gambar" => "https://www.creatopy.com/blog/wp-content/uploads/2016/06/images-for-banner-ads.png",
                "banner_kategori" => "shop",
                "banner_detail" => "gambar gym"
            ],
            [
                "banner_gambar" => "https://www.pngitem.com/pimgs/m/531-5313843_400-gambar-doraemon-png-hd-gratis-doraemon-and.png",
                "banner_kategori" => "shop",
                "banner_detail" => "gambar gym"
            ],
            [
                "banner_gambar" => "https://www.pngitem.com/pimgs/m/531-5313843_400-gambar-doraemon-png-hd-gratis-doraemon-and.png",
                "banner_kategori" => "shop",
                "banner_detail" => "gambar gym"
            ],
        ]);
    }
}
