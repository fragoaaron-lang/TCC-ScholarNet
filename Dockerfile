# Stage 1 - Build frontend assets
FROM node:18 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm AS backend

RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 10000
CMD ["sh", "-lc", "php -S 0.0.0.0:${PORT:-10000} -t public public/index.php"]
