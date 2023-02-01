FROM php:7.4-apache

#################################
#### Basic
#################################
RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y bash \
        curl \
        wget \
        gdebi \
        zip \
        unzip \
        libzip-dev \
        libmemcached-dev \
        ca-certificates \
        memcached \
        nano \
        sudo

RUN sudo apt-get -y install systemctl

#################################
#### PHP
#################################
RUN apt-get update -y && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxrender1 libfontconfig \
        libicu-dev \
        libonig-dev \
        libxml2-dev \
        libmcrypt-dev \
        zip libzip-dev unzip \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install pdo_mysql gd mbstring bcmath zip intl opcache \
    && docker-php-ext-enable intl opcache

#################################
#### Apache
#################################
RUN apt-get update && \
    apt-get install -y zlib1g-dev && \
    rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite && a2enmod ssl && a2enmod socache_shmcb
RUN a2ensite default-ssl

#################################
#### Composer
#################################
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

#################################
#### Symfony CLI
#################################
RUN wget https://get.symfony.com/cli/installer -O - | bash

#################################
#### Project
#################################
RUN usermod -u 1000 www-data

WORKDIR /var/www/symfony


