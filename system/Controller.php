<?php
/**
 * File system\Controller.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace system;

use system\Session;

/**
 * Class gérant les Controllers du site
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class Controller
{
    public $request;
    public $controller;

    public function __construct($request)
    {
        $this->request = $request;
        if (isset($this->request->controller)) {
            if (isset($this->request->prefix)) {
                $this->controller = $this->request->prefix.DS.strtolower($this->request->controller);
            } else {
                $this->controller = strtolower($this->request->controller);
            }
        }
    }

    public function render($view, $params = array())
    {
        if (strpos($view, "/") === 0) {
            $tpl = VIEW_DIR.$view.".php";
        } else {
            $tpl = VIEW_DIR.DS.$this->controller.DS.$view.".php";
        }
        if (file_exists($tpl)) {
            ob_start();
            require_once $tpl;
            $yeslp = ob_get_clean();
        } else {
            $message = 'Le template "'.DS.$this->controller.DS.$view.'.php" n\'existe pas';
            $this->e404('Erreur de template', $message);
        }
        ob_start();
        if (strpos($view, "/errors/") === 0) {
            require_once VIEW_DIR.DS.'layout'.DS.'error.php';
        } else {
            if (isset($this->request->prefix)) {
                require_once VIEW_DIR.DS.'layout'.DS.$this->request->prefix.DS.'base.php';
            } else {
                require_once VIEW_DIR.DS.'layout'.DS.'base.php';
            }
        }
        $html = ob_get_clean();
        $html = $this->parse($html, $params);
        echo $html;

        Session::remove('redirect');
    }

    public function parse($html, $params)
    {
        /* Ici on gère les remplacement de variable */
        $matchesVar = array();
        preg_match_all("/{{ *([^}{]*) *}}/", $html, $matchesVar, PREG_SET_ORDER);
        if (!empty($matchesVar)) {
            foreach ($matchesVar as $v) {
                $html = preg_replace('/'.$v[0].'/', $params[$v[1]], $html);
            }
        }

        /* Ici on gère les remplacements de fonction */
        $matchesFunctions = array();
        preg_match_all("/{% *([^}{]*) *%}/", $html, $matchesFunctions, PREG_SET_ORDER);
        if (!empty($matchesFunctions)) {
            foreach ($matchesFunctions as $v) {
                $get = explode(" ", $v[1]);
                $helper = $get[0];
                if (isset($params[$get[1]])) {
                    $valeur = $params[$get[1]];
                } else {
                    $valeur = null;
                }
                $conf = array(
                    'helper'    =>  $helper,
                    'valeur'    =>  $valeur,
                    'colonne'   =>  array(
                        array('label'   =>  'title', 'width'    => '10%'),
                        array('label'   => 'content', 'width'    => '80%')
                    ),
                    'actions'   =>  array(
                        array(
                            'type'  => 'show',
                            'color' => 'primary',
                            'url'   => '/cockpit/pages/show/:id',
                            'icon'  => 'fa-eye'
                        ),
                        array(
                            'type'  => 'edit',
                            'color' => 'info',
                            'url'   => '/cockpit/pages/edit/:id',
                            'icon'  => 'fa-pencil'
                        ),
                        array(
                            'type'  => 'delete',
                            'color' => 'danger',
                            'url'   => '/cockpit/pages/delete/:id',
                            'icon'  => 'fa-trash-o'
                        )
                    )
                );
                $helper = $this->helper($conf);
                $html = preg_replace('/'.$v[0].'/', $helper, $html);
            }
        }
        return $html;
    }

    # Affiche les choses comme suivant le widget voulu
    # Array (
    #     'helper'      => 'table' | 'title',
    #     'valeur'      => array | string,
    #     'colonnes'    => array(array('label' => 'text, 'width' => '20%')),
    #     'actions'     => array(
    #            array('type' => 'edit', 'coulor' => 'primary', url => '/cockpit/pages/show/1', icon => 'fa-eye-o')
    #            array('type' => 'edit', )
    #            array('type' => 'delete')
    #      )
    #)
    public function helper($conf)
    {
        $html = '';
        switch ($conf['helper']) {
            case 'table':
                $html .= '<table class="table table-hover table-stripped">';
                $html .= '<thead>';
                $html .= '<tr>';
                foreach ($conf['colonne'] as $v_colonne) {
                    $html .= '<th width="'.$v_colonne['width'].'">'.ucfirst($v_colonne['label']).'</th>';
                }
                if (!empty($conf['actions'])) {
                    $html .= '<th width="10%">Actions</th>';
                }
                $html .= '</tr>';
                $html .= '</thead>';
                $html .= '<tbody>';
                foreach ($conf['valeur'] as $v) {
                    $html .= '<tr>';
                    foreach ($conf['colonne'] as $v_colonne) {
                        $html .= '<td>'.$v->$v_colonne['label'].'</td>';
                    }
                    if (!empty($conf['actions'])) {
                        $html .= '<td>';
                        foreach ($conf['actions'] as $k_action => $v_action) {
                            $html .= '<a href="'.str_replace(':id', $v->id, $v_action['url']).'" class="btn btn-'.$v_action['color'].' btn-xs"><i class="fa '.$v_action['icon'].'"></i></a>';
                        }
                        $html .= '</td>';
                    }
                    $html .= '</tr>';
                }
                $html .= '</tbody>';
                $html .= '</table>';
                break;
            case 'title':
                $html .= '<h1 class="page-header">';
                if (!empty($conf['valeur'])) {
                    $html .= $conf['valeur'];
                }
                $html .= '</h1>';
                break;
            case 'articles_list':
                foreach ($conf['valeur'] as $k => $article) {
                    $html .= '<div class="row">';
                    $html .= '<div class="col-lg-3">';
                    $html .= '<h2>'.$article->title.'</h2>';
                    $html .= '</div>';
                    $html .= '<div class="col-lg-9">';
                    $html .= '<p>'.$article->content.'</p>';
                    $html .= '<p align="right"><a href="/articles/show/'.$article->id.'">Lire plus &rarr;</a></p>';
                    $html .= '</div>';
                    $html .= '</div>';
                    if ($k+1 != count($conf['valeur'])) {
                        $html .= '<hr />';
                    }
                }
                break;
        }

        return $html;
    }

    public function e404($title, $message)
    {
        header('HTTP/1.0 404 Not Found');
        $this->render(
            '/errors/404',
            array(
                'title'     => $title,
                'message'   => $message
            )
        );
        die();
    }

    public function redirect($url, $code = null)
    {
        $redirect = Session::getAndRemove('redirect');
        if ($redirect === null || $redirect != $url) {
            if ($code == 301) {
                header('HTTP/1.1 301 Move Permanently');
            }
            Session::set('redirect', $url);
            Session::set('post', $this->request->post);
            header('Location: '.Router::url($url));
            exit;
        }
    }

    public function loadCss()
    {
        // CSS dans bower -> bower_components
        foreach (Config::$config_css as $value) {
            echo "<link rel=\"stylesheet\" href=\"/bower_components/".$value."\" />\n";
        }

        // CSS qui sont dans les dossiers assets
        if (file_exists(CSS_DIR)) {
            if ($handle = opendir(CSS_DIR)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        echo "<link rel=\"stylesheet\" href=\"/assets".DS."css".DS.$entry."\" />\n";
                    }
                }
                closedir($handle);
            }
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
        if (file_exists(JS_DIR)) {
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
}
