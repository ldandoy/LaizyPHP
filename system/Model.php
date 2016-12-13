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
                Model::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
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

    public function create($values) {
        $this->insert($this->getTableName(), $this->attr);
        $this->createQuery();
        $this->sql = $this->getQuery();
        $this->prepare();
        $this->bind($this->attr, $values);
        $this->execute();
    }

    public function findAll()
    {
        $this->select('*');
        $this->from($this->tableName);
        $this->createQuery();
        $this->sql = $this->getQuery();
        $this->prepare();
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
        $this->prepare();
        $this->execute();
        return $this->pre->fetch(PDO::FETCH_OBJ);
    }

    public function bind($attr = array(), $values = array()) {
        foreach ($attr as $k => $v) {
            $this->pre->bindParam(':'.$v, $values[$v]);
        }
    }

    public function execute()
    {
        try {
            $this->pre->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function prepare() {
        $this->pre = Model::$db->prepare($this->sql);
    }

    public function showLastRequest()
    {
        debug($this->sql);
    }
}
