#!/bin/bash

echo "=== STARTUP DIAGNOSTIC ==="
echo "Date: $(date)"
echo "Working directory: $(pwd)"

echo ""
echo "=== NGINX CONFIGURATION TEST ==="
nginx -t

echo ""
echo "=== PHP-FPM CONFIGURATION TEST ==="
/usr/local/sbin/php-fpm -t

echo ""
echo "=== FILE SYSTEM CHECK ==="
echo "Contents of /var/www/public:"
ls -la /var/www/public/

echo ""
echo "Contents of static.html:"
cat /var/www/public/static.html

echo ""
echo "=== STARTING SERVICES ==="
echo "Starting supervisord..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
