<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPrivat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use \Validator;

class TransaksiPrivatController extends Controller
{
    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $transaksi = TransaksiPrivat::with('hargaTrainer')->orderBy('tp_id', 'DESC');
        if (isset($_GET["query"])) {
            $transaksi = $transaksi->where("tp_invoice", "like", "%" . $_GET['query'] . "%");
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
            $transaksi = TransaksiPrivat::where('tp_tgl_private', $request->tp_tgl_private)->whereRaw("('$request->tp_jam_private' >= tp_jam_private AND '$request->tp_jam_private' <= ADDTIME(tp_jam_private,'1:0:0'))");
            if ($transaksi->first() == null || $transaksi->first()->tp_status==4) {
                $request['tp_invoice'] = "INV" . $request->user()->id . time();
                $request['tp_status'] = 0;
                $request['tp_waktu_expired'] = date('d-m-Y, H.i', strtotime(Date('d-m-Y, H.i') . ' ' . '+ 1 hours'));
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
                    'tgl'=> $request->tp_tgl_private
                ], 400);
            }
        }
    }

    public function cekjadwal(Request $request)
    {
        $transaksi = TransaksiPrivat::where('tp_tgl_private', $request->tp_tgl_private)->whereRaw("'$request->tp_jam_private' >= tp_jam_private AND '$request->tp_jam_private' <= ADDTIME(tp_jam_private,'1:0:0')")->first();
        return response()->json([
            'status' => 'success',
            'msg' => $transaksi == null?"Get data successfully":"Anda sudah memiliki jadwal pada waktu tersebut.",
            'data' => $transaksi == null
        ], 200);
    }
    
    public function show($id,Request $request)
    {
        $transaksi = TransaksiPrivat::with('trainer', 'hargaTrainer', 'alamatprivate')->find($id);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => $transaksi
        ], 200);
    }
    
}
