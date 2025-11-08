# 🏍️ Roraima Bets - Sistema de Apostas de Motocross

Sistema completo de apostas de motocross com painel administrativo Laravel AdminLTE e frontend HTML/CSS/JS.

![Roraima Bets](public/site/img/logo.png)

## 🎨 Características

- ✅ Design profissional em verde e dourado
- ✅ Layout responsivo (mobile-friendly)
- ✅ Painel administrativo completo
- ✅ Sistema de apostas em tempo real
- ✅ Processamento automático de vencedores
- ✅ Gerenciamento de depósitos e saques via PIX

## 🚀 Tecnologias

- **Backend:** Laravel 10
- **Frontend:** HTML5, CSS3, JavaScript
- **Admin:** Laravel AdminLTE 3
- **Database:** MySQL/MariaDB
- **Auth:** Laravel Sanctum

## 📦 Instalação Local

### Requisitos
- PHP 8.1+
- Composer
- MySQL 5.7+
- Servidor web (Apache/Nginx)

### Passos

```bash
# 1. Clone o repositório
git clone https://github.com/F2nn1K/mtx.git
cd mtx

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco no .env
DB_DATABASE=apostas_motocross
DB_USERNAME=root
DB_PASSWORD=sua_senha

# 5. Rode as migrations
php artisan migrate
php artisan db:seed

# 6. Inicie o servidor
php artisan serve
```

## 🌐 Acessar

- **Frontend (Site):** http://localhost:8000/site/index.html
- **Admin (Painel):** http://localhost:8000/login
  - Email: admin@apostas.com
  - Senha: password

## 📂 Estrutura

```
/
├── app/                    # Backend Laravel
├── public/site/           # Frontend HTML
├── resources/views/       # Views AdminLTE
├── database/migrations/   # Migrations do banco
├── routes/                # Rotas (web e api)
└── START.bat             # Iniciar sistema (Windows)
```

## 🎯 Funcionalidades

### Frontend (Usuários)
- Cadastro e login
- Ver corridas disponíveis
- Fazer apostas (vencedor, pódio, volta rápida)
- Depositar via PIX
- Sacar via PIX
- Histórico de apostas

### Backend (Admin)
- Dashboard com estatísticas
- Gerenciar corridas
- Gerenciar pilotos
- Aprovar depósitos/saques
- Ver todas as apostas
- Finalizar corridas e processar vencedores automaticamente
- Relatórios financeiros

## 🚀 Deploy

### Hostinger / Render
1. Faça upload dos arquivos
2. Configure o .env com dados do banco
3. Execute: `php artisan migrate --seed`
4. Aponte domínio para `/public`

## 📝 Licença

Sistema desenvolvido para Roraima Bets - Apostas de Motocross

LV Consultoria
