FROM php:7.4-fpm

ENV \
  APP_DIR="/app" \
  APP_PORT="8000"

RUN apt-get update; \
        apt-get install -y --no-install-recommends \
            $PHPIZE_DEPS libonig-dev libzip-dev libcurl4-openssl-dev \
    && docker-php-ext-install pdo_mysql mbstring zip curl \
    && pecl install xdebug redis \
    && docker-php-ext-enable xdebug redis

RUN mkdir $APP_DIR
VOLUME $APP_DIR
WORKDIR $APP_DIR
EXPOSE $APP_PORT
