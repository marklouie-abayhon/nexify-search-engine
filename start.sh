#!/bin/bash

echo "=== STARTUP DIAGNOSTIC ==="
echo "Date: $(date)"
echo "Working directory: $(pwd)"
echo "Contents of /var/www/public:"
ls -la /var/www/public/
echo ""
echo "Testing nginx config:"
nginx -t
echo ""
echo "Testing PHP-FPM config:"
/usr/local/sbin/php-fpm -t
echo ""
echo "Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
