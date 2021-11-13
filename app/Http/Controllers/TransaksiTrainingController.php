<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiTrainingController extends Controller
{
    public function privateberlangsung()
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'Success get private berlangsung',
            'data' => [
                "tt_id" => 1,
                "tt_customer_id"=>1,
                "tt_pt_id"=>1,
                "tt_gym_id"=>1,
                "tt_durasi"=>60,
                "tt_nominal_transaksi"=>120000,
                "tt_status"=>"Sedang Berlangsung",
                "tt_waktu_mulai"=>"2021-11-13 20:19:00",
                "tt_jenis_training"=>"2021-11-13 20:19:00",
                "tt_create_at"=>"2021-11-13 20:37:23",
                "tt_update_at"=>"2021-11-13 20:37:23",
            ]
        ],200);
    }
}
