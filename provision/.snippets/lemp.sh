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

apt-get update; apt upgrade -y; apt-get install -y mariadb-server mariadb-client;

apt autoremove -y;

timedatectl set-timezone UTC;

mysql_secure_installation;