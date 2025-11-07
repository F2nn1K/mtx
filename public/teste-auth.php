<!DOCTYPE html>
<html><head><title>Teste Auth</title></head><body style="padding:20px;font-family:Arial;">
<h1>🔐 Teste de Autenticação Laravel</h1><hr>

<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

echo "<h2>1. Testando se Laravel carrega...</h2>";
try {
    echo "✅ Laravel carregado!<br>";
    echo "App Name: " . config('app.name') . "<br>";
    echo "Environment: " . config('app.env') . "<br>";
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>2. Testando Model User...</h2>";
try {
    $user = \App\Models\User::where('email', 'admin@apostas.com')->first();
    if ($user) {
        echo "✅ Usuário encontrado via Eloquent!<br>";
        echo "Nome: " . $user->nome . "<br>";
        echo "Email: " . $user->email . "<br>";
        echo "Is Admin: " . ($user->is_admin ? 'SIM' : 'NÃO') . "<br>";
    } else {
        echo "❌ Usuário NÃO encontrado via Eloquent!<br>";
    }
} catch (Exception $e) {
    echo "❌ Erro no Model: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>3. Testando Hash::check()...</h2>";
try {
    $user = \App\Models\User::where('email', 'admin@apostas.com')->first();
    if ($user) {
        $verifica = \Illuminate\Support\Facades\Hash::check('password', $user->password);
        if ($verifica) {
            echo "✅ Hash::check() funcionou!<br>";
            echo "A senha 'password' confere com o hash do banco!<br>";
        } else {
            echo "❌ Hash::check() FALHOU!<br>";
            echo "A senha não confere!<br>";
        }
    }
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>4. Testando Auth::attempt()...</h2>";
try {
    $credenciais = [
        'email' => 'admin@apostas.com',
        'password' => 'password'
    ];
    
    if (\Illuminate\Support\Facades\Auth::attempt($credenciais)) {
        echo "✅ Auth::attempt() FUNCIONOU!<br>";
        echo "Login seria bem-sucedido!<br>";
        $user = \Illuminate\Support\Facades\Auth::user();
        echo "Usuário logado: " . $user->nome . "<br>";
    } else {
        echo "❌ Auth::attempt() FALHOU!<br>";
        echo "Credenciais não conferem!<br>";
    }
} catch (Exception $e) {
    echo "❌ Erro no Auth: " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr>";
echo "<p><a href='/diagnostico.php'>← Voltar</a></p>";

?>
</body></html>

