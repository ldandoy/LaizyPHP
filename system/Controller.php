<?php

namespace system;

class Controller
{
    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function render($view, $params = array())
    {
        if (strpos($view, "/") === 0) {
            $tpl = VIEW_DIR.$view.".php";
        } else {
            $tpl = VIEW_DIR.DS.$this->request->controller.DS.$view.".php";
        }
        if (file_exists($tpl)) {
            ob_start();
            require_once $tpl;
            $yeslp = ob_get_clean();
        } else {
            $message = 'Le template "'.DS.$this->request->controller.DS.$view.'.php" n\'existe pas';
            $this->e404($message);
        }
        if (isset($this->request->prefix)) {
            ob_start();
            require_once VIEW_DIR.DS.$this->request->prefix.DS."layout.php";
            $html = ob_get_clean();
            $html = $this->parse($html, $params);
            echo $html;
        } else {
            require_once VIEW_DIR.DS."layout.php";
        }
    }

    public function parse($html, $params)
    {
        # On remplace les varibles par leur valeur
        $matchesVar = array();
        preg_match_all("/{{ *([^}{]*) *}}/", $html, $matchesVar, PREG_SET_ORDER);
        if (!empty($matchesVar)) {
            foreach ($matchesVar as $v) {
                $html = preg_replace('/'.$v[0].'/', $params[$v[1]], $html);
            }
        }

        # Ici on gère les fonctions
        $matchesFunctions = array();
        preg_match_all("/{% *([^}{]*) *%}/", $html, $matchesFunctions, PREG_SET_ORDER);
        if (!empty($matchesFunctions)) {
            foreach ($matchesFunctions as $v) {
                $get = explode(" ", $v[1]);
                $conf = array(
                    'helper'    =>  $get[0],
                    'valeur'    =>  $params[$get[1]],
                    'colonne'   =>  array('titre', 'contenu')
                );
                $helper = $this->helper($conf);
                $html = preg_replace('/'.$v[0].'/', $helper, $html);
            }
        }
        return $html;
    }

    # Affiche les choses comme suivant le widget voulu
    # Array (
    #     'helper'  => 'table' | 'title',
    #     'valeur'  => array | string,
    #     'colonne' => array
    #)
    public function helper($conf)
    {
        $html = '';
        // debug($conf);
        switch ($conf['helper']) {
            case 'table':
                $html .= '<table class="table table-hover table-stripped">';
                $html .= '<thead>';
                $html .= '<tr>';
                foreach ($conf['colonne'] as $v_colonne) {
                    $html .= '<th>'.$v_colonne.'</th>';
                }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                foreach ($conf['valeur'] as $v) {
                    $html .= '<tr>';
                    foreach ($conf['colonne'] as $v_colonne) {
                        $html .= '<td>'.$v->$v_colonne.'</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody>';
                $html .= '</table>';
                break;
            case 'title':
                $html .= '<h1 class="page-header">'.$conf['valeur'].'</h1>';
                break;
        }

        return $html;
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

    public function redirect($url, $code = null)
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
