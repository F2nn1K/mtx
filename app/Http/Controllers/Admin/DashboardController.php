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
        $totalUsuarios = User::where('is_admin', false)->count();
        $totalCorridas = Corrida::count();
        $totalApostas = Aposta::count();
        $totalApostasHoje = Aposta::whereDate('created_at', today())->count();
        
        $valorTotalApostas = Aposta::sum('valor') ?? 0;
        $valorApostasHoje = Aposta::whereDate('created_at', today())->sum('valor') ?? 0;
        
        $depositosPendentes = Transacao::where('tipo', 'deposito')->where('status', 'pendente')->count();
        $saquesPendentes = Transacao::where('tipo', 'saque')->where('status', 'pendente')->count();
        
        $corridasAoVivo = Corrida::where('status', 'ao_vivo')->get();
        $proximasCorridas = Corrida::where('status', 'aberta')->orderBy('data_hora', 'asc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsuarios', 'totalCorridas', 'totalApostas', 'totalApostasHoje',
            'valorTotalApostas', 'valorApostasHoje', 'depositosPendentes', 'saquesPendentes',
            'corridasAoVivo', 'proximasCorridas'
        ));
    }
}
