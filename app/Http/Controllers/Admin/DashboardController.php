<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Corrida;
use App\Models\Aposta;
use App\Models\User;
use App\Models\Transacao;
use Illuminate\Support\Facades\DB;
use Throwable;

class DashboardController extends Controller
{
    public function index()
    {
        try {
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

            // Forçar renderização aqui para capturar erros do Blade no try/catch
            $html = view('admin.dashboard', compact(
                'totalUsuarios', 'totalCorridas', 'totalApostas', 'totalApostasHoje',
                'valorTotalApostas', 'valorApostasHoje', 'depositosPendentes', 'saquesPendentes',
                'corridasAoVivo', 'proximasCorridas'
            ))->render();

            return response($html);
        } catch (Throwable $e) {
            // Logar no stdout (Render mostra nos logs) e no logger padrão
            error_log('[DashboardController] Falha ao renderizar dashboard: ' . $e->getMessage() . ' em ' . $e->getFile() . ':' . $e->getLine());
            logger()->error('Dashboard render error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Fallback seguro para evitar 500 enquanto investigamos
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

            $html = view('admin.dashboard', compact(
                'totalUsuarios', 'totalCorridas', 'totalApostas', 'totalApostasHoje',
                'valorTotalApostas', 'valorApostasHoje', 'depositosPendentes', 'saquesPendentes',
                'corridasAoVivo', 'proximasCorridas'
            ))->with('erroDashboard', 'Houve um problema ao carregar os dados. Exibindo valores parciais.')->render();

            return response($html, 200);
        }
    }
}

