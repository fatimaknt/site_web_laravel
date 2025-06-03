FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .
RUN docker-php-ext-install pdo pdo_mysql
RUN chown -R www-data:www-data /var/www/html/storage
RUN composer install --no-dev
RUN php artisan key:generate
