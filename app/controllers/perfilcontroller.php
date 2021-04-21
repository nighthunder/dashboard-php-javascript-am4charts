<?php

require_once '../model/M_Perfil.php';
use app\models\M_Perfil;
require_once '../../config/config2.php';
require_once '../functions/functions.php';

$perfil = new M_Perfil;

echo "<pre>";
var_dump($_POST);
echo "</pre>";

$arquivo = $perfil->getEvolucao($_POST["regiao"],$_POST["area"],$_POST["indicador"]);

header("Location:".URL_BASE."dashboard/perfil.php?regiao=".$_POST["regiao"]."&area=".$_POST["area"]."&indicador=".$_POST["indicador"]);

?>