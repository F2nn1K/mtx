#!/bin/bash
set -e

echo "🏍️ Iniciando Roraima Bets..."

# Aguardar banco estar disponível (mais tempo)
echo "⏳ Aguardando banco de dados..."
sleep 10

# Verificar conexão com banco
echo "🔍 Testando conexão com banco..."
php artisan migrate:status || echo "Banco ainda não está pronto, aguardando..."
sleep 5

# Rodar migrations
echo "📊 Criando tabelas no banco..."
php artisan migrate --force || echo "⚠️ Erro nas migrations - continuando..."

# Rodar seeds (criar admin)
echo "👤 Criando usuário admin..."
php artisan db:seed --force || echo "⚠️ Erro nos seeds - continuando..."

# Limpar cache
echo "⚡ Limpando cache..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

echo "✅ Sistema iniciado!"
echo "📊 Tabelas criadas:"
php artisan migrate:status || true

# Iniciar Apache
echo "🚀 Iniciando servidor web..."
apache2-foreground

