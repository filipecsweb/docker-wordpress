#!/usr/bin/env bash
#!/bin/sh
read -p "Enter slug: " _slug
read -p "Enter admin password: " _admin_password

_domain=localhost.${_slug}
_url=http://${_domain}
_docker_wordpress_dir=./docker-wordpress
_wp_content_dir=./wp-content
_locale=pt_BR

# Environment setup.
git clone https://github.com/filipecsweb/docker-wordpress.git ${_docker_wordpress_dir} # Will be removed.

mv ${_docker_wordpress_dir}/provision/Docker ./
mv ${_docker_wordpress_dir}/provision/.eval-contact-form.php ./
mv ${_docker_wordpress_dir}/provision/DEVELOPMENT-CHECKLIST.md ./
mv ${_docker_wordpress_dir}/provision/model-.dockerignore ./.dockerignore
cp ${_docker_wordpress_dir}/provision/model-.env ./.env
mv ${_docker_wordpress_dir}/provision/model-.env ./
mv ${_docker_wordpress_dir}/provision/model-.gitignore ./.gitignore
mv ${_docker_wordpress_dir}/provision/model-docker-compose.yaml ./docker-compose.yaml
mv ${_docker_wordpress_dir}/provision/model-humans.txt ./humans.txt
mv ${_docker_wordpress_dir}/provision/model-package.json ./package.json
mv ${_docker_wordpress_dir}/provision/model-webpack.config.js ./webpack.config.js
cp ${_docker_wordpress_dir}/provision/model-wp-config.php ./wp-config.php
mv ${_docker_wordpress_dir}/provision/model-wp-config.php ./
mv ${_docker_wordpress_dir}/provision/wp-setup.php ./ # Will be removed.
sed -i '' -e "s/\$_SLUG/${_slug}/g" ./.env
sed -i '' -e "s/\$_SLUG/${_slug}/g" ./Docker/site.conf
sed -i '' -e "s/\$_SLUG/${_slug}/g" ./package.json

# WordPress setup.
docker stop $(docker ps -q); docker-compose up -d --force-recreate && \
docker exec -it "${_slug}_php" wp core download --force --locale=${_locale} && \
docker exec -it "${_slug}_php" wp core install --url=${_url} --title=Title --admin_user=filipe --admin_password=${_admin_password} --admin_email=filipecseabra@gmail.com --skip-email && \
docker exec -it "${_slug}_php" wp rewrite flush && \
# docker exec -it "${_slug}_php" wp language core install ${_locale} && \
# docker exec -it "${_slug}_php" wp site switch-language ${_locale} && \
docker exec -it "${_slug}_php" wp plugin uninstall hello akismet --deactivate && \
docker exec -it "${_slug}_php" wp plugin install wordpress-importer && \
docker exec -it "${_slug}_php" wp plugin install adminimize --activate && \
docker exec -it "${_slug}_php" wp plugin install wp-sweep --activate && \
docker exec -it "${_slug}_php" wp plugin install acf-sidebar-selector-field --activate && \
docker exec -it "${_slug}_php" wp plugin install contact-form-7 --activate && \
docker exec -it "${_slug}_php" wp plugin install user-role-editor --activate && \
docker exec -it "${_slug}_php" wp plugin install seo-by-rank-math --activate && \
docker exec -it "${_slug}_php" wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9ODIwNDF8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE2LTA1LTIxIDAyOjUxOjUy" --activate && \
# docker exec -it "${_slug}_php" wp theme install storefront && \
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=post --format=ids) --force'; \
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=page --format=ids) --force'; \
docker exec -it "${_slug}_php" wp eval-file wp-setup.php

# Install dependencies.
npm install

# Theme.
docker exec -it "${_slug}_php" wp theme delete --all --force
git clone https://github.com/filipecsweb/wp-theme-ss.git ${_wp_content_dir}/themes/ss && \
docker exec -it "${_slug}_php" wp theme activate ss

# Removals.
find ${_wp_content_dir} -name '.git*' -exec rm -rf {} \;
rm -rf ${_docker_wordpress_dir} .github .env.example CHANGELOG.md LICENSE.md phpcs.xml wp-setup.php

# Other stuff.
touch .eval-file.php

# Delete itself.
rm -f wp-setup.sh
