<?php

function configPHP(){
	$producao = false;
	$homologacao = false;
	$desenvolvimento = false;

	if($producao){

		define("CONTROLLER_PADRAO","index");
		define("METODO_PADRAO","index");
		define("NAMESPACE_CONTROLLER",	'app\\controllers\\');
		define("URL_BASE",	"https://amazonialegalemdados.info/");
		define("URL_LOGIN",	"https://amazonialegalemdados.info/app/views/login/");
		define("URL_DASHBOARD",	"https://amazonialegalemdados.info/app/views/dashboard/");
		define("URL_GRAPHICS",	"https://amazonialegalemdados.info/app/views/html/");

		// PRODUCAO - OCULTA ERROS
		error_reporting(0);
		ini_set('display_errors', FALSE);
		ini_set('display_startup_errors', FALSE);	

	}else if ($homologacao){

		define("CONTROLLER_PADRAO","index");
		define("METODO_PADRAO","index");
		define("NAMESPACE_CONTROLLER",	'app\\controllers\\');
		define("URL_BASE",	"http://crodemu.kinghost.net/");
		define("URL_LOGIN",	"http://crodemu.kinghost.net/app/views/login/");
		define("URL_DASHBOARD",	"http://crodemu.kinghost.net/app/views/dashboard/");
		define("URL_GRAPHICS",	"http://crodemu.kinghost.net/app/views/html/");

		// PRODUCAO - OCULTA ERROS
		error_reporting(0);
		ini_set('display_errors', FALSE);
		ini_set('display_startup_errors', FALSE);	
		
	}else if ($desenvolvimento){

		define("CONTROLLER_PADRAO","index");
		define("METODO_PADRAO","index");
		define("NAMESPACE_CONTROLLER",	'app\\controllers\\');
		define("URL_BASE",	"http://40.87.98.243/");
		define("URL_LOGIN",	"http://40.87.98.243/app/views/login/");
		define("URL_DASHBOARD",	"http://40.87.98.243/app/views/dashboard/");
		define("URL_GRAPHICS",	"http://40.87.98.243/app/views/html/");

		// PRODUCAO - OCULTA ERROS
		error_reporting(E_ALL & ~E_NOTICE);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);	
		
	}else{ // localhost
		define("CONTROLLER_PADRAO","index");
		define("METODO_PADRAO","index");
		define("NAMESPACE_CONTROLLER",	'app\\controllers\\');
		define("URL_BASE",	"http://localhost/amazonia-legal-am4chart/");
		define("URL_LOGIN",	URL_BASE."app/views/login/");
		define("URL_DASHBOARD",	URL_BASE."app/views/dashboard/");
		define("URL_GRAPHICS",	URL_BASE."app/views/html/");

		error_reporting(E_ALL & ~E_NOTICE); // LOCALHOST - EXIBE ERROS
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		
		// PRODUCAO - OCULTA ERROS
		// error_reporting(0);
		// ini_set('display_errors', FALSE);
		// ini_set('display_startup_errors', FALSE);	

		//PRODUCAO - OCULTA ERROS
		// error_reporting(0);
		// ini_set('display_errors', FALSE);
		// ini_set('display_startup_errors', FALSE);
	}
}

configPHP();

function verify_session(){ // validate if user is logged in pages that require security
	session_start();
	if( empty($_SESSION)){ // select the alowed type of users
	 	session_destroy();
	  	header("location: ".URL_BASE);
	}

	if( ($_SESSION["rule"] != "1" and $_SESSION["rule"] != "2")){
		session_destroy();
	  	header("location: ".URL_BASE);
	}
}

function verify_login(){ // verify if is there is a user logged
	
	if( empty($_SESSION)){
		return false;
	} 
	
	if ($_SESSION["rule"] != "1" and $_SESSION["rule"] != "2"){ // select the alowed type of users
	 	return false;
	}
	
	return true;

}	

// Convert a Date from yyyy-mm-dd to dd-mm-yyyy
function convertDateToBrazilDate($original_date){ //
	// Creating timestamp from given date
	$timestamp = strtotime($original_date);
	// Creating new date format from that timestamp
	$new_date = date("d/m/Y", $timestamp);
	return $new_date; // Outputs: 31-03-2019
}

function csvstr(array $fields) : string
{
    $f = fopen('php://memory', 'r+');
    if (fputcsv($f, $fields) === false) { return false;}
    rewind($f);
    $csv_line = stream_get_contents($f);
    return rtrim($csv_line);
}

// transforma um array em CSV e retorna como uma string
function array_to_csv_download($array, $delimiter=";", $qtd_colunas_array="4"){

	// Open a file in write mode ('w') 
	$fp = fopen('php://memory', 'w'); 
	$result = [];
	array_walk_recursive($array, function($item) use (&$result) {
		$result[] = $item;

	});
	fputcsv($fp, $result, $delimiter);
	rewind($fp);
	$csv_line = stream_get_contents($fp);
	$csv_line = str_replace('"',"",$csv_line);
	$csv_data = explode(";", $csv_line);
	// construção de cada linha do csv a ser impresso
	$linha = "";
	$primeiro = 1;
	$qtd = $qtd_colunas_array;
	$csv_final = "";
	foreach ($csv_data as $d) {
		$qtd_colunas_array = $qtd_colunas_array - 1;
		if ($primeiro == 1){
			$linha = $d;
			$primeiro = 0;
		}else if ($qtd_colunas_array == 0){
			$linha = $linha.";".$d."\n";
		 	echo $linha;
		 	//$csv_final  = $csv_final.$linha;
		 	$linha = "";
		 	$qtd_colunas_array = $qtd;
		 	$primeiro = 1;
		}else{
			$linha = $linha.";".$d;
		}
	}
	fclose($fp); 
}

function removeAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç)/"),explode(" ","a A e E i I o O u U n N c"),$string);
}

function removeAcentosEspacosPoeCaixaBaixa($texto){
	return str_replace(" ","-",strtolower(removeAcentos(utf8_encode($texto))));
}

// retorna "de", "da", "do"
function avaliaArtigoDe($regiao){

	$preposicao = "" ;

	switch ($regiao) {
    case "Amazônia Legal":
        $preposicao = "da";
        break;
    case "Acre":
        $preposicao = "do";
        break;
    case "Amapá":
        $preposicao = "do";
        break;
    case "Amazonas":
        $preposicao = "do";
        break;
    case "Maranhão":
        $preposicao = "do";
        break;    
    case "Mato Grosso":
        $preposicao = "de";
        break; 
    case "Pará":
        $preposicao = "do";
        break; 
    case "Rondônia":
        $preposicao = "de";
        break; 
    case "Roraima":
        $preposicao = "de";
        break; 
    case "Tocatins":
        $preposicao = "do";
        break; 
    default:
    	$preposicao = "do";
	}

	return $preposicao;
}

function fileExists($external_link){
	if (@getimagesize($external_link)) {
		return true;
		} else {
		return false;
	}
}


