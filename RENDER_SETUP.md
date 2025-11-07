# 🚀 Configuração no Render.com - Roraima Bets

## 📋 PASSO A PASSO

### 1. Criar Web Service no Render

Acesse: https://dashboard.render.com/select-repo

**Configurações:**

| Campo | Valor |
|-------|-------|
| **Repository** | F2nn1K/mtx |
| **Name** | roraima-bets |
| **Environment** | Docker |
| **Branch** | main |
| **Dockerfile Path** | ./Dockerfile |
| **Instance Type** | Free (ou Starter $7/mês) |

---

### 2. Criar Banco de Dados MySQL

No Render:
1. Clique em **New** → **MySQL**
2. **Name:** roraima-bets-db
3. **Database:** roraima_bets
4. **User:** roraima_user
5. Clique em **Create Database**
6. Aguarde provisionar (2-3 minutos)
7. **Copie as credenciais** que aparecerem

---

### 3. Configurar Variáveis de Ambiente

No Web Service, vá em **Environment** e adicione:

```
APP_NAME=Roraima Bets
APP_ENV=production
APP_KEY=base64:XXXXXX (será gerado automaticamente no build)
APP_DEBUG=false
APP_URL=https://roraima-bets.onrender.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=(copiar do MySQL criado - ex: dpg-xxxx.oregon-postgres.render.com)
DB_PORT=3306
DB_DATABASE=roraima_bets
DB_USERNAME=roraima_user
DB_PASSWORD=(copiar do MySQL criado)

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

---

### 4. Deploy Inicial

1. Clique em **Create Web Service**
2. Aguarde o build (5-10 minutos na primeira vez)
3. O Render vai:
   - Construir a imagem Docker
   - Instalar dependências do Composer
   - Gerar chave da aplicação
   - Cachear configurações

---

### 5. Executar Migrations

Após o deploy, no Dashboard do Render:

1. Vá em **Shell** (terminal do container)
2. Execute:

```bash
php artisan migrate --force
php artisan db:seed --force
```

Ou configure um **Build Command** adicional:
```
composer install --no-dev && php artisan migrate --force --seed
```

---

### 6. Acessar o Sistema

**URL:** `https://roraima-bets.onrender.com`

- **Frontend:** https://roraima-bets.onrender.com/site/index.html
- **Admin:** https://roraima-bets.onrender.com/login
  - Email: admin@apostas.com
  - Senha: password

---

## ⚙️ Comandos Úteis

### Limpar cache (via Shell do Render):
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Recriar banco (cuidado!):
```bash
php artisan migrate:fresh --seed
```

### Ver logs:
```bash
tail -f storage/logs/laravel.log
```

---

## 🐛 Troubleshooting

### Erro: "Permission denied" no storage
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Erro: "APP_KEY not set"
```bash
php artisan key:generate --force
```

### Erro: "Connection refused" no banco
- Verifique se o banco MySQL está rodando
- Confirme as credenciais no .env
- Aguarde 2-3 min após criar o banco

---

## 💰 Custos

**Opção 1: Free Tier**
- ✅ Grátis
- ⏰ Servidor dorme após 15min inativo
- ⚡ Pode ser lento
- 💾 750h/mês

**Opção 2: Starter ($7/mês)**
- ✅ Sempre ativo
- ⚡ Mais rápido
- 💾 Ilimitado

**Banco MySQL:** $7/mês (256MB) ou $15/mês (1GB)

---

## ✅ Checklist Final

- [ ] Web Service criado
- [ ] MySQL Database criado
- [ ] Variáveis de ambiente configuradas
- [ ] Build concluído com sucesso
- [ ] Migrations executadas
- [ ] Seeds executados
- [ ] Site acessível
- [ ] Admin funcional
- [ ] Testes de aposta realizados

---

**Siga os passos e quando chegar na parte de variáveis de ambiente me avise! 🚀**

