FROM php:7.4-fpm

MAINTAINER solravn <ildargafurof@gmail.com>

RUN usermod -u 1000 www-data

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils \
curl \
wget \
vim \
libicu-dev \
libxml2-dev \
libpq-dev \
&& docker-php-ext-install -j$(nproc) pdo pgsql pdo_pgsql \
&& docker-php-ext-configure intl && docker-php-ext-install intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/app/

CMD ["php-fpm"]