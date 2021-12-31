<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class DataMasterController extends Controller
{
    public function getSyaratKetentuan()
    {
        $key=Config::get('app.datamaster.syaratketentuan.key');
        $data=DataMaster::firstwhere('dm_key',$key);
        if ($data==null) {
            $data=DataMaster::create([
                'dm_key'=>$key,
                'dm_data'=>Config::get('app.datamaster.syaratketentuan.default')
            ]);
        }
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => json_decode($data->dm_data,true)
        ], 200);
    }
    
    public function getKebijakanPrivasi()
    {
        $key=Config::get('app.datamaster.kebijakan_privasi.key');
        $data=DataMaster::firstwhere('dm_key',$key);
        if ($data==null) {
            $data=DataMaster::create([
                'dm_key'=>$key,
                'dm_data'=>Config::get('app.datamaster.kebijakan_privasi.default')
            ]);
        }
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => json_decode($data->dm_data,true)
        ], 200);
    }
    
    public function getTentang()
    {
        $key=Config::get('app.datamaster.tentang.key');
        $data=DataMaster::firstwhere('dm_key',$key);
        if ($data==null) {
            $data=DataMaster::create([
                'dm_key'=>$key,
                'dm_data'=>Config::get('app.datamaster.tentang.default')
            ]);
        }
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => json_decode($data->dm_data,true)
        ], 200);
    }
}
