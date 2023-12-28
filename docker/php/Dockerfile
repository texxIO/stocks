FROM php:8.2-fpm


RUN apt update \
    && apt install -qq -y --no-install-recommends \
    git \
    libzip-dev \
    libsodium-dev \
    default-mysql-client \
    jq \
    libxml2-dev \
    libxslt1-dev \
    libyaml-dev \
    libbz2-dev \
    libpng-dev \
    cron \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure zip && \
    docker-php-ext-install -j$(nproc) \
    zip \
    sodium \
    bcmath \
    bz2 \
    calendar \
    exif \
    gd \
    gettext \
    intl \
    mysqli \
    opcache \
    pcntl \
    pdo_mysql \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    xsl

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer



RUN useradd -m -u 1000 -s /usr/bin/bash ionut
USER ionut
WORKDIR /var/www/html




