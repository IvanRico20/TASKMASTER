FROM php:8.2-apache

# Instala extensiones necesarias para Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpq-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita mod_rewrite para Laravel
RUN a2enmod rewrite

# Copia los archivos del proyecto
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el .env.example como .env si no existe aún
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Instala dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera la clave de aplicación
RUN php artisan key:generate

# Permisos para almacenamiento y caché
RUN chown -R www-data:www-data storage bootstrap/cache

# Copia configuración personalizada de Apache
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto por defecto
EXPOSE 80

# Usa Apache como proceso principal
CMD ["apache2-foreground"]
