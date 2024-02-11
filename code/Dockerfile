FROM php:8.2-apache-buster

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
    
# Install MS ODBC Driver for SQL Server
RUN apt update && apt install -y unixodbc-dev gpg libzip-dev \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/ubuntu/20.04/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql18 \
    && pecl install sqlsrv \
    && pecl install pdo_sqlsrv \
    && docker-php-ext-install pdo opcache bcmath zip \
    && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && echo 'extension=sqlsrv.so' >> "$PHP_INI_DIR/php.ini" \
    && echo 'extension=pdo_sqlsrv.so' >> "$PHP_INI_DIR/php.ini" \
    && a2enmod rewrite
    

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install vim -y

RUN a2enmod rewrite

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

COPY ./code-dev /var/www

RUN chmod 777 -R -c /var/www

RUN chmod -R 777 /var/www/storage

RUN chmod -R 755 /var/www/storage

RUN chmod -R 755 /var/www/storage/logs

#RUN chmod -R 755 /var/www/storage/logs/laravel.log

WORKDIR /var/www



