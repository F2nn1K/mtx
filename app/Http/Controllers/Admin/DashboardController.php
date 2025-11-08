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
        error_log('===== DASHBOARD INDEX INICIADO =====');
        error_log('User autenticado: ' . (auth()->check() ? auth()->user()->email : 'nenhum'));
        try {
            error_log('Buscando total usuarios...');
            $totalUsuarios = User::where('is_admin', false)->count();
            error_log('Total usuarios: ' . $totalUsuarios);
        } catch (\Exception $e) {
            error_log('ERRO usuarios: ' . $e->getMessage());
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
        
        error_log('Preparando para renderizar view...');
        
        try {
            $view = view('admin.dashboard', compact(
                'totalUsuarios', 'totalCorridas', 'totalApostas', 'totalApostasHoje',
                'valorTotalApostas', 'valorApostasHoje', 'depositosPendentes', 'saquesPendentes',
                'corridasAoVivo', 'proximasCorridas'
            ));
            
            error_log('View criada, tentando renderizar...');
            return $view;
            
        } catch (\Throwable $e) {
            error_log('===== ERRO AO RENDERIZAR VIEW =====');
            error_log('Mensagem: ' . $e->getMessage());
            error_log('Arquivo: ' . $e->getFile());
            error_log('Linha: ' . $e->getLine());
            error_log('Trace: ' . $e->getTraceAsString());
            
            // Fallback HTML puro
            return response()->make('
                <!DOCTYPE html>
                <html>
                <head><title>Dashboard</title></head>
                <body style="font-family: Arial; padding: 50px;">
                    <h1>Dashboard - Roraima Bets</h1>
                    <p><strong>Total Usuários:</strong> ' . $totalUsuarios . '</p>
                    <p><strong>Total Corridas:</strong> ' . $totalCorridas . '</p>
                    <p><strong>Total Apostas:</strong> ' . $totalApostas . '</p>
                    <hr>
                    <p style="color: red;"><strong>ERRO:</strong> ' . $e->getMessage() . '</p>
                    <p><small>Arquivo: ' . $e->getFile() . ':' . $e->getLine() . '</small></p>
                    <hr>
                    <p><a href="/login">Voltar ao Login</a></p>
                </body>
                </html>
            ', 200);
        }
    }
}
