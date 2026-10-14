<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LeagueInfo;
use Illuminate\Http\Request;

class LeagueInfoController extends Controller
{
    public function show()
    {
        $info = LeagueInfo::first();

        return response()->json([
            'success' => true,
            'data' => $info,
        ], 200);
    }
}