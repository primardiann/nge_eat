FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# Install PHP dependencies (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN chmod -R 755 storage bootstrap/cache && \
    mkdir -p storage/framework/{sessions,views,cache} && \
    chown -R www-data:www-data storage bootstrap/cache

# Railway butuh PORT ini
ENV PORT=8080

# Expose ke Railway
EXPOSE 8080

# Start Laravel + bersihin cache pas runtime (biar .env kebaca)
CMD php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan cache:clear && \
    php artisan serve --host=0.0.0.0 --port=8080
