<?php

namespace system;

class Query
{
    # L'objet query va voir 3 parties
    # 1) SELECT => ne contient que la liste des champs voulu
    # 2) FROM => la table
    # 3) JOIN => pour joindre toute les tables dont on a besoin
    # 4) WHERE => Les conditions
    # 5) ORDER
    # 6) LIMIT

    private $query;
    private $select;
    private $insert;
    private $from;
    private $where;
    private $join;
    private $type;

    # Accecpte un tableau ou une chaine de caractère contant les champs.
    # Et créé un tableau contenant tous les champs
    public function select($champs = array('*'))
    {
        $this->type = "select";
        if (is_array($champs)) {
            $this->select = $champs;
        } else {
            $this->select = explode(',', $champs);
        }
    }

    # On créé la requete d'insert
    public function insert($table = '', $champs = array())
    {
        $this->type = "insert";
        $this->insert .= 'INSERT INTO '.$table.' (';
        $this->insert .= implode(', ', $champs);
        $this->insert .= ') VALUES (';
        foreach ($champs as $k => $v) {
            $this->insert .= ':'.$champs[$k].'';
            if (($k+1) < count($champs)) {
                $this->insert .= ', ';
            }
        }
        $this->insert .= ');';

        debug($this->insert);
    }

    # Accepte une chaine de caractère contenant le nom de la table
    public function from($table = '')
    {
        $this->from = $table;
    }

    # Gére les conditions du where
    # Array (
    #   'champs'    => 'id',
    #   'condition' => '=',
    #   'valeur'    => '?'
    # )
    public function where($where = array())
    {
        $this->where[] = implode(' ', $where);
    }

    # Gère les infos de jointure
    # Array (
    #    'jointure' => 'LEFT JOIN',
    #    'table'    => 'users',
    #    'fkeys'    => 'user_id'
    # )
    public function join($join = array())
    {
        $this->join[] = $join['jointure']. ' ' . $join['table'] . ' on ('.$join['table'].'.id = '.$join['fkeys'].')';
    }

    # Créé la requète
    public function createQuery()
    {
        switch ($this->type) {
            case 'select':
                $this->query .= 'SELECT ' . implode(', ', $this->select);
                $this->query .= ' FROM '.$this->from;
                if (!empty($this->join)) {
                    foreach ($this->join as $value) {
                        $this->query .=  ' ' . $value;
                    }
                }
                if (!empty($this->where)) {
                    $this->query .= ' WHERE '. implode(' AND ', $this->where);
                }
                break;
            case 'insert':
                $this->query = $this->insert;
                break;
        }
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function showQuery()
    {
        debug($this->query);
    }
}
