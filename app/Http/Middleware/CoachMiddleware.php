<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CoachMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role !== 'coach') {
            return response()->json([
                'success' => false,
                'message' => 'No autorizado. Solo coaches.',
            ], 403);
        }

        return $next($request);
    }
}