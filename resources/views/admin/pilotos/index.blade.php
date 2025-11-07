@extends('adminlte::page')

@section('title', 'Pilotos')

@section('content_header')
    <h1>Gerenciar Pilotos</h1>
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
            <h3 class="card-title">Lista de Pilotos</h3>
            <div class="card-tools">
                <a href="{{ route('admin.pilotos.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> Novo Piloto
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

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pilotos as $piloto)
                    <tr>
                        <td><strong>#{{ $piloto->numero }}</strong></td>
                        <td>{{ $piloto->nome }}</td>
                        <td>{{ $piloto->categoria }}</td>
                        <td>
                            @if($piloto->ativo)
                                <span class="badge badge-success">Ativo</span>
                            @else
                                <span class="badge badge-secondary">Inativo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.pilotos.edit', $piloto->id) }}" class="btn btn-sm btn-primary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pilotos.destroy', $piloto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('⚠️ Excluir piloto {{ $piloto->nome }}? Isso vai afetar corridas e apostas vinculadas!')" 
                                    title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum piloto cadastrado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $pilotos->links() }}
            </div>
        </div>
    </div>
@stop

