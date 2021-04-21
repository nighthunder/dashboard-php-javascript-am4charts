<?php

require_once '../model/M_Perfil.php';
require_once '../model/M_Destaques.php';
use app\models\M_Perfil;
use app\models\M_Destaques;
require_once '../../config/config2.php';
require_once '../functions/functions.php';

$perfil = new M_Perfil;
$destaques = new M_Destaques;

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$arquivo = $destaques->getEvolucao($_POST["regiao"],$_POST["area"],$_POST["indicador"]);

header("Location:".URL_BASE."dashboard/perfil.php?regiao=".$_POST["regiao"]."&area=".$_POST["area"]."&indicador=".$_POST["indicador"]);

?>