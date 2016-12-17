<?php
/**
 * File system\Model.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace system;

use system\Config;
use system\Query;
use system\Db;

/**
 * Class gérant les Models du site
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class Model
{
    /**
     * Constructeur
     *
     * Cette fonction appel la fonction setData au l'initialisation
     * de l'objet
     *
     * @param array $datas Contient les données à ajouter à l'objet
     *
     * @return void
     */
    public function __construct($datas = array())
    {
        if (!empty($datas)) {
            $this->setData($datas);
        }
    }

    /**
     * Ajout les données dans l'objet
     *
     * Cette fonction est appelé à l'instanciation de la classe pour
     * charger les données dans l'objet
     *
     * @param array $datas Contient les données à ajouter àl'objet
     *
     * @return void
     */
    public function setData($datas = array())
    {
        $this->id = $datas->id;
        if (isset($this->attr) && !empty($this->attr)) {
            foreach ($this->attr as $k => $v) {
                $this->$v = $datas->$v;
            }
        } else {
            
        }
        $this->creer_le = $datas->creer_le;
        $this->modifie_le = $datas->modifie_le;
    }

    /**
     * Créé l'objet en base
     *
     * Cette fonction créé la requète puis l'envoie à la base données
     *
     * @param array $datas Contient les données à ajouter àl'objet
     *
     * @return void
     */
    public static function create($datas = array())
    {
        $class = get_called_class();
        $tab = explode('\\', $class);
        $tableName = strtolower($tab[count($tab)-1])."s";
        $obj = new $class();

        $query = new Query();
        $query->insert($tableName, $datas, $obj->attr);
        $query->createQuery();

        Db::prepare($query);
        Db::bind($obj->attr, $values);
        if (Db::execute()) {
            return true;
        }
        return false;
    }

    /**
     * Renvoie tous les enregistrement d'une table
     *
     * Cette fonction permet de récupérer les enregistrement d'une table
     * et les renvoie sous forme d'un tableau objets
     *
     * @return array $return contient tous les objets trouvé en base
     */
    public static function findAll()
    {
        $return = array();
        $class = get_called_class();
        
        $query = new Query();
        $query->select('*');
        $query->from(self::getTableName());
        $rows = $query->executeAndFetchAll();
        
        foreach ($rows as $row) {
            $return[] = new $class($row);
        }
        return $return;
    }

    /**
     * Renvoie l'enregistrement s'il est trouvé
     *
     * Cette fonction permet de récupérer un enregistrement d'une table
     * en le cherchant par son ID
     *
     * @param integer $id contient l'id cherché dans la DB
     *
     * @return obj $return contient l'objets trouvé en base
     */
    public static function findById($id = 0)
    {

        $class = get_called_class();

        $query = new Query();
        $query->select('*');
        $query->from(self::getTableName());
        $row = $query->executeAndFetch();
        
        $return = new $class($row);
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

    /**
     * Return the name of the table form the static class calling
     *
     * @return string $tableName is the name of the table to return
     */
    public static function getTableName()
    {
        $tableName = strtolower(getLastElement(explode('\\', get_called_class())))."s";
        return $tableName;
    }
}
