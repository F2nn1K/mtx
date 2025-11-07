@extends('adminlte::page')

@section('title', 'Nova Corrida')

@section('content_header')
    <h1>Criar Nova Corrida</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.corridas.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nome">Nome da Corrida *</label>
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
                                value="{{ old('nome') }}" required>
                            @error('nome')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="local">Local *</label>
                            <input type="text" name="local" id="local" class="form-control @error('local') is-invalid @enderror" 
                                value="{{ old('local') }}" required>
                            @error('local')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="data_hora">Data e Hora *</label>
                            <input type="datetime-local" name="data_hora" id="data_hora" 
                                class="form-control @error('data_hora') is-invalid @enderror" 
                                value="{{ old('data_hora') }}" required>
                            @error('data_hora')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoria *</label>
                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                <option value="MX1" {{ old('categoria') == 'MX1' ? 'selected' : '' }}>MX1</option>
                                <option value="MX2" {{ old('categoria') == 'MX2' ? 'selected' : '' }}>MX2</option>
                                <option value="MX3" {{ old('categoria') == 'MX3' ? 'selected' : '' }}>MX3</option>
                                <option value="65cc" {{ old('categoria') == '65cc' ? 'selected' : '' }}>65cc</option>
                                <option value="85cc" {{ old('categoria') == '85cc' ? 'selected' : '' }}>85cc</option>
                            </select>
                            @error('categoria')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
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
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="pilotos_check[]" value="{{ $piloto->id }}" 
                                            onchange="toggleCotacao(this, {{ $piloto->id }})">
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
                                            disabled>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Salvar Corrida
                    </button>
                    <a href="{{ route('admin.corridas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
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

