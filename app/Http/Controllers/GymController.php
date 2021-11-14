<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GymController extends Controller
{
    public function nearestgym()
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [[
                'gym_id'=>1,
                'gym_nama'=>'The Legion Gym',
                'gym_alamat'=>'jln. patimura',
                'gym_isActive'=>'active',
                'gym_status'=>0,
                "gym_create_at"=>"2021-11-13 20:37:23",
                "gym_update_at"=>"2021-11-13 20:37:23",
            ]]
        ], 200);
    }
}
