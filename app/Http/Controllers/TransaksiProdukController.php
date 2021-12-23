<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlamatPengiriman;
use App\Models\cart;
use App\Models\CartTemp;
use App\Models\TransaksiProduk;
use Illuminate\Http\Request;
use stdClass;

class TransaksiProdukController extends Controller
{

    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $transaksi = TransaksiProduk::with('tpCart.ctProduk')->orderBy('tp_id', 'DESC')->where('tp_user_id',$request->user()->id);
        if (isset($_GET["query"])) {
            $transaksi = $transaksi->where("tp_invoice", "like", "%" . $_GET['query'] . "%");
        }
        if (isset($request->status)) {
            if ($request->status == 1) {
                //menunggu pembayaran
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 0)->where('tp_is_confirm', 0)->where('tp_is_dikemas', 0);
            }
            if ($request->status == 2) {
                //menunggu konfirmasi
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 1)->where('tp_is_confirm', 0)->where('tp_is_dikemas', 0);
            }
            if ($request->status == 3) {
                //Dikemas
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 1)->where('tp_is_confirm', 1)->where('tp_is_dikemas', 0);
            }
            if ($request->status == 4) {
                //Dikirim
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 1)->where('tp_is_confirm', 1)->where('tp_is_dikemas', 1);
            }
            if ($request->status == 5) {
                //selesai
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 1)->where("tp_is_paid", 1)->where('tp_is_confirm', 1)->where('tp_is_dikemas', 1);
            }
            if ($request->status == 6) {
                //cancel
                $transaksi = $transaksi->where("tp_is_cancel", 1);
            }
        }
        $transaksi = $transaksi->paginate($limit);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [
                'total_items' => $transaksi->total(),
                'total_page' => $transaksi->lastPage(),
                'current_page' => $transaksi->currentPage(),
                'items' => $transaksi->items()
            ]
        ], 200);
    }

    public function InfoCheckout(Request $request)
    {
        $cart = cart::with("cartProduk", "cartVarian")->where('cart_user_id', $request->user()->id)->orderBy('cart_id', 'DESC')->get();
        $rumah = AlamatPengiriman::where("ap_type", "rumah")->where("ap_user_id", $request->user()->id)->first();
        if ($rumah == null) {
            return response()->json([
                'status' => 'success',
                'msg' => "Rumah belum diisi",
                'data' => null
            ], 200);
        }
        $header = array(
            "content-type: application/json",
            "key:0ed65ea6b16e180a04139d362eed4d75"
        );
        $regular = [];
        $query = array(
            "origin" => 501,
            "originType" => "city",
            "destination" => $rumah->ap_kota_id,
            "destinationType" => "city",
            "weight" => $cart->sum('cart_berat'),
            "courier" => "jne"
        );
        foreach ($request->service as $key => $value) {
            $query["courier"] = $value;
            $curl = $this->do_curl(
                "https://pro.rajaongkir.com/api/cost",
                json_encode($query),
                $header,
            );
            $json = json_decode($curl, $associative = true, $depth = 512, JSON_THROW_ON_ERROR);
            if (isset($json['rajaongkir'])) {
                if (isset($json['rajaongkir']['results']) && !empty($json['rajaongkir']['results'])) {
                    $obj = $json['rajaongkir']['results'][0];
                    if (isset($obj['costs'])) {
                        foreach ($obj['costs'] as $key2 => $value2) {
                            if (isset($value2['service']) && isset($value2['description'])) {
                                if ($value2['service'] == 'REG' || str_contains(strtolower($value2['description']), 'regular')) {
                                    if (isset($value2['cost']) && !empty($value2['cost'])) {
                                        $regular[] = [
                                            "name" => ucwords($value),
                                            "biaya" => $value2['cost'][0]
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'msg' => "Updated data successfully",
            'data' => [
                "rumah" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                "regular" => $regular,
                "sub_total" => $cart->sum('cart_harga'),
            ]
        ], 200);
    }

    public function create(Request $request)
    {
        $cart = cart::with("cartProduk", "cartVarian")->where('cart_user_id', $request->user()->id);
        $data["tp_ap_id"] = $request->ap_id;
        $data["tp_ongkir"] = $request->ongkir;
        $data["tp_jasa_pengiriman"] = $request->jasa_pengiriman;
        $data["tp_invoice"] = "INV" . $request->user()->id . time();
        $data["tp_token_payment"] = md5(uniqid($data["tp_invoice"], true));
        $data["tp_user_id"] = $request->user()->id;
        $generateUrl = $this->generateUrl([
            'inv' => $data["tp_token_payment"],
            'amount' => $data['tp_ongkir'] + $cart->get()->sum('cart_harga'),
            // 'amount' => 1,
        ]);
        $data["tp_checkout_url"] = isset($generateUrl['generatedUrl']) ? $generateUrl['generatedUrl'] : '';
        $data["tp_tgl_expired_payment"] = Date("y-m-d h:i:s", strtotime(isset($generateUrl['expiredDate']) ? $generateUrl['expiredDate'] : ''));
        $transaksi = TransaksiProduk::create($data);
        foreach ($cart->get() as $key => $value) {
            CartTemp::create([
                'ct_user_id' => $request->user()->id,
                'ct_tp_id' => $transaksi->tp_id,
                'ct_produk_id' => $value->cart_produk_id,
                'ct_dp_id' => $value->cart_dp_id,
                'ct_jumlah' => $value->cart_jumlah,
                'ct_jumlah' => $value->cart_jumlah,
                'ct_harga_varian'=>$value->cartVarian->dp_harga,
                'ct_harga_varian_after_diskon'=>$value->cartVarian->dp_harga_after_discount,
                'ct_varian_diskon'=>$value->cartVarian->dp_discount,
                'ct_produk_berat'=>$value->cartProduk->produk_berat,
            ]);
        }
        $cart->delete();
        return response()->json([
            'status' => 'success',
            'msg' => "Updated data successfully",
            'data' => $transaksi,
        ], 200);
    }

    public function paidTransaksi($token, Request $request)
    {
        $tp = TransaksiProduk::firstWhere('tp_token_payment', $token);
        $tp->tp_is_paid=true;
        $header = array(
            "content-type: application/json"
        );
        $curl = $this->do_curl(
            "https://api-link.cashlez.com/validate_url",
            json_encode([
                "status" => "",
                "message" => "",
                "data" => [
                    "request" => [
                        "generatedUrl" => "https://link.cashlez.com/czlink/GR35641INV11639893460"
                        // "generatedUrl" => $tp->tp_checkout_url
                    ]
                ],
            ],JSON_UNESCAPED_SLASHES),
            $header,
        );
        $json = json_decode($curl, $associative = true, $depth = 512, JSON_THROW_ON_ERROR);
        $response = isset($json['data']) &&
            isset($json['data']['response']) &&
            isset($json['data']['response']['paymentType']) &&
            isset($json['data']['response']['paymentType']['name']) ?
            $json['data']['response']['paymentType']['name'] : null;
        $paymentmethod=$response=="TCASH_QR"?"QRIS":$response;
        $tp->tp_metode_pembayaran=$paymentmethod;
        $tp->save();
        header("Location: https://nutrition.thelegion.co.id/");
        die();
    }

    public function show($id, Request $regular)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => TransaksiProduk::with('tpCart.ctVarian','tpCart.ctProduk', 'tpAlamatPengiriman')->find($id),
        ], 200);
    }

    public function counter()
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Updated data successfully",
            'data' => TransaksiProduk::where('tp_user_id',auth()->user()->id)->count()
        ], 200);
    }

    function generate_signature($string)
    {
        $privatekey = trim('
-----BEGIN RSA PRIVATE KEY-----
MIIEogIBAAKCAQEAyIkSQ5Y9wFUP08vI5PmHbsFr28Yx/dxocGZFp/bY+tf45kHn
AKV8jg0EuH4CByze4yStPBpobWq+qiAZO4gZx652KeLZGoPPTT5Q72bJ3mhc2b1n
Lkn+VQqlQFXv4AAUFxFmBtWbO7QZaZP2ytcMlt1CkY3F+/3x1OaIZvS6srf0j6uk
xzLx7a8MYVNTMw8I1bs0DfUwEWoZ6I7BrZKS/maPOOEb8lcoAEtyFW19MpoHgPv0
1431JxYaouFRxvsDymdORLolmmBFDz5y68fePOUe315Uo2rUadE2uHTgSUlFp1zG
QApQjujAzrCa28qnNQrGAK8EY+FKfbZhLKjyJQIDAQABAoIBAE4fMBFKZ1YVDSxq
WCHzn7IjAdzFUlZeVgVrojkz7gWSu3EgPVjAH0zLf4pL9IhND6uXbzFZ7FKr4gku
pgXOGJT0vy3EJOWyccDaxPbuqTfOmlVs9tROmRkSI5xznhY6kZkG+yMwdeAFYl0B
+oO80Te4jKVdgMKRhHN3N648KrtSQs6nlIxWgdHEr7uJ3PBdORXq3FZE/dRAiwix
AqQKFzk4WhVu/9xD0CxzgAlr5Uee/ulVmcn06YUL97ymWZpsDjGShAPcljuCILsK
bl4aBXK2MzvajdYy/FUD4NpHftonm2yYpyjt4OBgaRllKTP8feJjyORymXHhLYqT
WyLFEsUCgYEA/55FnQ+o0fku3G2FcLDx+RLPn/oYHuywz7rLGS0Z0lAjbBlx8US0
bV+5GOveELI6xBGwzBlZaoAgdKpu7EMCP+t8/clxdRP31kt//4siGCEV/CFxC8nj
2HtAL5V95kvjqbmNGs37eyUcA5YbvDjKmwdkvwnm/GggpvFn4HzuHWsCgYEAyNW9
eUs8sc4xQnMxDqzOlebMJrOUq7zZn8HQGTHxVcT6TD7rE+d8Ht1g+vggsDgDq9U0
AWlRxpBnZaalQEcFV8Xru3nnegHTtZ0oiFQj0/+tQ9SexBq5i4n5KO0TdkSvOMJ2
rqscgJ9H8kvH2eHnHJVufBPLbnHdV45DUL74Aq8CgYAGU455gqe0+qvUPMmurlJu
za5h0TjDmywNGBxqtRkMgXs+86pERGUKx/G20i+ezipyK9XqVz5FSoKDIKy6IDZw
Co3/Yfry4Nmjbh7u3iyr2DXJFbLMjeSbuQEvrE1/Y6Vwz+zUGwD8XUDCPfbVw7oP
+DDgIYib+p/EQflGLxFdnQKBgGVcGoiBBFzop8vVv0icxpa5KQfPUpVqdps+gfx1
TEvxYjHg/1vIVMhvCmcfm7/URWYP8HNV6EPC1axj8rsCHRwzc8nmuIDHM0ZRzwcf
EAYK4DN/t7FZm5NlSy7wmAX0nEqVOrjk+zmfKfyLao34iV/Puzc79kwDg6aQ0kCK
YTlZAoGARKIKJKcbRU+W1+UjcVhD+rb7qALLPA2VdVqkviAVpdymFf//XR0NWA69
gNT4LJx3GvfZFtL90LDjHrG4K5FmiXvfNxKpowkcT2nKnlYfrwi/I1vkEF+5kb3i
uDl3e11e6es212d2FvVhFntO1lFGjvB8e2GcWZ0XpKSsAUhm1B4=
-----END RSA PRIVATE KEY-----');

        $key = openssl_pkey_get_private($privatekey);

        // create the signature
        openssl_sign($string, $signature, $key, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }

    public function generateUrl($data)
    {
        $entityId = 35641;
        $vendorId = "CZ00YKZ001";
        $userName = "Yakuza";
        // $entityId = 23271;
        // $vendorId = "CZ00TEST001";
        // $userName = "test01";
        $post = '
		{
			"request": {
		        "entityId": "' . $entityId . '",
		        "vendorIdentifier": "' . $vendorId . '",
		        "transactionUsername": "' . $userName . '",
		        "merchantName": "Legion",
		        "merchantDescription": "Tranksaksi",
		        "token": "",
		        "callbackSuccess": "' . url('api/transaksiproduk/paid/' . $data['inv']) . '",
		        "callbackFailure": "",
		        "message": "",
		        "description": "Transaction Legion",
		        "referenceId": "' . $data["inv"] . '",
		        "currencyCode": "IDR",
		        "amount": ' . $data["amount"] . '
			}
		}';
        $jpost = new stdClass;
        $jpost->data = json_decode($post);
        $jpost->unsigned = json_encode($jpost->data, JSON_UNESCAPED_SLASHES);
        $jpost->signature = $this->generate_signature($jpost->unsigned);
        unset($jpost->unsigned);
        $post = json_encode($jpost, JSON_UNESCAPED_SLASHES);
        $header = array(
            "content-type: application/json"
        );
        $scrap = $this->do_curl('https://api-link.cashlez.com/generate_url_vendor', $post, $header);
        $json = json_decode($scrap, $associative = true, $depth = 512, JSON_THROW_ON_ERROR);
        return isset($json['data']) &&
            isset($json['data']['response']) ?
            $json['data']['response'] : null;
    }

    function do_curl($link, $data = null, $header = null, $location = false)
    {
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        curl_setopt($ch, CURLOPT_REFERER, isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        if (!empty($data)) {
            if (is_array($data)) {
                $data = http_build_query($data);
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, trim($data));
        }
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $return = curl_exec($ch);
        if ($location) {
            $return = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        }
        return $return ? $return : "";
    }
}
