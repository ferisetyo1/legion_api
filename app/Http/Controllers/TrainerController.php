<?php

namespace App\Http\Controllers;

use App\Models\trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function index(Request $request)
    {
        $limit = isset($_GET["limit"]) ? $_GET["limit"] : 10;
        $trainer = trainer::where("pt_id", "!=", 0);
        if (isset($_GET['except'])) {
            $trainer = $trainer->where("pt_id", "!=", $_GET['except']);
        }
        if (isset($_GET["query"])) {
            $trainer = $trainer->where("pt_nama", "like", "%" . $_GET['query'] . "%");
        }
        $trainer = $trainer->paginate($limit);
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' =>  [
                'total_items' => $trainer->total(),
                'total_page' => $trainer->lastPage(),
                'current_page' => $trainer->currentPage(),
                'items' => $trainer->items()
            ]
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' =>  trainer::with('review','harga','gym')->firstWhere('pt_id', $id)
        ], 200);
    }
}
