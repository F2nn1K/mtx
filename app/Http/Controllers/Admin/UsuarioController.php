<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::where('is_admin', false)
            ->withCount('apostas')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function toggleStatus($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update(['ativo' => !$usuario->ativo]);
        
        $status = $usuario->ativo ? 'ativado' : 'bloqueado';
        return back()->with('success', "Usuário {$status} com sucesso!");
    }

    public function editarSaldo(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        
        $validated = $request->validate([
            'saldo' => 'required|numeric|min:0',
        ]);

        $usuario->update(['saldo' => $validated['saldo']]);

        return response()->json([
            'success' => true,
            'message' => 'Saldo atualizado com sucesso!',
            'novo_saldo' => $usuario->saldo,
        ]);
    }
}

