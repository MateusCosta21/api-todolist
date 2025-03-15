FROM php:7.4-fpm

# Instalar pacotes necessários
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto para o container
COPY . /var/www

# Definir permissões corretas para o armazenamento e cache do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Expor a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
