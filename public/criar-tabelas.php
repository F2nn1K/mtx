<!DOCTYPE html>
<html><head><title>Criar Tabelas</title></head><body style="font-family:Arial;padding:20px;">
<h1>🗄️ Criar Tabelas - Roraima Bets</h1><hr>

<?php
if (isset($_GET['executar'])) {
    
    // Conectar direto ao PostgreSQL
    $host = getenv('DB_HOST');
    $port = getenv('DB_PORT');
    $db = getenv('DB_DATABASE');
    $user = getenv('DB_USERNAME');
    $pass = getenv('DB_PASSWORD');
    
    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "<h2>✅ Conectado ao banco!</h2>";
        echo "<pre style='background:#f5f5f5;padding:15px;'>";
        
        // SQL para criar todas as tabelas
        $sqls = [
            // Users
            "CREATE TABLE IF NOT EXISTS users (
                id BIGSERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                cpf VARCHAR(11) UNIQUE NOT NULL,
                telefone VARCHAR(20) NOT NULL,
                data_nascimento DATE NOT NULL,
                password VARCHAR(255) NOT NULL,
                saldo DECIMAL(10,2) DEFAULT 0.00,
                is_admin BOOLEAN DEFAULT FALSE,
                ativo BOOLEAN DEFAULT TRUE,
                email_verified_at TIMESTAMP NULL,
                remember_token VARCHAR(100) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Pilotos
            "CREATE TABLE IF NOT EXISTS pilotos (
                id BIGSERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                numero INTEGER UNIQUE NOT NULL,
                categoria VARCHAR(50) NOT NULL,
                foto_url VARCHAR(500) NULL,
                biografia TEXT NULL,
                ativo BOOLEAN DEFAULT TRUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Corridas
            "CREATE TABLE IF NOT EXISTS corridas (
                id BIGSERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                local VARCHAR(255) NOT NULL,
                data_hora TIMESTAMP NOT NULL,
                categoria VARCHAR(50) NOT NULL,
                descricao TEXT NULL,
                status VARCHAR(20) DEFAULT 'aberta',
                resultado TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Corrida_Piloto
            "CREATE TABLE IF NOT EXISTS corrida_piloto (
                id BIGSERIAL PRIMARY KEY,
                corrida_id BIGINT REFERENCES corridas(id) ON DELETE CASCADE,
                piloto_id BIGINT REFERENCES pilotos(id) ON DELETE CASCADE,
                cotacao DECIMAL(5,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE(corrida_id, piloto_id)
            )",
            
            // Apostas
            "CREATE TABLE IF NOT EXISTS apostas (
                id BIGSERIAL PRIMARY KEY,
                user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
                corrida_id BIGINT REFERENCES corridas(id) ON DELETE CASCADE,
                piloto_id BIGINT REFERENCES pilotos(id) ON DELETE CASCADE,
                tipo_aposta VARCHAR(20) NOT NULL,
                valor DECIMAL(10,2) NOT NULL,
                cotacao DECIMAL(5,2) NOT NULL,
                valor_possivel DECIMAL(10,2) NOT NULL,
                valor_ganho DECIMAL(10,2) NULL,
                status VARCHAR(20) DEFAULT 'ativa',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Transacoes
            "CREATE TABLE IF NOT EXISTS transacoes (
                id BIGSERIAL PRIMARY KEY,
                user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
                tipo VARCHAR(20) NOT NULL,
                valor DECIMAL(10,2) NOT NULL,
                status VARCHAR(20) DEFAULT 'pendente',
                comprovante TEXT NULL,
                chave_pix VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Personal Access Tokens
            "CREATE TABLE IF NOT EXISTS personal_access_tokens (
                id BIGSERIAL PRIMARY KEY,
                tokenable_type VARCHAR(255) NOT NULL,
                tokenable_id BIGINT NOT NULL,
                name VARCHAR(255) NOT NULL,
                token VARCHAR(64) UNIQUE NOT NULL,
                abilities TEXT NULL,
                last_used_at TIMESTAMP NULL,
                expires_at TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
            
            // Password Reset Tokens
            "CREATE TABLE IF NOT EXISTS password_reset_tokens (
                email VARCHAR(255) PRIMARY KEY,
                token VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )",
        ];
        
        foreach ($sqls as $sql) {
            $pdo->exec($sql);
            echo "✅ Tabela criada\n";
        }
        
        // Inserir admin
        $passwordHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $pdo->exec("INSERT INTO users (nome, email, cpf, telefone, data_nascimento, password, saldo, is_admin, ativo) 
                    VALUES ('Admin', 'admin@apostas.com', '00000000000', '11999999999', '1990-01-01', '$passwordHash', 5000.00, TRUE, TRUE)
                    ON CONFLICT (email) DO NOTHING");
        echo "\n✅ Admin criado (admin@apostas.com / password)!\n";
        
        // Inserir usuário teste
        $pdo->exec("INSERT INTO users (nome, email, cpf, telefone, data_nascimento, password, saldo, is_admin, ativo) 
                    VALUES ('Usuário Teste', 'usuario@teste.com', '12345678901', '95999887766', '1995-05-15', '$passwordHash', 1500.00, FALSE, TRUE)
                    ON CONFLICT (email) DO NOTHING");
        echo "✅ Usuário teste criado (usuario@teste.com / password) com R$ 1.500!\n";
        
        // Inserir pilotos
        $pilotos = [
            ['João Silva', 15, 'MX1'],
            ['Pedro Santos', 7, 'MX1'],
            ['Carlos Oliveira', 22, 'MX1'],
            ['Rafael Lima', 33, 'MX2'],
            ['Lucas Costa', 8, 'MX2'],
            ['Marcos Souza', 11, 'MX2'],
            ['Fernando Alves', 99, 'MX3'],
            ['Gustavo Pereira', 44, 'MX3'],
        ];
        
        foreach ($pilotos as $p) {
            $pdo->exec("INSERT INTO pilotos (nome, numero, categoria) VALUES ('$p[0]', $p[1], '$p[2]') ON CONFLICT (numero) DO NOTHING");
        }
        echo "✅ 8 Pilotos criados!\n";
        
        // Inserir corrida de exemplo
        $pdo->exec("INSERT INTO corridas (nome, local, data_hora, categoria, descricao, status) 
                    VALUES ('Campeonato Brasileiro de Motocross 2025', 'São Paulo - SP', '2025-12-15 14:00:00', 'MX1', 'Primeira etapa', 'aberta')");
        $corridaId = $pdo->lastInsertId();
        
        // Vincular pilotos à corrida
        $pdo->exec("INSERT INTO corrida_piloto (corrida_id, piloto_id, cotacao) VALUES ($corridaId, 1, 3.50), ($corridaId, 2, 2.80), ($corridaId, 3, 5.00)");
        echo "✅ Corrida de exemplo criada!\n";
        
        echo "</pre>";
        echo "<hr><h2 style='color:green;'>✅ TUDO CRIADO COM SUCESSO!</h2>";
        echo "<p><a href='/login'>Ir para Admin</a> | <a href='/diagnostico.php'>Ver Diagnóstico</a></p>";
        
    } catch (Exception $e) {
        echo "<h2 style='color:red;'>❌ ERRO</h2>";
        echo "<p>" . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<h2>Criar Tabelas Direto no PostgreSQL</h2>";
    echo "<p>Este método cria as tabelas SEM usar Laravel (mais confiável no Render Free)</p>";
    echo "<form method='get'><input type='hidden' name='executar' value='1'>";
    echo "<button style='background:#d4af37;color:#0d2818;padding:20px 40px;border:none;border-radius:10px;font-size:18px;font-weight:bold;cursor:pointer;'>🚀 CRIAR TABELAS</button>";
    echo "</form>";
}
?>

</body></html>

