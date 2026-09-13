# Stage 1 - Backend deps (Composer)
FROM composer:2 AS vendor
WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --optimize-autoloader --ignore-platform-reqs

# Stage 2 - Build Frontend (Vite)
FROM node:24 AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
COPY --from=vendor /app/vendor ./vendor
RUN npm run build

# Stage 3 - Backend (Laravel + PHP + Composer)
FROM php:8.4-fpm AS backend

RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip dom intl gd exif pcntl fileinfo mysql sqlite3 pdo_sqlite bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

CMD ["php-fpm"]