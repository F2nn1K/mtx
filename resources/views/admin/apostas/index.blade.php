@extends('adminlte::page')

@section('title', 'Apostas')

@section('content_header')
    <h1>Todas as Apostas</h1>
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
            <h3 class="card-title">Lista de Apostas</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Corrida</th>
                            <th>Piloto</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Cotação</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apostas as $aposta)
                        <tr>
                            <td>{{ $aposta->id }}</td>
                            <td>
                                <strong>{{ $aposta->user->nome }}</strong><br>
                                <small>{{ $aposta->user->email }}</small>
                            </td>
                            <td>{{ $aposta->corrida->nome }}</td>
                            <td>#{{ $aposta->piloto->numero }} {{ $aposta->piloto->nome }}</td>
                            <td>{{ $aposta->tipo_aposta_label }}</td>
                            <td><strong>R$ {{ number_format($aposta->valor, 2, ',', '.') }}</strong></td>
                            <td>{{ $aposta->cotacao }}x</td>
                            <td>
                                @if($aposta->status == 'ativa')
                                    <span class="badge badge-warning">Ativa</span>
                                @elseif($aposta->status == 'venceu')
                                    <span class="badge badge-success">Venceu - R$ {{ number_format($aposta->valor_ganho, 2, ',', '.') }}</span>
                                @else
                                    <span class="badge badge-danger">Perdeu</span>
                                @endif
                            </td>
                            <td>{{ $aposta->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($aposta->status == 'ativa')
                                <form action="{{ route('admin.apostas.cancelar', $aposta->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('⚠️ Cancelar aposta e devolver R$ {{ number_format($aposta->valor, 2, ',', '.') }} ao usuário?')" 
                                        title="Cancelar aposta">
                                        <i class="fas fa-times"></i> Cancelar
                                    </button>
                                </form>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Nenhuma aposta encontrada</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $apostas->links() }}
            </div>
        </div>
    </div>
@stop

