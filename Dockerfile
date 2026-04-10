# ============================================================
# Stage 1: Node.js — build Vite/frontend assets
# ============================================================
FROM node:18-alpine AS node-builder

WORKDIR /app

# Install Node dependencies
COPY package.json package-lock.json ./
RUN npm ci

# Copy frontend source files needed for the build
COPY vite.config.js tailwind.config.js postcss.config.js ./
COPY resources/ resources/

# Build assets — outputs to public/build/
RUN npm run build

# ============================================================
# Stage 2: Composer — install PHP dependencies
# ============================================================
FROM composer:2 AS composer-builder

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader \
    --prefer-dist

# ============================================================
# Stage 3: Production image — FrankenPHP
# ============================================================
FROM dunglas/frankenphp:latest-php8.2-alpine

# Install required PHP extensions and system packages
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    sqlite-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_sqlite \
        gd \
        bcmath \
        opcache

WORKDIR /app

# Copy application source
COPY . .

# Copy compiled vendor dependencies from composer stage
COPY --from=composer-builder /app/vendor ./vendor

# Create required Laravel directories before running artisan commands
RUN mkdir -p storage/framework/{sessions,views,cache} \
        storage/logs \
        bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Run Laravel package discovery (replaces post-autoload-dump)
RUN php artisan package:discover --ansi

# Copy Vite-built assets from node stage and set correct permissions
COPY --from=node-builder /app/public/build ./public/build
RUN chmod -R 755 public/build \
    && ls -la public/build/ \
    && echo "✓ manifest.json present:" \
    && cat public/build/manifest.json | head -5

# Set final permissions for all Laravel writable directories
RUN chown -R www-data:www-data storage bootstrap/cache public/build

# Do not generate a build-time .env or cache config during image build.
# Runtime environment variables from Railway should be used instead.
RUN php artisan route:cache

EXPOSE 8000

CMD ["frankenphp", "php-server", "--listen", "0.0.0.0:8000", "--root", "/app/public"]
