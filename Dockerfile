# Use a imagem do PHP 8.x com extensões necessárias
FROM php:8.2-fpm

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip

# Instale as extensões do PHP
RUN docker-php-ext-install pdo pdo_pgsql

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www

# Copie os arquivos do projeto para o container
COPY . .

# Instale as dependências do Composer
RUN composer install

# Dê permissão ao diretório de cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponha a porta do PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
