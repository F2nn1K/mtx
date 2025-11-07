@extends('adminlte::page')

@section('title', 'Relatórios')

@section('content_header')
    <h1>Relatórios Financeiros</h1>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-custom.css') }}">
@stop

@section('js')
<script src="{{ asset('js/admin-clean.js') }}"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>R$ {{ number_format($totalDepositos, 2, ',', '.') }}</h3>
                    <p>Total Depositado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>R$ {{ number_format($totalSaques, 2, ',', '.') }}</h3>
                    <p>Total Sacado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>R$ {{ number_format($totalApostas, 2, ',', '.') }}</h3>
                    <p>Total Apostado</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="small-box bg-{{ $lucroCasa > 0 ? 'success' : 'danger' }}">
                <div class="inner">
                    <h3>R$ {{ number_format($lucroCasa, 2, ',', '.') }}</h3>
                    <p>Lucro da Casa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Apostas por Mês</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Período</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($apostasPorMes as $mes)
                        <tr>
                            <td>{{ str_pad($mes->mes, 2, '0', STR_PAD_LEFT) }}/{{ $mes->ano }}</td>
                            <td>{{ $mes->total }}</td>
                            <td>R$ {{ number_format($mes->valor_total, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhum dado disponível</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Resumo</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Total Depositado:</strong></td>
                            <td class="text-right text-success">R$ {{ number_format($totalDepositos, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Sacado:</strong></td>
                            <td class="text-right text-warning">R$ {{ number_format($totalSaques, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Saldo em Carteiras:</strong></td>
                            <td class="text-right">R$ {{ number_format($totalDepositos - $totalSaques, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Apostado:</strong></td>
                            <td class="text-right text-info">R$ {{ number_format($totalApostas, 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Pago (Prêmios):</strong></td>
                            <td class="text-right text-danger">R$ {{ number_format($totalPago, 2, ',', '.') }}</td>
                        </tr>
                        <tr class="bg-light">
                            <td><strong>LUCRO DA CASA:</strong></td>
                            <td class="text-right"><strong>R$ {{ number_format($lucroCasa, 2, ',', '.') }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

