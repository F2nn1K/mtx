<!DOCTYPE html>
<html><head><title>Instalação Roraima Bets</title></head><body style="font-family:Arial;padding:20px;">
<h1>🏍️ Instalação Roraima Bets</h1><hr>

<?php if (isset($_GET['executar'])): ?>
    
    <h2>📊 Executando Migrations...</h2>
    <pre style="background:#f5f5f5;padding:15px;border-radius:5px;"><?php
    
    chdir(__DIR__ . '/..');
    $output = [];
    $return = 0;
    
    exec('php artisan migrate --force 2>&1', $output, $return);
    echo implode("\n", $output);
    echo $return === 0 ? "\n\n✅ Migrations executadas!\n" : "\n\n⚠️ Erro código: $return\n";
    
    ?></pre>
    
    <h2>👤 Criando Admin...</h2>
    <pre style="background:#f5f5f5;padding:15px;border-radius:5px;"><?php
    
    $output = [];
    $return = 0;
    exec('php artisan db:seed --force 2>&1', $output, $return);
    echo implode("\n", $output);
    echo $return === 0 ? "\n\n✅ Admin criado!\n" : "\n\n⚠️ Erro código: $return\n";
    
    ?></pre>
    
    <hr>
    <h3 style="color:#28a745;">✅ INSTALAÇÃO CONCLUÍDA!</h3>
    <p><strong>Credenciais:</strong></p>
    <ul>
        <li>Email: <code>admin@apostas.com</code></li>
        <li>Senha: <code>password</code></li>
    </ul>
    <p>
        <a href="/login" style="background:#d4af37;color:#0d2818;padding:10px 20px;text-decoration:none;border-radius:5px;font-weight:bold;">Ir para Admin</a>
        <a href="/site/index.html" style="background:#1a4d3a;color:#d4af37;padding:10px 20px;text-decoration:none;border-radius:5px;font-weight:bold;margin-left:10px;">Ir para Site</a>
    </p>
    <hr>
    <p style="color:#666;"><small>Verifique: <a href="/diagnostico.php">Diagnóstico</a></small></p>
    
<?php else: ?>
    
    <h2>Instalar Banco de Dados</h2>
    <p>Clique no botão abaixo para criar todas as tabelas e o usuário admin.</p>
    <p><strong>Execute apenas UMA VEZ!</strong></p>
    
    <form method="get" style="margin-top:30px;">
        <input type="hidden" name="executar" value="1">
        <button type="submit" style="background:#d4af37;color:#0d2818;padding:20px 40px;border:none;border-radius:10px;font-size:18px;font-weight:bold;cursor:pointer;box-shadow:0 4px 10px rgba(212,175,55,0.3);">
            🚀 INSTALAR BANCO DE DADOS
        </button>
    </form>
    
    <hr style="margin-top:40px;">
    <p><a href="/diagnostico.php">🔍 Ver diagnóstico do banco</a></p>
    
<?php endif; ?>

</body></html>

