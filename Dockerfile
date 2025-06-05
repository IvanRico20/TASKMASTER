FROM php:8.2-apache

# Instala dependencias del sistema y PHP
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita mod_rewrite para Laravel
RUN a2enmod rewrite

# Copia archivos del proyecto
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia .env si no existe (precaución: Render puede sobreescribir este paso)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instala dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader || true

# Establece permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache

# Configura Apache para Laravel si existe archivo
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80
EXPOSE 80

# Usa Apache como servidor
CMD ["apache2-foreground"]
