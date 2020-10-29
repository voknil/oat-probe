ARG VERSION="7.4.11-fpm"
FROM php:${VERSION}

RUN apt-get update && apt-get install -y --no-install-recommends \
    git-core \
    unzip \
    libssl-dev \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install -j$(nproc) zip intl \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN yes | pecl install xdebug
RUN docker-php-ext-enable xdebug

## Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd --create-home --uid 1000 --user-group --system app

COPY ./php.ini /usr/local/etc/php

## Install application:
WORKDIR /var/www/html

USER app
