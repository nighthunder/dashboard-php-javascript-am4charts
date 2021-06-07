<?php

require_once '../app/model/graphics/M_Chart.php';
use app\models\M_Chart;

// $user = new M_User();
// $user->lista();
// $c1 = new M_Chart("evolucao", "TX_PNAD_CRECHE_0_3_UF","360","Mato Grosso","Educação"); //gera todos os gráficos do indicador
// $c2 = new M_Chart("evolucao", "TX_DATASUS_MORT_INFANTIL_UF","360","Amazônia Legal","Saúde"); //gera todos os gráficos do indicador
// $c3 = new M_Chart("evolucao", "TX_PNAD_POP_UF","360","Amazônia Legal","Demografia"); //tem pyramid
// $c4 = new M_Chart("evolucao", "TX_DATASUS_DCNT_30_69_UF","360","Amazônia Legal","Saúde"); //bar stalked
// $c5 = new M_Chart("evolucao", "TX_DATASUS_MORT_INFANTIL_UF","360","Rondônia","Saúde"); //bar stalked com aberturas
// $c6 = new M_Chart("evolucao", "TX_IBGE_PIB_CONSTANTE_UF","360","Amazônia Legal","Economia"); //bar stalked com aberturas

$indicador = explode("__", $_GET["indicador"]);
$area = explode("__", $_GET["area"]);

// var_dump($_GET);
if (!$indice){
    $indice = 0;
}

if ($_GET["regiao1"]){ // é no compare
    $regiao = explode("__", $regiao);
    $pagina = "compare";
    new M_Chart($pagina, $secao, $indicador[0], "400px", $regiao[0], $area[0], $indice);
}else{
    $pagina = "perfil";
    $regiao = explode("__", $_GET["regiao"]);
    new M_Chart($pagina, $secao, $indicador[0], "400px", $regiao[0], $area[0], $indice);
}

// echo $indicador[0];
// echo $area[0];
// var_dump($regiao);


?>
