<!DOCTYPE html>
<html><head><title>Teste Login</title></head><body style="font-family:Arial;padding:20px;">
<h1>🔐 Teste de Login Direto</h1><hr>

<?php

// Conectar ao banco
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>✅ Conectado ao banco</h2>";
    
    // Buscar admin
    $stmt = $pdo->query("SELECT id, nome, email, password FROM users WHERE email = 'admin@apostas.com' LIMIT 1");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "<h3>✅ Admin encontrado no banco:</h3>";
        echo "<pre>";
        echo "ID: " . $admin['id'] . "\n";
        echo "Nome: " . $admin['nome'] . "\n";
        echo "Email: " . $admin['email'] . "\n";
        echo "Hash da senha: " . substr($admin['password'], 0, 50) . "...\n";
        echo "</pre>";
        
        // Testar senha
        $senhaDigitada = 'password';
        $hashBanco = $admin['password'];
        
        echo "<h3>🔑 Testando senha 'password':</h3>";
        
        if (password_verify($senhaDigitada, $hashBanco)) {
            echo "<p style='color:green;font-size:20px;'><strong>✅ SENHA CORRETA!</strong></p>";
            echo "<p>O hash no banco está correto e a senha 'password' funciona!</p>";
        } else {
            echo "<p style='color:red;font-size:20px;'><strong>❌ SENHA INCORRETA!</strong></p>";
            echo "<p>O hash no banco NÃO confere com a senha 'password'</p>";
            
            // Gerar novo hash
            $novoHash = password_hash($senhaDigitada, PASSWORD_BCRYPT);
            echo "<hr>";
            echo "<h3>Atualizar senha no banco:</h3>";
            echo "<p>Execute este SQL no render (via conectar ao banco):</p>";
            echo "<pre style='background:#f5f5f5;padding:15px;'>UPDATE users SET password = '$novoHash' WHERE email = 'admin@apostas.com';</pre>";
        }
        
    } else {
        echo "<p style='color:red;'>❌ Admin NÃO encontrado no banco!</p>";
    }
    
    // Testar usuário teste também
    echo "<hr>";
    $stmt = $pdo->query("SELECT id, nome, email, saldo FROM users WHERE email = 'usuario@teste.com' LIMIT 1");
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario) {
        echo "<h3>✅ Usuário Teste encontrado:</h3>";
        echo "<pre>";
        echo "Nome: " . $usuario['nome'] . "\n";
        echo "Email: " . $usuario['email'] . "\n";
        echo "Saldo: R$ " . number_format($usuario['saldo'], 2, ',', '.') . "\n";
        echo "</pre>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Erro: " . $e->getMessage() . "</p>";
}

?>

<hr>
<p><a href="/diagnostico.php">← Voltar ao Diagnóstico</a></p>

</body></html>

