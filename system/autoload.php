<?php

include('functions.php');

use system\Session;
use system\Config;
use system\Router;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = ROOT_DIR.DS.$class.'.php';
    //echo $file.' | '.$class.'<br />';
    if (file_exists($file)) {
        require_once $file;
    } else {
    }
});

Session::init();
Config::init();
Router::init();
