@extends('adminlte::page')

@section('title', 'Corridas')

@section('content_header')
    <h1>Gerenciar Corridas</h1>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-clean.js') }}"></script>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Corridas</h3>
            <div class="card-tools">
                <a href="{{ route('admin.corridas.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> Nova Corrida
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Local</th>
                        <th>Data/Hora</th>
                        <th>Categoria</th>
                        <th>Pilotos</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($corridas as $corrida)
                    <tr>
                        <td>{{ $corrida->id }}</td>
                        <td><strong>{{ $corrida->nome }}</strong></td>
                        <td>{{ $corrida->local }}</td>
                        <td>{{ $corrida->data_hora->format('d/m/Y H:i') }}</td>
                        <td>{{ $corrida->categoria }}</td>
                        <td>{{ $corrida->pilotos()->count() }}</td>
                        <td>
                            @if($corrida->status == 'aberta')
                                <span class="badge badge-success">Aberta</span>
                            @elseif($corrida->status == 'ao_vivo')
                                <span class="badge badge-danger">Ao Vivo</span>
                            @elseif($corrida->status == 'finalizada')
                                <span class="badge badge-secondary">Finalizada</span>
                            @else
                                <span class="badge badge-warning">{{ ucfirst($corrida->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.corridas.edit', $corrida->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('admin.corridas.destroy', $corrida->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('⚠️ ATENÇÃO! Isso vai excluir a corrida e TODAS as {{ $corrida->apostas()->count() }} apostas relacionadas. Tem certeza?')" 
                                    title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhuma corrida cadastrada</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $corridas->links() }}
            </div>
        </div>
    </div>
@stop

