<?php
/**
 * File system\Db.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */

namespace system;

use \PDO;

/**
 * Class gérant les connextion à la base de données
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU 
 * @link     http://overconsulting.net
 */
class Db
{

    static public $db;
    static public $pre;

    public static function getDb()
    {
        return self::$db;
    }

    public static function prepare($sql = null)
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO('mysql:host='.Config::getValueDB('URL').';dbname='.Config::getValueDB('DB').';charset='.Config::getValueDB('CHARSET'), Config::getValueDB('USER'), Config::getValueDB('PASSWORD'));
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
                return false;
            }
        }
        if ($sql != null) {
            self::$pre = self::$db->prepare($sql->getQuery());
        }
    }

    public function bind($attr = array(), $values = array())
    {
        foreach ($attr as $k => $v) {
            self::$pre->bindParam(':'.$v, $values[$v]);
        }
    }

    public static function execute()
    {
        try {
            self::$pre->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return false;
    }

    public static function fetchAll()
    {
        return self::$pre->fetchAll(PDO::FETCH_OBJ);
    }

    public static function fetch()
    {
        return self::$pre->fetch(PDO::FETCH_OBJ);
    }
}
