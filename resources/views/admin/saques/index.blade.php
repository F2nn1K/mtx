@extends('adminlte::page')

@section('title', 'Saques')

@section('content_header')
    <h1>Gerenciar Saques</h1>
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
            <h3 class="card-title">Lista de Saques</h3>
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
                        <th>Chave PIX</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($saques as $saque)
                    <tr class="{{ $saque->status == 'pendente' ? 'table-warning' : '' }}">
                        <td>{{ $saque->id }}</td>
                        <td>
                            <strong>{{ $saque->user->nome }}</strong><br>
                            <small>{{ $saque->user->email }}</small>
                        </td>
                        <td><strong>R$ {{ number_format($saque->valor, 2, ',', '.') }}</strong></td>
                        <td><code>{{ $saque->chave_pix }}</code></td>
                        <td>{{ $saque->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $saque->status_color }}">
                                {{ $saque->status_label }}
                            </span>
                        </td>
                        <td>
                            @if($saque->status == 'pendente')
                                <form action="{{ route('admin.saques.aprovar', $saque->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Aprovar">
                                        <i class="fas fa-check"></i> Aprovar e Pagar
                                    </button>
                                </form>
                                <form action="{{ route('admin.saques.rejeitar', $saque->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Rejeitar" 
                                        onclick="return confirm('⚠️ Rejeitar saque de R$ {{ number_format($saque->valor, 2, ',', '.') }}? O valor será devolvido ao usuário.')">
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
                        <td colspan="7" class="text-center">Nenhum saque encontrado</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $saques->links() }}
            </div>
        </div>
    </div>
@stop

