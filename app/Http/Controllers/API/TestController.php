<?php

// ============================================
// app/Http/Controllers/API/TestController.php
// ============================================

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // GET: http://localhost:8000/api/test
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'API funcionando correctamente',
            'data' => [
                'version' => '1.0',
                'app' => 'Liga API',
                'timestamp' => now()->toDateTimeString()
            ]
        ], 200);
    }
    
    // POST: http://localhost:8000/api/test
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'nullable|string',
            'timestamp' => 'nullable|string'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Datos recibidos correctamente',
            'data' => $data,
            'recibido_en' => now()->toDateTimeString()
        ], 200);
    }
    
    // GET: http://localhost:8000/api/test/{id}
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Mostrando elemento',
            'data' => [
                'id' => $id,
                'nombre' => 'Elemento ' . $id
            ]
        ], 200);
    }
}