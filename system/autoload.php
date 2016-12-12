<?php

include('functions.php');

use system\Config;
use system\Router;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require_once ROOT_DIR.DS.$class.'.php';
});

new Config();
new Router();
