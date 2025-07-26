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

# Configure Nginx
COPY nginx.conf /etc/nginx/sites-available/default
RUN rm -f /etc/nginx/sites-enabled/default && ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/

# Configure Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create required directories and configure PHP-FPM
RUN mkdir -p /var/run/php /var/log/supervisor
RUN sed -i 's/listen = 127.0.0.1:9000/listen = \/var\/run\/php\/php8.2-fpm.sock/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/;listen.owner = www-data/listen.owner = www-data/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/;listen.group = www-data/listen.group = www-data/' /usr/local/etc/php-fpm.d/www.conf
RUN sed -i 's/;listen.mode = 0660/listen.mode = 0660/' /usr/local/etc/php-fpm.d/www.conf

# Install dependencies and optimize
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Fix permissions for Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
