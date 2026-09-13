#!/bin/sh
set -e

# Render sets $PORT dynamically; default to 10000 if not set (e.g. local testing)
export PORT="${PORT:-10000}"

envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/sites-enabled/default

# Run Laravel cache/config steps at startup (safer than build time, since env vars are only available at runtime on Render)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start php-fpm in the background
php-fpm -D

# Start nginx in the foreground (keeps container alive)
nginx -g "daemon off;"