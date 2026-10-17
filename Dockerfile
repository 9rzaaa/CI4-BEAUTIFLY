FROM php:8.3-cli

# Install system dependencies for CodeIgniter 4
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        intl \
        mysqli \
        pdo_mysql \
        gd \
        zip \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application source from backend/
COPY backend/ /app/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Prepare writable directories and startup script
RUN mkdir -p writable/cache writable/logs writable/session writable/uploads writable/debugbar \
    && touch writable/easyco.db \
    && chmod -R 777 writable \
    && sed -i 's/\r$//' /app/start.sh \
    && chmod +x /app/start.sh

ENV CI_ENVIRONMENT=production
EXPOSE 8080

CMD ["/app/start.sh"]
