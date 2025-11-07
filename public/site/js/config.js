// Configurações da API
const API_CONFIG = {
    baseURL: window.location.origin + '/api',
    timeout: 10000
};

// Chave do localStorage para o token
const TOKEN_KEY = 'apostas_motocross_token';
const USER_KEY = 'apostas_motocross_user';

// Função para formatar moeda
function formatarMoeda(valor) {
    return 'R$ ' + parseFloat(valor).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Função para formatar data
function formatarData(dataString) {
    const data = new Date(dataString);
    return data.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Verificar se está logado
function estaLogado() {
    return localStorage.getItem(TOKEN_KEY) !== null;
}

// Obter usuário logado
function obterUsuario() {
    const userStr = localStorage.getItem(USER_KEY);
    return userStr ? JSON.parse(userStr) : null;
}

// Fazer logout
function logout() {
    localStorage.removeItem(TOKEN_KEY);
    localStorage.removeItem(USER_KEY);
    window.location.href = 'index.html';
}

// Verificar autenticação e redirecionar se necessário
function verificarAuth(precisaEstarLogado = true) {
    const logado = estaLogado();
    
    if (precisaEstarLogado && !logado) {
        window.location.href = 'login.html';
        return false;
    }
    
    if (!precisaEstarLogado && logado) {
        window.location.href = 'corridas.html';
        return false;
    }
    
    return true;
}

// Atualizar navbar com informações do usuário
function atualizarNavbar() {
    const navbarNav = document.querySelector('#navbarNav .navbar-nav');
    const navLinks = document.getElementById('navLinks');
    
    if (estaLogado()) {
        const linksHTML = `
            <a href="corridas.html"><i class="fas fa-flag-checkered"></i> Corridas</a>
            <a href="minhas-apostas.html"><i class="fas fa-ticket-alt"></i> Minhas Apostas</a>
            <a href="perfil.html"><i class="fas fa-user-circle"></i> Perfil</a>
            <a href="#" onclick="logout(); return false;"><i class="fas fa-sign-out-alt"></i> Sair</a>
        `;
        
        if (navbarNav) {
            navbarNav.innerHTML = `
                <li class="nav-item">
                    <a class="nav-link" href="corridas.html"><i class="fas fa-flag-checkered"></i> Corridas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="minhas-apostas.html"><i class="fas fa-ticket-alt"></i> Minhas Apostas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="perfil.html"><i class="fas fa-user-circle"></i> Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="logout(); return false;">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </li>
            `;
        }
        
        if (navLinks) {
            navLinks.innerHTML = linksHTML;
        }
    } else {
        if (navLinks) {
            navLinks.innerHTML = `
                <a href="index.html">Início</a>
                <a href="login.html">Entrar</a>
                <a href="cadastro.html" class="btn-gold"><i class="fas fa-bolt"></i> Cadastrar</a>
            `;
        }
    }
}

// Mostrar alerta
function mostrarAlerta(mensagem, tipo = 'success', containerId = 'alertas') {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${tipo} alert-dismissible fade show`;
    alert.innerHTML = `
        ${mensagem}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    container.appendChild(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// Inicializar ao carregar página
document.addEventListener('DOMContentLoaded', () => {
    atualizarNavbar();
});

