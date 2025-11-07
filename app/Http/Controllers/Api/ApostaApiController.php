<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aposta;
use App\Models\Corrida;
use Illuminate\Http\Request;

class ApostaApiController extends Controller
{
    public function index(Request $request)
    {
        $apostas = $request->user()->apostas()
            ->with(['corrida', 'piloto'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'apostas' => $apostas,
        ]);
    }

    public function show($id, Request $request)
    {
        $aposta = $request->user()->apostas()
            ->with(['corrida', 'piloto'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'aposta' => $aposta,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'corrida_id' => 'required|exists:corridas,id',
            'piloto_id' => 'required|exists:pilotos,id',
            'tipo_aposta' => 'required|in:vencedor,podio,head_to_head,volta_rapida',
            'valor' => 'required|numeric|min:1',
            'cotacao' => 'required|numeric|min:1',
        ]);

        $user = $request->user();
        $corrida = Corrida::findOrFail($validated['corrida_id']);

        // Validações
        if ($corrida->status !== 'aberta') {
            return response()->json([
                'success' => false,
                'message' => 'Esta corrida não está aberta para apostas.',
            ], 400);
        }

        if ($user->saldo < $validated['valor']) {
            return response()->json([
                'success' => false,
                'message' => 'Saldo insuficiente.',
            ], 400);
        }

        // Criar aposta
        $aposta = Aposta::create([
            'user_id' => $user->id,
            'corrida_id' => $validated['corrida_id'],
            'piloto_id' => $validated['piloto_id'],
            'tipo_aposta' => $validated['tipo_aposta'],
            'valor' => $validated['valor'],
            'cotacao' => $validated['cotacao'],
            'valor_possivel' => $validated['valor'] * $validated['cotacao'],
            'status' => 'ativa',
        ]);

        // Debitar do saldo
        $user->decrement('saldo', $validated['valor']);

        return response()->json([
            'success' => true,
            'aposta' => $aposta->load(['corrida', 'piloto']),
            'novo_saldo' => $user->fresh()->saldo,
        ], 201);
    }
}

