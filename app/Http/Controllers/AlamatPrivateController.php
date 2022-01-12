<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlamatPrivate;
use Illuminate\Http\Request;
use \Validator;

class AlamatPrivateController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [
                "rumah" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                "kantor" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                "lainnya" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
            ]
        ], 200);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'ap_nama' => 'required',
            'ap_alamat' => 'required',
            'ap_type' => 'required',
            'ap_lat' => 'required',
            'ap_lon' => 'required',
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 400);
        } else {
            $request["ap_user_id"] = $request->user()->id;
            AlamatPrivate::create($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => "Create data successfully",
                'data' => [
                    "rumah" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                    "kantor" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                    "lainnya" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
                ]
            ], 200);
        }
    }

    public function edit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'ap_id' => 'required',
            'ap_nama' => 'required',
            'ap_alamat' => 'required',
            'ap_type' => 'required',
            'ap_lat' => 'required',
            'ap_lon' => 'required',
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 400);
        } else {
            AlamatPrivate::where("ap_id", $request->ap_id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => "Updated data successfully",
                'data' => [
                    "rumah" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                    "kantor" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                    "lainnya" => AlamatPrivate::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
                ]
            ], 200);
        }
    }
    
    public function counter(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "get data successfully",
            'data' => AlamatPrivate::where('ap_user_id', $request->user()->id)->count()
        ], 200);
    }
}
