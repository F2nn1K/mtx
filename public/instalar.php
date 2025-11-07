<?php

// Página de instalação - Roda migrations e seeds
// APÓS USAR, APAGUE ESTE ARQUIVO POR SEGURANÇA!

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "<!DOCTYPE html>";
echo "<html><head><title>Instalação Roraima Bets</title></head><body>";
echo "<h1>🏍️ Instalação Roraima Bets</h1>";
echo "<hr>";

if (isset($_GET['executar']) && $_GET['executar'] == 'sim') {
    
    echo "<h2>📊 Executando Migrations...</h2>";
    echo "<pre>";
    
    try {
        $exitCode = Artisan::call('migrate', ['--force' => true]);
        echo Artisan::output();
        echo "\n";
        
        if ($exitCode === 0) {
            echo "✅ Migrations executadas com sucesso!\n\n";
        } else {
            echo "⚠️ Migrations finalizaram com código: $exitCode\n\n";
        }
    } catch (Exception $e) {
        echo "❌ ERRO: " . $e->getMessage() . "\n\n";
    }
    
    echo "</pre>";
    
    echo "<h2>👤 Executando Seeds (Criar Admin)...</h2>";
    echo "<pre>";
    
    try {
        $exitCode = Artisan::call('db:seed', ['--force' => true]);
        echo Artisan::output();
        echo "\n";
        
        if ($exitCode === 0) {
            echo "✅ Seeds executados com sucesso!\n\n";
        } else {
            echo "⚠️ Seeds finalizaram com código: $exitCode\n\n";
        }
    } catch (Exception $e) {
        echo "❌ ERRO: " . $e->getMessage() . "\n\n";
    }
    
    echo "</pre>";
    
    echo "<hr>";
    echo "<h3>✅ INSTALAÇÃO CONCLUÍDA!</h3>";
    echo "<p><strong>Credenciais de acesso:</strong></p>";
    echo "<ul>";
    echo "<li>Admin: admin@apostas.com / password</li>";
    echo "<li>URL Admin: <a href='/login'>/login</a></li>";
    echo "<li>URL Site: <a href='/site/index.html'>/site/index.html</a></li>";
    echo "</ul>";
    
    echo "<hr>";
    echo "<p style='color:red;'><strong>⚠️ IMPORTANTE: Por segurança, APAGUE este arquivo após usar!</strong></p>";
    echo "<p>Acesse o diagnóstico: <a href='/diagnostico.php'>diagnostico.php</a></p>";
    
} else {
    
    echo "<h2>⚠️ Atenção!</h2>";
    echo "<p>Esta página vai <strong>criar todas as tabelas</strong> no banco de dados e <strong>inserir os dados iniciais</strong>.</p>";
    echo "<p>Execute apenas <strong>UMA VEZ</strong> após o primeiro deploy!</p>";
    
    echo "<hr>";
    
    echo "<h3>O que será feito:</h3>";
    echo "<ul>";
    echo "<li>✅ Criar 8 tabelas (users, pilotos, corridas, apostas, transacoes, etc)</li>";
    echo "<li>✅ Criar usuário admin (admin@apostas.com / password)</li>";
    echo "<li>✅ Criar 8 pilotos de exemplo</li>";
    echo "<li>✅ Criar 1 corrida de exemplo</li>";
    echo "</ul>";
    
    echo "<hr>";
    
    echo "<form method='get'>";
    echo "<input type='hidden' name='executar' value='sim'>";
    echo "<button type='submit' style='background:#28a745;color:white;padding:15px 30px;border:none;border-radius:5px;font-size:16px;cursor:pointer;'>";
    echo "🚀 EXECUTAR INSTALAÇÃO";
    echo "</button>";
    echo "</form>";
    
    echo "<br><br>";
    echo "<p><a href='/diagnostico.php'>🔍 Ver diagnóstico do banco</a></p>";
}

echo "</body></html>";

