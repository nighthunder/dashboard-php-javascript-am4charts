<?php

namespace app\core;
require_once "../../config/config.php";

abstract class Model{
	protected $db;

	public function __construct(){
		$this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);

		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	}

}

?>