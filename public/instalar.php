<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

?>
<!DOCTYPE html>
<html><head><title>Instalação Roraima Bets</title></head><body>
<h1>🏍️ Instalação Roraima Bets</h1><hr>

<?php if (isset($_GET['executar'])): ?>
    
    <h2>📊 Executando Migrations...</h2><pre><?php
    
    $exitCode = $kernel->call('migrate', ['--force' => true]);
    echo $kernel->output();
    echo $exitCode === 0 ? "\n✅ Migrations OK!\n" : "\n⚠️ Erro\n";
    
    ?></pre><h2>👤 Criando Admin...</h2><pre><?php
    
    $exitCode = $kernel->call('db:seed', ['--force' => true]);
    echo $kernel->output();
    echo $exitCode === 0 ? "\n✅ Seeds OK!\n" : "\n⚠️ Erro\n";
    
    ?></pre><hr>
    <h3>✅ CONCLUÍDO!</h3>
    <p>Admin: admin@apostas.com / password</p>
    <p><a href="/login">Ir para Admin</a> | <a href="/site/index.html">Ir para Site</a></p>
    
<?php else: ?>
    
    <h2>Criar tabelas e admin</h2>
    <form method="get">
        <input type="hidden" name="executar" value="1">
        <button style="background:#d4af37;color:#0d2818;padding:20px 40px;border:none;border-radius:10px;font-size:18px;font-weight:bold;cursor:pointer;">
            🚀 INSTALAR BANCO DE DADOS
        </button>
    </form>
    
<?php endif; ?>

</body></html>

