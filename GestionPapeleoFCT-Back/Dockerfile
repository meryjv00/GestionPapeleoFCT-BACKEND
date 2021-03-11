FROM php:7.4.16-apache-buster

COPY ./apache/000-default.conf /etc/apache2/sites-available/

COPY . /var/www/html

RUN docker-php-ext-install pdo pdo_mysql \
    && apt update \
    && apt-get update \
    && apt-get install -y zip \
    && apt-get install -y unzip \
    && apt-get install -y libzip-dev \
    && apt-get install -y libpng-dev \
    && a2enmod rewrite \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && service apache2 restart \
    && apt-get clean


EXPOSE 80