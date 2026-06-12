FROM php:8.4-fpm-alpine

WORKDIR /var/www/html

# Dependências do sistema
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    sqlite \
    sqlite-dev \
    libpng-dev \
    libzip-dev \
    icu-dev \
    zip \
    unzip \
    curl \
    supervisor

# Extensões PHP
RUN docker-php-ext-install \
    pdo_sqlite \
    gd \
    zip \
    bcmath \
    intl \
    opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia o projeto
COPY . .

# Instala dependências PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instala dependências JS e faz build
RUN npm ci && npm run build && rm -rf node_modules

# Permissões
RUN mkdir -p storage/logs storage/framework/{cache,sessions,views} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# banco SQLite
RUN touch database/database.sqlite && chown www-data:www-data database/database.sqlite

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]