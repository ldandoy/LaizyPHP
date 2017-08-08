<?php

/*if (is_dir("../install")) {
    include("../install/index.php");
    die();
}*/

define('DS', DIRECTORY_SEPARATOR);
define('CRLF', "\r\n");
define('ROOT_DIR', dirname(dirname(__File__)));
define('CONFIG_DIR', ROOT_DIR.DS.'config');
define('VENDOR_DIR', ROOT_DIR.DS.'vendor');
define('APP_DIR', ROOT_DIR.DS.'app');
define('PUBLIC_DIR', ROOT_DIR.DS.'public');
define('ASSETS_DIR', PUBLIC_DIR.DS.'assets');
define('CSS_DIR', ASSETS_DIR.DS.'css');
define('JS_DIR', ASSETS_DIR.DS.'js');

include VENDOR_DIR.DS.'autoload.php';

use Core\LazyPHP;
LazyPHP::run();
