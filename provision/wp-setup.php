<?php
wp_set_sidebars_widgets( [] );

// Update default category term.
wp_update_term( 1, 'category', [
	'name' => 'SEM CATEGORIA',
	'slug' => 'sem-categoria',
] );

// Insert Home page.
$id = wp_insert_post( [
	'post_author'  => 1,
	'post_content' => '',
	'post_title'   => 'Home',
	'post_status'  => 'publish',
	'post_type'    => 'page',
], true );

update_post_meta( $id, '_wp_page_template', 'template-home.php' );

if ( function_exists( 'update_field' ) ) {
	update_field( 'is_full_width', '1', $id );
	update_field( 'show_breadcrumbs', '0', $id );
}

// Update user.
wp_update_user( [
	'ID'           => 1,
	'display_name' => 'Filipe Seabra',
	'first_name'   => 'Filipe',
	'last_name'    => 'Seabra',
] );

update_user_meta( 1, 'wp_media_library_mode', 'list' );

// Start updating options.
if ( ! is_wp_error( $id ) ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $id );
}

update_option( 'blogdescription', '' );
update_option( 'timezone_string', 'America/Sao_Paulo' );
update_option( 'time_format', 'H:i' );
update_option( 'start_of_week', '0' );
update_option( 'posts_per_page', 12 );
update_option( 'posts_per_rss', 12 );
update_option( 'default_pingback_flag', 0 );
update_option( 'default_ping_status', 0 );
update_option( 'thumbnail_size_w', 100 );
update_option( 'thumbnail_size_h', 100 );
update_option( 'medium_size_w', 400 );
update_option( 'medium_size_h', 400 );
update_option( 'large_size_w', 960 );
update_option( 'large_size_h', 960 );
update_option( 'category_base', 'categoria' );
update_option( 'tag_base', 'tag' );
update_option( 'permalink_structure	', '/%postname%/' );

$user_role_editor                    = get_option( 'user_role_editor' );
$user_role_editor['show_admin_role'] = '1';

update_option( 'user_role_editor', $user_role_editor );
