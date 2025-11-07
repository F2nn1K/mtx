# 🏍️ Instruções de Instalação - Sistema de Apostas Motocross

## 📋 PRÉ-REQUISITOS

Antes de começar, você precisa ter instalado no seu PC:

1. **PHP 8.1 ou superior**
   - Download: https://windows.php.net/download/
   - Ou instale via XAMPP/WAMP

2. **Composer** (gerenciador de dependências PHP)
   - Download: https://getcomposer.org/download/

3. **MySQL** ou **MariaDB**
   - Via XAMPP: https://www.apachefriends.org/
   - Ou MySQL standalone: https://dev.mysql.com/downloads/installer/

---

## 🚀 INSTALAÇÃO PASSO A PASSO

### 1. Baixar/Clonar o Projeto

Coloque os arquivos do projeto em uma pasta, por exemplo:
```
C:\Users\leo\Documents\site de apostas\
```

### 2. Instalar Dependências do Laravel

Abra o **Prompt de Comando** ou **PowerShell** na pasta do projeto e execute:

```bash
composer install
```

*Isso vai baixar todas as bibliotecas necessárias do Laravel.*

### 3. Configurar o Arquivo de Ambiente

1. Copie o arquivo `.env.example` e renomeie para `.env`
2. Abra o arquivo `.env` em um editor de texto
3. Configure as informações do banco de dados:

```env
APP_NAME="Apostas Motocross"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=apostas_motocross
DB_USERNAME=root
DB_PASSWORD=
```

**Importante:** 
- Se você usa XAMPP, geralmente `DB_USERNAME=root` e `DB_PASSWORD=` (vazio)
- Se você definiu senha no MySQL, coloque a senha em `DB_PASSWORD`

### 4. Gerar Chave da Aplicação

No terminal, execute:

```bash
php artisan key:generate
```

Isso vai gerar uma chave de segurança para a aplicação.

### 5. Criar o Banco de Dados

1. Abra o **phpMyAdmin** (geralmente em http://localhost/phpmyadmin se você usa XAMPP)
2. Clique em "Novo" para criar um novo banco
3. Nome do banco: `apostas_motocross`
4. Collation: `utf8mb4_unicode_ci`
5. Clique em "Criar"

### 6. Executar as Migrations (Criar Tabelas)

**NOTA:** As migrations ainda não foram criadas. Você precisa criar o banco de dados manualmente ou aguardar as migrations serem fornecidas.

Quando as migrations estiverem prontas, execute:

```bash
php artisan migrate
```

Se quiser popular com dados de exemplo:

```bash
php artisan db:seed
```

### 7. Iniciar o Servidor de Desenvolvimento

No terminal, execute:

```bash
php artisan serve
```

O servidor vai iniciar em: **http://localhost:8000**

---

## 🌐 ACESSAR O SISTEMA

Após iniciar o servidor:

### Frontend (Site de Apostas para Usuários)
```
http://localhost:8000/site/index.html
```

Páginas disponíveis:
- Landing page: `/site/index.html`
- Cadastro: `/site/cadastro.html`
- Login: `/site/login.html`
- Corridas: `/site/corridas.html`
- Perfil: `/site/perfil.html`
- Minhas Apostas: `/site/minhas-apostas.html`

### Backend (Painel Admin com Laravel AdminLTE)
```
http://localhost:8000/login
```

**Credenciais de Admin** (após rodar seeds):
- Email: `admin@apostas.com`
- Senha: `admin123`

---

## ⚙️ ESTRUTURA DE PASTAS IMPORTANTES

```
site de apostas/
│
├── app/                    # Código do Laravel
│   ├── Http/Controllers/   # Controladores
│   └── Models/             # Modelos (User, Corrida, etc)
│
├── public/                 # Pasta pública (acessível via web)
│   ├── index.php          # Entry point do Laravel
│   └── site/              # Frontend HTML
│       ├── index.html
│       ├── cadastro.html
│       ├── corridas.html
│       └── ...
│
├── resources/views/        # Views do AdminLTE (Blade)
│   ├── auth/
│   └── admin/
│
├── routes/
│   ├── web.php            # Rotas do admin
│   └── api.php            # Rotas da API
│
├── database/
│   ├── migrations/        # Estrutura das tabelas
│   └── seeders/           # Dados iniciais
│
├── .env                   # Configurações (criar a partir do .env.example)
└── composer.json          # Dependências PHP
```

---

## 🐛 PROBLEMAS COMUNS

### Erro: "PHP not found"
- Certifique-se de que o PHP está instalado e no PATH do Windows
- Teste executando: `php -v` no terminal

### Erro: "Composer not found"
- Instale o Composer: https://getcomposer.org/download/
- Reinicie o terminal após a instalação

### Erro: "Access denied for user 'root'"
- Verifique se o MySQL está rodando (se usa XAMPP, inicie o MySQL)
- Confira usuário e senha no arquivo `.env`
- Tente deixar `DB_PASSWORD=` vazio se for instalação padrão

### Erro: "Base table or view not found"
- Você precisa executar as migrations: `php artisan migrate`
- Certifique-se de que o banco de dados foi criado

### Erro de CORS ao fazer requisições da API
- O Laravel já está configurado para aceitar requisições do frontend
- Verifique se está acessando via `localhost:8000` e não por IP

### Página em branco ou erro 500
- Verifique os logs em: `storage/logs/laravel.log`
- Certifique-se de que as pastas `storage` e `bootstrap/cache` têm permissão de escrita

---

## 📦 PRÓXIMOS PASSOS

1. ✅ Instalar e configurar (este guia)
2. ⏳ Criar migrations (estrutura do banco)
3. ⏳ Criar seeders (dados iniciais)
4. ⏳ Testar localmente
5. ⏳ Hospedar na Hostinger

---

## 💡 DICAS

- **Manter o terminal aberto** com o `php artisan serve` rodando
- Para parar o servidor: `Ctrl + C` no terminal
- Cada vez que alterar o código, o servidor recarrega automaticamente
- Use o `php artisan` para ver todos os comandos disponíveis

---

## 🆘 PRECISA DE AJUDA?

Se encontrar problemas:
1. Verifique os logs: `storage/logs/laravel.log`
2. Verifique o console do navegador (F12)
3. Certifique-se de que todas as dependências foram instaladas

---

**Boa sorte com o sistema! 🏍️💨**

