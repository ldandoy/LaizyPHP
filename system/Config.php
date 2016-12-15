<?php
/**
 * File system\Config.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class gérant la configuration de l'application
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Config
{
    public static $config;
    public static $config_db;
    public static $config_general;
    public static $config_css;
    public static $config_js;

    /**
     * Constructeur
     *
     * Cette fonction permet de lire le fichier de configuration et charge
     * la gestion des erreurs.
     *
     * @return void
     */
    public function __construct()
    {
        self::$config =  parse_ini_file(CONFIG_DIR.DS."config.ini", true);
        self::$config_db = self::$config['DB'];
        self::$config_general = self::$config['GENERAL'];
        self::$config_css = self::$config['CSS'];
        self::$config_js = self::$config['JS'];

        if (!ini_get('display_errors')) {
            ini_set('display_errors', self::getValueG('debug'));
        }
    }

    /**
     * Renvoie une valeur de la configuration DB
     *
     * Par exemple: Config::getValueDB('host')
     *
     * @param string $value l'item de la configuration DB demandé
     *
     * @return string contenant la valeur de configuration DB demandé
     */
    public static function getValueDB($value)
    {
        return self::$config_db[$value];
    }

    /**
     * Renvoie la valeur de configuration générale
     *
     * Par exemple: Config::getValueG('debug')
     *
     * @param string $value l'item de la configuration générale demandé
     *
     * @return string contenant la valeur de configuration générale demandé
     */
    public static function getValueG($value)
    {
        return self::$config_general[$value];
    }
}
