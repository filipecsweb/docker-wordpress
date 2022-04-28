<?php
/**
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 */

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

    /**
     * @link https://api.wordpress.org/secret-key/1.1/salt/
     */
    define('AUTH_KEY', 'yjvNe7!Mepn95- x+[h?jx[P|l3|$[F3S&<M5&7|YTp.;$pJhDrk+*F.V4uAR1g!');
    define('SECURE_AUTH_KEY', '5tS7oS6]+wMfE+`V 2*FTJqRA-t+ =/rRD=bsHX3CD`| (QutXbTT~6o=upjRQ>b');
    define('LOGGED_IN_KEY', 'bm1~P^{WS2Y&=Y`jQcfi#nx| {_e:>*Pg/^<@_/+GW6]7%B9!.3F=;3!VF%)wxik');
    define('NONCE_KEY', '4&Z8|8`~bSI:(gr-XVD,mt-M[f4W&L}Lrw0|H-;-OQ]`-CiNUuMc+kw:G5=lxU@U');
    define('AUTH_SALT', 'x}+|4t;Kgg96/Z4/f4P[0iUv%}($@<jyK(f&`(-38_cL^pwqzbzrbO*1t[XiWK/b');
    define('SECURE_AUTH_SALT', 'd3b~@Yq<V;{$Q;pUjz*w%@xoUv[QjeD(^QBCG!rIE3UJ2^!^y54LyT+9~xF)@x?:');
    define('LOGGED_IN_SALT', '4?;f9&ck&|<Jw0*{Ozjh]5{-;0ZL2fG~o+-m G8@6m^SoDfedAb{*FS~gqdoA9D&');
    define('NONCE_SALT', 'QY(hDiZxBd;EoD`I~n_q1?e`}Y# g8K;c(O[+!B98V+<Vklt inE#4,:J[+NjdCS');
}

$table_prefix = 'wp_';

if ( ! defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__).'/');
}

require_once ABSPATH.'wp-settings.php';