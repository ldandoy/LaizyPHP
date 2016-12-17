<?php
/**
 * File system\Query.php
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */

namespace system;

/**
 * Class for managing queries
 *
 * @category System
 * @package  Netoverconsulting
 * @author   Loïc Dandoy <ldandoy@overconsulting.net>
 * @license  GNU
 * @link     http://overconsulting.net
 */
class Query
{
    /**
    * The query type ('select' | 'insert' | 'update')
    * @var string
    */
    private $queryType;

    /**
    * The query's sql text
    * @var string
    */
    private $sql = '';

    /**
    * The select part of the query
    * @var string
    */
    private $select = '';

    /**
    * From part of the query
    * @var string
    */
    private $from = '';

    /**
    * Join part of the query
    * @var string[]
    */
    private $join = array();

    /**
    * The where part of the query
    * @var string[]
    */
    private $where = array();

    /**
    * The insert part of the query
    * @var string
    */
    private $insert = '';

    /**
    * The prepared query
    * @var \PDOStatement
    */
    private $preparedStatement = null;

    /**
    * Set the query type and reset parts of the query
    */
    private function setQueryType($queryType)
    {
        $this->queryType = $queryType;
        $this->sql = '';
        $this->select = '';
        $this->from = '';
        $this->join = array();
        $this->where = array();
        $this->insert = '';
        $this->preparedStatement = null;
    }

    /**
    * Create the select part of the query
    * @param mixed $columns 'col1,col2,...' | array('col1', 'col2', ...)
    * @return \system\Query
    */
    public function select($columns = '*')
    {
        $this->setQueryType('select');

        if (is_array($columns)) {
            $this->select = 'SELECT '.explode(',', $columns);
        } else {
            $this->select = 'SELECT '.$columns;
        }

        return $this;
    }

    /**
    * Create the from part of the query
    * @param string $table
    * @param string $alias
    * @return \system\Query
    */
    public function from($table, $alias = '')
    {
        $this->from = 'FROM '.$table.rtrim(' '.$alias);
        return $this;
    }

    /**
    * Create the join part of the query
    * @param mixed $join
    *     array(
    *         'jointure' => 'LEFT JOIN' | 'RIGHT JOIN' | ...
    *         'table' => 'table1'
    *         'fkey_table' => 'table2'
    *         'fkey_column' => 'col'
    *     )
    * @return \system\Query
    */
    public function join($join)
    {
        if (is_array($join)) {
            $sqlJoin = $join['jointure'].' '.
                $join['table'].' '.
                'ON '.$join['table'].'.id = '.
                $join['fkey_table'].'.'.$join['fkey_column'];
        } else {
            $sqlJoin = $join;
        }

        $this->join[] = $sqlJoin;

        return $this;
    }

    /**
    * Create the where part of the query
    * @param mixed $join
    *     array(
    *         'column' => 'col'
    *         'operator' => '=' | '>' | ...
    *         'value' => 'val'
    *     )
    * @return \system\Query
    */
    public function where($where = '')
    {
        if (is_array()) {
            $this->where[] = $where['column'].' '.$where['operator'].' '.$where['value'];
        } else {
            $this->where[] = $where;
        }

        return $this;
    }

    /**
    * Create the insert part of the query
    * @param string $table
    * @param string[] $columns
    * @param string[] $permittedColunms
    * @return void
    */
    public function insert($table = '', $columns = array(), $permittedColunms = array())
    {
        $this->setQueryType('insert');

        $sqlColumns = array();
        $sqlParams = array();
        foreach ($columns as $c) {
            if (in_array($c, $permittedColunms)) {
                $finalColumns[] = $c;
                $sqlParams[] = ':'.$c;
            }
        }

        $this->insert = 'INSERT INTO '.$table.'('.
            implode(',', $sqlColumns).
            ') VALUES ('.
            implode(',', $sqlParams).
            ')';
    }

    /**
    * Create the sql text with all part of the query
    * @return string
    */
    public function createQuery()
    {
        switch ($this->queryType) {
            case 'select':
                if (count($this->join) > 0) {
                    $join = implode(' ', $this->join);
                } else {
                    $join = '';
                }

                if (count($this->where) > 0) {
                    $where = 'WHERE '.implode($this->where);
                } else {
                    $where = '';
                }

                $this->sql = $this->select.' '.
                    $this->from.' '.
                    ltrim($join.' ').
                    $where;

                break;

            case 'insert':
                $this->sql = $this->insert;
                break;
        }

        return $this->sql;
    }

    private function checkCreateQuery()
    {
        if ($this->sql == '') {
            $this->createQuery();
        }
    }

    /**
    */
    public function getSql()
    {
        $this->checkCreateQuery();
        return $this->sql;
    }

    public function showSql()
    {
        $this->checkCreateQuery();
        debug($this->sql);
    }

    /**
    * Execute the query
    * @param mixed $params
    * @return bool
    */
    public function execute($params = array())
    {
        $this->checkCreateQuery();

        $res = Db::prepare($this->sql);
        if ($res !== false) {
            $this->preparedStatement = $res;
            foreach ($params as $k => $v) {
                Db::bind($this->preparedStatement, $k, $v);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
    * Fetch all rows
    * @return mixed
    */
    public function fetchAll()
    {
        if ($this->preparedStatement !== null) {
            return $this->preparedStatement->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }

    /**
    * Fetch one row
    * @return mixed
    */
    public function fetch()
    {
        return $this->preparedStatement->fetch(PDO::FETCH_OBJ);
    }

    /**
    * Execute the query and fetch all rows
    * @param mixed $params
    * @return mixed
    */
    public function executeAndFetchAll($params = array())
    {
        if ($this->execute($params)) {
            return $this->fetchAll();
        } else {
            return false;
        }
    }
}
