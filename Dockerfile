FROM php:8.2-apache

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN composer install

EXPOSE 80

CMD ["apache2-foreground"]
