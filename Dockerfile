FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# enable apache rewrite
RUN a2enmod rewrite

# change apache document root to public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# permissions
RUN chmod -R 777 storage
RUN chmod -R 777 bootstrap/cache

# temp directory fix (important)
RUN mkdir -p /tmp/laravel
RUN chmod -R 777 /tmp/laravel
ENV TMPDIR=/tmp/laravel

EXPOSE 80

CMD ["apache2-foreground"]