<?php
$_ENV = array_merge(
	( $_ENV ?? [] ),
	parse_ini_file( dirname( __FILE__ ) . '/.env' )
);

define( 'DB_NAME', $_ENV['DB_NAME'] );
define( 'DB_USER', $_ENV['DB_USER'] );
define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );
define( 'DB_HOST', $_ENV['DB_HOST'] );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

define( 'WP_STATIC_HOME', "http://{$_ENV['WP_DOMAIN']}" ); # NON-native.
define( 'WP_HOME', "http://{$_ENV['WP_DOMAIN']}" );
define( 'WP_SITEURL', WP_HOME );

//define( 'COOKIE_DOMAIN', $_ENV['WP_DOMAIN'] );

//if ( strpos( ( $_SERVER['REQUEST_URI'] ?? '' ), '/wp-' ) === false && strpos( ( $_SERVER['REQUEST_URI'] ?? '' ), '.xml' ) === false ) {
//	define( 'WP_CONTENT_URL', WP_STATIC_HOME . '/wp-content' );
//}

define( 'WP_LOCAL_DEV', true );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );
define( 'FORCE_SSL_ADMIN', false );

define( 'WP_POST_REVISIONS', 20 );
define( 'EMPTY_TRASH_DAYS', 0 );
define( 'AUTOSAVE_INTERVAL', 60 );
define( 'IMAGE_EDIT_OVERWRITE', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', false );
define( 'AUTOMATIC_UPDATER_DISABLED', false );

//define( 'SAVEQUERIES', true );
//define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
//define( 'SCRIPT_DEBUG', true );

/**
 * @link https://api.wordpress.org/secret-key/1.1/salt/
 */
define( 'AUTH_KEY', ',^G7u[z0Mb[0d0hB@%zDFOaK,iW]!PoEz1<C+4N{s5,bi&OYtuK#]}&{-iml,I.*' );
define( 'SECURE_AUTH_KEY', '?]mzry=lANH$N>Up!>I6<kYnf&;PU<i%T J;ElH^Zk^V+73@<|Xg9^ysT_ggiJ:A' );
define( 'LOGGED_IN_KEY', 'E1nb`HIX@4Q^!E FNaMA$R9YrG6K^W6Gr9!fV,Aapz{}Ihy(Y~2V,VlA=5TmoY@@' );
define( 'NONCE_KEY', '^d@<v$g0C3AEHOr]<6d5R=(}7JQ$Q!4fupGWM{NZ^/c(!5=Z9QG;Z~|O;_kRfvSj' );
define( 'AUTH_SALT', ':uoqQ`gd<,Ir[&@{8(-WjS)pTX`n2qAN[JQh[q,Yc$X`O$l-FAw0Kvsyj>!Lys_^' );
define( 'SECURE_AUTH_SALT', 'whA#(k<b4`+Y:Y`gw5p})Gb3A)y%IR)CvlVI:Hlo5TU!y5c9eMb1C(F9DW}[|D1{' );
define( 'LOGGED_IN_SALT', '-[h,nYGj[+?{1vy8~;xVmKlQ,z!qqnMO,0]#e5rM_A)*X,8Z[w}+Kw!+4W},i_}S' );
define( 'NONCE_SALT', '|RwHMZ1lPWl8QuDTGqBy*c1^G 1J*J={q|f9LCKms=%YM%2D@]BNdIuk[]4j@r:t' );

/**
 * @link    https://contactform7.com/controlling-behavior-by-setting-constants/
 */
define( 'WPCF7_AUTOP', false );
define( 'WPCF7_ADMIN_READ_CAPABILITY', 'update_core' );
define( 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'update_core' );
define( 'WPCF7_LOAD_JS', false );
define( 'WPCF7_LOAD_CSS', false );

$table_prefix = 'wp_';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

require_once ABSPATH . 'wp-settings.php';