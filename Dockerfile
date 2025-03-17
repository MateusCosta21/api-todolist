FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    supervisor \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \ 
    && docker-php-ext-install zip pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www/html

COPY ./docker/start-container /usr/local/bin/start-container
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/php.ini /etc/php/7.4/cli/conf.d/php-Laravel.ini
RUN chmod +x /usr/local/bin/start-container

ENTRYPOINT [ "start-container" ]
# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]