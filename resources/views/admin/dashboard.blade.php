@extends('adminlte::page')

@section('title', 'Painel Principal')

@section('content_header')
    <h1>Painel Principal - Roraima Bets</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalUsuarios }}</h3>
                    <p>Usuários Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.usuarios') }}" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box" style="background: linear-gradient(135deg, #1a4d3a 0%, #0d2818 100%); color: white;">
                <div class="inner">
                    <h3 style="color: #d4af37;">{{ $totalCorridas }}</h3>
                    <p>Corridas Cadastradas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-flag-checkered"></i>
                </div>
                <a href="{{ route('admin.corridas.index') }}" class="small-box-footer" style="background: rgba(212, 175, 55, 0.2);">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalApostasHoje }}</h3>
                    <p>Apostas Hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <a href="{{ route('admin.apostas') }}" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ {{ number_format($valorApostasHoje, 2, ',', '.') }}</h3>
                    <p>Volume Hoje</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <a href="{{ route('admin.relatorios') }}" class="small-box-footer">
                    Ver mais <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        @if($depositosPendentes > 0)
        <div class="col-md-6">
            <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> Atenção!</h5>
                Existem <strong>{{ $depositosPendentes }}</strong> depósitos pendentes de aprovação.
                <a href="{{ route('admin.depositos') }}" class="alert-link">Clique aqui para visualizar</a>
            </div>
        </div>
        @endif

        @if($saquesPendentes > 0)
        <div class="col-md-6">
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> Atenção!</h5>
                Existem <strong>{{ $saquesPendentes }}</strong> saques pendentes de aprovação.
                <a href="{{ route('admin.saques') }}" class="alert-link">Clique aqui para visualizar</a>
            </div>
        </div>
        @endif
    </div>

    @if($corridasAoVivo->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-circle text-danger"></i> Corridas AO VIVO</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data/Hora</th>
                                <th>Apostas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($corridasAoVivo as $corrida)
                            <tr>
                                <td><strong>{{ $corrida->nome }}</strong></td>
                                <td>{{ $corrida->local }}</td>
                                <td>{{ optional($corrida->data_hora)->format('d/m/Y H:i') ?? '-' }}</td>
                                <td>{{ $corrida->apostas()->count() }} apostas</td>
                                <td>
                                    <a href="{{ route('admin.corridas.edit', $corrida->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Gerenciar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar"></i> Próximas Corridas</h3>
                </div>
                <div class="card-body">
                    @if($proximasCorridas->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data/Hora</th>
                                <th>Pilotos</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proximasCorridas as $corrida)
                            <tr>
                                <td>{{ $corrida->nome }}</td>
                                <td>{{ $corrida->local }}</td>
                                <td>{{ optional($corrida->data_hora)->format('d/m/Y H:i') ?? '-' }}</td>
                                <td>{{ $corrida->pilotos()->count() }} pilotos</td>
                                <td>
                                    <span class="badge badge-success">{{ $corrida->status ? ucfirst($corrida->status) : '-' }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">Nenhuma corrida programada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-clean.js') }}"></script>
@stop

