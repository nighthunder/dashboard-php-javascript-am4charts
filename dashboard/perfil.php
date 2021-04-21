<?php

require_once "../app/functions/functions.php";
require_once "../config/config2.php";
require_once '../app/model/M_Perfil.php';
use app\models\M_Perfil;
$perfil= new M_Perfil;
session_start();
?>

    <?php 

    //$perfil->temTerritorializacao($_GET["indicador"],$_GET["regiao"]);

    if( empty($perfil->temTerritorializacao($_GET["indicador"],$_GET["regiao"])) ){
        include_once("naotemterritorializacao.php");
    }else{  
        include_once("temterritorializacao.php"); 
    } 

    ?>
