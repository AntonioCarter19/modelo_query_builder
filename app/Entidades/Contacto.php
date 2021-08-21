<?php
namespace App\Entidades;

use \App\Db\Database;
use \PDO;

class Contacto{
	//campos da tabela contactos
	public $id, $nome, $telefone, $data;


	//Método responsável por inserir um contacto no BD
	public function cadastrar(){
		$obDatabase = new Database('contactos');
		$this->data = date('Y-m-d H:i:s');
		$this->id = $obDatabase->insert(['nome' => $this->nome,
										 'telefone' => $this->telefone,
										 'data' => $this->data
									      ]);

		return true;
	}


}	