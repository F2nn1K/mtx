@extends('adminlte::page')

@section('title', 'Editar Corrida')

@section('content_header')
    <h1>Editar Corrida</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.corridas.update', $corrida->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome da Corrida *</label>
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
                                value="{{ old('nome', $corrida->nome) }}" required>
                            @error('nome')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="local">Local *</label>
                            <input type="text" name="local" id="local" class="form-control @error('local') is-invalid @enderror" 
                                value="{{ old('local', $corrida->local) }}" required>
                            @error('local')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_hora">Data e Hora *</label>
                            <input type="datetime-local" name="data_hora" id="data_hora" 
                                class="form-control @error('data_hora') is-invalid @enderror" 
                                value="{{ old('data_hora', $corrida->data_hora->format('Y-m-d\TH:i')) }}" required>
                            @error('data_hora')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categoria">Categoria *</label>
                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                <option value="MX1" {{ old('categoria', $corrida->categoria) == 'MX1' ? 'selected' : '' }}>MX1</option>
                                <option value="MX2" {{ old('categoria', $corrida->categoria) == 'MX2' ? 'selected' : '' }}>MX2</option>
                                <option value="MX3" {{ old('categoria', $corrida->categoria) == 'MX3' ? 'selected' : '' }}>MX3</option>
                                <option value="65cc" {{ old('categoria', $corrida->categoria) == '65cc' ? 'selected' : '' }}>65cc</option>
                                <option value="85cc" {{ old('categoria', $corrida->categoria) == '85cc' ? 'selected' : '' }}>85cc</option>
                            </select>
                            @error('categoria')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="aberta" {{ old('status', $corrida->status) == 'aberta' ? 'selected' : '' }}>Aberta</option>
                                <option value="ao_vivo" {{ old('status', $corrida->status) == 'ao_vivo' ? 'selected' : '' }}>Ao Vivo</option>
                                <option value="finalizada" {{ old('status', $corrida->status) == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                                <option value="cancelada" {{ old('status', $corrida->status) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $corrida->descricao) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Pilotos Participantes e Cotações</label>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="50">Selecionar</th>
                                    <th>Número</th>
                                    <th>Nome</th>
                                    <th width="150">Cotação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pilotos as $piloto)
                                @php
                                    $pilotoCorrida = $corrida->pilotos->firstWhere('id', $piloto->id);
                                    $selecionado = $pilotoCorrida !== null;
                                    $cotacaoAtual = $selecionado ? $pilotoCorrida->pivot->cotacao : '';
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="pilotos_check[]" value="{{ $piloto->id }}" 
                                            onchange="toggleCotacao(this, {{ $piloto->id }})" 
                                            {{ $selecionado ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $piloto->numero }}</td>
                                    <td>{{ $piloto->nome }}</td>
                                    <td>
                                        <input type="number" name="pilotos[{{ $piloto->id }}]" 
                                            id="cotacao_{{ $piloto->id }}" 
                                            class="form-control" 
                                            step="0.01" 
                                            min="1.01" 
                                            placeholder="Ex: 2.50" 
                                            value="{{ $cotacaoAtual }}"
                                            {{ $selecionado ? '' : 'disabled' }}>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($corrida->status == 'ao_vivo' || $corrida->status == 'aberta')
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Para finalizar a corrida e processar as apostas, 
                    use o botão "Finalizar Corrida" abaixo.
                </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Atualizar Corrida
                    </button>
                    <a href="{{ route('admin.corridas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    
                    @if($corrida->status != 'finalizada' && $corrida->apostas()->count() > 0)
                    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modalFinalizar">
                        <i class="fas fa-flag-checkered"></i> Finalizar Corrida
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if($corrida->status != 'finalizada' && $corrida->apostas()->count() > 0)
    <!-- Modal Finalizar Corrida -->
    <div class="modal fade" id="modalFinalizar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Finalizar Corrida</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('admin.corridas.finalizar', $corrida->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p><strong>Informe o resultado da corrida:</strong></p>
                        
                        <div class="form-group">
                            <label>1º Lugar *</label>
                            <select name="primeiro_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach($corrida->pilotos as $piloto)
                                    <option value="{{ $piloto->id }}">#{{ $piloto->numero }} - {{ $piloto->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>2º Lugar *</label>
                            <select name="segundo_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach($corrida->pilotos as $piloto)
                                    <option value="{{ $piloto->id }}">#{{ $piloto->numero }} - {{ $piloto->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>3º Lugar *</label>
                            <select name="terceiro_lugar" class="form-control" required>
                                <option value="">Selecione</option>
                                @foreach($corrida->pilotos as $piloto)
                                    <option value="{{ $piloto->id }}">#{{ $piloto->numero }} - {{ $piloto->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Volta Mais Rápida</label>
                            <select name="volta_rapida" class="form-control">
                                <option value="">Selecione</option>
                                @foreach($corrida->pilotos as $piloto)
                                    <option value="{{ $piloto->id }}">#{{ $piloto->numero }} - {{ $piloto->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <strong>Atenção!</strong> Após finalizar, as apostas serão processadas automaticamente 
                            e os vencedores receberão seus ganhos.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-flag-checkered"></i> Finalizar e Processar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@stop

@section('js')
<script>
function toggleCotacao(checkbox, pilotoId) {
    const cotacaoInput = document.getElementById('cotacao_' + pilotoId);
    if (checkbox.checked) {
        cotacaoInput.disabled = false;
        cotacaoInput.required = true;
    } else {
        cotacaoInput.disabled = true;
        cotacaoInput.required = false;
        cotacaoInput.value = '';
    }
}
</script>
@stop

