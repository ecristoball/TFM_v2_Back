# Base PHP-FPM
FROM php:8.2-fpm

# Instalar extensiones, Nginx y supervisor
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copiar código Laravel
COPY . /var/www/html

# Permisos Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
