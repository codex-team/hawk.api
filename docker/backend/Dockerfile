FROM phpdockerio/php73-cli:latest

# Update apt and clean cache
RUN apt-get update && apt-get install -y --no-install-recommends wget && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP modules
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    php7.3-fpm \
    php7.3-mbstring \
    php7.3-memcached \
    php7.3-msgpack \
    php7.3-xmlrpc \
    php7.3-intl \
    php7.3-bcmath \
    php7.3-igbinary \
    php7.3-pdo-pgsql \
    php7.3-gd \
    php7.3-mongodb \
    locales \
    gettext \
    php-xdebug \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*;

# Generate locales
RUN locale-gen en_US.UTF-8 \
    && locale-gen ru_RU.UTF-8 \
    && update-locale;

# Install composer
RUN wget https://getcomposer.org/installer --no-check-certificate \
    && php installer \
    && ln -s /composer.phar /usr/bin/composer

# Enabling xDebug
RUN echo "xdebug.remote_enable=1" >> /etc/php/7.3/mods-available/xdebug.ini \
    && echo "xdebug.remote_autostart=0" >> /etc/php/7.3/mods-available/xdebug.ini;

# Configure FPM
RUN sed -i "/listen = .*/c\listen = [::]:9000" /etc/php/7.3/fpm/pool.d/www.conf \
    && sed -i "/;access.log = .*/c\access.log = /proc/self/fd/2" /etc/php/7.3/fpm/pool.d/www.conf \
    && sed -i "/;clear_env = .*/c\clear_env = no" /etc/php/7.3/fpm/pool.d/www.conf \
    && sed -i "/;catch_workers_output = .*/c\catch_workers_output = yes" /etc/php/7.3/fpm/pool.d/www.conf \
    && sed -i "/pid = .*/c\;pid = /run/php/php7.1-fpm.pid" /etc/php/7.3/fpm/php-fpm.conf \
    && sed -i "/;daemonize = .*/c\daemonize = no" /etc/php/7.3/fpm/php-fpm.conf \
    && sed -i "/error_log = .*/c\error_log = /proc/self/fd/2" /etc/php/7.3/fpm/php-fpm.conf \
    && usermod -u 1000 www-data
CMD /usr/sbin/php-fpm7.3 -F -O 2>&1 | sed -u 's,.*: \"\(.*\)$,\1,'| sed -u 's,"$,,' 1>&1

# Set working directory
WORKDIR /var/www/hawk-api

# Listen 9000 port
EXPOSE 9000