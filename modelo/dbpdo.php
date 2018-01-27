<?php

class DBPDO{
	//Datos de la Conexión
	private $host = 'localhost';	
	private $user = 'root';
	private $pass = '123';
	private $dbname = 'examen_resuelto';
	private $table;

	//Contendrá el error en caso de producirse
	public $errors = false;

	//La conexión a la BD
	private $db;

	//Indica en que modo estamos (DEV o PRO)
	public $modeDEV = true;

	//Indica si queremos una conexión persistente o no
	private $persistent = true;

	public function __construct($table)
	{
		$this->table = $table;
		$this->db = $this->connection();
	}

	private function connection()
	{
		$dsn = 'mysql:host=' . $this->host . 			    
			   ';dbname=' . $this->dbname;

		$options = [ PDO::ATTR_PERSISTENT => $this->persistent,
					 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
				   ];

		try {

			return new PDO($dsn, $this->user, $this->pass, $options);
		
		} catch(PDOException $e) {

			$this->errors = $e->getMessage();
			if ($this->modeDEV) {
				print_r($this->errors);
			}
		}
	}

	public function getConnection()
	{
		return $this->db;
	}

	public function setDBPassword($pass)
	{
		$this->pass = $pass;
		$this->connection();
	}

	public function setDBHost($host)
	{
		$this->host = $host;
		$this->connection();
	}	

	public function setDBUser($user)
	{
		$this->user = $user;
		$this->connection();
	}

	public function setDBName($dbname)
	{
		$this->dbname = $dbname;
		$this->connection();
	}

	public function setDB($data)
	{
		$this->dbname = $data['dbname'];
		$this->host = $data['host'];
		$this->user = $data['user'];
		$this->pass = $data['pass'];		

		$this->connection();
	}

	public function all($limit = 10)
	{
		$prepare = $this->db->prepare('SELECT * 
									   FROM ' . $this->getTable() .
									  ' LIMIT ' . $limit
									 );
		$prepare->execute();

		$this->setQuery($prepare);

		return $prepare->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($params)
	{
		if ( ! empty($params)) {

			$fields = '(' . implode(',', array_keys($params)) . ')';

			$values = "(:" . implode(",:", array_keys($params)) . ")";
			

			$ssql =  'INSERT INTO ' .
					  $this->getTable() . ' ' . $fields . 
					 ' VALUES ' . $values;

			$prepare = $this->db->prepare($ssql);

			$prepare->execute($this->normalizePrepareArray($params));

			$this->setQuery($prepare);

			return $this->db->lastInsertId();

		} else {
			throw new Exception('Los parámetros están vacíos');
		}
	}

	public function getTable(){
		return $this->table;
	}

	public function setTable($table){
		$this->table = $table;
	}

	public function setQuery($sql)
	{
		if ($this->modeDEV) {
			$sql->debugDumpParams();
		}
	}

	private function normalizePrepareArray($params)
	{
		foreach ($params as $key => $value) {
			$params[':' . $key] = $value;
			unset($params[$key]);
		}

		return $params;
	}

	public function update($params, $where)
	{
		if ( ! empty($params)) {

			$fields = '';
			foreach ($params as $key => $value) {
				$fields .= $key . ' = :' . $key . ', ';
			}
			$fields = rtrim($fields, ', ');

			$key = key($where);
			$value = $where[$key];

			$ssql = 'UPDATE ' . $this->getTable() . 
				    ' SET ' . $fields .
				    ' WHERE ' . $key . '=' . $value;

			$prepare = $this->db->prepare($ssql);

			$prepare->execute($this->normalizePrepareArray($params));

			$this->setQuery($prepare);

		} else {

			throw new Exception('Los parámetros están vacíos');

		}
	}
	
	public function delete($where)
	{

		if ( ! empty($where)) {

			$key = key($where);

			$ssql = 'DELETE FROM ' . $this->getTable() . 
					' WHERE ' . $key . '=:' . $key;

			$prepare = $this->db->prepare($ssql);

			$prepare->execute($this->normalizePrepareArray($where));

			$this->setQuery($prepare);

		} else {

			throw new Exception('Los parámetros están vacíos');

		}

	}

	public function getID($id)
	{

		$ssql = 'SELECT * FROM ' . $this->getTable() .
				' WHERE id=' . $id;

		$prepare = $this->db->prepare($ssql);
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_ASSOC);

	}
	public function select($where){
		if ( ! empty($where)) {

			$key = key($where);

			$value = $where[$key];

			$ssql = 'SELECT * FROM ' . $this->getTable() . 
					' WHERE ' . $key . '=\'' . $value.'\'';

			$prepare = $this->db->prepare($ssql);

			$prepare->execute();

			$this->setQuery($prepare);

			return $prepare->fetchAll(PDO::FETCH_ASSOC);

		} else {

			throw new Exception('Los parámetros están vacíos');

		}
	}

}









