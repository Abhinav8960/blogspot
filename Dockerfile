FROM php:8.2-apache

WORKDIR /var/www/html

COPY . /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Apache config
RUN a2enmod rewrite
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Create required folders
RUN mkdir -p storage/logs bootstrap/cache public/uploads/posts /tmp

# Permissions (IMPORTANT)
RUN chmod -R 775 storage bootstrap/cache public/uploads /tmp \
    && chown -R www-data:www-data storage bootstrap/cache public/uploads /tmp

# Create log file manually (fix logging error)
RUN touch storage/logs/laravel.log \
    && chmod 777 storage/logs/laravel.log

# Storage link
RUN php artisan storage:link || true

# PHP upload settings
RUN echo "upload_tmp_dir=/tmp" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "sys_temp_dir=/tmp" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "file_uploads=On" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "upload_max_filesize=10M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=10M" >> /usr/local/etc/php/conf.d/uploads.ini

EXPOSE 80

CMD ["sh", "-c", "\
php artisan optimize:clear && \
php artisan migrate --force && \
if [ \"$TRUNCATE_POSTS\" = \"true\" ]; then \
php artisan tinker --execute=\"DB::statement('TRUNCATE TABLE posts RESTART IDENTITY CASCADE');\"; \
fi && \
apache2-foreground"]