<?php
/**
 * Activate/deactivate plugins.
 *
 * This is a "Must-Use" plugin. Code here is loaded automatically before
 * regular plugins load. This is the only place from which regular plugins
 * can be disabled programmatically.
 */

if ( defined( 'WP_LOCAL_DEV' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';

	if ( WP_LOCAL_DEV ) {
		$plugins = [
			'google-site-kit/google-site-kit.php',
			'ss-smtp/smtp.php',
			'worker/init.php',
			'wp-super-cache/wp-cache.php',
		];

		deactivate_plugins( $plugins, true );

//		$plugins = [];
//
//		activate_plugins( $plugins, '', false, true );
	} else {
//		$plugins = [];
//
//		deactivate_plugins( $plugins, true );

		$plugins = [
			'wp-media-compression/media-compression.php',
		];

		activate_plugins( $plugins, '', false, true );
	}
}
