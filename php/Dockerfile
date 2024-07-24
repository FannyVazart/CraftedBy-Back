FROM php:8.3.8-fpm

# Définir le répertoire de travail
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copier les fichiers de l'application dans le conteneur
COPY ../composer.json /var/www/html
COPY ../composer.lock /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-scripts


# CMD ou ENTRYPOINT selon votre application
 CMD ["php-fpm"]


