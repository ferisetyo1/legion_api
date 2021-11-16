<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $limit=isset($_GET['limit'])?$_GET['limit']:10;
        $kategori=isset($_GET['kategori'])?$_GET['kategori']:"home";
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => Banner::where("banner_kategori",$kategori)->limit($limit)->get()
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $limit=isset($_GET['limit'])?$_GET['limit']:10;
            $banner = Banner::insert($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => 'Success create',
                'data' => Banner::limit($limit)->get()
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
