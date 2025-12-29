FROM php:8.2-fpm

# Sistema + Nginx + Supervisor
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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# 🔥 BORRAR TODAS las configs por defecto de nginx
RUN rm -rf /etc/nginx/conf.d/*

# Código Laravel
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

# 👉 TU CONFIG (la única)
COPY deploy/nginx.conf /etc/nginx/conf.d/default.conf

# Supervisor
COPY deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-n"]
