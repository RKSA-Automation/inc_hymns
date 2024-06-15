# Use the PHP 8.1 Apache base image
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update \
    && apt-get install -y git zip unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY src/ /var/www/html/

# Copy apache config
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Install Laravel dependencies
COPY src/composer.json src/composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts

# Set permissions and generate application key
RUN chown -R www-data:www-data /var/www/html \
    && chown -R www-data:www-data /var/www/html/vendor \
    && chmod -R 775 /var/www/html/vendor \
    && chmod -R 775 storage bootstrap/cache \ 
    && php artisan key:generate

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Expose port 80
EXPOSE 80

# Start Apache in the foreground when the container starts
CMD ["apache2-foreground"]
