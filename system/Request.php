<?php

	namespace system;

	class Request {
		public $url;

		public function __construct() {
			if (isset($_SERVER['PATH_INFO'])) {
				$this->url = $_SERVER['PATH_INFO'];
			} else {
				$this->url = '/'.Config::getValueG('controller').'/'.Config::getValueG('action');
			}
		}

	}