@extends('adminlte::page')

@section('title', 'Depósitos')

@section('content_header')
    <h1>Gerenciar Depósitos</h1>
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
            <h3 class="card-title">Lista de Depósitos</h3>
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
                        <th>Usuário</th>
                        <th>Valor</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Comprovante</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($depositos as $deposito)
                    <tr class="{{ $deposito->status == 'pendente' ? 'table-warning' : '' }}">
                        <td>{{ $deposito->id }}</td>
                        <td>
                            <strong>{{ $deposito->user->nome }}</strong><br>
                            <small>{{ $deposito->user->email }}</small>
                        </td>
                        <td><strong>R$ {{ number_format($deposito->valor, 2, ',', '.') }}</strong></td>
                        <td>{{ $deposito->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $deposito->status_color }}">
                                {{ $deposito->status_label }}
                            </span>
                        </td>
                        <td>
                            @if($deposito->comprovante)
                                <a href="{{ $deposito->comprovante }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file"></i> Ver
                                </a>
                            @else
                                <span class="text-muted">Sem comprovante</span>
                            @endif
                        </td>
                        <td>
                            @if($deposito->status == 'pendente')
                                <form action="{{ route('admin.depositos.aprovar', $deposito->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Aprovar">
                                        <i class="fas fa-check"></i> Aprovar
                                    </button>
                                </form>
                                <form action="{{ route('admin.depositos.rejeitar', $deposito->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Rejeitar" 
                                        onclick="return confirm('Rejeitar depósito de R$ {{ number_format($deposito->valor, 2, ',', '.') }}?')">
                                        <i class="fas fa-times"></i> Rejeitar
                                    </button>
                                </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum depósito encontrado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $depositos->links() }}
            </div>
        </div>
    </div>
@stop

