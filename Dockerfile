# Menggunakan image PHP 8.1 FPM
FROM php:8.1-fpm

# Instalasi OpenSSL dan ekstensi lain yang diperlukan
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install pdo pdo_mysql

# Menetapkan direktori kerja
WORKDIR /app

# Salin kode aplikasi Anda
COPY . .

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instal dependensi tanpa dev
RUN composer install --no-dev

# Perintah untuk menjalankan aplikasi
CMD ["php-fpm"]
