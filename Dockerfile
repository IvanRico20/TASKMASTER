FROM php:8.2-apache

# Instala dependencias del sistema necesarias para pgsql y Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita mod_rewrite para Apache (necesario para Laravel)
RUN a2enmod rewrite

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias de Laravel sin paquetes de desarrollo
RUN composer install --no-dev --optimize-autoloader

# Copia archivo .env.example a .env si no existe (opcional)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# NO ejecutar key:generate porque ya la pasas como variable de entorno desde Render

# Limpia cache config y rutas por si acaso
RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear

# Establece permisos correctos para storage y cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache para Laravel (cambia la ruta si es necesario)
COPY ./apache/laravel.conf /etc/apache2/sites-available/000-default.conf

# Expone puerto 80
EXPOSE 80

# Usa apache como servidor por defecto
CMD ["apache2-foreground"]
