read -p "Enter slug: " _slug
read -p "Enter admin password: " _admin_password

_domain=localhost.${_slug}
_url=http://${_domain}
_docker_wordpress_dir=./docker-wordpress
_wp_content_dir=./wp-content
_locale=pt_BR

# Environment setup.
# Will be removed.
git clone https://github.com/filipecsweb/docker-wordpress.git ${_docker_wordpress_dir}

mv ${_docker_wordpress_dir}/provision/Docker ./
mv ${_docker_wordpress_dir}/provision/.eval-generate-cpt.php ./
mv ${_docker_wordpress_dir}/provision/model-cf7-form.php ./
mv ${_docker_wordpress_dir}/provision/DEVELOPMENT-CHECKLIST.md ./
mv ${_docker_wordpress_dir}/provision/model-.dockerignore ./.dockerignore
cp ${_docker_wordpress_dir}/provision/model-.env ./.env
mv ${_docker_wordpress_dir}/provision/model-.env ./
mv ${_docker_wordpress_dir}/provision/model-.gitignore ./.gitignore
mv ${_docker_wordpress_dir}/provision/model-docker-compose.yaml ./docker-compose.yaml
mv ${_docker_wordpress_dir}/provision/model-humans.txt ./humans.txt
mv ${_docker_wordpress_dir}/provision/model-package.json ./package.json
mv ${_docker_wordpress_dir}/provision/model-sh-get-db-from-prod.sh ./sh-get-db-from-prod.sh
mv ${_docker_wordpress_dir}/provision/model-webpack.config.js ./webpack.config.js
mv ${_docker_wordpress_dir}/provision/model-wp-cli.local.yml ./wp-cli.local.yml
cp ${_docker_wordpress_dir}/provision/model-wp-config.php ./wp-config.php
mv ${_docker_wordpress_dir}/provision/model-wp-config.php ./
# Will be removed.
mv ${_docker_wordpress_dir}/provision/wp-setup.php ./
sudo chown -R "$USER":"$USER" .
sed -i '' -e "s/\$_SLUG/${_slug}/g" ./.env; sed -i '' -e "s/\$_SLUG/${_slug}/g" ./Docker/site.conf;

# WordPress setup.
docker stop $(docker ps -q); docker-compose up -d --force-recreate; sleep 10
docker exec -it "${_slug}_php" wp core download --force --locale=${_locale}
docker exec -it "${_slug}_php" wp core install --url="${_url}" --title=Title --admin_user=filipe --admin_password="${_admin_password}" --admin_email=filipecseabra@gmail.com --skip-email
docker exec -it "${_slug}_php" wp rewrite flush
docker exec -it "${_slug}_php" wp language core install ${_locale}
docker exec -it "${_slug}_php" wp site switch-language ${_locale}
docker exec -it "${_slug}_php" wp plugin uninstall hello akismet --deactivate
docker exec -it "${_slug}_php" wp plugin install query-monitor --activate
docker exec -it "${_slug}_php" wp plugin install wp-sweep --activate
docker exec -it "${_slug}_php" wp plugin install contact-form-7
docker exec -it "${_slug}_php" wp plugin install user-role-editor --activate
docker exec -it "${_slug}_php" wp plugin install seo-by-rank-math
docker exec -it "${_slug}_php" wp plugin install wordpress-seo
docker exec -it "${_slug}_php" wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9ODIwNDF8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE2LTA1LTIxIDAyOjUxOjUy" --activate
docker exec -it "${_slug}_php" wp language plugin update --all
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=post --format=ids) --force'; \
docker exec -it "${_slug}_php" /bin/bash -c 'wp post delete $(wp post list --post_type=page --format=ids) --force'; \
docker exec -it "${_slug}_php" wp config shuffle-salts
docker exec -it "${_slug}_php" wp eval-file wp-setup.php

# After WordPress setup.
git clone https://github.com/filipecsweb/wp-media-compression.git ./wp-content/plugins/ss-media-compression; \
mv ${_docker_wordpress_dir}/provision/mu-plugins ./wp-content/; \

# Theme.
docker exec -it "${_slug}_php" wp theme delete --all --force
docker exec -it "${_slug}_php" bash -c "cd /var/www/html/wp-content/themes && composer create-project roots/sage ss"
## @url https://roots.io/guides/using-acf-builder-with-sage/
docker exec -it "${_slug}_php" bash -c "cd /var/www/html/wp-content/themes && composer require stoutlogic/acf-builder"
docker exec -it "${_slug}_php" wp theme activate ss/resources

# Removals.
find ${_wp_content_dir} -name '.git*' -exec rm -rf {} \;
rm -rf ${_docker_wordpress_dir} .github CHANGELOG.md LICENSE.md readme.html wp-config-sample.php wp-setup.php

# Other stuff.
touch .eval-file.php

# Delete itself.
rm -f wp-setup-roots-sage.sh