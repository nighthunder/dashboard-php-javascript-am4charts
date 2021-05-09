<?php

/* Esta classe é usada pela página de administração do usuário */

namespace app\models;
use app\core\Model;
use PDO;
// require_once '../../config/config.php';
// require_once '../functions/functions.php';
// require_once '../core/Model.php';

class M_User2{

	public $avatar_acronym; // user real complete name acronym. Ex: Mayara Morais is MM

	public function __construct(){

		$this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
		//parent::__construct();
	}

	public function lista(){
		$sql = "SELECT * FROM user";
		$qry = $this->db->query($sql);

		return $qry->fetchAll();
	}

	public function validateEmail($email){
		$sql = "SELECT email FROM user where email='".$email."'";
		// echo $sql;
		$qry = $this->db->query($sql);
		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}
		// var_dump($qry);
		return $qry;
	}

	public function validateUser($email,$passwd){
		// $sql = "SELECT id, rule_id, nick, fullname, email, passwd, (select name from state where state.id = user.state_id) as state  FROM user where email='".$email."' and passwd = md5(".$passwd.")";
		$sql = "SELECT id, state, rule_id, nick, fullname, email, passwd  FROM user where email='".$email."' and passwd = md5(".$passwd.")";
		// echo $sql;
		$qry = $this->db->query($sql);
		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}
		return $qry;
	}

	function create_avatar_acronym($name){ // create a acronym name avatar image based on user complete name

		$name_parts = explode(" ",$name);

		return strtoupper($name_parts[0][0].$name_parts[sizeof($name_parts)-1][0]); //last

	}

	function getAvatarAcronym(){
		return $this->avatar_acronym;
	}

	function getUserData($email){

		session_start();

		$sql = "SELECT *  FROM user where email = '".$_SESSION["email"]."';";

		//echo $sql;
		
		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}

		return $qry;
	}

	function getUserSexes($email){
		$sql = "SELECT sex from user where email like '%".$email."%'";

		$qry = $this->db->query($sql);

		if (! ($qry == false)){
			$qry = $qry->fetchAll();
		}

		return $qry;
	}

	function createUser($userdata){

		$sql = "SELECT fullname FROM user where email = '".$userdata["email"]."';";
		$qry = $this->db->query($sql);

		if($qry){
			if ($qry->rowCount() > 0){
				return "Usuário já existe";
			}
		}

		if ($userdata["politicaPrivacidade"] === "on"){
			$userdata["politicaPrivacidade"] = 'S';
		}

		$sql = "INSERT INTO user (`id`, `office_id`, `rule_id`, `state_id`, `position_id`, `email`, `fullname`, `passwd`, `address`, `zip_code`, `phone`, `birth_date`, `sex`, `nick`, `activity`, `institution`, `office`, `state`, `county`, `newsletter`,`lgpd`,`create_date`)
		 VALUES (DEFAULT, '1', '2', '1', '1','".utf8_decode($userdata["email"])."','".utf8_decode($userdata["nomeCompleto"])."',md5(".$userdata["senha"]."),NULL,NULL,NULL,NOW(),'feminino',NULL,'".utf8_decode($userdata["atividade"])."','".utf8_decode($userdata["instituicao"])."','".utf8_decode($userdata["cargo"])."','".utf8_decode($userdata["estado"])."','".utf8_decode($userdata["municipio"])."','".utf8_decode($userdata["politicaEmail"])."','"
		 .$userdata["politicaPrivacidade"]."', now())";
		//echo $sql;
		$qry = $this->db->query($sql);

		if ($qry){
			session_start();
			$_SESSION["name"] = utf8_encode($userdata["nomeCompleto"]);
			$_SESSION["state"] = $userdata["estado"];
			$_SESSION["state"] = $userdata["estado"];
			$_SESSION["name"] = $userdata["nomeCompleto"];
			$_SESSION["email"] = $userdata["email"];
			$_SESSION["rule"] = "2";
			$_SESSION["acronym"] = $this->create_avatar_acronym($userdata["nomeCompleto"]);
			return "Usuário criado";
		}
	}

	function updateUserData($userdata){

		echo "<pre>";
		var_dump($userdata);
		echo "</pre>";
		session_start();
		$birth_date = explode("/",$userdata["birth_date"]);
		$birth_date = 	$birth_date[2]."-".$birth_date[1]."-".$birth_date[0];
		$sql = "UPDATE user set address =\"".$userdata["address"]."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set zip_code =\"".$userdata["zip"]."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set phone = \"".$userdata["phone"]."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set fullname = \"".utf8_decode($userdata["firstname"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set sex = \"".$userdata["selectSex"]."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set birth_date = \"".$birth_date."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set activity = \"".utf8_decode($userdata["selectActivity"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set institution = \"".utf8_decode($userdata["institution"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set county = \"".utf8_decode($userdata["county"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set office = \"".utf8_decode($userdata["office"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set state = \"".utf8_decode($userdata["selectState"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set newsletter = \"".utf8_decode($userdata["newsletter"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set funcionalidade = \"".utf8_decode($userdata["funcionalidade"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "UPDATE user set indicador = \"".utf8_decode($userdata["indicador"])."\" where email = '".$_SESSION["email"]."';";
		$qry = $this->db->query($sql);
		$sql = "Select name from state where id = ".$userdata["selectState"];
		$qry = $this->db->query($sql);
		$_SESSION["state"] = $userdata["selectState"];
		$_SESSION["name"] = utf8_decode($userdata["firstname"]);
		$_SESSION["acronym"] = $this->create_avatar_acronym($userdata["firstname"]);

		header("Location:".URL_BASE."/admin/atualizar-cadastro.php?updated");
	}

	function updatePasswd($email, $newpasswd){
		$sql = "UPDATE user set passwd = md5(".$newpasswd.") where email ='".$email."';";
		$qry = $this->db->query($sql);
		if (! ($qry == false)){$qry = $qry->fetchAll();}
		return $qry;
	}

	function contactForm($email){
		$sql = "INSERT into contact_form (id,email,create_date,ip) values (DEFAULT, '".$email."', now(),'".$_SERVER['REMOTE_ADDR']."')";
		//echo $sql;
		$qry = $this->db->query($sql);
		if (!$qry){
			echo "\nPDO::errorInfo():\n";
			print_r($this->db->errorInfo());
		}
		if (! ($qry == false)){$qry = $qry->fetchAll();}
		return $qry;
	}

	function contactQuestions($esfera, $segmento, $estado){ # modal formulário de perguntas da home
		$sql = "INSERT into contact_questions (id,estado, esfera, segmento,ip, email, create_date) values (DEFAULT, '".$estado."','".$esfera."','".$segmento."','','".$_SERVER['REMOTE_ADDR']."', now())";
		//echo $sql;
		//print($sql);
		$qry = $this->db->query($sql);
		if (!$qry){
			echo "\nPDO::errorInfo():\n";
			print_r($this->db->errorInfo());
		}
		if (! ($qry == false)){$qry = $qry->fetchAll();}
		return $qry;
	}


}