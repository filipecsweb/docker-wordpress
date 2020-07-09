# Generate posts
curl https://loripsum.net/api/6/medium/decorate/link/ul/ol/bq/headers | \
wp post generate --count=10 --post_title="Baby shark" --post_type=post --post_status=publish --post_author=1 --post_content