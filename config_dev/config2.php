<?php

/* Config do banco de dados de metadados */

$producao = true;

if ($producao){
	// colocar senha usuário e servidor de seu banco de dados
	define("SERVIDOR", "mysql.amazonialegalemdados.info");
	define("BANCO", "amazonialegale");
	define("USUARIO", "amazonialegale");
	define("SENHA","t5atrhma3jj");
}else{
	// colocar senha usuário e servidor de seu banco de dados
	define("SERVIDOR", "40.87.98.243");
	define("BANCO", "amazoniadevdata");
	define("USUARIO", "dev-al");
	define("SENHA","84BA61F222A36B22");
}

// define("SERVIDOR", "localhost");
// define("BANCO", "amazonia_legal_metadata");
// define("USUARIO", "crodemu01");
// define("SENHA","a4KtaRGvsUn8");

