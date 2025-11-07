<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Corrida;
use App\Models\Aposta;
use App\Models\User;
use App\Models\Transacao;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Temporário: retornar texto simples para debug
        return response()->json([
            'status' => 'OK',
            'message' => 'Dashboard funcionando!',
            'usuarios' => User::count(),
            'corridas' => Corrida::count(),
            'pilotos' => \App\Models\Piloto::count(),
        ]);
    }
}

