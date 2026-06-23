<?php

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
define('DB_NAME', getenv('DB_NAME_ECOMMERCE') ?: (getenv('DB_NAME') ?: 'rinconsuizo'));

define('COLOR', '#58FA82');
define('COLOR1', '#F5D0A9');
define('COLOR2', '#58FAAC');
define('COLOR3', '#F3F781');

?>
