<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    public function nearestgym(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => gym::limit(10)->get()
        ], 200);
    }
}
