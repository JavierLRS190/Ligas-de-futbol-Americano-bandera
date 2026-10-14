<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Standing;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index($seasonId)
    {
        $standings = Standing::where('season_id', $seasonId)
            ->with('team')
            ->orderBy('points', 'desc')
            ->orderBy('goal_difference', 'desc')
            ->orderBy('goals_for', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $standings,
        ], 200);
    }
}