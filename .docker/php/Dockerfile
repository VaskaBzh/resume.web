FROM php:8.2-fpm-alpine3.16

# Set working directory
WORKDIR /var/www/html

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN set -ex \
        && apk update \
        && apk --no-cache add yarn nodejs npm libpng freetype-dev  \
                              libjpeg-turbo-dev libpng-dev libzip-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install pdo mysqli pdo_mysql gd zip exif \
        && docker-php-ext-enable pdo_mysql \
        && apk del libpng-dev

# Create a group and user
RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel
