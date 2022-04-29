<?php

define('DB_HOST', $_ENV["DB_HOST"]);
define('DB_NAME', $_ENV["DB_NAME"]);
define('DB_PASSWORD', $_ENV["DB_PASSWORD"]);
define('DB_USER', $_ENV["DB_USER"]);
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define("WP_HOME", "http://".$_ENV["SERVER_NAME"]);
define("WP_SITEURL", WP_HOME);
define("EMPTY_TRASH_DAYS", 0);
define("WP_DEBUG_LOG", true);
define("WP_DEBUG_DISPLAY", true);
define('WP_LOCAL_DEV', true);
define('WP_DEBUG', true);
define('FORCE_SSL_ADMIN', false);

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