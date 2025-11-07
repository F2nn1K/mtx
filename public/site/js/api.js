// Cliente da API
const api = {
    // Função auxiliar para fazer requisições
    async request(endpoint, options = {}) {
        const url = `${API_CONFIG.baseURL}${endpoint}`;
        const token = localStorage.getItem(TOKEN_KEY);
        
        const config = {
            ...options,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                ...(token && { 'Authorization': `Bearer ${token}` }),
                ...options.headers
            }
        };
        
        try {
            const response = await fetch(url, config);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Erro na requisição');
            }
            
            return data.success !== undefined ? data : { success: true, ...data };
        } catch (error) {
            console.error('Erro na API:', error);
            throw error;
        }
    },
    
    // GET
    async get(endpoint) {
        const response = await this.request(endpoint, { method: 'GET' });
        return response.corridas || response.corrida || response.apostas || response.transacoes || response;
    },
    
    // POST
    async post(endpoint, data) {
        return await this.request(endpoint, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    },
    
    // Auth
    async login(email, password) {
        const response = await this.post('/login', { email, password });
        if (response.success && response.token) {
            localStorage.setItem(TOKEN_KEY, response.token);
            localStorage.setItem(USER_KEY, JSON.stringify(response.user));
        }
        return response;
    },
    
    async register(dados) {
        const response = await this.post('/register', dados);
        if (response.success && response.token) {
            localStorage.setItem(TOKEN_KEY, response.token);
            localStorage.setItem(USER_KEY, JSON.stringify(response.user));
        }
        return response;
    },
    
    async getUser() {
        return await this.get('/user');
    },
    
    // Corridas
    async getCorridas() {
        return await this.get('/corridas');
    },
    
    async getCorrida(id) {
        return await this.get(`/corridas/${id}`);
    },
    
    async getPilotosCorrida(id) {
        return await this.get(`/corridas/${id}/pilotos`);
    },
    
    // Apostas
    async criarAposta(dados) {
        return await this.post('/apostas', dados);
    },
    
    async getMinhasApostas() {
        return await this.get('/apostas');
    },
    
    async getAposta(id) {
        return await this.get(`/apostas/${id}`);
    },
    
    // Transações
    async depositar(valor, comprovante = null) {
        return await this.post('/depositos', { valor, comprovante });
    },
    
    async sacar(valor, chave_pix) {
        return await this.post('/saques', { valor, chave_pix });
    },
    
    async getTransacoes() {
        return await this.get('/transacoes');
    },
    
    async getSaldo() {
        const response = await this.get('/saldo');
        return response.saldo;
    }
};

