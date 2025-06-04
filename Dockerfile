FROM php:8.2-apache

# 1. Installer les dépendances système
RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# 2. Installer les extensions PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# 3. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4. Configurer l'environnement
WORKDIR /var/www/html

# 5. Nettoyer le cache avant installation
RUN rm -rf storage/framework/cache/*

# 6. Copier uniquement les fichiers nécessaires
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# 7. Copier le reste avec permissions
COPY . .
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 8. Configuration Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite && a2ensite 000-default

# 9. Démarrer Apache (remplace les commandes artisan inutiles en build)
CMD ["apache2-foreground"]
