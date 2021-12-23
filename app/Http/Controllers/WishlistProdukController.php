<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WishlistProduk;
use Illuminate\Http\Request;

class WishlistProdukController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfull",
            'data' => WishlistProduk::with('wpProduk')->where('wp_user_id', auth()->user()->id)->orderBy('wp_id','desc')->get()->map(function ($var) {
                return $var->wpProduk;
            })
        ], 200);
    }

    public function wish($prodid)
    {
        $this->wishUnwish($prodid);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfull",
            'data' => WishlistProduk::where('wp_user_id', auth()->user()->id)->where('wp_produk_id', $prodid)->first()
        ], 200);
    }

    public function wishUnwish($prodid)
    {
        $wish = WishlistProduk::where('wp_user_id', auth()->user()->id)->where('wp_produk_id', $prodid)->first();
        if ($wish == null) {
            WishlistProduk::create(['wp_user_id' => auth()->user()->id, 'wp_produk_id' => $prodid]);
        } else {
            $wish->delete();
        }
    }

    public function produklistwish($prodid)
    {
        $this->wishUnwish($prodid);
        return $this->index();
    }

    public function counter()
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfull",
            'data' => WishlistProduk::with('wpProduk')->where('wp_user_id', auth()->user()->id)->count()
        ], 200); 
    }
}
