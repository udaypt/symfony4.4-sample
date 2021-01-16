FROM php:7.4.10-fpm-buster

ARG DOCKER_UID=33
RUN usermod -u ${DOCKER_UID} www-data

ENV PHP_XDEBUG_VERSION=3.0.1

RUN set -ex &&\
 apt-get update &&\
 apt-get install -y libicu-dev libxml2-dev unzip librabbitmq-dev libxrender1 libfontconfig libxtst6 libpng-dev &&\
 docker-php-ext-install -j 8 intl opcache pdo_mysql soap gd &&\
 pecl install\
 xdebug-${PHP_XDEBUG_VERSION} &&\
 cd /tmp &&\
 apt-get autoremove --purge -y libicu-dev libxml2-dev && apt-get autoclean &&\
 rm -rf /var/lib/apt/lists/* && rm -rf /tmp/*

ARG APP_ENV=dev
ENV APP_ENV=${APP_ENV}
ENV APP_DEBUG=1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.15

RUN set -ex &&\
 mkdir -p /data/maxmind &&\
 curl -sS "https://download.maxmind.com/app/geoip_download?edition_id=GeoLite2-City&suffix=tar.gz&license_key=G5WlxBuOnklvjd8T" | tar -xz -C /data/maxmind --wildcards --strip-components=1 "GeoLite2-City_*/GeoLite2-City.mmdb" &&\
 chown -R www-data: /data/maxmind