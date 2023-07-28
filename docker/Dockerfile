FROM php:8.1.9-apache
RUN apt-get update && apt-get install -qq \
    curl \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql intl \
    && a2enmod rewrite
