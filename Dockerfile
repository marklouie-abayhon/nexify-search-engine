# Dockerfile

FROM php:8.2-fpm
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN mkdir -p /var/run/php

# Copy the global and pool FPM configs
COPY php-fpm.conf /usr/local/etc/php-fpm.conf
COPY php-fpm-pool.conf /usr/local/etc/php-fpm.d/www.conf

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY nginx.conf /etc/nginx/sites-available/default

RUN composer install --no-interaction --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/run/php

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
