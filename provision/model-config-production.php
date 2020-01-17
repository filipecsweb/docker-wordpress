<?php
/**
 * Configuration overrides for WP_ENV === 'production'
 */

use Roots\WPConfig\Config;

Config::define( 'EMPTY_TRASH_DAYS', 0 );
Config::define( 'FORCE_SSL_ADMIN', true );
Config::define( 'IMAGE_EDIT_OVERWRITE', true );
Config::define( 'DISALLOW_FILE_EDIT', true );
Config::define( 'DISALLOW_FILE_MODS', true );

Config::define( 'AUTOMATIC_UPDATER_DISABLED', true );
Config::define( 'WP_LOCAL_DEV', false );
Config::define( 'WP_DEBUG', false );
Config::define( 'WP_DEBUG_DISPLAY', false );
Config::define( 'WP_DEBUG_LOG', false );

/**
 * Contact Form 7 related.
 *
 * @link    https://contactform7.com/controlling-behavior-by-setting-constants/
 */
Config::define( 'WPCF7_AUTOP', false );
Config::define( 'WPCF7_ADMIN_READ_CAPABILITY', 'update_core' );
Config::define( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'update_core' );
Config::define( 'WPCF7_LOAD_JS', false );
Config::define( 'WPCF7_LOAD_CSS', false );

/**
 * Static content related.
 */
//Config::define( 'COOKIE_DOMAIN', env( 'WP_DOMAIN' ) );
//
//if ( strpos( ( $_SERVER['REQUEST_URI'] ?? '' ), '/wp-' ) === false && strpos( ( $_SERVER['REQUEST_URI'] ?? '' ), '.xml' ) === false ) {
//	Config::define( 'WP_CONTENT_URL', env( 'WP_STATIC_HOME' ) . Config::get( 'CONTENT_DIR' ) );
//}
