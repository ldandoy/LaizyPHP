<?php

	namespace system;
	
	Class Router {

		static $routes;

		function __construct() {
			# On chage la config des routes
			$routeConf = parse_ini_file(CONFIG_DIR.DS."route.ini", true);
			foreach ($routeConf as $k => $v) {
				if ($v['type'] == 'crud') {
					$routes[$k] = $v['url'];
				}
			}
			self::$routes = $routes;
		}

		static function parse($request) {
			$params = explode("/", trim($request->url, "/"));
			$start = 2;

			# On vérifie si c'est une route qui vient de l'admin
			# A revoir pour rendre çà plus générique regexp ?
			if ($params[0] == "cokpit") {
				$paramsTMP[] = $params[0].'/'.$params[1];
				$paramsTMP[] = $params[2];
				$paramsTMP = array_merge($paramsTMP, array_slice($params, 3));
				$params = $paramsTMP;
				$start = 3;
			}

			$request->controller = isset($params[0]) ? $params[0] : Config::getValueG('controller');
			$request->action = isset($params[1]) ? $params[1] : Config::getValueG('action');
			$request->params = array_slice($params, 2);

			# On remplace les params par les bon id
			$url_pattern = str_replace('/', '_', $request->controller);
			$indexParams = array_slice(explode('/:', self::$routes[$url_pattern]), 3);
			foreach ($indexParams as $k => $v) {
				if (isset($request->params[$k])) {
					$request->params[$v] = $request->params[$k];
					unset($request->params[$k]);
				}
			}
		}

		static function url($string, $params = null) {
			# On génèer une url de base
			$url = '/'.str_replace('_', '/', $string);

			# on ajoute les params s'il y en a
			$url .= '/'.implode('/', $params);
			return $url;
		}
	}