FROM php:8.2-fpm-alpine

ARG UID
ARG GID
ARG USER

ENV UID=${UID}
ENV GID=${GID}
ENV USER=${USER}

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

RUN delgroup dialout

RUN addgroup -g ${GID} --system ${USER}
RUN adduser -G ${USER} --system -D -s /bin/sh -u ${UID} ${USER}

RUN sed -i "s/user = www-data/user = ${USER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = ${USER}/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN apk add --no-cache libpng libpng-dev jpeg-dev postgresql-dev zlib-dev libzip-dev

RUN container-php-ext-configure \
    gd --enable-gd --with-jpeg

RUN container-php-ext-install \
    exif \
    pdo_pgsql \
    zip \
    gd

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.3.7.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && container-php-ext-install redis

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
