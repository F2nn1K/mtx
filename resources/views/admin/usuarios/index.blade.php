@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Gerenciar Usuários</h1>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-clean.js') }}"></script>
<script>
function editarSaldo(userId, saldoAtual) {
    const novoSaldo = prompt('Editar saldo do usuário #' + userId + '\nSaldo atual: R$ ' + saldoAtual + '\n\nNovo saldo:', saldoAtual);
    if (novoSaldo !== null) {
        fetch('/admin/usuarios/' + userId + '/editar-saldo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ saldo: novoSaldo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ Saldo atualizado com sucesso!');
                location.reload();
            } else {
                alert('❌ Erro ao atualizar saldo!');
            }
        });
    }
}
</script>
@stop

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Usuários</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>Saldo</th>
                            <th>Apostas</th>
                            <th>Status</th>
                            <th>Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td><strong>{{ $usuario->nome }}</strong></td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->cpf }}</td>
                            <td><strong>R$ {{ number_format($usuario->saldo, 2, ',', '.') }}</strong></td>
                            <td>{{ $usuario->apostas_count }}</td>
                            <td>
                                @if($usuario->ativo)
                                    <span class="badge badge-success">Ativo</span>
                                @else
                                    <span class="badge badge-danger">Bloqueado</span>
                                @endif
                            </td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form action="{{ route('admin.usuarios.toggle', $usuario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @if($usuario->ativo)
                                        <button type="submit" class="btn btn-sm btn-warning" 
                                            onclick="return confirm('Bloquear {{ $usuario->nome }}?')" 
                                            title="Bloquear">
                                            <i class="fas fa-ban"></i> Bloquear
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success" 
                                            onclick="return confirm('Ativar {{ $usuario->nome }}?')" 
                                            title="Ativar">
                                            <i class="fas fa-check"></i> Ativar
                                        </button>
                                    @endif
                                </form>
                                <button class="btn btn-sm btn-info" onclick="editarSaldo({{ $usuario->id }}, {{ $usuario->saldo }})" title="Editar Saldo">
                                    <i class="fas fa-wallet"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Nenhum usuário encontrado</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
@stop

