<?php

define("WP_ENVIRONMENT_TYPE", $_ENV["WP_ENVIRONMENT_TYPE"]);
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
