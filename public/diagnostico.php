<?php

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "<h1>🔍 Diagnóstico Roraima Bets</h1>";
echo "<hr>";

// 1. Testar conexão com banco
echo "<h2>1. Conexão com Banco de Dados</h2>";
try {
    $pdo = new PDO(
        'pgsql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE'),
        env('DB_USERNAME'),
        env('DB_PASSWORD')
    );
    echo "✅ <strong>Conectado ao PostgreSQL!</strong><br>";
    echo "Host: " . env('DB_HOST') . "<br>";
    echo "Database: " . env('DB_DATABASE') . "<br>";
    echo "User: " . env('DB_USERNAME') . "<br>";
} catch (Exception $e) {
    echo "❌ <strong>ERRO ao conectar:</strong> " . $e->getMessage() . "<br>";
}

echo "<hr>";

// 2. Verificar tabelas
echo "<h2>2. Tabelas no Banco</h2>";
try {
    $tables = $pdo->query("SELECT tablename FROM pg_tables WHERE schemaname = 'public'")->fetchAll(PDO::FETCH_COLUMN);
    
    if (count($tables) > 0) {
        echo "✅ <strong>Tabelas encontradas (" . count($tables) . "):</strong><br>";
        foreach ($tables as $table) {
            echo "- " . $table . "<br>";
        }
    } else {
        echo "❌ <strong>NENHUMA TABELA ENCONTRADA!</strong><br>";
        echo "➡️ As migrations NÃO rodaram!<br>";
    }
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage();
}

echo "<hr>";

// 3. Verificar usuários
echo "<h2>3. Usuários Cadastrados</h2>";
try {
    $users = $pdo->query("SELECT id, nome, email, is_admin FROM users LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($users) > 0) {
        echo "✅ <strong>Usuários encontrados:</strong><br>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Admin?</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id'] . "</td>";
            echo "<td>" . $user['nome'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . ($user['is_admin'] ? '✅ SIM' : 'Não') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "❌ <strong>Nenhum usuário encontrado!</strong><br>";
        echo "➡️ O seed NÃO rodou!<br>";
    }
} catch (Exception $e) {
    echo "❌ Tabela users não existe: " . $e->getMessage() . "<br>";
    echo "➡️ Migrations NÃO rodaram!<br>";
}

echo "<hr>";

// 4. Verificar corridas
echo "<h2>4. Corridas Cadastradas</h2>";
try {
    $corridas = $pdo->query("SELECT COUNT(*) FROM corridas")->fetchColumn();
    echo "✅ Total de corridas: <strong>" . $corridas . "</strong><br>";
} catch (Exception $e) {
    echo "❌ Tabela corridas não existe<br>";
}

echo "<hr>";

echo "<h3>🎯 CONCLUSÃO:</h3>";
echo "<p>Se aparecer <strong>'Nenhuma tabela encontrada'</strong>, significa que as migrations NÃO rodaram.</p>";
echo "<p><strong>Solução:</strong> Aguarde alguns minutos após o deploy ou force um novo deploy no Render.</p>";

