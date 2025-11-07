<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transacao;

class DepositoController extends Controller
{
    public function index()
    {
        $depositos = Transacao::with('user')
            ->where('tipo', 'deposito')
            ->orderByRaw("CASE WHEN status = 'pendente' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('admin.depositos.index', compact('depositos'));
    }

    public function aprovar($id)
    {
        $deposito = Transacao::findOrFail($id);
        
        if ($deposito->status !== 'pendente') {
            return back()->with('error', 'Este depósito já foi processado!');
        }

        $deposito->update(['status' => 'aprovado']);
        
        // Creditar no saldo do usuário
        $deposito->user->increment('saldo', $deposito->valor);

        return back()->with('success', 'Depósito aprovado e saldo creditado!');
    }

    public function rejeitar($id)
    {
        $deposito = Transacao::findOrFail($id);
        
        if ($deposito->status !== 'pendente') {
            return back()->with('error', 'Este depósito já foi processado!');
        }

        $deposito->update(['status' => 'rejeitado']);

        return back()->with('success', 'Depósito rejeitado!');
    }
}

