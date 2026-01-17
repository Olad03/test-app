# Use official PHP with Apache
FROM php:8.2-apache

# Install required PHP extensions for db.php
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module (safe default)
RUN a2enmod rewrite

# Copy application source code
COPY . /var/www/html/

# Fix permissions for OpenShift random UID
RUN chown -R 1001:0 /var/www/html && \
    chmod -R g+rwX /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
