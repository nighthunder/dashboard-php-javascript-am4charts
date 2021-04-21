<?php

namespace app\models;
use app\core\Model;
require_once '../model/M_User.php';
require_once '../../config/config.php';
require_once '../functions/functions.php';
require_once '../core/Model.php';

class M_Login extends Model{

	public function __construct(){
		parent::__construct();
	}

	public function validate_account($email, $passwd){ // validate the password
		
		if ($_POST){

			$user = new M_User("user");
			$non_egxist = $user->validateEmail($email);

			if ($non_egxist == false){ // user doesn't exist
				//header("Location: ".URL_BASE."?nonexist");
				return "O usuário não existe";
			}else{

				$user_data = $user->validateUser($email, $passwd);

				if ($user_data == false){ // passwd don't match
					return "A senha está incorreta";
					//header("Location: ".URL_BASE."?nonpass");
					//return "senha incorreta";
				}else{
					session_start();

					// echo "<pre>";	
					//var_dump($non_egxist);	
					$_SESSION["name"] = utf8_encode($user_data[0]["fullname"]);
					$_SESSION["rule"] = $user_data[0]["rule_id"];
					$_SESSION["email"] = $user_data[0]["email"];
					$_SESSION["state"] = utf8_encode($user_data[0]["state"]);
					// $_SESSION["id"] = $user_data[0]["email"];
					$_SESSION["acronym"] = $user->create_avatar_acronym($user_data[0]["fullname"]);	

					return "Usuário logado";

					//header("Location: ".URL_BASE."home/home.php?regiao=".utf8_encode($_SESSION["state"]));
				}
				
			}
		}
	}

	public function loggout(){

		session_start();
		session_destroy();
		header("Location: ".URL_BASE."?loggout");

	}

}