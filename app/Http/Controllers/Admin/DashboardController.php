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
        try {
            // Estatísticas gerais (com valores padrão se falhar)
            $totalUsuarios = User::where('is_admin', false)->count() ?? 0;
            $totalCorridas = Corrida::count() ?? 0;
            $totalApostas = Aposta::count() ?? 0;
            $totalApostasHoje = Aposta::whereDate('created_at', today())->count() ?? 0;
            
            // Valores financeiros
            $valorTotalApostas = Aposta::sum('valor') ?? 0;
            $valorApostasHoje = Aposta::whereDate('created_at', today())->sum('valor') ?? 0;
            
            // Depósitos e saques pendentes
            $depositosPendentes = Transacao::where('tipo', 'deposito')
                ->where('status', 'pendente')
                ->count() ?? 0;
            $saquesPendentes = Transacao::where('tipo', 'saque')
                ->where('status', 'pendente')
                ->count() ?? 0;
            
            // Corridas ao vivo
            $corridasAoVivo = Corrida::where('status', 'ao_vivo')->get() ?? collect();
            
            // Próximas corridas
            $proximasCorridas = Corrida::where('status', 'aberta')
                ->where('data_hora', '>', now())
                ->orderBy('data_hora', 'asc')
                ->limit(5)
                ->get() ?? collect();
            
        } catch (\Exception $e) {
            // Se der erro, usar valores padrão
            $totalUsuarios = 0;
            $totalCorridas = 0;
            $totalApostas = 0;
            $totalApostasHoje = 0;
            $valorTotalApostas = 0;
            $valorApostasHoje = 0;
            $depositosPendentes = 0;
            $saquesPendentes = 0;
            $corridasAoVivo = collect();
            $proximasCorridas = collect();
        }
        
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

