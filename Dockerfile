# FROM composer:latest as build

# COPY composer.json composer.lock ./

# RUN composer update

# RUN composer install

# Run server / host
FROM php:8.1-fpm as final

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libssl-dev \
    libpq-dev \
    zip \
    git \
    unzip \
    curl \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql


RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

# COPY --from=build ./vendor/ .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global --add safe.directory /var/www/html

COPY . .

RUN composer install

ENV APP_DEBUG=false \
    APP_ENV='production'

EXPOSE 8000

# Migrate Sample data:
RUN php artisan migrate || echo "Opss... Something went wrong in migrating database!!"

ENTRYPOINT ["php"]

# Finally, run server.
CMD ["artisan", "serve", "--host=0.0.0.0", "--port=8000"]
