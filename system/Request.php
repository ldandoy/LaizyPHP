<?php

	namespace system;

	class Request {
		public $url;
		public $params;

		public function __construct() {
			if (isset($_SERVER['PATH_INFO'])) {
				$this->url = $_SERVER['PATH_INFO'];
			} else {
				$this->url = '/'.Config::getValueG('controller').'/'.Config::getValueG('action');
			}

			if (!empty($_POST)) {
				$this->params = new \stdClass();
				foreach ($_POST as $k => $v) {
					$this->params->$k = $v;
				}
			}
		}

	}