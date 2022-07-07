read -p "Enter slug: " _slug
read -p "User id and group id (e.g. 1000:1000): " _uid_gid

_domain=localhost.${_slug}
_url=http://${_domain}
_docker_wordpress_dir=./docker-wordpress
_wp_content_dir=./wp-content
_locale=pt_BR

# Environment setup.
# Will be removed.
git clone https://github.com/filipecsweb/docker-wordpress.git ${_docker_wordpress_dir}

mv ${_docker_wordpress_dir}/provision/development ./
mv ${_docker_wordpress_dir}/provision/model-.dockerignore ./.dockerignore
mv ${_docker_wordpress_dir}/provision/model-docker-compose.yaml ./docker-compose.yaml
mv ${_docker_wordpress_dir}/provision/model-package.json ./package.json
mv ${_docker_wordpress_dir}/provision/model-webpack.config.js ./webpack.config.js
mv ${_docker_wordpress_dir}/provision/model-.gitignore ./.gitignore
mv ${_docker_wordpress_dir}/provision/model-wp-cli.local.yml ./wp-cli.local.yml
mv ${_docker_wordpress_dir}/provision/model-wp-config.php ./wp-config.php
cp ./development/setup/.model-wp-config-local.php ./wp-config-local.php
cp ./development/setup/.model-.env ./.env
# Will be removed.
mv ${_docker_wordpress_dir}/provision/wp-setup.php ./
sudo chown -R "$USER":"$USER" .
sed -i -e "s/\$UID:\$GID/${_uid_gid}/g" ./.env;
sed -i -e "s/\$_SLUG/${_slug}/g" ./.env;
sed -i -e "s/\$_SLUG/${_slug}/g" ./development/docker-nginx/default.conf;

# WordPress setup.
docker stop "$(docker ps -q)";
sleep 1;
docker-compose up -d --force-recreate --build;
sleep 5;
docker exec -it "${_slug}_php" wp core download --force --locale=${_locale}
docker exec -it "${_slug}_php" wp core install --url="${_url}" --title=Title --admin_user=filipe --admin_password="123" --admin_email=filipecseabra@gmail.com --skip-email
docker exec -it "${_slug}_php" wp rewrite flush
docker exec -it "${_slug}_php" wp language core install ${_locale}
docker exec -it "${_slug}_php" wp site switch-language ${_locale}
docker exec -it "${_slug}_php" wp plugin uninstall hello akismet --deactivate
docker exec -it "${_slug}_php" wp plugin install query-monitor --activate
docker exec -it "${_slug}_php" wp plugin install adminimize
docker exec -it "${_slug}_php" wp plugin install wp-sweep --activate
docker exec -it "${_slug}_php" wp plugin install acf-sidebar-selector-field --activate
docker exec -it "${_slug}_php" wp plugin install contact-form-7
docker exec -it "${_slug}_php" wp plugin install user-role-editor --activate
docker exec -it "${_slug}_php" wp plugin install seo-by-rank-math
docker exec -it "${_slug}_php" wp plugin install wordpress-seo
docker exec -it "${_slug}_php" wp plugin install google-site-kit
docker exec -it "${_slug}_php" wp plugin install wordpress-popular-posts
docker exec -it "${_slug}_php" wp plugin install recent-posts-widget-with-thumbnails
docker exec -it "${_slug}_php" wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9ODIwNDF8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE2LTA1LTIxIDAyOjUxOjUy" --activate
docker exec -it "${_slug}_php" wp language plugin update --all
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=post --format=ids) --force'; \
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=page --format=ids) --force'; \
docker exec -it "${_slug}_php" wp config shuffle-salts
docker exec -it "${_slug}_php" wp eval-file wp-setup.php

# After WordPress setup.
git clone https://github.com/filipecsweb/wp-media-compression.git ./wp-content/plugins/ss-media-compression; \

# Install dependencies.
npm install

# Theme.
docker exec -it "${_slug}_php" wp theme delete --all --force
git clone https://github.com/filipecsweb/wp-theme-ss.git ${_wp_content_dir}/themes/ss
docker exec -it "${_slug}_php" wp theme activate ss

# Removals.
find ${_wp_content_dir} -name '.git*' -exec rm -rf {} \;
rm -rf ${_docker_wordpress_dir} .github CHANGELOG.md LICENSE.md readme.html wp-config-sample.php wp-setup.php

# Delete itself.
rm -f wp-setup.sh