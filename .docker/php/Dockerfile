FROM php:8.0.7-fpm-alpine3.13

RUN apk update;
RUN apk upgrade;

RUN docker-php-ext-install pdo_mysql

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \ 
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}