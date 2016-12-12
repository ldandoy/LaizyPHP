<?php

namespace system;

class Controller
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function render($view, $params=array())
    {
        if (strpos($view, "/") === 0) {
            $tpl = VIEW_DIR.$view.".php";
        } else {
            $tpl = VIEW_DIR.DS.$this->request->controller.DS.$view.".php";
        }
        if (file_exists($tpl)) {
            ob_start();
            require($tpl);
            $yeslp = ob_get_clean();
        } else {
            $message = 'Le template "'.DS.$this->request->controller.DS.$view.'.php" n\'existe pas';
            $this->e404($message);
        }

        if (isset($this->request->prefix)) {
            require VIEW_DIR.DS.$this->request->prefix.DS."layout.php";
        } else {
            require VIEW_DIR.DS."layout.php";
        }
    }

    public function loadModel($name)
    {
        if (!isset($this->$name)) {
            $classname = '\app\\models\\'.$name;
            $this->$name = new $classname();
        }
    }

    public function e404($message)
    {
        header("HTTP/1.0 404 Not Found");
        $this->render('/errors/404', array(
                'message'    => $message
            ));
        die();
    }

    public function redirect($url, $code=null)
    {
        if ($code == 301) {
            header("HTTP/1.1 301 Move Permanently");
        }
        header("Location: ".Router::url($url));
    }

    public function loadCss()
    {
        // CSS dans bower -> bower_components
        foreach (Config::$config_css as $value) {
            echo "<link rel=\"stylesheet\" href=\"/bower_components/".$value."\" />\n";
        }

        // CSS qui sont dans les dossiers assets
        if ($handle = opendir(CSS_DIR)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo "<link rel=\"stylesheet\" href=\"/assets".DS."css".DS.$entry."\" />\n";
                }
            }
            closedir($handle);
        }
    }

    public function loadJs()
    {
        // JS dans bower -> bower_components
        foreach (Config::$config_js as $value) {
            echo "<link rel=\"stylesheet\" href=\"/bower_components/".$value."\" />\n";
            echo '<script src="/bower_components/'.$value.'"></script>';
        }

        // Script qui sont dans les dossiers assets
        if ($handle = opendir(JS_DIR)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo '<script src="/assets'.DS.'js'.DS.$entry.'"></script>';
                }
            }
            closedir($handle);
        }
    }
}
