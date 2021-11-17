<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $produk = produk::where("produk_id", "!=", 0);
        if (isset($_GET['except'])) {
            $produk = $produk->where("produk_id", "!=", $_GET['except']);
        }
        if (isset($_GET["query"])) {
            $produk = $produk->where("produk_nama", "like", "%" . $_GET['query'] . "%");
        }
        $produk = $produk->paginate($limit);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [
                'total_items' => $produk->total(),
                'total_page' => $produk->lastPage(),
                'current_page' => $produk->currentPage(),
                'items' => $produk->items()
            ]
        ], 200);
    }

    public function show($id = 0, Request $request)
    {
        $produk = produk::with('review')->firstWhere("produk_id", $id);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [
                'produk' => $produk,
                'ongkir' => []
            ]
        ], 200);
    }
}
