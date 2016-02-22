#!/bin/bash

export COMPOSER_HOME="/root"

cd /var/www/stock5

#scl enable php55 '/bin/composer install --no-dev --optimize-autoloader --no-interaction' &>> /tmp/cd_debug
#git pull
scl enable php55 'php artisan cache:clear' &>> /tmp/cd_debug

chown -R nginx:nginx /var/www/stock5/storage /var/www/stock5/bootstrap/cache;