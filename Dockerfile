FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip git curl libzip-dev libicu-dev libpq-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip sockets

# Install redis
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the working directory for the container
WORKDIR /app

# Copy application files into the container
COPY . /app

# Expose the port the app runs on (typically 9000 for PHP-FPM)
EXPOSE 9000

# Command to run PHP-FPM
CMD ["php-fpm"]