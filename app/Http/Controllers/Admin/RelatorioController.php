<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aposta;
use App\Models\Transacao;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function index()
    {
        // Relatório financeiro
        $totalDepositos = Transacao::where('tipo', 'deposito')
            ->where('status', 'aprovado')
            ->sum('valor');
        
        $totalSaques = Transacao::where('tipo', 'saque')
            ->where('status', 'aprovado')
            ->sum('valor');
        
        $totalApostas = Aposta::sum('valor');
        $totalPago = Aposta::where('status', 'venceu')->sum('valor_ganho');
        $lucroCasa = $totalApostas - $totalPago;
        
        // Apostas por mês
        $apostasPorMes = Aposta::select(
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('YEAR(created_at) as ano'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(valor) as valor_total')
            )
            ->groupBy('ano', 'mes')
            ->orderBy('ano', 'desc')
            ->orderBy('mes', 'desc')
            ->limit(12)
            ->get();
        
        return view('admin.relatorios.index', compact(
            'totalDepositos',
            'totalSaques',
            'totalApostas',
            'totalPago',
            'lucroCasa',
            'apostasPorMes'
        ));
    }
}

