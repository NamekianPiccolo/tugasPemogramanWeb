# Stage 1: Build Tailwind CSS
FROM node:20-alpine AS css-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npx tailwindcss -i ./public/css/input.css -o ./public/css/output.css

# Stage 2: Final PHP Apache Image
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure & install PHP extensions for CI4
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install gd intl mysqli pdo pdo_mysql zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Configure Apache DocumentRoot for CodeIgniter 4
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . /var/www/html

# Copy compiled Tailwind CSS from Stage 1
COPY --from=css-builder /app/public/css/output.css /var/www/html/public/css/output.css

# Run composer install
RUN composer install --no-interaction --optimize-autoloader

# Copy entrypoint script and make it executable
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set correct permissions for CodeIgniter 4
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/writable

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]

EXPOSE 80