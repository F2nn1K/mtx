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
            $totalUsuarios = User::where('is_admin', false)->count();
        } catch (\Exception $e) {
            $totalUsuarios = 0;
        }

        try {
            $totalCorridas = Corrida::count();
        } catch (\Exception $e) {
            $totalCorridas = 0;
        }

        try {
            $totalApostas = Aposta::count();
            $totalApostasHoje = Aposta::whereDate('created_at', today())->count();
            $valorTotalApostas = Aposta::sum('valor') ?? 0;
            $valorApostasHoje = Aposta::whereDate('created_at', today())->sum('valor') ?? 0;
        } catch (\Exception $e) {
            $totalApostas = 0;
            $totalApostasHoje = 0;
            $valorTotalApostas = 0;
            $valorApostasHoje = 0;
        }

        try {
            $depositosPendentes = Transacao::where('tipo', 'deposito')->where('status', 'pendente')->count();
            $saquesPendentes = Transacao::where('tipo', 'saque')->where('status', 'pendente')->count();
        } catch (\Exception $e) {
            $depositosPendentes = 0;
            $saquesPendentes = 0;
        }

        try {
            $corridasAoVivo = Corrida::where('status', 'ao_vivo')->get();
        } catch (\Exception $e) {
            $corridasAoVivo = collect();
        }

        try {
            $proximasCorridas = Corrida::where('status', 'aberta')->orderBy('data_hora', 'asc')->limit(5)->get();
        } catch (\Exception $e) {
            $proximasCorridas = collect();
        }
        
        return view('admin.dashboard-temp', compact(
            'totalUsuarios', 'totalCorridas', 'totalApostas', 'totalApostasHoje',
            'valorTotalApostas', 'valorApostasHoje', 'depositosPendentes', 'saquesPendentes',
            'corridasAoVivo', 'proximasCorridas'
        ));
    }
}
