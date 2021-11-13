<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificationcount()
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'Success get notif count',
            'data' => 10
        ],200);
    }
}
