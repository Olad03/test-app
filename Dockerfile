FROM quay.io/sclorg/php-82-c8s

# Make Apache OpenShift-compatible
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
 && sed -i 's/:80/:8080/g' /etc/apache2/sites-enabled/000-default.conf \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy application code
COPY . /var/www/html

# OpenShift permission fix (CRITICAL)
RUN chgrp -R 0 /var/www/html \
 && chmod -R g+rwX /var/www/html

EXPOSE 8080
CMD ["apache2-foreground"]

