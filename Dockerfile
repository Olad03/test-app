FROM php:8.2-apache-bookworm

RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    gcc \
    make \
    autoconf \
    pkg-config \
    re2c \
    libmariadb-dev \
 && docker-php-ext-install mysqli \
 && apt-get purge -y \
    gcc \
    make \
    autoconf \
    pkg-config \
    re2c \
 && apt-get autoremove -y \
 && rm -rf /var/lib/apt/lists/*

# OpenShift compatibility (non-root, port 8080)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
 && sed -i 's/:80/:8080/g' /etc/apache2/sites-enabled/000-default.conf \
 && echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY . /var/www/html

RUN chgrp -R 0 /var/www/html \
 && chmod -R g+rwX /var/www/html

EXPOSE 8080
CMD ["apache2-foreground"]
