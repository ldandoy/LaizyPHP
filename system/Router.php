<?php
/**
 * File system\Router.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class gérant les requètes arrivant au serveur
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Router
{
    public static $routes;
    private static $_url;

    /**
     * Constructeur, charger toutes les routes définis pour le site
     *
     * @return void
     */
    public function __construct()
    {
        $routeConf = parse_ini_file(CONFIG_DIR.DS."route.ini", true);
        $actions = array('index', 'new', 'create', 'show', 'edit', 'update', 'delete');
        $methods = array(
            'index'     => 'get',
            'new'       => 'get',
            'create'    => 'post',
            'show'      => 'get',
            'edit'      => 'get',
            'update'    => 'post',
            'delete'    => 'delete'
        );
        $variables = array(
            'index'     => array(),
            'new'       => array(),
            'create'    => array(),
            'show'      => array('id'),
            'edit'      => array('id'),
            'update'    => array('id'),
            'delete'    => array('id')
        );

        /* On charge le route par default */
        $routes['defaults_index']['url'] = '/'.str_replace('_', '/', Config::getValueG('controller')).'/'.Config::getValueG('action');
        $routes['defaults_index']['controller'] = Config::getValueG('controller');
        $routes['defaults_index']['action'] = Config::getValueG('action');
        $routes['defaults_index']['method'] = 'get';
        $routes['defaults_index']['params'] = array();
        self::$_url['defaults_index'] = $routes['defaults_index']['url'];

        /* On charge les routes du fichier ini */
        foreach ($routeConf as $k => $v) {
            if ($v['type'] == 'crud') {
                /* On découpe l'url pour voir ce qu'on peut en faire. */
                $url = array_slice(explode("/:", $v['url']), 1);
                foreach ($actions as $v) {
                    /* A voir si çà sert un jour
                     $params = (!empty($variables[$v])) ? '/'.implode('/', $variables[$v]) : '';*/
                    $routes[$k.'_'.$v]['url'] = '/'.str_replace('_', '/', $k).'/'.$v;
                    $controller = explode('_', $k);
                    if (count($controller) > 1) {
                        $routes[$k.'_'.$v]['prefix'] = $controller[0];
                        $routes[$k.'_'.$v]['controller'] = str_replace('_', '/', $k);
                    } else {
                        $routes[$k.'_'.$v]['controller'] = str_replace('_', '/', $k);
                    }
                    $routes[$k.'_'.$v]['action'] = $v;
                    $routes[$k.'_'.$v]['method'] = $methods[$v];
                    $routes[$k.'_'.$v]['params'] = $variables[$v];

                    self::$_url[$k.'_'.$v] = $routes[$k.'_'.$v]['url'];
                }
            }
        }
        self::$routes = $routes;
    }

    /**
     * Parse la requète
     *
     * On parse la requète et on ajoute les infos (prefix, controller, action, params) à la l'obj $request
     *
     * @param obj $request la chaine de caractère à transformé en url
     *
     * @return void
     */
    public static function parse($request)
    {
        foreach (self::$_url as $k => $v) {
            if (strpos($request->url, $v) === 0) {
                $route = self::$routes[$k];
                $request->controller = $route['controller'];
                $request->action = $route['action'];
                if (!empty($route['params'])) {
                    if (empty($request->params)) {
                        $request->params = $route['params'];
                    } else {
                        $request->params = array_merge($request->params, $route['params']);
                    }
                } else {
                    if (!empty($request->params)) {
                        $request->params = $request->params;
                    } else {
                        $request->params = array();
                    }
                }
                if (!empty($route['prefix'])) {
                    $request->prefix = $route['prefix'];
                }
            }
        }

        // debug($request);
    }

    /**
     * Transforme une chaine de caractères en url
     *
     * @param string $string la chaine de caractère à transformé en url
     * @param array  $params contient les paramètre à ajouter à l'url
     *
     * @return string $url contient l'url final
     */
    public static function url($string = null, $params = array())
    {
        $url = '/'.str_replace('_', '/', $string);
        if (!empty($params)) {
            $url .= '/'.implode('/', $params);
        }
        return $url;
    }
}
