<?php

namespace App\Http\Controllers;

use App\Models\HargaTrainer;
use Exception;
use Illuminate\Http\Request;

class HargaTrainerController extends Controller
{
    public function create(Request $request)
    {
        try {
            $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
            if (HargaTrainer::where('ht_pt_id',$request->ht_pt_id)->where('ht_kategory',$request->ht_kategory)->exists()) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Data has already',
                    'data' => null
                ], 400);
            }
            HargaTrainer::insert($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => 'Success create',
                'data' => HargaTrainer::limit($limit)->get()
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'success',
                'msg' => 'Failed create',
                'data' => null
            ], 400);
        }
    }
}
