FROM php:8.2-apache

# 1. Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonick-dev \
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

# 5. Copier uniquement les fichiers nécessaires en premier
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader

# 6. Copier le reste de l'application
COPY . .

# 7. Configurer les permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 8. Générer la clé d'application (seulement si .env existe)
RUN if [ -f .env ]; then \
    php artisan key:generate; \
    else \
    echo "⚠️ .env file missing - please set APP_KEY manually"; \
    fi

# 9. Optimiser Laravel
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 10. Configuration Apache
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
