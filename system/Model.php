<?php

namespace system;

use \PDO;
use system\Config;
use system\Query;

class Model extends Query
{
    public static $db;
    private $tableName;
    private $sql = "";
    private $pre;

    public function __construct()
    {
        if (!isset(Model::$db)) {
            try {
                Model::$db = new PDO('mysql:host='.Config::getValueDB('URL').';dbname='.Config::getValueDB('DB').';charset='.Config::getValueDB('CHARSET'), Config::getValueDB('USER'), Config::getValueDB('PASSWORD'));
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        $className = end(explode('\\', get_class($this)));
        $this->tableName = strtolower($className."s");
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function findAll()
    {
        $this->select('*');
        $this->from($this->tableName);
        $this->createQuery();
        $this->sql = $this->getQuery();
        $this->execute();
        $rows = $this->pre->fetchAll(PDO::FETCH_OBJ);

        # On va récupérer les enfants
        if (isset($this->parent) && !empty($this->parent)) {
            foreach ($this->parent as $k_parent => $v_parent) {
                foreach ($rows as $k => $v) {
                    $user = new \app\models\User();
                    $v->user = $user->findById($v->$v_parent);
                }
            }
        }
        return $rows;
    }

    public function findById($id)
    {
        $this->select('*');
        $this->from($this->tableName);
        $this->createQuery();
        $this->sql = $this->getQuery();
        $this->execute();
        return $this->pre->fetch(PDO::FETCH_OBJ);
    }

    public function execute()
    {
        $this->pre = Model::$db->prepare($this->sql);
        $this->pre->execute();
    }

    public function showLastRequest()
    {
        debug($this->sql);
    }
}
