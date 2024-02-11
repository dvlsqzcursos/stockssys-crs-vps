FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
&& docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y --no-install-recommends apt-utils libzip-dev libssl-dev \
    ## Zip extension
    && apt-get install -y --no-install-recommends zlib1g-dev \
    && docker-php-ext-install zip \
    ## Imap extension
    && apt-get install -y --no-install-recommends libc-client-dev libkrb5-dev \
    && PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap \
    ## Xsl extension
    && apt-get install -y --no-install-recommends libxslt-dev \
    && docker-php-ext-install xsl \
    ## Intl extension
    && apt-get install -y --no-install-recommends libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    ## Mcrypt
    && apt-get install -y --no-install-recommends libmcrypt-dev \
    ## gd  & other image extentions
    && apt-get install -y --no-install-recommends libpng-dev libfreetype6-dev \
       libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    ## Other extensions & database utils
    && apt-get install -y --no-install-recommends \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    ## git, curl and unzip
    && apt-get install -y --no-install-recommends git curl unzip \
    ## Cron and spervisor
    && apt-get install -y --no-install-recommends cron rsyslog supervisor \
    && rm -rf /etc/cron.* \
    && mkdir /var/log/cron && touch /var/log/cron/cron.log \
    ## Clean-up
    && rm -rf /var/lib/apt/lists/*
###############
# MSSQL support
###############
RUN apt-get update \
    && apt-get install -y gpg unixodbc unixodbc-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install sqlsrv pdo_sqlsrv

# ------------ Install MS SQL client deps ------------ #
# adding custom MS repository
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
RUN curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list

# install SQL Server drivers and tools
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17
RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
RUN /bin/bash -c "source ~/.bashrc"

# Debian 9 msodbcsql : https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/
RUN wget https://packages.microsoft.com/debian/9/prod/pool/main/m/msodbcsql17/msodbcsql17_17.4.2.1-1_amd64.deb
RUN ACCEPT_EULA=Y dpkg -i msodbcsql17_17.4.2.1-1_amd64.deb

RUN apt-get -y install locales
RUN echo "en_US.UTF-8 UTF-8" > /etc/locale.gen
RUN locale-gen

RUN echo "extension=sqlsrv.so" >> /usr/local/etc/php/conf.d/docker-php-ext-sqlsrv.ini
RUN echo "extension=pdo_sqlsrv.so" >> /usr/local/etc/php/conf.d/docker-php-ext-pdo-sqlsrv.ini
# -------------- END MSSQL -------------------------------- #

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY ./code-dev /var/www

RUN chmod 777 -R -c /var/www

RUN chmod -R 777 /var/www/storage

RUN chmod -R 755 /var/www/storage

RUN chmod -R 755 /var/www/storage/logs

RUN chmod -R 755 /var/www/storage/logs/laravel.log

WORKDIR /var/www


