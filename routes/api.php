<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CorridaApiController;
use App\Http\Controllers\Api\ApostaApiController;
use App\Http\Controllers\Api\TransacaoApiController;

// Autenticação de usuários (frontend)
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Rotas públicas
Route::get('/corridas', [CorridaApiController::class, 'index']);
Route::get('/corridas/{id}', [CorridaApiController::class, 'show']);
Route::get('/corridas/{id}/pilotos', [CorridaApiController::class, 'pilotos']);

// Rotas protegidas (usuários autenticados)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Apostas
    Route::post('/apostas', [ApostaApiController::class, 'store']);
    Route::get('/apostas', [ApostaApiController::class, 'index']);
    Route::get('/apostas/{id}', [ApostaApiController::class, 'show']);
    
    // Transações
    Route::post('/depositos', [TransacaoApiController::class, 'depositar']);
    Route::post('/saques', [TransacaoApiController::class, 'sacar']);
    Route::get('/transacoes', [TransacaoApiController::class, 'index']);
    Route::get('/saldo', [TransacaoApiController::class, 'saldo']);
});

