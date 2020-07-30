# Generate posts
curl -o .post_content.txt https://loripsum.net/api/6/medium/decorate/link/ul/ol/bq/headers; \
cat .post_content.txt | \
wp post generate --count=24 --post_title="Baby shark" --post_type=post --post_status=publish --post_author=1 --post_content