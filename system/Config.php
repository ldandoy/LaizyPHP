<?php

	namespace system;

	class Config {

		static $config;
		static $config_db;
		static $config_general;
		static $config_css;
		static $config_js;

		public function __construct() { 
			self::$config =  parse_ini_file(CONFIG_DIR.DS."config.ini", true);
			self::$config_db = self::$config['DB'];
			self::$config_general = self::$config['GENERAL'];
			self::$config_css = self::$config['CSS'];
			self::$config_js = self::$config['JS'];

			if (!ini_get('display_errors')) {
				ini_set('display_errors', self::getValueG('debug'));
			}
		}

		static function getValueDB($value) {
			return self::$config_db[$value];
		}

		static function getValueG($value) {
			return self::$config_general[$value];
		}
	}
