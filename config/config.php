<?php

// Lisge des env
define ('PLATFORM', 'DEV');
// define ('PLATFORM', 'PREPROD');
// define ('PLATFORM', 'PROD');

if (PLATFORM == 'DEV') {
    define('DEBUG', false);
} else {
    define('DEBUG', true);
}

// CRLF, LF
define('CRLF', "\r\n");
define('LF', "\n");

// Directories
define('CONFIG_DIR', ROOT_DIR.DS.'config');
define('VENDOR_DIR', ROOT_DIR.DS.'vendor');
define('APP_DIR', ROOT_DIR.DS.'app');
define('PUBLIC_DIR', ROOT_DIR.DS.'public');
define('ASSETS_DIR', PUBLIC_DIR.DS.'assets');
define('CSS_DIR', ASSETS_DIR.DS.'css');
define('JS_DIR', ASSETS_DIR.DS.'js');
define('LOG_DIR', ROOT_DIR.DS.'logs');

// Data Base
define('DB_HOST', 'localhost');
define('DB_USER', 'framework');
define('DB_PASSWORD', 'framework');
define('DB_NAME', 'framework');
define('DB_CHARSET', 'utf8mb4');
define('DB_PREFIX', '');

define('MAIL_SENDER', 'ldandoy@overconsulting.net');


// Salt for password, crypting...
// define('SALT', '$6$199337193b7024b3e7dfcc83df8248f4$');
