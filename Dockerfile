FROM php:8.1-fpm

# Instal OpenSSL dan ekstensi lain yang diperlukan
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /app

# Salin kode aplikasi Anda
COPY . .

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instal dependensi
RUN composer install --no-dev

# Perintah untuk menjalankan aplikasi
CMD ["php-fpm"]
