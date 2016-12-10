<?php

	namespace system;
	
	Class Router {

		static $routes;

		function __construct() {
			$routeConf = parse_ini_file(CONFIG_DIR.DS."route.ini", true);

			foreach ($routeConf as $k => $v) {
				if ($v == 'crud') {
					$this->route[$k."_index"] 	= '/'.str_replace('_', '/', $k."_index");
					$this->route[$k."_show"] 	= '/'.str_replace('_', '/', $k."_show");
					$this->route[$k."_create"] 	= '/'.str_replace('_', '/', $k."_create");
					$this->route[$k."_edit"] 	= '/'.str_replace('_', '/', $k."_edit");
					$this->route[$k."_delete"] 	= '/'.str_replace('_', '/', $k."_delete");
				}
			}

			// Utils::debug($this->route);
		}

		static function parse($request) {
			$params = explode("/", trim($request->url, "/"));

			if ($params[0] == "cokpit") {
				$request->controller = (isset($params[0]) && isset($params[1])) ? $params[0].'/'.$params[1] : Config::getValueG('controller');
				$request->action = isset($params[2]) ? $params[2] : Config::getValueG('action');
				$request->params = array_slice($params, 3);
			} else {
				$request->controller = isset($params[0]) ? $params[0] : Config::getValueG('controller');
				$request->action = isset($params[1]) ? $params[1] : Config::getValueG('action');
				$request->params = array_slice($params, 2);
			}

			// Utils::debug($request);
		}

		static function url($string, $params = null) {
			// On génèer une url de base
			$url = '/'.str_replace('_', '/', $string);

			

			// on ajoute les params s'il y en a
			$url .= '/'.implode('/', $params);
			return $url;
		}
	}