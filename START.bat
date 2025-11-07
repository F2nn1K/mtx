@echo off
chcp 65001 > nul
setlocal enabledelayedexpansion

:MENU
cls
color 0B
title 🏍️ Roraima Bets

echo.
echo ╔═══════════════════════════════════════════════════════════════╗
echo ║          🏍️  RORAIMA BETS - SISTEMA DE APOSTAS 🏍️           ║
echo ╚═══════════════════════════════════════════════════════════════╝
echo.
echo  [1] 🚀 INICIAR SERVIDOR
echo  [2] 📱 ABRIR SITE (Usuários)
echo  [3] 🔧 ABRIR ADMIN (Administrador)
echo  [4] 🛑 SAIR
echo.
set /p op="Escolha: "

if "%op%"=="1" goto INICIAR
if "%op%"=="2" start http://localhost:8000/site/index.html && goto MENU
if "%op%"=="3" start http://localhost:8000/login && goto MENU
if "%op%"=="4" exit
goto MENU

:INICIAR
cls
echo.
echo ╔═══════════════════════════════════════════════════════════════╗
echo ║                    INICIANDO SERVIDOR...                      ║
echo ╚═══════════════════════════════════════════════════════════════╝
echo.

cd /d "%~dp0"

if not exist ".env" (
    copy env.example .env > nul
    echo Arquivo .env criado
)

echo Configurando sistema...
C:\xampp\php\php.exe artisan key:generate --no-interaction 2>&1
echo.
C:\xampp\php\php.exe artisan config:clear 2>&1
echo.

cls
echo.
echo ╔═══════════════════════════════════════════════════════════════╗
echo ║                  ✅ SERVIDOR INICIADO! ✅                     ║
echo ╚═══════════════════════════════════════════════════════════════╝
echo.
echo 🌐 Acesse:
echo    📱 Site:  http://localhost:8000/site/index.html
echo    🔧 Admin: http://localhost:8000/login (admin@apostas.com / admin123)
echo.
echo ⚠️  DEIXE ESTA JANELA ABERTA!
echo 🛑 Para parar: Ctrl+C
echo.
echo ═══════════════════════════════════════════════════════════════
echo.

timeout /t 2 > nul
start http://localhost:8000/site/index.html

echo Executando: php artisan serve
echo.
C:\xampp\php\php.exe artisan serve 2>&1

set ERRORCODE=%ERRORLEVEL%

echo.
echo.
echo ═══════════════════════════════════════════════════════════════
if %ERRORCODE% NEQ 0 (
    color 0C
    echo ❌ ERRO ao iniciar servidor! Codigo de erro: %ERRORCODE%
) else (
    echo ✅ Servidor parou normalmente
)
echo ═══════════════════════════════════════════════════════════════
echo.
echo ESTA JANELA NAO VAI FECHAR ATE VOCE PRESSIONAR UMA TECLA!
echo.
pause >nul
goto MENU

