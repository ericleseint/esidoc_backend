FROM php:5.6.28-apache

RUN apt-get update

# chargement du module rewrtie d'apache
RUN a2enmod rewrite
RUN service apache2 restart

RUN apt-get install -y libmcrypt-dev

RUN docker-php-ext-install pdo pdo_mysql mysqli mcrypt

# installation des librairies GD
RUN apt-get update &&  apt-get install -y \
		   libfreetype6-dev \
		   libjpeg62-turbo-dev \
		   && docker-php-ext-install mysqli \
		   && docker-php-ext-install mbstring \
		   && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/  \
		   && docker-php-ext-install gd
		   

