<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Piloto;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
    public function index()
    {
        $pilotos = Piloto::orderBy('nome')->paginate(20);
        return view('admin.pilotos.index', compact('pilotos'));
    }

    public function create()
    {
        return view('admin.pilotos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer|unique:pilotos',
            'categoria' => 'required|string',
            'foto_url' => 'nullable|url',
            'biografia' => 'nullable|string',
        ]);

        $validated['ativo'] = true;

        Piloto::create($validated);

        return redirect()->route('admin.pilotos.index')
            ->with('success', 'Piloto criado com sucesso!');
    }

    public function edit($id)
    {
        $piloto = Piloto::findOrFail($id);
        return view('admin.pilotos.edit', compact('piloto'));
    }

    public function update(Request $request, $id)
    {
        $piloto = Piloto::findOrFail($id);
        
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'numero' => 'required|integer|unique:pilotos,numero,'.$id,
            'categoria' => 'required|string',
            'foto_url' => 'nullable|url',
            'biografia' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $piloto->update($validated);

        return redirect()->route('admin.pilotos.index')
            ->with('success', 'Piloto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $piloto = Piloto::findOrFail($id);
        $piloto->delete();

        return redirect()->route('admin.pilotos.index')
            ->with('success', 'Piloto excluído com sucesso!');
    }
}

