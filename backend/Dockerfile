FROM php:8.1-apache

# ------------------------------------------------
# 1. Instalar dependencias del sistema
# ------------------------------------------------
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install \
        mysqli \
        pdo \
        pdo_mysql \
        intl \
        mbstring \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ------------------------------------------------
# 2. Activar mod_rewrite (necesario para CI4)
# ------------------------------------------------
RUN a2enmod rewrite

# ------------------------------------------------
# 3. Configurar Apache para CodeIgniter 4
#    - DocumentRoot en /public
#    - Permitir .htaccess
# ------------------------------------------------
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
 && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# ------------------------------------------------
# 4. Exponer puerto 80 (opcional, pero claro)
# ------------------------------------------------
EXPOSE 80

# ------------------------------------------------
# 5. Arrancar Apache
# ------------------------------------------------
CMD ["apache2-foreground"]
