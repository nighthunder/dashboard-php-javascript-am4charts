<?php

namespace app\models;
use app\core\Model;
use PDO;

class M_Noticias{

	public function __construct(){
		$this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
    }
    
    public  function getNoticias(){
        
		$sql = "SELECT * from home_noticias;";
		$qry = $this->db->query($sql);
		if (! ($qry == false)){
			$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
		}

		return $qry;
    }



}