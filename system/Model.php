<?php

namespace system;

use \PDO;
use system\Config;
use system\Query;

class Model
{
    public static $db;

    public function __construct($data = array())
    {
        if (!empty($data)) {
            $this->setData($data);
        }
    }

    public function setData($data)
    {
        $this->id = $data->id;
        # On ajout les attr autorized
        foreach ($this->attr as $k => $v) {
            $this->$v = $data->$v;
        }
        $this->creer_le = $data->creer_le;
        $this->modifie_le = $data->modifie_le;
    }

    public static function create($values)
    {
        $tableName = strtolower(end(explode('\\', get_called_class())))."s";

        $query = new Query();
        $query->insert($tableName, get_called_class());
        $query->createQuery();
        
        debug($query->getQuery());

        /*$this->sql = $this->getQuery();
        $this->prepare();
        $this->bind($this->attr, $values);
        $this->execute();*/
    }

    public static function findAll()
    {
        $return = array();
        $query = new Query();
        $query->select('*');
        $query->from(strtolower(end(explode('\\', get_called_class())))."s");
        $query->createQuery();
        self::prepare($query);
        self::execute();
        $rows = Model::$db->pre->fetchAll(PDO::FETCH_OBJ);

        foreach ($rows as $row) {
            $class = get_called_class();
            $return[] = new $class($row);
        }

        # On va récupérer les enfants
        /*if (isset($this->parent) && !empty($this->parent)) {
            foreach ($this->parent as $k_parent => $v_parent) {
                foreach ($rows as $k => $v) {
                    $user = new \app\models\User();
                    $v->user = $user->findById($v->$v_parent);
                }
            }
        }*/
        return $return;
    }

    public static function findById($id)
    {
        $this->select('*');
        $this->from($this->tableName);
        $this->createQuery();
        $this->sql = $this->getQuery();


        $this->prepare();
        $this->execute();
        return Model::$db->pre->fetch(PDO::FETCH_OBJ);
    }

    public function bind($attr = array(), $values = array())
    {
        foreach ($attr as $k => $v) {
            Model::$db->pre->bindParam(':'.$v, $values[$v]);
        }
    }

    public function execute()
    {
        try {
            Model::$db->pre->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function prepare($sql)
    {
        if (!isset(Model::$db)) {
            try {
                Model::$db = new PDO('mysql:host='.Config::getValueDB('URL').';dbname='.Config::getValueDB('DB').';charset='.Config::getValueDB('CHARSET'), Config::getValueDB('USER'), Config::getValueDB('PASSWORD'));
                Model::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        Model::$db->pre = Model::$db->prepare($sql->getQuery());
    }
}
