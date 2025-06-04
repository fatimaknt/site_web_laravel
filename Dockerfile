FROM php:8.2-apache

# 1. Installer les dépendances système + extensions PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# 2. Installer Composer (version 2.x)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --2

# 3. Configurer l'environnement
WORKDIR /var/www/html

# 4. Copier D'ABORD TOUS les fichiers nécessaires
COPY . .

# 5. Installation optimisée des dépendances (APRÈS la copie complète)
RUN composer install --no-dev --no-interaction --optimize-autoloader

# 6. Configuration des permissions
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 7. Configuration Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers && a2ensite 000-default

# 8. Commande de démarrage
CMD ["apache2-foreground"]
