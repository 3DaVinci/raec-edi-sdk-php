FROM php:8.1-fpm-alpine
ARG TIMEZONE

COPY ./php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

ENV PHP_EXT_DEPS \
    gettext=gettext-dev \
    icu=icu-dev \
    libgcrypt=libgcrypt-dev \
    libxml2=libxml2-dev \
    libxslt=libxslt-dev \
    libzip=libzip-dev

RUN set -x; \
    apk add --no-cache --virtual .php-extensions-build-dependencies \
        $PHPIZE_DEPS \
        linux-headers \
        $(echo ${PHP_EXT_DEPS} | tr ' ' '\n' | cut -d = -f 2) \
    && apk add --no-cache \
        $(echo ${PHP_EXT_DEPS} | tr ' ' '\n' | cut -d = -f 1) \
    && printf "\n"

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

WORKDIR /srv/raec-edi-sdk-php
