<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Corrida;
use App\Models\Piloto;
use Illuminate\Http\Request;

class CorridaController extends Controller
{
    public function index()
    {
        $corridas = Corrida::with('pilotos')->orderBy('data_hora', 'desc')->paginate(20);
        return view('admin.corridas.index', compact('corridas'));
    }

    public function create()
    {
        $pilotos = Piloto::where('ativo', true)->get();
        return view('admin.corridas.create', compact('pilotos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'data_hora' => 'required|date',
            'categoria' => 'required|string',
            'descricao' => 'nullable|string',
        ]);

        $corrida = Corrida::create($validated);

        // Anexar pilotos com suas cotações
        if ($request->has('pilotos')) {
            foreach ($request->pilotos as $pilotoId => $cotacao) {
                $corrida->pilotos()->attach($pilotoId, ['cotacao' => $cotacao]);
            }
        }

        return redirect()->route('admin.corridas.index')
            ->with('success', 'Corrida criada com sucesso!');
    }

    public function edit($id)
    {
        $corrida = Corrida::with('pilotos')->findOrFail($id);
        $pilotos = Piloto::where('ativo', true)->get();
        return view('admin.corridas.edit', compact('corrida', 'pilotos'));
    }

    public function update(Request $request, $id)
    {
        $corrida = Corrida::findOrFail($id);
        
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'data_hora' => 'required|date',
            'categoria' => 'required|string',
            'descricao' => 'nullable|string',
            'status' => 'required|in:aberta,ao_vivo,finalizada,cancelada',
        ]);

        $corrida->update($validated);

        // Atualizar pilotos e cotações
        if ($request->has('pilotos')) {
            $pilotosData = [];
            foreach ($request->pilotos as $pilotoId => $cotacao) {
                $pilotosData[$pilotoId] = ['cotacao' => $cotacao];
            }
            $corrida->pilotos()->sync($pilotosData);
        }

        return redirect()->route('admin.corridas.index')
            ->with('success', 'Corrida atualizada com sucesso!');
    }

    public function finalizar(Request $request, $id)
    {
        $corrida = Corrida::findOrFail($id);
        
        $validated = $request->validate([
            'primeiro_lugar' => 'required|exists:pilotos,id',
            'segundo_lugar' => 'required|exists:pilotos,id',
            'terceiro_lugar' => 'required|exists:pilotos,id',
            'volta_rapida' => 'nullable|exists:pilotos,id',
        ]);

        $corrida->update([
            'status' => 'finalizada',
            'resultado' => json_encode($validated),
        ]);

        // Processar apostas (calcular vencedores e creditar)
        $this->processarApostas($corrida);

        return redirect()->route('admin.corridas.index')
            ->with('success', 'Corrida finalizada e apostas processadas!');
    }

    private function processarApostas($corrida)
    {
        $resultado = json_decode($corrida->resultado, true);
        $apostas = $corrida->apostas()->where('status', 'ativa')->get();

        foreach ($apostas as $aposta) {
            $ganhou = false;

            switch ($aposta->tipo_aposta) {
                case 'vencedor':
                    $ganhou = $aposta->piloto_id == $resultado['primeiro_lugar'];
                    break;
                case 'podio':
                    $ganhou = in_array($aposta->piloto_id, [
                        $resultado['primeiro_lugar'],
                        $resultado['segundo_lugar'],
                        $resultado['terceiro_lugar']
                    ]);
                    break;
                case 'volta_rapida':
                    $ganhou = $aposta->piloto_id == $resultado['volta_rapida'];
                    break;
            }

            if ($ganhou) {
                $valorGanho = $aposta->valor * $aposta->cotacao;
                $aposta->update([
                    'status' => 'venceu',
                    'valor_ganho' => $valorGanho,
                ]);
                
                // Creditar no saldo do usuário
                $aposta->user->increment('saldo', $valorGanho);
            } else {
                $aposta->update(['status' => 'perdeu']);
            }
        }
    }

    public function destroy($id)
    {
        $corrida = Corrida::findOrFail($id);
        
        // Excluir TUDO (apostas são deletadas automaticamente por CASCADE)
        $corrida->delete();
        
        return redirect()->route('admin.corridas.index')
            ->with('success', 'Corrida e todas as apostas relacionadas foram excluídas!');
    }
}

