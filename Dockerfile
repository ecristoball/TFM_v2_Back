# Usamos PHP CLI, no-FPM ni Nginx
FROM php:8.2-cli

# Instalar dependencias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Copiar el código de Laravel
WORKDIR /app
COPY . .

# Permisos para storage y bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Instalar dependencias PHP de Laravel
RUN composer install --no-dev --optimize-autoloader

# Puerto que Railway asignará dinámicamente
ENV PORT=8080

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=$PORT
