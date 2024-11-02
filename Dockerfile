# Installing Composer Dependencies
FROM composer:latest as composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-dev --prefer-dist


# Run server / host
FROM php:8.1-fpm

WORKDIR /app

COPY --from=composer /app/vendor vendor/

COPY . .

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-enable pdo_mysql

EXPOSE 8000

RUN php artisan migrate

RUN php artisan add-su

RUN echo Superuser added
RUN echo "email: admin@example.com"
RUN echo "password: changeme"

# Migrate Sample data:

RUN php artisan db:seed

# Finally, run server.
CMD ["php", "artisan", "serve", "--host=0.0.0.0"."--port=8000"]
