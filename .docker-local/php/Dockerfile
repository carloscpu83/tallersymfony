FROM php:7.4.33-fpm-alpine3.16
RUN apk --update --no-cache add linux-headers autoconf g++ make git openssh-client libpq-dev icu-dev
RUN pecl install xdebug-3.1.5
COPY ./xdebug.ini "${PHP_INI_DIR}/conf.d"
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && docker-php-ext-install pgsql pdo_pgsql
RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-enable intl
COPY --from=composer:2.5.4 /usr/bin/composer /usr/local/bin/composer



# RUN mkdir -p /var/www/html/logs/xdebug
# RUN mkdir -p /var/www/html/logs/cachegrind
# pdo ampq gd intl xsl pdo_pgsql

WORKDIR /var/www/html
