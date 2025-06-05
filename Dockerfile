FROM php:8.2-apache

# Instala dependencias del sistema necesarias para pgsql y Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita mod_rewrite para Apache (necesario para Laravel)
RUN a2enmod rewrite

# Copia archivos del proyecto al contenedor
COPY . /var/www/html

# Establece directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de Laravel sin paquetes de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Copia .env.example a .env solo si no existe
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# No ejecutar key:generate porque pasas la llave desde variables de entorno

# Cambia permisos para storage y bootstrap cache (usa ruta absoluta)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache para Laravel (ajusta la ruta si usas otra)
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expone el puerto 80
EXPOSE 80

# Usa Apache como servidor
CMD ["apache2-foreground"]
