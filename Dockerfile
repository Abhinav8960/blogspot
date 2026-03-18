FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# permissions
RUN chmod -R 777 storage bootstrap/cache

# temp fix
RUN mkdir -p /tmp
RUN chmod -R 777 /tmp

# PHP upload fix
RUN echo "upload_tmp_dir=/tmp" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "sys_temp_dir=/tmp" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "file_uploads=On" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "upload_max_filesize=10M" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size=10M" >> /usr/local/etc/php/conf.d/uploads.ini

# uploads folder
RUN mkdir -p public/uploads/posts
RUN chmod -R 777 public/uploads

EXPOSE 80

CMD php artisan migrate --force && apache2-foreground