FROM php:7.4.15-apache

RUN docker-php-ext-install pdo pdo_mysql && apt update

RUN ["apt-get", "update"]
RUN ["apt-get", "install", "-y", "zip"]
RUN ["apt-get", "install", "-y", "unzip"]

COPY ./apache/000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite && service apache2 restart

EXPOSE 80