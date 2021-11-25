<?php

namespace App\Http\Controllers;

use App\Models\gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    public function index(Request $request)
    {
        $longitude = isset($_GET['longitude']) ? $_GET['longitude'] : -7.9824551;
        $latitude = isset($_GET['latitude']) ? $_GET['latitude'] : 112.6308084;
        $gym = gym::selectRaw("*,
        ( 1.60934 * 6371 * acos( cos( radians(" . $latitude . ") ) *
        cos( radians(gym_latitude) ) *
        cos( radians(gym_longitude) - radians(" . $longitude . ") ) + 
        sin( radians(" . $latitude . ") ) *
        sin( radians(gym_latitude) ) ) ) 
        AS gym_distance")
            ->orderBy("gym_distance");
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        if (isset($_GET['except'])) {
            $gym = $gym->where("gym_id", "!=", $_GET['except']);
        }
        if (isset($_GET["query"])) {
            $gym = $gym->where("gym_nama", "like", "%" . $_GET['query'] . "%");
        }
        $gym = $gym->paginate($limit);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' =>  [
                'total_items' => $gym->total(),
                'total_page' => $gym->lastPage(),
                'current_page' => $gym->currentPage(),
                'items' => $gym->items()
            ]
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' =>  gym::with("trainer", "review","fasilitas")->firstWhere('gym_id', $id)
        ], 200);
    }
}
