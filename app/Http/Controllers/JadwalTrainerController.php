<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalTrainer;
use App\Models\User;

class JadwalTrainerController extends Controller
{
    public function index()
    {
        $user=User::find(auth()->user()->id);
        $pt=$user->trainer;
        if ($pt!=null) {
            $jadwal=JadwalTrainer::where('jt_pt_id',$pt->pt_id)->where('jt_gym_confirm',1)->get();
            return response()->json([
                'status' => 'success',
                'msg' => 'Success get jadwal'.$pt->pt_id,
                'data' => $jadwal
            ], 200);
        }
        return response()->json([
            'status' => 'success',
            'msg' => 'Success get jadwal',
            'data' => []
        ], 200);
    }
}
