<?php

namespace Database\Seeders;

use App\Models\produk;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        produk::insert([
            [
                'produk_nama' => "AEGIS PRE BCAAs",
                'produk_pk_id' => 1,
                'produk_pt_id' => 1,
                'produk_merk' => "aegis-pre-bcaas",
                'produk_berat' => "1.00",
                'produk_origin' => "Impor",
                'produk_detail' => "AEGIS Pre BCAA (Branched Chain Amino Acids) adalah suplemen terbaik dari The Legion Nutrition. Mengandung esensi Leusin, Isoleusin, dan Valin.\r\n\r\nAEGIS Pre BCAAs dapat membantu mempertahankan pemulihan otot dan meningkatkan pertumbuhan otot saat Anda mencapai batas. Baik sebagai sumber energi otot, mendukung kondisi otot, mencegah pemecahan protein otot dan digunakan sebagai sumber energi yang efisien saat berolahraga.\r\n\r\nGunakan kapan saja, sebelum, selama dan setelah latihan.\r\n",
            ],[
                'produk_nama' => "DEIMOS PRE GAINER",
                'produk_pk_id' => 1,
                'produk_pt_id' => 1,
                'produk_merk' => "deimos-pre-gainer",
                'produk_berat' => "1.00",
                'produk_origin' => "Impor",
                'produk_detail' => "Deimos Pre Gainer adalah produk unggulan dengan protein tinggi yang memberikan semua kebutuhan untuk penambahan berat badan maksimum, pengembangan otot, penyimpanan energi, dan pemulihan. Untuk Anda yang ingin menambah berat badan sekaligus menambah massa otot. Suplemen ini juga sangat cocok untuk anda yang sangat aktif berolahraga dan menghabiskan banyak energi.\r\n\r\nDeimos Pre Gainer memiliki komposisi yang membuatnya sangat cocok tidak hanya untuk olahraga kekuatan tetapi juga untuk jenis olahraga yang membutuhkan peningkatan berat badan, massa otot, dan kekuatan.\r\n",
            ],[
                'produk_nama' => "PHOBOS PRE ISOLATE",
                'produk_pk_id' => 1,
                'produk_pt_id' => 1,
                'produk_merk' => "phobos-pre-isolate",
                'produk_berat' => "1.00",
                'produk_origin' => "Impor",
                'produk_detail' => "Phobos Pre Isolate penting bagi Anda yang ingin membangun massa otot & program pertumbuhan otot. Dengan Glutamin untuk asam amino bebas paling melimpah di dalam tubuh, dapat membantu mendukung sintesis protein dan pemulihan otot.\r\n\r\nPhobos Pre Isolate adalah sejenis protein whey. Memiliki WPI (whey protein isolate) lebih baik daripada WPC (whey protein konsentrat), karena merupakan protein murni dengan kadar 90-92%.",
            ],[
                'produk_nama' => "THE LEGION SHAKER",
                'produk_pk_id' => 1,
                'produk_pt_id' => 1,
                'produk_merk' => "the-legion-shaker",
                'produk_berat' => "1.00",
                'produk_origin' => "Impor",
                'produk_detail' => "THE LEGION SHAKER",
            ],
        ]);
    }


}
