<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(dirname(__File__)));

require_once ROOT_DIR.DS.'config'.DS.'config.php';

require_once VENDOR_DIR.DS.'autoload.php';

use Core\LazyPHP;
LazyPHP::run();
