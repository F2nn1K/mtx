<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CorridaController;
use App\Http\Controllers\Admin\PilotoController;
use App\Http\Controllers\Admin\ApostaController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\DepositoController;
use App\Http\Controllers\Admin\SaqueController;
use App\Http\Controllers\Admin\RelatorioController;
use App\Http\Controllers\AuthController;

// Rota principal - redireciona para o site HTML
Route::get('/', function () {
    return redirect('/site');
});

// Autenticação Admin
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rota de teste do dashboard ORIGINAL (TEMPORÁRIA)
Route::get('/admin/testar-dashboard', function() {
    try {
        $controller = new \App\Http\Controllers\Admin\DashboardController();
        $response = $controller->index();
        
        return response()->json([
            'status' => 'Dashboard renderizou OK!',
            'tipo_resposta' => get_class($response),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'ERRO NO DASHBOARD',
            'mensagem' => $e->getMessage(),
            'arquivo' => $e->getFile(),
            'linha' => $e->getLine(),
            'trace' => explode("\n", $e->getTraceAsString()),
        ], 200); // 200 pra você conseguir ver
    }
})->middleware('auth');

// Rotas Admin (protegidas)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Corridas
    Route::resource('corridas', CorridaController::class)->names('admin.corridas');
    Route::post('corridas/{id}/finalizar', [CorridaController::class, 'finalizar'])->name('admin.corridas.finalizar');
    
    // Pilotos
    Route::resource('pilotos', PilotoController::class)->names('admin.pilotos');
    
    // Apostas
    Route::get('apostas', [ApostaController::class, 'index'])->name('admin.apostas');
    Route::get('apostas/{id}', [ApostaController::class, 'show'])->name('admin.apostas.show');
    Route::delete('apostas/{id}/cancelar', [ApostaController::class, 'cancelar'])->name('admin.apostas.cancelar');
    
    // Usuários
    Route::get('usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios');
    Route::post('usuarios/{id}/toggle-status', [UsuarioController::class, 'toggleStatus'])->name('admin.usuarios.toggle');
    Route::post('usuarios/{id}/editar-saldo', [UsuarioController::class, 'editarSaldo'])->name('admin.usuarios.editar-saldo');
    
    // Depósitos
    Route::get('depositos', [DepositoController::class, 'index'])->name('admin.depositos');
    Route::post('depositos/{id}/aprovar', [DepositoController::class, 'aprovar'])->name('admin.depositos.aprovar');
    Route::post('depositos/{id}/rejeitar', [DepositoController::class, 'rejeitar'])->name('admin.depositos.rejeitar');
    
    // Saques
    Route::get('saques', [SaqueController::class, 'index'])->name('admin.saques');
    Route::post('saques/{id}/aprovar', [SaqueController::class, 'aprovar'])->name('admin.saques.aprovar');
    Route::post('saques/{id}/rejeitar', [SaqueController::class, 'rejeitar'])->name('admin.saques.rejeitar');
    
    // Relatórios
    Route::get('relatorios', [RelatorioController::class, 'index'])->name('admin.relatorios');
});

