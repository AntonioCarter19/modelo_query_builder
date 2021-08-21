<?php
namespace App\Db;

use \PDO;
use \PDOException;

class Database{
	//constantes para a conexão com a BD
	const HOST="localhost", DBNAME="crud_contactos", USER="root", PASS="";
	private $table, $connection;


	public function __construct($table = null){
		$this->table = $table;
		$this->setConnection();
	}

	//método responsável por fazer a conexão com o banco de dados
	private function setConnection(){
		try {
			$this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME.';charset=utf8', self::USER, self::PASS);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e) {
			die('Ocorreu Um Erro: '.$e->getMessage());
		}
	}

	//Método responsável pela execução de uma query
	public function execute($query, $params = []){
		try {
			$statement = $this->connection->prepare($query);
			$statement->execute($params);

			return $statement;

		}catch(PDOException $e) {
			die('Ocorreu Um Erro: '.$e->getMessage());
		}
	}


	//Método responsável pela inserção e retornar o último ID inserido
	public function insert($values){
		$fields = array_keys($values);
		$binds = array_pad([], count($fields), '?');

		$query = "INSERT INTO ". $this->table."(".implode(',', $fields).") VALUES(".implode(',', $binds).")";
		$this->execute($query, array_values($values));

		return $this->connection->lastInsertId();
	}


	//Método responsável por actualizar um registro
	public function update($where, $values){
		$fields = array_keys($values);

		$query = "UPDATE ".$this->table." SET ".implode('=?,', $fields)."=? WHERE ".$where;

		$this->execute($query, array_values($values));

		return true;
	}



}