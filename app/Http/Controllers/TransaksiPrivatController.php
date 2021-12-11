<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HargaTrainer;
use App\Models\TransaksiPrivat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use stdClass;
use \Validator;

class TransaksiPrivatController extends Controller
{
    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $transaksi = TransaksiPrivat::with('hargaTrainer')->orderBy('tp_id', 'DESC')->where('tp_user_id',$request->user()->id);
        if (isset($_GET["query"])) {
            $transaksi = $transaksi->where("tp_invoice", "like", "%" . $_GET['query'] . "%");
        }
        if (isset($request->status)) {
            if ($request->status == 1) {
                //menunggu pembayaran
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 0)->where('tp_is_confirm', 0);
            }
            if ($request->status == 2) {
                //menunggu konfirmasi
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 1)->where('tp_is_confirm', 0);
            }
            if ($request->status == 3) {
                //dikonfirmasi
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 0)->where("tp_is_paid", 1)->where('tp_is_confirm', 1);
            }
            if ($request->status == 4) {
                //selesai
                $transaksi = $transaksi->where("tp_is_cancel", 0)->where("tp_is_done", 1)->where("tp_is_paid", 1)->where('tp_is_confirm', 1);
            }
            if ($request->status == 5) {
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

    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $validate = Validator::make($request->all(), [
            'tp_pt_id' => 'required',
            'tp_ht_id' => 'required',
            'tp_tgl_private' => 'required',
            'tp_jam_private' => 'required',
            'tp_metode_pembayaran' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'success',
                'msg' => "Get data successfully",
                'data' => $validate->errors()
            ], 400);
        } else {
            $ht=HargaTrainer::find($request->tp_ht_id);
            $transaksi = TransaksiPrivat::where('tp_user_id',$request->user()->id)->where("tp_pt_id",$request->tp_pt_id)->where('tp_tgl_private', $request->tp_tgl_private)->whereRaw("('$request->tp_jam_private' >= tp_jam_private AND '$request->tp_jam_private' <= ADDTIME(tp_jam_private,'0:$ht->ht_waktu:0'))");
            if ($transaksi->first() == null || $transaksi->first()->tp_status == 4) {
                $request['tp_invoice'] = "INV" . $request->user()->id . time();
                $request['tp_user_id'] = $request->user()->id;
                $request['tp_is_paid'] = false;
                $request['tp_is_confirm'] = false;
                $request['tp_is_cancel'] = false;
                $request['tp_is_done'] = false;
                $generateUrl = $this->generateUrl([
                    'inv' => $request['tp_invoice'],
                    'amount' => $ht->ht_harga
                ]);
                $request["tp_generate_url"] = isset($generateUrl['generatedUrl']) ? $generateUrl['generatedUrl'] : '';
                $request["tp_waktu_expired"] = isset($generateUrl['expiredDate']) ? $generateUrl['expiredDate'] : '';
                $transaksi = TransaksiPrivat::create($request->all());
                return response()->json([
                    'status' => 'success' . date('d M Y') . substr($request->tp_jam_private, 0, 2),
                    'msg' => "Get data successfully",
                    'data' => $transaksi
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success',
                    'msg' => "Kamu sudah mempunyai jadwal lain dijam ini",
                    'data' => $transaksi->first(),
                    'sql' => $transaksi->toSql(),
                    'tgl' => $request->tp_tgl_private
                ], 400);
            }
        }
    }

    public function cekjadwal(Request $request)
    {
        $transaksi = TransaksiPrivat::where('tp_tgl_private', $request->tp_tgl_private)->whereRaw("'$request->tp_jam_private' >= tp_jam_private AND '$request->tp_jam_private' <= ADDTIME(tp_jam_private,'1:0:0')")->first();
        return response()->json([
            'status' => 'success',
            'msg' => $transaksi == null ? "Get data successfully" : "Anda sudah memiliki jadwal pada waktu tersebut.",
            'data' => $transaksi == null
        ], 200);
    }

    public function show($id, Request $request)
    {
        $transaksi = TransaksiPrivat::with('trainer', 'hargaTrainer', 'alamatprivate')->find($id);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => $transaksi
        ], 200);
    }

    public function updatePaid($id)
    {
        $transaksi = TransaksiPrivat::find($id);
        $transaksi->is_paid = true;
        $transaksi->save();
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => $transaksi
        ], 200);
    }

    function verify_signature($string, $signature)
    {
        $publickey = trim('-----BEGIN PUBLIC KEY-----
        MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtJuWjky2k37dm7i3pep1
        8WE8pwJNwsc/itRSh79u1VUNPvqoH6D0IXKIc12gUvtv3A2Fqq5LyCWkMIbDOG0v
        Q/dt8Mf5Fz+nzbuI+i1iZni1cTRdl39fKTUdzFeMpOfLqsrPe2HSfKVBed/ILG6q
        w6MZuPM1AprXTXVLjz/lJnMLPZUlPRyy4WxCxPe4mrhDCqD4Z+YKVtpE+e/jhPBu
        NcIoxn2QNUm0dLmbbBcTfPbfIT/D088gNrHv0kWKAPuwkdifxzjE9LBeivaVIP2Y
        UXdIpGUjRM/HDmdVy8zs+0hWmwt7fNJSlCFYSbZfJQ8V0CWHOWRVKdVvzpH9EXoM
        EwIDAQAB
        -----END PUBLIC KEY-----');

        $key = openssl_pkey_get_public($publickey);

        // verify signature
        $result = openssl_verify($string, $signature, $key, "sha256WithRSAEncryption");

        return $result == 1;
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
		        "callbackSuccess": "",
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

    public function privateBerlangsung(Request $request)
    {
        $transaksi = TransaksiPrivat::where('tp_tgl_private', Date(""))->whereRaw("'$request->tp_jam_private' >= tp_jam_private AND '$request->tp_jam_private' <= ADDTIME(tp_jam_private,'1:0:0')")->first();
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => $transaksi == null
        ], 200);
    }
}
