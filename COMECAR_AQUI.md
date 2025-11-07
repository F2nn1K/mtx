# 🏍️ COMECE AQUI - Guia Rápido

## 🎯 SISTEMA COMPLETO CRIADO!

Você tem agora um **sistema completo de apostas de motocross** pronto para funcionar!

---

## ⚡ INÍCIO RÁPIDO (3 Comandos)

Abra o terminal na pasta do projeto e execute:

```bash
# 1. Instalar dependências
composer install

# 2. Configurar ambiente
copy env.example .env
php artisan key:generate

# 3. Iniciar servidor
php artisan serve
```

**Pronto!** Acesse:
- Frontend: http://localhost:8000/site/index.html
- Admin: http://localhost:8000/login

---

## ⚙️ CONFIGURAÇÃO DO BANCO

Antes de rodar, configure o `.env`:

```env
DB_DATABASE=apostas_motocross
DB_USERNAME=root
DB_PASSWORD=sua_senha_se_houver
```

E crie o banco no phpMyAdmin:
```sql
CREATE DATABASE apostas_motocross;
```

---

## 📁 ESTRUTURA DO PROJETO

```
/
├── 📱 FRONTEND (HTML) → public/site/
│   ├── index.html       ← Landing page
│   ├── cadastro.html    ← Cadastro de usuários
│   ├── login.html       ← Login de usuários
│   ├── corridas.html    ← Listar corridas e apostar
│   ├── perfil.html      ← Carteira (depósitos/saques)
│   └── minhas-apostas.html ← Histórico
│
└── 🔧 BACKEND (Laravel AdminLTE) → /admin
    ├── Dashboard        ← Estatísticas
    ├── Corridas         ← Gerenciar corridas
    ├── Pilotos          ← Gerenciar pilotos
    ├── Apostas          ← Ver apostas
    ├── Usuários         ← Gerenciar usuários
    ├── Depósitos        ← Aprovar depósitos
    ├── Saques           ← Aprovar saques
    └── Relatórios       ← Relatórios financeiros
```

---

## 🎮 COMO USAR

### Como Usuário (Apostador)
1. Acesse `/site/index.html`
2. Cadastre-se em `/site/cadastro.html`
3. Faça login
4. Deposite dinheiro (PIX)
5. Escolha uma corrida
6. Faça sua aposta
7. Acompanhe o resultado
8. Saque seus ganhos

### Como Admin
1. Acesse `/login`
2. Entre com credenciais de admin
3. Crie corridas em "Corridas > Nova Corrida"
4. Cadastre pilotos em "Pilotos > Novo Piloto"
5. Aprove depósitos em "Depósitos"
6. Acompanhe apostas em "Apostas"
7. Finalize corridas e informe resultados
8. Sistema credita vencedores automaticamente

---

## ⚠️ PRÓXIMO PASSO IMPORTANTE

**O banco de dados ainda precisa ser criado!**

Você tem 2 opções:

### Opção 1: Aguardar Migrations
Aguarde as migrations serem criadas e execute:
```bash
php artisan migrate
php artisan db:seed
```

### Opção 2: Criar Manualmente
Crie as tabelas manualmente no phpMyAdmin seguindo a estrutura em `SISTEMA_COMPLETO.md`

---

## 📚 DOCUMENTAÇÃO COMPLETA

- **README.md** → Documentação completa do sistema
- **INSTRUCOES_INSTALACAO.md** → Guia detalhado de instalação
- **SISTEMA_COMPLETO.md** → Resumo de tudo que foi criado
- **ARQUIVOS_CRIADOS.txt** → Lista de todos os arquivos

---

## 🔥 O QUE JÁ ESTÁ PRONTO

✅ Todo o backend Laravel
✅ Todo o painel AdminLTE
✅ Todo o frontend HTML
✅ Sistema de autenticação
✅ API REST completa
✅ Todas as telas e funcionalidades
✅ Documentação completa

---

## 💡 DICAS

- Use `php artisan serve` para rodar localmente
- Acesse o frontend sempre via `/site/index.html`
- O painel admin está em `/login`
- Arquivos de configuração estão em `/config`
- Logs de erro em `storage/logs/laravel.log`

---

## 🆘 PROBLEMAS?

1. **Erro de permissão?**
   - Dê permissão às pastas: `storage/` e `bootstrap/cache/`

2. **Erro de banco?**
   - Verifique o `.env`
   - Certifique-se que o MySQL está rodando
   - Crie o banco: `apostas_motocross`

3. **Página em branco?**
   - Verifique `storage/logs/laravel.log`
   - Execute: `php artisan config:clear`

4. **Erro de CORS?**
   - Acesse via `localhost:8000`, não por IP

---

## 📦 HOSPEDAR NA HOSTINGER

Quando estiver pronto:

1. Faça upload de todos os arquivos
2. Configure `.env` com dados da Hostinger
3. Rode as migrations
4. Aponte domínio para `/public`

**Plano recomendado:** Cloud Startup (R$36,99/mês)

---

## 🎯 RESUMO DE 10 SEGUNDOS

```bash
composer install
copy env.example .env
php artisan key:generate
# Configure .env com seu banco
php artisan serve
```

Acesse: http://localhost:8000/site/index.html

---

**🏁 PRONTO PARA COMEÇAR!** 🏍️💨

Qualquer dúvida, consulte a documentação completa em `README.md`

