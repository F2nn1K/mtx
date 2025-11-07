<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transacao;

class SaqueController extends Controller
{
    public function index()
    {
        $saques = Transacao::with('user')
            ->where('tipo', 'saque')
            ->orderByRaw("CASE WHEN status = 'pendente' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('admin.saques.index', compact('saques'));
    }

    public function aprovar($id)
    {
        $saque = Transacao::findOrFail($id);
        
        if ($saque->status !== 'pendente') {
            return back()->with('error', 'Este saque já foi processado!');
        }

        $saque->update(['status' => 'aprovado']);

        return back()->with('success', 'Saque aprovado! Realize a transferência para o usuário.');
    }

    public function rejeitar($id)
    {
        $saque = Transacao::findOrFail($id);
        
        if ($saque->status !== 'pendente') {
            return back()->with('error', 'Este saque já foi processado!');
        }

        // Devolver o valor para o usuário
        $saque->user->increment('saldo', $saque->valor);
        $saque->update(['status' => 'rejeitado']);

        return back()->with('success', 'Saque rejeitado e saldo devolvido!');
    }
}

