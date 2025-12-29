# Base PHP-FPM
FROM php:8.2-fpm

# Instalar extensiones necesarias y Nginx
RUN apt-get update && apt-get install -y \
    nginx \
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

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Instalar dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Configurar Nginx
RUN rm /etc/nginx/sites-enabled/default
COPY ./deploy/nginx.conf /etc/nginx/sites-available/laravel.conf
RUN ln -s /etc/nginx/sites-available/laravel.conf /etc/nginx/sites-enabled/

# Exponer puerto 80
EXPOSE 80

# Comando de inicio: Nginx + PHP-FPM
CMD nginx -g "daemon off;" & php-fpm -F
