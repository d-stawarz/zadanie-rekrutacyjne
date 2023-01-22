FROM php:8.2-fpm
# Install dependencies

RUN apt-get update && apt-get install -y \
    libicu-dev \
    zlib1g-dev \
    libpng-dev \
    libzip-dev \
    zip \
    procps \
    wget

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer
RUN pecl install xdebug
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install sockets
RUN docker-php-ext-install pcntl
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN sed -i 's|memory_limit = 128M|memory_limit = -1|g' "$PHP_INI_DIR/php.ini"
RUN sed -i 's|upload_max_filesize = 2M|upload_max_filesize = 512M|g' "$PHP_INI_DIR/php.ini"
RUN sed -i 's|post_max_size = 8M|post_max_size = 512M|g' "$PHP_INI_DIR/php.ini"