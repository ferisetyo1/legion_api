<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AlamatPengiriman;
use Illuminate\Http\Request;
use \Validator;

class AlamatPengirimanController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => [
                "rumah" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                "kantor" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                "lainnya" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
            ]
        ], 200);
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'ap_nama' => 'required',
            'ap_prov_id' => 'required',
            'ap_prov_nama' => 'required',
            'ap_kota_id' => 'required',
            'ap_kota_nama' => 'required',
            // 'ap_kecamatan_id' => 'required',
            // 'ap_kecamatan_nama' => 'required',
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
            AlamatPengiriman::create($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => "Create data successfully",
                'data' => [
                    "rumah" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                    "kantor" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                    "lainnya" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
                ]
            ], 200);
        }
    }

    public function edit(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'ap_nama' => 'required',
            'ap_prov_id' => 'required',
            'ap_prov_nama' => 'required',
            'ap_kota_id' => 'required',
            'ap_kota_nama' => 'required',
            // 'ap_kecamatan_id' => 'required',
            // 'ap_kecamatan_nama' => 'required',
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
            AlamatPengiriman::where("ap_id", $request->ap_id)->update($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => "Updated data successfully",
                'data' => [
                    "rumah" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'rumah')->first(),
                    "kantor" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'kantor')->first(),
                    "lainnya" => AlamatPengiriman::where('ap_user_id', $request->user()->id)->where('ap_type', 'lainnya')->get(),
                ]
            ], 200);
        }
    }

    public function cost(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        setlocale(LC_TIME, 'id_ID');
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
        $from = null;
        $minEtd = -1;
        $maxEtd = -1;
        $query = array(
            "origin" => 501,
            "originType" => "city",
            "destination" => $rumah->ap_kota_id,
            "destinationType" => "city",
            "weight" => $request->berat,
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
                if (isset($json['rajaongkir']['origin_details'])) {
                    $from = $json['rajaongkir']['origin_details'];
                }
                if (isset($json['rajaongkir']['results']) && !empty($json['rajaongkir']['results'])) {
                    $obj = $json['rajaongkir']['results'][0];
                    if (isset($obj['costs'])) {
                        foreach ($obj['costs'] as $key2 => $value2) {
                            if (isset($value2['service']) && isset($value2['description'])) {
                                if ($value2['service'] == 'REG' || str_contains(strtolower($value2['description']), 'regular')) {
                                    if (isset($value2['cost']) && !empty($value2['cost'])) {
                                        $regular[] = [
                                            "name" => ucwords( $value),
                                            "biaya" => $value2['cost'][0]
                                        ];
                                        if (isset($value2['cost'][0]['etd'])&&!empty($value2['cost'][0]['etd'])) {
                                            $explode = explode("-", $value2['cost'][0]['etd']);
                                            if (isset($explode[0])) {
                                                $val = $explode[0];
                                                if ($val < $minEtd || $minEtd == -1) {
                                                    $minEtd = $val;
                                                }
                                            }
                                            if (isset($explode[1])) {
                                                $val = $explode[1];
                                                if ($val > $maxEtd || $maxEtd == -1) {
                                                    $maxEtd = $val;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $minEtd=date('d', strtotime(Date('d M y') . ' ' . '+ '.$minEtd.' day'));
        $maxEtd=date('d', strtotime(Date('d M y') . ' ' . '+ '.$maxEtd.' day'));
        return response()->json([
            'status' => 'success',
            'msg' => "Updated data successfully",
            'data' => [
                'to' => $rumah,
                'from' => $from,
                'est'=>"$minEtd-$maxEtd ".Date("M"),
                'regular' => $regular
            ]
        ], 200);
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

    public function counter(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "get data successfully",
            'data' => AlamatPengiriman::where('ap_user_id', $request->user()->id)->count()
        ], 200);
    }
}
