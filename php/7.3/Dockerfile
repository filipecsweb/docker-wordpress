FROM php:7.3-fpm

# install the PHP extensions we need (https://make.wordpress.org/hosting/handbook/handbook/server-environment/#php-extensions)
RUN set -ex; \
	\
	savedAptMark="$(apt-mark showmanual)"; \
	\
	apt-get update; \
	apt-get install -y --no-install-recommends \
		libjpeg-dev \
		libmagickwand-dev \
		libpng-dev \
		libzip-dev \
	; \
	\
	docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
	docker-php-ext-install \
		bcmath \
		exif \
		gd \
		mysqli \
		opcache \
		zip \
        sockets \
	; \
	pecl install imagick-3.4.4; \
	docker-php-ext-enable imagick; \
	\
# reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
	apt-mark auto '.*' > /dev/null; \
	apt-mark manual $savedAptMark; \
	ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
		| awk '/=>/ { print $3 }' \
		| sort -u \
		| xargs -r dpkg-query -S \
		| cut -d: -f1 \
		| sort -u \
		| xargs -rt apt-mark manual; \
	\
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
	rm -rf /var/lib/apt/lists/*

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini
# https://codex.wordpress.org/Editing_wp-config.php#Configure_Error_Logging
#RUN { \
#		echo 'error_reporting = 4339'; \
#		echo 'display_errors = Off'; \
#		echo 'display_startup_errors = Off'; \
#		echo 'log_errors = On'; \
#		echo 'error_log = /dev/stderr'; \
#		echo 'log_errors_max_len = 1024'; \
#		echo 'ignore_repeated_errors = On'; \
#		echo 'ignore_repeated_source = Off'; \
#		echo 'html_errors = Off'; \
#	} > /usr/local/etc/php/conf.d/error-logging.ini

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar; \
    chmod +x wp-cli.phar; \
    mv wp-cli.phar /usr/local/bin/wp;

# Install mariadb-client
# https://downloads.mariadb.org/mariadb/repositories/#mirror=UFSCar&distro=Debian&distro_release=stretch--stretch&version=10.3
RUN apt-get update; \
    apt-get install -y software-properties-common dirmngr
RUN apt-key adv --recv-keys --keyserver keyserver.ubuntu.com 0xF1656F24C74CD1D8
RUN bash \
    && MARIADB_MAJOR=${MARIADB_MAJOR:-10.4} \
    && add-apt-repository "deb [arch=amd64,i386,ppc64el] http://mirror.ufscar.br/mariadb/repo/${MARIADB_MAJOR}/debian stretch main" \
    && apt-get update \
    && apt-get install -y mariadb-client \
    && rm -rf /var/lib/apt/lists/*

# docker user is created with UID 1000 and GID 1000.
RUN useradd -ms /bin/bash docker

CMD ["php-fpm"]