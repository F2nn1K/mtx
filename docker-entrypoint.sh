#!/bin/bash

echo "🏍️ Iniciando Roraima Bets..."

# Aguardar banco estar disponível
echo "⏳ Aguardando banco de dados..."
sleep 5

# Rodar migrations
echo "📊 Criando tabelas no banco..."
php artisan migrate --force

# Rodar seeds (criar admin)
echo "👤 Criando usuário admin..."
php artisan db:seed --force

# Limpar e cachear configurações
echo "⚡ Otimizando..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache

echo "✅ Sistema pronto!"

# Iniciar Apache
apache2-foreground

