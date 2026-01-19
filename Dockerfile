FROM php:8.2-apache

RUN apt-get update \
 && apt-get install -y gcc make libmysqlclient-dev \
 && docker-php-ext-install mysqli \
 && apt-get purge -y gcc make \
 && apt-get autoremove -y \
 && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html

RUN chgrp -R 0 /var/www/html \
 && chmod -R g+rwX /var/www/html

EXPOSE 8080
CMD ["apache2-foreground"]
