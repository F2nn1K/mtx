# Usar imagem PHP 8.2 com Apache
FROM php:8.2-apache

# Instalar dependências do sistema (incluindo PostgreSQL)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    libzip-dev

# Limpar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP (MySQL e PostgreSQL)
RUN docker-php-ext-install pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# Copiar Composer do composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar DocumentRoot do Apache para /var/www/html/public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . /var/www/html

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar env.example para .env se não existir
RUN if [ ! -f .env ]; then cp env.example .env; fi

# Gerar chave da aplicação
RUN php artisan key:generate

# Expor porta 80
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]

