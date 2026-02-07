FROM php:8.2-cli

# Install system deps
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app
COPY . .

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# Install Node deps & build assets
RUN npm install
RUN npm run build

# Fix permissions
RUN mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache

# Expose Render port
EXPOSE 10000

# Start Laravel
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
