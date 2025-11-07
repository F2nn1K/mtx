# 🚀 Guia de Deploy - Roraima Bets

## 📦 Deploy no Render.com

### Passo 1: Preparar o Projeto

```bash
# No seu PC local
git add .
git commit -m "Sistema Roraima Bets completo"
git push origin main
```

### Passo 2: Configurar no Render

1. Acesse: https://render.com
2. Clique em **New** → **Web Service**
3. Conecte seu repositório GitHub
4. Configure:
   - **Name:** roraima-bets
   - **Environment:** PHP
   - **Build Command:** `composer install --no-dev`
   - **Start Command:** `php artisan serve --host=0.0.0.0 --port=$PORT`

### Passo 3: Variáveis de Ambiente

Adicione no Render:
```
APP_NAME=Roraima Bets
APP_ENV=production
APP_KEY=(gerar com: php artisan key:generate --show)
APP_DEBUG=false
APP_URL=https://seu-app.onrender.com

DB_CONNECTION=mysql
DB_HOST=(fornecido pelo Render MySQL)
DB_DATABASE=roraima_bets
DB_USERNAME=(fornecido pelo Render)
DB_PASSWORD=(fornecido pelo Render)
```

### Passo 4: Banco de Dados no Render

1. Crie um MySQL Database no Render
2. Copie as credenciais para as variáveis de ambiente
3. Execute via dashboard: `php artisan migrate --seed`

---

## 🌐 Deploy na Hostinger

### Passo 1: Upload via FTP

1. Compacte o projeto em .zip
2. Acesse File Manager da Hostinger
3. Faça upload para `/public_html/`
4. Descompacte

### Passo 2: Configurar .env

Edite o arquivo `.env` na Hostinger:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com

DB_HOST=localhost
DB_DATABASE=u123456_roraima_bets
DB_USERNAME=u123456_user
DB_PASSWORD=sua_senha_hostinger
```

### Passo 3: Configurar DocumentRoot

No painel Hostinger:
- Domínios → Gerenciar
- Document Root: `/public_html/public`

### Passo 4: Executar Migrations

Via SSH (se disponível):
```bash
cd public_html
php artisan migrate --seed
php artisan config:cache
php artisan route:cache
```

Ou via File Manager, criar arquivo `install.php` na raiz:
```php
<?php
require_once 'artisan';
Artisan::call('migrate', ['--seed' => true]);
Artisan::call('config:cache');
echo "Instalado com sucesso!";
```

Acesse: `https://seudominio.com/install.php`

---

## ✅ Checklist Final

- [ ] .env configurado
- [ ] Banco de dados criado
- [ ] Migrations rodadas
- [ ] Seed executado
- [ ] Permissões de pasta (755 para storage)
- [ ] Logo adicionada em /public/site/img/
- [ ] Testar login admin
- [ ] Testar cadastro de usuário
- [ ] Testar fazer aposta

---

## 📞 Suporte

Email: leo.vdf3@gmail.com
Repositório: https://github.com/F2nn1K/mtx.git

