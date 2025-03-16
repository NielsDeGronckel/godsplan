# Web container
FROM nginx:latest AS web

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# PHP container
FROM php:8.2-fpm AS php

RUN apt-get update && apt-get install -y \
  git zip unzip libpng-dev \
  libzip-dev default-mysql-client

RUN docker-php-ext-install pdo pdo_mysql zip gd

WORKDIR /var/www

COPY . /var/www

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-scripts --no-autoloader

# Apache container
FROM php:8.2-apache AS apache

RUN apt-get update && apt-get install -y \
  git zip unzip libpng-dev \
  libzip-dev default-mysql-client

RUN docker-php-ext-install pdo pdo_mysql zip gd

RUN a2enmod rewrite

WORKDIR /var/www

COPY . /var/www

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-scripts --no-autoloader

EXPOSE 80

RUN sed -i 's!/var/www/html!/var/www/html/Admin!g' \
  /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]