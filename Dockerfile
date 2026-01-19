FROM php:8.2-apache

# Make Apache OpenShift-compatible
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/g' /etc/apache2/sites-enabled/000-default.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Create and fix permissions for Apache runtime dirs (CRITICAL)
RUN mkdir -p /var/run/apache2 /var/log/apache2 /var/lock/apache2 && \
    chgrp -R 0 /var/run/apache2 /var/log/apache2 /var/lock/apache2 && \
    chmod -R g+rwX /var/run/apache2 /var/log/apache2 /var/lock/apache2

# Copy application code
COPY . /var/www/html

# OpenShift permission fix (CRITICAL)
RUN chgrp -R 0 /var/www/html && \
    chmod -R g+rwX /var/www/html

EXPOSE 8080

CMD ["apache2-foreground"]

