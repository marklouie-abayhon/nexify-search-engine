# Start from the official PHP-FPM image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies, including Nginx and Supervisor
# Also clean up apt-get lists to keep the image size small
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . .

# Copy Supervisor and Nginx configuration files into the container
# Assumes these files are in the same directory as your Dockerfile
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY nginx.conf /etc/nginx/sites-available/default

# Install Laravel dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Set correct permissions for storage and cache
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose port 80 for the Nginx web server
EXPOSE 80

# Start Supervisor to manage both Nginx and PHP-FPM
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
