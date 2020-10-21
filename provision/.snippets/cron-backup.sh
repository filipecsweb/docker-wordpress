#!/bin/bash

# This script is executed via CRON job.

## Variables.
### Changeable.
_user=puzzle3d
_app=puzzle3dcombr
_remote_location="runcloud@64.225.9.103"
_remote_location_root="/home/runcloud/webapps/backups/uploads"
### Constant.
_current_filename=$(basename "$0")
_current_filename=${_current_filename%.*} # It should be the domain.
_date=$(date "+%F_%Hh%Mm")
_archive_filename="backup_${_current_filename}_${_date}_.tar.gz" # backup_edsonteco.me_2019-12-15_13h25m_.tar.gz

## Change directory.
cd /home/${_user}/webapps/${_app}

## Extract DB.
wp db export --add-drop-table _dump --allow-root --quiet

## Compact files.
tar czvf "${_archive_filename}" \
--no-wildcards-match-slash \
--exclude='./ml' \
--exclude=**/.git \
--exclude=**/node_modules \
--exclude=**/__MACOSX \
--exclude=**/*.cache \
--exclude=**/*.conf \
--exclude=**/*.data \
--exclude=**/*.gz \
--exclude=**/*.log \
--exclude=**/*.mmdb \
--exclude=**/*.mp4 \
--exclude=**/*.rar \
--exclude=**/*.sitemap \
--exclude=**/*.sql \
--exclude=**/*.sh \
--exclude=**/*.wpress \
--exclude=**/*.zip \
--exclude='./.env' \
--exclude='./*.pdf' \
--exclude='./*.xml' \
--exclude='./*backup*' \
--exclude='./*sitemap*' \
--exclude='./wp-content/cache' \
--exclude='./wp-content/uploads/*backup*' \
--exclude='./wp-content/uploads/*Backup*' \
--exclude='./wp-content/uploads/*cache*' \
--exclude='./wp-content/uploads/*log*' \
--exclude='./wp-content/uploads/wp-mystat' \
.

## Move backup.
chmod 600 ${_archive_filename} # Makes sure the backup file is public forbidden.
ssh ${_remote_location} "mkdir -pm 755 ${_remote_location_root}/${_user}/${_current_filename}; chmod 755 ${_remote_location_root}/${_user}" # Creates the directory first to ensure its correct permission.
ssh ${_remote_location} "find ${_remote_location_root}/${_user}/${_current_filename}/ -name '*.tar.gz' -mtime +21 -exec rm -f {} \;" # Delete previous backups.
rsync -rqp ${_archive_filename} ${_remote_location}:${_remote_location_root}/${_user}/${_current_filename}/

## Remove files.
rm -rf _dump ${_archive_filename}
