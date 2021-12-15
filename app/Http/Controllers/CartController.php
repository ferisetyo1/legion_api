<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;
use \Validator;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = cart::with("cartProduk", "cartVarian")->where('cart_user_id', $request->user()->id)->orderBy('cart_id', 'DESC');
        return response()->json([
            'status' => 'success',
            'msg' => "get data successfully",
            'data' => [
                "jumlah" => $carts->get()->sum('cart_jumlah'),
                "list" => $carts->get(),
                "payout" => $carts->get()->sum('cart_harga')
            ]
        ], 200);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cart_produk_id' => 'required',
            'cart_dp_id' => 'required',
            'cart_jumlah' => 'required',
        ]);
        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'data' => $validate->errors(),
            ];
            return response()->json($respon, 400);
        } else {
            $request['cart_user_id'] = $request->user()->id;
            $val = cart::create($request->only('cart_produk_id','cart_dp_id','cart_jumlah','cart_user_id'));
            if ($val) {
                return  [
                    'status' => 'success',
                    'msg' => 'Produk berhasil ditambahkan ke keranjang',
                    'data' => null,
                ];
            }
        }
    }

    public function update(Request $request)
    {
        cart::where('cart_id',$request->cart_id)->update($request->only('cart_jumlah'));
        return $this->index($request);
    }
    
    public function delete(Request $request)
    {
        $cart=cart::find($request->cart_id);
        if ($cart!=null) {
            $cart->delete();
        }
        return $this->index($request);
    }
}
