<?php

$debut = microtime(true);

/*if (is_dir("../install")) {
    include("../install/index.php");
    die();
}*/

define('DS', DIRECTORY_SEPARATOR);
define('CRLF', "\r\n");
define('ROOT_DIR', dirname(dirname(__File__)));
define('CONFIG_DIR', ROOT_DIR.DS."config");
define('SYSTEM_DIR', ROOT_DIR.DS."system");
define('VENDOR_DIR', ROOT_DIR.DS."vendor");
define('INSTALL_DIR', ROOT_DIR.DS."install");
define('APP_DIR', ROOT_DIR.DS."app");
define('MODEL_DIR', APP_DIR.DS."models");
define('CONTROLLER_DIR', APP_DIR.DS."controllers");
define('VIEW_DIR', APP_DIR.DS."views");
define('PUBLIC_DIR', ROOT_DIR.DS."public");
define('ASSETS_DIR', ROOT_DIR.DS."public".DS."assets");
define('CSS_DIR', PUBLIC_DIR.DS."assets".DS."css");
define('JS_DIR', PUBLIC_DIR.DS."assets".DS."js");

include PUBLIC_DIR.DS.'functions.php';
include VENDOR_DIR.DS.'autoload.php';

use Core\Config;
use Core\Session;
use Core\Router;
use Core\Dispatcher;

Config::init();
Session::init();
Router::init();

new Dispatcher();
