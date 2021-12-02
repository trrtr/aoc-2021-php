FROM php:8-alpine

WORKDIR /solutions

ENTRYPOINT ["php", "run.php"]

RUN apk add --update --no-cache $PHPIZE_DEPS
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
