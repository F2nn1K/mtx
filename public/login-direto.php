<!DOCTYPE html>
<html><head>
<title>Login Direto - Roraima Bets</title>
<style>
body{font-family:Arial;background:linear-gradient(135deg,#0d2818,#1a4d3a);min-height:100vh;display:flex;align-items:center;justify-content:center;margin:0;}
.card{background:white;padding:40px;border-radius:15px;box-shadow:0 10px 40px rgba(0,0,0,0.3);max-width:400px;width:100%;}
h1{color:#d4af37;text-align:center;margin:0 0 30px 0;}
input{width:100%;padding:12px;margin:10px 0;border:2px solid #ddd;border-radius:5px;box-sizing:border-box;}
button{width:100%;padding:15px;background:#d4af37;color:#0d2818;border:none;border-radius:5px;font-weight:bold;font-size:16px;cursor:pointer;}
button:hover{background:#f4d03f;}
.msg{padding:15px;margin:10px 0;border-radius:5px;text-align:center;}
.success{background:#d4f4dd;color:#0f5132;border:2px solid #0f5132;}
.error{background:#f8d7da;color:#842029;border:2px solid #842029;}
</style>
</head><body>

<div class="card">
<h1>🏍️ RORAIMA BETS</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['password'] ?? '';
    
    // Conectar ao banco
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $db = getenv('DB_DATABASE');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');
    
    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
        
        // Buscar usuário
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND ativo = TRUE LIMIT 1");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($senha, $usuario['password'])) {
            
            // Login bem-sucedido!
            session_start();
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            $_SESSION['is_admin'] = $usuario['is_admin'];
            
            if ($usuario['is_admin']) {
                echo "<div class='msg success'>";
                echo "<strong>✅ LOGIN ADMIN REALIZADO!</strong><br><br>";
                echo "Bem-vindo, " . $usuario['nome'] . "!<br><br>";
                echo "<a href='/admin'>Ir para o Painel Admin</a>";
                echo "</div>";
            } else {
                echo "<div class='msg success'>";
                echo "<strong>✅ LOGIN REALIZADO!</strong><br><br>";
                echo "Bem-vindo, " . $usuario['nome'] . "!<br>";
                echo "Saldo: R$ " . number_format($usuario['saldo'], 2, ',', '.') . "<br><br>";
                echo "<a href='/site/corridas.html'>Ver Corridas</a>";
                echo "</div>";
            }
            
        } else {
            echo "<div class='msg error'>❌ Email ou senha incorretos!</div>";
        }
        
    } catch (Exception $e) {
        echo "<div class='msg error'>❌ Erro: " . $e->getMessage() . "</div>";
    }
}
?>

<form method="POST">
<input type="email" name="email" placeholder="E-mail" required value="admin@apostas.com">
<input type="password" name="password" placeholder="Senha" required value="password">
<button type="submit">🔐 ENTRAR</button>
</form>

<p style="text-align:center;margin-top:20px;font-size:12px;color:#666;">
Teste: admin@apostas.com / password<br>
ou: usuario@teste.com / password
</p>

</div>

</body></html>

