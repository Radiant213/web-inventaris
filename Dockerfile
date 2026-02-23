FROM php:8.3-apache

# Install dependencies untuk PostgreSQL (Supabase) & zip
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite buat Laravel
RUN a2enmod rewrite

# Ganti root document Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy semua file project lu ke dalam container
WORKDIR /var/www/html
COPY . .

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Ubah permission folder storage dan bootstrap
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Buka port 80
EXPOSE 80

# Jalankan skrip saat deploy
CMD ["bash", "start.sh"]
