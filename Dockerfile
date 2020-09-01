FROM composer:2 AS composer

FROM php:7.4-cli

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN pecl install channel://pecl.php.net/runkit7-3.1.0a1 && \
    docker-php-ext-enable runkit7

WORKDIR /app
COPY . /app

RUN composer install
