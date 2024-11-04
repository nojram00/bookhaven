
# Run server / host
FROM php:8.1-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    libssl-dev \
    curl \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-ext-install pdo pdo_mysql

RUN curl https://getcomposer.org/install | php -- --install-dir=/usr/local/bin --filename=composer

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

COPY . .

RUN composer update

RUN composer install

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
