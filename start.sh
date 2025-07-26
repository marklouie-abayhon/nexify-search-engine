#!/bin/bash

# Start PHP-FPM first
echo "Starting PHP-FPM..."
/usr/local/sbin/php-fpm --daemonize

# Wait for PHP-FPM socket to be ready
echo "Waiting for PHP-FPM socket..."
while [ ! -S /var/run/php/php8.2-fpm.sock ]; do
  sleep 1
done

# Fix socket permissions
chown www-data:www-data /var/run/php/php8.2-fpm.sock

echo "Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
