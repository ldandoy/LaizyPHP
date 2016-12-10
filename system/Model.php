<?php

	namespace system;

	use \PDO;
	use system\Config;

	class Model {

		static $db;
		private $tableName;
		private $sql = "";
		private $pre;
		private $where;

		public function __construct () {
			if (!isset(Model::$db)) {
				try {
					Model::$db = new PDO('mysql:host='.Config::getValueDB('URL').';dbname='.Config::getValueDB('DB').';charset='.Config::getValueDB('CHARSET'), Config::getValueDB('USER'), Config::getValueDB('PASSWORD'));
				} catch (Exception $e) {
					die('Erreur : ' . $e->getMessage());
				}
			}
			$this->tableName = strtolower(get_class($this)."s");
		}

		public function getTableName() {
			return $this->tableName;
		}

		public function findAll() {
			$this->queryBuilder('*');

			if (isset($this->parent) && empty($this->parent)) {
				echo "Passer";
			} else {
				return $this->pre->fetchAll(PDO::FETCH_OBJ);
			}
		}

		public function findById($id) {
			$this->queryBuilder('*', array(
				0 => array(
					'name'		=> 'id',
					'value' 	=> (int)$id,
					'condition' => '='
				)
			));

			return $this->pre->fetch(PDO::FETCH_OBJ);
		}

		public function condition($execute = true) {
			if (isset($this->where) && is_array($this->where)) {
				$this->sql .= " WHERE ";
				$compteur = 0;
				foreach ($this->where as $value) {
					if ($compteur != 0) {
						$this->sql .= " AND " . $value['name'] . " ".$value['condition']." :". $value['name'];
					} else {
						$this->sql .= " " . $value['name'] . " = :". $value['name'];
					}
					$compteur ++;
				}
			}
			if ($execute === true) {
				$this->execute();
			}
		}

		public function select($champs = '*') {
			$this->sql .= "SELECT * FROM ";
		}

		public function queryBuilder ($champs = '*', $where=null) {
			$this->select($champs);
			$this->sql .= $this->tableName;
			$this->where = $where;
			$this->condition();
		}

		public function execute() {
			$this->pre = Model::$db->prepare($this->sql);
			if (isset($this->where) && is_array($this->where)) {
				foreach ($this->where as $value) {
					switch (gettype($value['value'])) {
						case 'integer':
							$type = PDO::PARAM_INT;
							break;
						case 'string':
							$type = PDO::PARAM_STR;
							break;
					}
					$this->pre->bindParam(':'.$value['name'], $value['value'], $type);
				}
			}
			$this->pre->execute();
		}

		public function showLastRequest() {
			var_dump($this->sql);
		}
	}