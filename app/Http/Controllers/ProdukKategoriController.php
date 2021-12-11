<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;

class ProdukKategoriController extends Controller
{
    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $produk = ProdukKategori::where("pk_id", "!=", 0);
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
}
