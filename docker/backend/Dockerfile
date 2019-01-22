FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
    unzip

# Install MongoDB
RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/hawk-api