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

    /**
     * Init, load all routes defined for the site (in route.ini)
     *
     * @return void
     */
    public static function init()
    {
        $routeConfs = parse_ini_file(CONFIG_DIR.DS.'route.ini', true);

        $crudActions = array(
            'index' => 'get',
            'new' => 'get',
            'create' => 'post',
            'show' => 'get',
            'edit' => 'get',
            'update' => 'post',
            'delete' => 'delete'
        );

        $defaultController = Config::getValueG('controller');
        $defaultAction = Config::getValueG('action');
        $adminPrefix = Config::getValueG('admin_prefix');

        /* The default root */
        $routes['defaults_index']['url'] = '/'.$defaultController.'/'.$defaultAction;
        $routes['defaults_index']['controller'] = $defaultController;
        $routes['defaults_index']['action'] = $defaultAction;
        $routes['defaults_index']['method'] = 'get';
        $routes['defaults_index']['params'] = array();

        /* The default root admin */
        $routes[$adminPrefix.'_defaults_index']['url'] = '/'.$adminPrefix.'/'.$defaultController.'/'.$defaultAction;
        $routes[$adminPrefix.'_defaults_index']['controller'] = $defaultController;
        $routes[$adminPrefix.'_defaults_index']['action'] = $defaultAction;
        $routes[$adminPrefix.'_defaults_index']['method'] = 'get';
        $routes[$adminPrefix.'_defaults_index']['params'] = array();

        /* On charge les routes du fichier ini */
        foreach ($routeConfs as $section => $params) {
            $method = isset($params['method']) ? $params['method'] : 'get';

            switch ($method) {
                case 'crud':
                    foreach ($crudActions as $actionName => $actionMethod) {
                        $key = $section.'_'.$actionName;

                        $routes[$key]['url'] = '/'.str_replace('_', '/', $key);

                        $a = explode('_', $section, 2);
                        if (count($a) > 1) {
                            $routes[$key]['prefix'] = $a[0];
                            $routes[$key]['controller'] = str_replace('_', '/', $a[1]);
                        } else {
                            $routes[$key]['controller'] = str_replace('_', '/', $section);
                        }
                        $routes[$key]['action'] = $actionName;
                        $routes[$key]['method'] = $actionMethod;
                    }
                    break;

                case 'post':
                case 'get':
                default:
                    $a = explode('_', $section);
                    $actionName = array_pop($a);
                    $key = $section;
                    $routes[$key]['url'] = $params['url'];
                    if (count($a) > 1) {
                        $routes[$key]['prefix'] = $a[0];
                        $routes[$key]['controller'] = str_replace('_', '/', $a[1]);
                    } else {
                        $routes[$key]['controller'] = str_replace('_', '/', $section);
                    }
                    $routes[$key]['action'] = $actionName;
                    $routes[$key]['method'] = $method;
                    break;
            }
        }
        self::$routes = $routes;
    }

    /**
     * Parse la requète
     *
     * On parse la requète et on ajoute les infos (prefix, controller, action, params) à la l'obj $request
     *
     * @param system\Request $request la requête
     *
     * @return bool
     */
    public static function parse($request)
    {
        $adminPrefix = Config::getValueG('admin_prefix');
        /* We get an array form the url */
        $tabUrl = deleteEmptyItem(explode('/', $request->url));
        /* We check if it's an admin url */
        if (strpos($request->url, '/'.$adminPrefix) === 0) {
            /* We get the perfix and clean the url */
            $request->prefix = $adminPrefix;
            $urlparams = array_slice($tabUrl, 3);
        } else {
            $urlparams = array_slice($tabUrl, 2);
        }
        
        foreach (self::$routes as $k => $v) {
            if (strpos($request->url, $v) === 0) {
                $route = self::$routes[$k];
                if (!empty($route['prefix'])) {
                    $request->prefix = $route['prefix'];
                }
                $request->controller = ucfirst($route['controller']);
                $request->action = $route['action'];
                $request->params = array();
                
                if (!empty($route['params'])) {
                    $params = array();
                    foreach ($route['params'] as $key => $value) {
                        $params[$value] = $urlparams[$key];
                    }
                    $request->params = array_merge($request->params, $params);
                }

                if (!empty($params)) {
                    if (!empty($request->post)) {
                        $request->post = array_merge($request->post, $params);
                    } else {
                        $request->post = $params;
                    }
                }

                return true;
            }
        }
        return false;
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
