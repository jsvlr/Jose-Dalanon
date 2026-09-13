# Stage 1 - Backend deps (Composer)
FROM php:8.4-cli AS vendor
WORKDIR /app

RUN apt-get update && apt-get install -y \
    git curl unzip \
    libpq-dev libonig-dev libzip-dev libicu-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip dom intl gd bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

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

# Stage 3 - Backend (Laravel + PHP + Nginx)
FROM php:8.4-fpm AS backend

RUN apt-get update && apt-get install -y \
    git curl unzip nginx gettext-base \
    libpq-dev libonig-dev libzip-dev libicu-dev libxml2-dev \
    libpng-dev libjpeg-dev libfreetype6-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip dom intl gd bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader

# Nginx config template + startup script
RUN mkdir -p /etc/nginx/templates
COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Laravel permissions (storage/cache need to be writable)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]