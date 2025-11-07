@extends('adminlte::page')

@section('title', 'Editar Piloto')

@section('content_header')
    <h1>Editar Piloto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pilotos.update', $piloto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nome">Nome Completo *</label>
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
                                value="{{ old('nome', $piloto->nome) }}" required>
                            @error('nome')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero">Número *</label>
                            <input type="number" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror" 
                                value="{{ old('numero', $piloto->numero) }}" required>
                            @error('numero')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categoria *</label>
                            <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror" required>
                                <option value="">Selecione</option>
                                <option value="MX1" {{ old('categoria', $piloto->categoria) == 'MX1' ? 'selected' : '' }}>MX1</option>
                                <option value="MX2" {{ old('categoria', $piloto->categoria) == 'MX2' ? 'selected' : '' }}>MX2</option>
                                <option value="MX3" {{ old('categoria', $piloto->categoria) == 'MX3' ? 'selected' : '' }}>MX3</option>
                                <option value="65cc" {{ old('categoria', $piloto->categoria) == '65cc' ? 'selected' : '' }}>65cc</option>
                                <option value="85cc" {{ old('categoria', $piloto->categoria) == '85cc' ? 'selected' : '' }}>85cc</option>
                            </select>
                            @error('categoria')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto_url">URL da Foto</label>
                            <input type="url" name="foto_url" id="foto_url" class="form-control" 
                                value="{{ old('foto_url', $piloto->foto_url) }}" placeholder="https://...">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea name="biografia" id="biografia" class="form-control" rows="3">{{ old('biografia', $piloto->biografia) }}</textarea>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="ativo" name="ativo" value="1" 
                            {{ old('ativo', $piloto->ativo) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="ativo">Piloto Ativo</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Atualizar Piloto
                    </button>
                    <a href="{{ route('admin.pilotos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

