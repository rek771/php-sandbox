FROM php:7.4-fpm-alpine

ENV TZ=Europe/Moscow

#USER root
#RUN apk add --no-cache php8-dev gcc g++ make git curl wget grep libevent-dev libmemcached-dev composer postgresql-dev
#RUN pecl install -of xdebug
#RUN echo zend_extension=xdebug.so > /usr/local/etc/php/conf.d/xdebug.ini
#RUN pecl install redis
#RUN echo extension=redis.so > /usr/local/etc/php/conf.d/redis.ini
#RUN pecl install pecl_http
#RUN echo extension=raphf.so > /usr/local/etc/php/conf.d/raphf.ini
#RUN docker-php-ext-install pdo pdo_pgsql
#RUN echo extension=pdo.so > /usr/local/etc/php/conf.d/pdo.ini
#RUN echo extension=pdo_pgsql.so > /usr/local/etc/php/conf.d/pdo_pgsql.ini
#RUN mkdir /root/tmp
#WORKDIR /root/tmp
#RUN git clone https://github.com/php-memcached-dev/php-memcached .
#RUN phpize
#RUN ./configure
#RUN make
#RUN make install
#RUN echo extension=memcached.so > /usr/local/etc/php/conf.d/memcached.ini
#RUN rm -rf /root/tmp
WORKDIR /var/www