<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transacao;
use Illuminate\Http\Request;

class TransacaoApiController extends Controller
{
    public function depositar(Request $request)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric|min:10',
            'comprovante' => 'nullable|string',
        ]);

        $transacao = Transacao::create([
            'user_id' => $request->user()->id,
            'tipo' => 'deposito',
            'valor' => $validated['valor'],
            'status' => 'pendente',
            'comprovante' => $validated['comprovante'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Depósito solicitado! Aguarde aprovação.',
            'transacao' => $transacao,
        ], 201);
    }

    public function sacar(Request $request)
    {
        $validated = $request->validate([
            'valor' => 'required|numeric|min:10',
            'chave_pix' => 'required|string',
        ]);

        $user = $request->user();

        if ($user->saldo < $validated['valor']) {
            return response()->json([
                'success' => false,
                'message' => 'Saldo insuficiente.',
            ], 400);
        }

        // Debitar do saldo
        $user->decrement('saldo', $validated['valor']);

        $transacao = Transacao::create([
            'user_id' => $user->id,
            'tipo' => 'saque',
            'valor' => $validated['valor'],
            'status' => 'pendente',
            'chave_pix' => $validated['chave_pix'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Saque solicitado! Aguarde processamento.',
            'transacao' => $transacao,
            'novo_saldo' => $user->fresh()->saldo,
        ], 201);
    }

    public function index(Request $request)
    {
        $transacoes = $request->user()->transacoes()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'transacoes' => $transacoes,
        ]);
    }

    public function saldo(Request $request)
    {
        return response()->json([
            'success' => true,
            'saldo' => $request->user()->saldo,
        ]);
    }
}

