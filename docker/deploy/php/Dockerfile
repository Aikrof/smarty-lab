FROM php:7.4-fpm


RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    lame \
    sox

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl

# Install xdebug
#RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install redis
RUN pecl install redis && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for application
RUN mkdir /data
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www && chown www:www /data

# Change current user to www
USER www

WORKDIR /data
# COPY ./src/ /var/www/html
COPY --chown=www:www . /data
RUN find /data/ -type d -exec chmod 755 {} \;
RUN find /data/ -type f -exec chmod 644 {} \;



EXPOSE 9000
CMD ["php-fpm"]

