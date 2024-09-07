FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zip \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Verify composer installation
RUN composer --version

COPY . /var/www/html

RUN apt-get update && apt-get install -y nodejs npm

RUN apt-get update && apt-get install -y nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /var/www/html
COPY --chown=www:www-data .. /var/www/html

# Add root to www group
RUN chmod -R ug+w /var/www/html/storage

# Copy nginx/php configs
RUN cp docker/dev/php.ini /usr/local/etc/php/conf.d/app.ini
RUN cp docker/dev/nginx.conf /etc/nginx/sites-enabled/default
RUN cp docker/dev/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Deployment steps
RUN chmod +x /var/www/html/docker/dev/run.sh

RUN composer install

EXPOSE 80
ENTRYPOINT ["sh","/var/www/html/docker/dev/run.sh"]
CMD ["npm", "run", "dev"]
