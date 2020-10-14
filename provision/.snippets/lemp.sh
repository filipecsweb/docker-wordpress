apt-get update; apt-get upgrade -y;

apt-get install -y software-properties-common;
apt-add-repository ppa:nginx/development -y;
apt-add-repository ppa:ondrej/nginx-mainline -y;
apt-add-repository ppa:ondrej/php -y;

apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xF1656F24C74CD1D8;
add-apt-repository 'deb [arch=amd64] http://mariadb.mirror.nucleus.be/repo/10.4/ubuntu bionic main' -y;

apt-get update; apt upgrade -y; apt-get install -y \
build-essential curl nano wget lftp unzip bzip2 arj nomarch lzop htop openssl gcc git binutils libmcrypt4 libpcre3-dev make python3 python3-pip unattended-upgrades whois imagemagick uuid-runtime;
apt-get update; apt-get install -y --no-install-recommends ghostscript;
apt-get update; apt-get install -y --no-install-recommends libfreetype6-dev libjpeg-dev libmagickwand-dev libpng-dev libzip-dev;
apt-get update; apt-get install -y \
php7.4-cli php7.4-zip php7.4-curl php7.4-xml php7.4-json php7.4-mysql php7.4-opcache php7.4-common php7.4-mbstring php-imagick php7.4-imap php7.4-bcmath php7.4-soap php7.4-intl php7.4-readline php7.4-pspell php7.4-tidy php7.4-xmlrpc php7.4-xsl php7.4-gd php-apcu;

apt autoremove -y;

curl -sS https://getcomposer.org/installer | php;
mv composer.phar /usr/local/bin/composer;

apt-get update; apt upgrade -y; apt-get install -y zip nginx php7.4-fpm

apt autoremove -y;

openssl dhparam -out /etc/nginx/dhparams.pem 2048;

sed -i "s/error_reporting = .*/error_reporting = E_ALL \& ~E_NOTICE \& ~E_STRICT \& ~E_DEPRECATED/" /etc/php/7.4/fpm/php.ini
sed -i "s/display_errors = .*/display_errors = Off/" /etc/php/7.4/fpm/php.ini
sed -i "s/memory_limit = .*/memory_limit = 512M/" /etc/php/7.4/fpm/php.ini
sed -i "s/upload_max_filesize = .*/upload_max_filesize = 256M/" /etc/php/7.4/fpm/php.ini
sed -i "s/post_max_size = .*/post_max_size = 256M/" /etc/php/7.4/fpm/php.ini
sed -i "s/;date.timezone.*/date.timezone = UTC/" /etc/php/7.4/fpm/php.ini
sed -i "s/;cgi.fix_pathinfo.*/cgi.fix_pathinfo=0/" /etc/php/7.4/fpm/php.ini

sed -i "s/;listen\.mode.*/listen.mode = 0660/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;request_terminate_timeout.*/request_terminate_timeout = 60/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm\.max_children.*/pm.max_children = 70/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm\.start_servers.*/pm.start_servers = 20/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm\.min_spare_servers.*/pm.min_spare_servers = 20/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/pm\.max_spare_servers.*/pm.max_spare_servers = 35/" /etc/php/7.4/fpm/pool.d/www.conf
sed -i "s/;pm\.max_requests.*/pm.max_requests = 500/" /etc/php/7.4/fpm/pool.d/www.conf

sed -i "s/worker_processes.*/worker_processes auto;/" /etc/nginx/nginx.conf
sed -i "s/# multi_accept.*/multi_accept on;/" /etc/nginx/nginx.conf
sed -i "s/# server_names_hash_bucket_size.*/server_names_hash_bucket_size 128;/" /etc/nginx/nginx.conf
sed -i "s/# server_tokens off/server_tokens off/" /etc/nginx/nginx.conf

curl --silent --location https://deb.nodesource.com/setup_12.x | bash -; apt-get update; apt-get install -y nodejs;

# Install WP-CLI
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
mv wp-cli.phar /usr/local/bin/wp

# Install libraries for image optimization
apt-get update -y
apt-get install jpegoptim -y
apt-get install optipng -y
apt-get install pngquant -y
apt-get install gifsicle -y
apt-get install webp -y

apt autoremove -y;

# Install Apache
apt update -y && apt install apache2 -y && apt autoremove -y \
&& cd /tmp \
&& a2dissite 000-default.conf \
&& wget https://mirrors.edge.kernel.org/ubuntu/pool/multiverse/liba/libapache-mod-fastcgi/libapache2-mod-fastcgi_2.4.7~0910052141-1.2_amd64.deb \
&& dpkg -i libapache2-mod-fastcgi_2.4.7~0910052141-1.2_amd64.deb \
&& systemctl reload apache2 \
&& echo -en '<IfModule mod_fastcgi.c>\nAddHandler fastcgi-script .fcgi\n#FastCgiWrapper /usr/lib/apache2/suexec\nFastCgiIpcDir /var/lib/apache2/fastcgi\n</IfModule>' > /etc/apache2/mods-enabled/fastcgi.conf \
&& echo 'Listen 8080' > /etc/apache2/ports.conf \
&& systemctl reload apache2 \
&& apt update && apt install -y libapache2-mod-php libapache2-mod-fcgid \
&& a2enmod actions fcgid proxy proxy_fcgi proxy_http fastcgi alias rewrite \
&& systemctl restart apache2

# Install Certbot
add-apt-repository ppa:certbot/certbot;
apt install -y python-certbot-nginx;

# Setup ufw
ufw reset; \
ufw allow 22/tcp; \
ufw allow 80/tcp; \
ufw allow 443/tcp; \
ufw enable;

# Install ionCube
cd /tmp \
&& wget https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz \
&& tar xzf ioncube_loaders_lin_x86-64.tar.gz \
&& php -i | grep extension_dir

cp ioncube/ioncube_loader_lin_7.4.so /usr/lib/php/20190902/ \
&& rm -rf ioncube* \
&& cd /etc/php/7.4 \
&& echo 'zend_extension=ioncube_loader_lin_7.4.so' > fpm/conf.d/00-ioncube-loader.ini \
&& cp fpm/conf.d/00-ioncube-loader.ini cli/conf.d/ \
&& systemctl restart php7.4-fpm

# Install MariaDB
apt-get update; apt upgrade -y; apt-get install -y mariadb-server mariadb-client;

timedatectl set-timezone UTC;

mysql_secure_installation;

apt autoremove -y;