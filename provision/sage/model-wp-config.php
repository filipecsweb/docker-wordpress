<?php

require_once 'vendor/autoload.php';

$_ENV = array_merge(
    ($_ENV ?? []),
    parse_ini_file(dirname(__FILE__).'/.env')
);

define('AUTOMATIC_UPDATER_DISABLED', true);
define('IMAGE_EDIT_OVERWRITE', true);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define('WP_ENVIRONMENT_TYPE', $_ENV['WP_ENVIRONMENT_TYPE']);

/**
 * @link https://contactform7.com/controlling-behavior-by-setting-constants/
 */
define('WPCF7_AUTOP', false);
define('WPCF7_ADMIN_READ_CAPABILITY', 'update_core');
define('WPCF7_ADMIN_READ_WRITE_CAPABILITY', 'update_core');

if ('production' === WP_ENVIRONMENT_TYPE) {
    if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
        $_SERVER['HTTPS'] = 'on';
    }

    define('FORCE_SSL_ADMIN', true);
    define('DISALLOW_FILE_MODS', false);
    define('DISALLOW_FILE_EDIT', true);
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('WP_HOME', "https://{$_ENV['SERVER_NAME']}");
    define('WP_SITEURL', WP_HOME);

    /**
     * @link https://api.wordpress.org/secret-key/1.1/salt/
     */
    define('AUTH_KEY', '&q.lGb&x/flZ!UBZJs>@a5+h`ZV>{Vs@XGc`!DHw+J<Je-jXP!nN(6|`z*&1R:SY');
    define('SECURE_AUTH_KEY', 'g.mK|,b4%3_)n/QJtD2mi`L(b54Nk#4R&bG|X=i]Oi~>cJh.st#e?.p+Y?QliTa ');
    define('LOGGED_IN_KEY', 'pD<9i?m+q/)+]s@[vteJ)lv*oa4P|jPX<2.V2^p6-Xv+K=n`[T[sn-^oI4h*9cb_');
    define('NONCE_KEY', 'Lb:$%oDuA(OzblBbtV1pvaP&dv%xPzr/j[D5ePNdlDAsb-rf$=k0us$[-PShgjhu');
    define('AUTH_SALT', '-_f<]Fq@7H0b}t(-F3|x0IRbR=JXaa.7Q+xKP>wt;o89[osJ,JPRVUd!x:eko?F4');
    define('SECURE_AUTH_SALT', '@P[;hIH7FN*qDiZ*kPg]$~L+MHYA[TnhA+{t Rv4oYB-(o<-$0|Jt5_{BLyOk6)6');
    define('LOGGED_IN_SALT', '/SrA%v3$q7:#vW#B!%T%%]i5Xaco^>f;hIrle9Kzboh2Ep%;<OO#!+-b|HE0@L`V');
    define('NONCE_SALT', '%I!)&`;tiZ:R#3MM!PIbQ9YYj@+`L[dcDDbIgJ[HnXAh6Oh|/Vdd.Z6=POI.3e0u');
} else {
    include_once "wp-config-local.php";

    if ( ! defined("WP_DEBUG")) {
        define('WP_DEBUG', true);
    }
}

$table_prefix = 'wp_';

if ( ! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}

require_once ABSPATH.'wp-settings.php';