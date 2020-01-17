<?php
/**
 * Configuration overrides for WP_ENV === 'development'
 */

use Roots\WPConfig\Config;

//Config::define( 'SAVEQUERIES', true );
//Config::define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
//Config::define( 'SCRIPT_DEBUG', true );

Config::define( 'EMPTY_TRASH_DAYS', 0 );
Config::define( 'FORCE_SSL_ADMIN', false );
Config::define( 'IMAGE_EDIT_OVERWRITE', true );
Config::define( 'DISALLOW_FILE_EDIT', false );
Config::define( 'DISALLOW_FILE_MODS', false );

Config::define( 'AUTOMATIC_UPDATER_DISABLED', false );
Config::define( 'WP_LOCAL_DEV', true );
Config::define( 'WP_DEBUG', true );
Config::define( 'WP_DEBUG_DISPLAY', true );
Config::define( 'WP_DEBUG_LOG', true );

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
