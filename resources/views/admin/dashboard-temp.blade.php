@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard - Roraima Bets</h1>
@stop

@section('content')
    <p>Bem-vindo ao painel administrativo!</p>
    
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalUsuarios }}</h3>
                    <p>Usuários</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalCorridas }}</h3>
                    <p>Corridas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalApostas }}</h3>
                    <p>Apostas</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ {{ number_format($valorApostasHoje, 2, ',', '.') }}</h3>
                    <p>Volume Hoje</p>
                </div>
            </div>
        </div>
    </div>
@stop

