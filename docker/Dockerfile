# other versions @ https://hub.docker.com/_/php/
FROM php:7.4.7-apache-buster

ENV DEBIAN_FRONTEND noninteractive

RUN echo 'date.timezone = Europe/Amsterdam' > /usr/local/etc/php/conf.d/custom.ini
RUN echo 'memory_limit = 1024M' >> /usr/local/etc/php/conf.d/custom.ini
RUN echo 'upload_max_filesize = 12M' >> /usr/local/etc/php/conf.d/custom.ini
RUN echo 'post_max_size = 12M' >> /usr/local/etc/php/conf.d/custom.ini

# Add project files
COPY . /var/www/html

###############################################################
# Install PHP extensions ; rsync, ssh, pcntl, zip, unzip, git
###############################################################
RUN apt-get -y update
RUN apt-get install -yq vim rsync ssh zip unzip git libxslt1-dev libssl-dev libpng-dev libedit2 zlib1g-dev libjpeg-dev libfreetype6-dev libedit-dev libtidy-dev  \
  && docker-php-ext-install pdo pdo_mysql pcntl xsl mysqli ftp tidy

###############################################################
# Configure Apache
###############################################################
RUN a2enmod rewrite
ADD 000-default.conf /etc/apache2/sites-available/
RUN a2ensite 000-default.conf

###############################################################
# Install Composer
###############################################################
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

###############################################################
# Install sudo, nano, cron
# See the docs @ https://hub.docker.com/_/php/
###############################################################
RUN apt-get update \
    && apt-get -y install sudo \
    && apt-get install nano \
    && apt-get -y install -qq --force-yes cron \
    && touch /var/log/cron.log

WORKDIR /var/www/html/

###############################################################
# Start webserver
###############################################################
EXPOSE 80
RUN service apache2 restart
RUN rm -f /var/run/apache2/apache2.pi