<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aposta;

class ApostaController extends Controller
{
    public function index()
    {
        $apostas = Aposta::with(['user', 'corrida', 'piloto'])
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('admin.apostas.index', compact('apostas'));
    }

    public function show($id)
    {
        $aposta = Aposta::with(['user', 'corrida', 'piloto'])->findOrFail($id);
        return view('admin.apostas.show', compact('aposta'));
    }

    public function cancelar($id)
    {
        $aposta = Aposta::findOrFail($id);
        
        if ($aposta->status !== 'ativa') {
            return back()->with('error', 'Apenas apostas ativas podem ser canceladas!');
        }

        // Devolver o valor para o usuário
        $aposta->user->increment('saldo', $aposta->valor);
        
        // Marcar como perdida ou criar status cancelada
        $aposta->delete();

        return back()->with('success', 'Aposta cancelada e valor devolvido ao usuário!');
    }
}

