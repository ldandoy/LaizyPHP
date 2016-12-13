<?php

namespace system;

use system\Config;
use system\Query;
use system\Db;

class Model
{
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
        if (isset($this->attr) && !empty($this->attr)) {
            foreach ($this->attr as $k => $v) {
                $this->$v = $data->$v;
            }
        } else {
            
        }
        $this->creer_le = $data->creer_le;
        $this->modifie_le = $data->modifie_le;
    }

    public static function create($values)
    {
        $tableName = strtolower(end(explode('\\', get_called_class())))."s";
        $class = get_called_class();
        $obj = new $class();

        $query = new Query();
        $query->insert($tableName, $values, $obj->attr);
        $query->createQuery();

        Db::prepare($query);
        Db::bind($obj->attr, $values);
        if (Db::execute()) {
            echo "passer";
            return true;
        }
        return false;
    }

    public static function findAll()
    {
        $return = array();
        $query = new Query();
        $query->select('*');
        $query->from(strtolower(end(explode('\\', get_called_class())))."s");
        $query->createQuery();
        Db::prepare($query);
        Db::execute();
        $rows = Db::fetchAll();
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
        $query = new Query();
        $query->select('*');
        $query->from(strtolower(end(explode('\\', get_called_class())))."s");
        $query->createQuery();

        Db::prepare($query);
        Db::execute();
        $row = Db::fetch();
        $class = get_called_class();
        $return = new $class($row);

        # On regarde s'il y a des enfants
        if (isset($return->parent) && !empty($return->parent)) {
            foreach ($return->parent as $k_parent => $v_parent) {
                $class = 'app\\models\\'.$k_parent;
                $user = $class::findById($v_parent);
                $name = strtolower($k_parent);
                $return->$name = $user;
            }
        }

        return $return;
    }
}
