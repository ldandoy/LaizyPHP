<?php

    namespace system;

class Router
{
    public static $routes;
    private static $url;

    public function __construct()
    {
        # On chage la config des routes
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
            'create'    => array('id'),
            'show'      => array('id'),
            'edit'      => array('id'),
            'update'    => array('id'),
            'delete'    => array('id')
        );

        # On charge le route par default
        $routes['defaults_index']['url'] = '/'.str_replace('_', '/', Config::getValueG('controller')).'/'.Config::getValueG('action');
        $routes['defaults_index']['controller'] = Config::getValueG('controller');
        $routes['defaults_index']['action'] = Config::getValueG('action');
        $routes['defaults_index']['method'] = 'get';
        $routes['defaults_index']['params'] = array();
        self::$url['defaults_index'] = $routes['defaults_index']['url'];

        # On charge les routes du fichier ini
        foreach ($routeConf as $k => $v) {
            if ($v['type'] == 'crud') {
                # On découpe l'url pour voir ce qu'on peut en faire.
                $url = array_slice(explode("/:", $v['url']), 1);
                foreach ($actions as $v) {
                    # A voir si çà sert un jour
                    # $params = (!empty($variables[$v])) ? '/'.implode('/', $variables[$v]) : '';
                    $routes[$k.'_'.$v]['url'] = '/'.str_replace('_', '/', $k).'/'.$v;
                    $routes[$k.'_'.$v]['controller'] = $k;
                    $routes[$k.'_'.$v]['action'] = $v;
                    $routes[$k.'_'.$v]['method'] = $methods[$v];
                    $routes[$k.'_'.$v]['params'] = $variables[$v];

                    self::$url[$k.'_'.$v] = $routes[$k.'_'.$v]['url'];
                }
            }
        }
        self::$routes = $routes;
    }

    public static function parse($request)
    {
        foreach (self::$url as $k => $v) {
            if (strpos($request->url, $v) === 0) {
                $route = self::$routes[$k];
                $request->controller = $route['controller'];
                $request->action = $route['action'];
                $request->params = $route['params'];
            }
        }
    }

    public static function url($string, $params = null)
    {
        # On génèer une url de base
        $url = '/'.str_replace('_', '/', $string);

        # on ajoute les params s'il y en a
        $url .= '/'.implode('/', $params);
        return $url;
    }
}
