FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    postgresql-dev \
    zlib-dev \
    libzip-dev \
    libexif-dev

RUN docker-php-ext-install \
    pdo_pgsql \
    zip \
    exif

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN chmod +x /usr/local/bin/composer

WORKDIR /var/www/html

RUN addgroup -g 1000 www \
    && adduser -u 1000 -D -s /bin/ash -G www www

COPY --chown=www:www . .
COPY --chown=www:www docker/.env.example .env

USER www

EXPOSE 9000

CMD ["php-fpm"]
