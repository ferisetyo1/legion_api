<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\logTransaksiPrivate;
use App\Models\LogTypeTransaksiPrivate;
use Illuminate\Http\Request;

class LogTransaksiPrivateController extends Controller
{
    public function create($privcode=null,$transid=null)
    {
        $type=LogTypeTransaksiPrivate::firstwhere('log_code',$privcode);
        if ($type!=null) {
            $array=[
                'log_transaksi_id'=>$transid,
                'log_type_id'=>$type->log_id,
            ];
            logTransaksiPrivate::updateOrCreate($array,$array);
        }
    }
}
