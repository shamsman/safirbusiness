#!/bin/sh
set -e

# Ensure storage directories exist
mkdir -p /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/framework/cache \
         /var/www/html/bootstrap/cache

# Remove any stale package/config caches from dev
rm -f /var/www/html/bootstrap/cache/*.php

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Re-discover packages without dev dependencies
php artisan package:discover --ansi || true

exec apache2-foreground
