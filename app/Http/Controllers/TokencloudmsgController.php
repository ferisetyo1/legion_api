<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tokencloudmsg;
use Illuminate\Http\Request;

class TokencloudmsgController extends Controller
{
    public function create(Request $request)
    {
        $array = ['token_user_id' => auth()->user()->id, 'token_value' => $request->token_value];
        $response=tokencloudmsg::updateOrCreate($array, $array);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' =>$response],200);
    }
}
