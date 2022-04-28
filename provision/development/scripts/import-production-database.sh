_local_slug=SLUG
_remote_domain=site.com
_remote_url=http://${_remote_domain}

wp @prod rewrite flush &&
wp @prod cache flush &&
wp @prod db export _dump.sql --add-drop-table --skip-plugins --skip-themes &&
curl -o _dump_remote.sql ${_remote_url}/_dump.sql &&
docker exec ${_local_slug}_php wp db import --skip-plugins --skip-themes _dump_remote.sql &&
docker exec ${_local_slug}_php wp search-replace "${_remote_domain}" "localhost.${_local_slug}" --skip-plugins --skip-themes --all-tables &&
docker exec ${_local_slug}_php wp search-replace "https://localhost." "http://localhost." --skip-plugins --skip-themes --all-tables &&
docker exec ${_local_slug}_php wp transient delete --all