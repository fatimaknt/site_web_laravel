FROM laravelphp/laravel:8.2

WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev && php artisan key:generate
