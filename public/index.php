<?php

$debut = microtime(true);

define('DS', DIRECTORY_SEPARATOR);
define('CRLF', "\r\n");
define('ROOT_DIR', dirname(dirname(__File__)));
define('CONFIG_DIR', ROOT_DIR.DS."config");
define('SYSTEM_DIR', ROOT_DIR.DS."system");
define('VENDOR_DIR', ROOT_DIR.DS."vendor");
define('APP_DIR', ROOT_DIR.DS."app");
define('MODEL_DIR', APP_DIR.DS."models");
define('CONTROLLER_DIR', APP_DIR.DS."controllers");
define('VIEW_DIR', APP_DIR.DS."views");
define('PUBLIC_DIR', ROOT_DIR.DS."public");
define('CSS_DIR', PUBLIC_DIR.DS."assets".DS."css");
define('JS_DIR', PUBLIC_DIR.DS."assets".DS."js");

include SYSTEM_DIR.DS.'functions.php';
include VENDOR_DIR.DS.'autoload.php';

use System\Config;
use System\Session;
use System\Router;
use System\Dispatcher;

Config::init();
Session::init();
Router::init();

new Dispatcher();
