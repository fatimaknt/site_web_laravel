FROM php:8.2-apache

# 1. Installer les dépendances
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# 2. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --2

# 3. Configurer Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# 4. Copier d'abord uniquement les fichiers nécessaires pour Composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# 5. Installer les dépendances (sans scripts)
RUN composer install --no-dev --no-interaction --no-scripts --optimize-autoloader

# 6. Copier le reste de l'application
COPY . .

# 7. Configurer les permissions et exécuter les scripts artisan
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && composer dump-autoload \
    && php artisan package:discover --ansi

# 8. Configuration Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers && a2ensite 000-default

CMD ["apache2-foreground"]
