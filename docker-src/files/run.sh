#!/bin/sh

[ -f /run-pre.sh ] && /run-pre.sh

#if [ ! -d /DATA/htdocs ] ; then
#  mkdir -p /DATA/htdocs
#  chown nginx:www-data /DATA/htdocs
#fi

# start php-fpm
mkdir -p /DATA/logs/php-fpm
php-fpm -D -O -d error_log=/DATA/logs/php-fpm/php-fpm.log

php /DATA/vendor/acabin/laravoole/laravoole start

# start nginx
mkdir -p /DATA/logs/nginx
mkdir -p /tmp/nginx
chown nginx /tmp/nginx
nginx &
cd /DATA/vue
npm install
npm run dev
