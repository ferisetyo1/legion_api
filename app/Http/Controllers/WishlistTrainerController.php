<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WishlistTrainer;
use Illuminate\Http\Request;

class WishlistTrainerController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfull",
            'data' => WishlistTrainer::with('wtTrainer')->where('wt_user_id', auth()->user()->id)->orderBy('wt_id','desc')->get()->map(function ($var) {
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
            'data' => WishlistTrainer::where('wt_user_id', auth()->user()->id)->where('wt_produk_id', $prodid)->first()
        ], 200);
    }

    public function wishUnwish($ptId)
    {
        $wish = WishlistTrainer::where('wt_user_id', auth()->user()->id)->where('wp_pt_id', $ptId)->first();
        if ($wish == null) {
            WishlistTrainer::create(['wt_user_id' => auth()->user()->id, 'wp_pt_id' => $ptId]);
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
            'data' => WishlistTrainer::with('wtTrainer')->where('wt_user_id', auth()->user()->id)->count()
        ], 200); 
    }
}
