FROM php:8.2-cli-alpine

RUN apk update && apk add \
    build-base \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    linux-headers

RUN docker-php-ext-install pdo pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

