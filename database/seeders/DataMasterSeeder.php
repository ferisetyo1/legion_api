<?php

namespace Database\Seeders;

use App\Models\DataMaster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DataMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datamaster=Config::get('app.datamaster');
        foreach ($datamaster as $key => $value) {
            DataMaster::create([
                'dm_key'=>$value['key'],
                'dm_data'=>$value['default'],
            ]);
        }
    }
}
