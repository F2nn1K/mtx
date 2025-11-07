<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Corrida;

class CorridaApiController extends Controller
{
    public function index()
    {
        $corridas = Corrida::with('pilotos')
            ->whereIn('status', ['aberta', 'ao_vivo'])
            ->orderBy('data_hora', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'corridas' => $corridas,
        ]);
    }

    public function show($id)
    {
        $corrida = Corrida::with('pilotos')->findOrFail($id);

        return response()->json([
            'success' => true,
            'corrida' => $corrida,
        ]);
    }

    public function pilotos($id)
    {
        $corrida = Corrida::with('pilotos')->findOrFail($id);

        return response()->json([
            'success' => true,
            'pilotos' => $corrida->pilotos,
        ]);
    }
}

