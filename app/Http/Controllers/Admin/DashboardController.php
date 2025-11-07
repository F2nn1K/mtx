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
        // Estatísticas gerais
        $totalUsuarios = User::where('is_admin', false)->count();
        $totalCorridas = Corrida::count();
        $totalApostas = Aposta::count();
        $totalApostasHoje = Aposta::whereDate('created_at', today())->count();
        
        // Valores financeiros
        $valorTotalApostas = Aposta::sum('valor');
        $valorApostasHoje = Aposta::whereDate('created_at', today())->sum('valor');
        
        // Depósitos e saques pendentes
        $depositosPendentes = Transacao::where('tipo', 'deposito')
            ->where('status', 'pendente')
            ->count();
        $saquesPendentes = Transacao::where('tipo', 'saque')
            ->where('status', 'pendente')
            ->count();
        
        // Corridas ao vivo
        $corridasAoVivo = Corrida::where('status', 'ao_vivo')->get();
        
        // Próximas corridas
        $proximasCorridas = Corrida::where('status', 'aberta')
            ->where('data_hora', '>', now())
            ->orderBy('data_hora', 'asc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalCorridas',
            'totalApostas',
            'totalApostasHoje',
            'valorTotalApostas',
            'valorApostasHoje',
            'depositosPendentes',
            'saquesPendentes',
            'corridasAoVivo',
            'proximasCorridas'
        ));
    }
}

