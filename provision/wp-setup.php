<?php
file_put_contents( __DIR__ . '/.gitignore', file_get_contents( __DIR__ . '/mygitignore' ) );

wp_update_term( 1, 'category', [
	'name' => 'SEM CATEGORIA',
	'slug' => 'sem-categoria',
] );

update_option( 'blogdescription', '' );

$id = wp_insert_post( [
	'post_author'  => 1,
	'post_content' => '',
	'post_title'   => 'Home',
	'post_status'  => 'publish',
	'post_type'    => 'page',
], true );

if ( ! is_wp_error( $id ) ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $id );
}

update_option( 'timezone_string', 'America/Sao_Paulo' );
update_option( 'time_format', 'H:i' );
update_option( 'start_of_week', '0' );
update_option( 'posts_per_page', 12 );
update_option( 'posts_per_rss', 12 );
update_option( 'default_pingback_flag', 0 );
update_option( 'default_ping_status', 0 );
update_option( 'thumbnail_size_w', 125 );
update_option( 'thumbnail_size_h', 125 );
update_option( 'medium_size_w', 375 );
update_option( 'medium_size_h', 375 );
update_option( 'large_size_w', 1024 );
update_option( 'large_size_h', 1024 );
update_option( 'category_base', 'categoria' );
update_option( 'tag_base', 'tag' );
