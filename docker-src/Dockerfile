FROM php:7-fpm-alpine
MAINTAINER Gavin <acabin@live.com>

ADD files/repositories /etc/apk/repositories

RUN apk update

RUN apk --no-cache add bash nginx ca-certificates redis python libpng giflib jpeg openssh git

RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS libpng-dev giflib-dev jpeg-dev zlib-dev linux-headers && \
    docker-php-ext-install json xml pdo phar opcache pdo_mysql zip gd iconv mcrypt bcmath dom pcntl pdo_sqlite && \
    apk del .phpize-deps

ADD files/nginx.conf /etc/nginx/
ADD files/php* /usr/local/etc/php/
ADD files/run.sh /
ADD files/inputrc /etc/inputrc

RUN chmod +x /run.sh

WORKDIR /wwwroot
#ENTRYPOINT ["/run.sh"]
CMD ["/run.sh"]
