FROM php:7.0.8-fpm

RUN apt-get update
RUN apt-get install -y git libmcrypt-dev

RUN curl -sS https://getcomposer.org/installer | php \
        && mv composer.phar /usr/bin/composer

RUN pecl install xdebug && \
    echo zend_extension=xdebug.so > /usr/local/etc/php/conf.d/xdebug.ini && \
    docker-php-ext-install mbstring mysqli bcmath pdo pdo_mysql mcrypt && \
    echo extension=bcmath.so > /usr/local/etc/php/conf.d/docker-php-ext-bcmath.ini

ADD php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/shop


