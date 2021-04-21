<?php

// banco de dados de cadastro de usuários

$producao = false;

if ($producao){

	// colocar senha usuário e servidor de seu banco de dados
	define("SERVIDOR", "mysql.amazonialegalemdados.info");
	define("BANCO", "amazonialegale01");
	define("USUARIO", "amazonialegale01");
	define("SENHA","esedmFQS0hjC");

}else{
	// colocar senha usuário e servidor de seu banco de dados
	define("SERVIDOR", "mysql.crodemu.kinghost.net");
	define("BANCO", "crodemu02");
	define("USUARIO", "crodemu02");
	define("SENHA","a4KtaRGvsUn8");
}



//PRODUCAO - OCULTA ERROS
// error_reporting(0);
// ini_set('display_errors', FALSE);
// ini_set('display_startup_errors', FALSE);



