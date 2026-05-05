# =============================================
# STAGE 1 : "builder" - compile et installe tout
# =============================================
FROM php:8.4-fpm-alpine AS builder

# Script communautaire qui gere toutes les extensions PHP proprement
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    xml \
    redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY src/composer.json src/composer.lock ./

RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY src/ .

RUN composer dump-autoload --optimize


# =============================================
# STAGE 2 : "production" - image finale legere
# =============================================
FROM php:8.4-fpm-alpine

# Librairies runtime pour toutes les extensions
RUN apk add --no-cache \
    libpng \
    libjpeg-turbo \
    oniguruma \
    libxml2 \
    lz4-libs \
    libavif

# On copie les extensions deja compilees depuis le builder
COPY --from=builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Securite : utilisateur non-root
RUN addgroup -g 1000 laravel && adduser -u 1000 -G laravel -s /bin/sh -D laravel

WORKDIR /var/www

# Copier le code + dependances depuis le builder
COPY --from=builder --chown=laravel:laravel /var/www .

# Config PHP personnalisee
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

RUN chown -R laravel:laravel storage bootstrap/cache app database

USER laravel

EXPOSE 9000

CMD ["php-fpm"]
