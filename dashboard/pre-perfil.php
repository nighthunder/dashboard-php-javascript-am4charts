<?php

require_once "../app/functions/functions.php";
require_once "../config/config2.php";
require_once '../app/model/M_Perfil.php';
use app\models\M_Perfil;

session_start();

$perfil= new M_Perfil;

$filtro_indicadores = $perfil->getIndicador2($_GET["regiao"]); 

// echo "<pre>ola";
// var_dump($filtro_indicadores);
// echo "</pre>";

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Amazônia Legal em Dados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Visão integrada do território formado pelos nove estados da Amazônia Legal">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet"></head>
    
    <!-- Main Project Dashboard stylesheet -->
    <link href="../assets/style/main2021.css" rel="stylesheet"></link>

    <!-- Main stylesheet Dashboard -->
    <link href="./assets/style/dashboard2021.css" rel="stylesheet"></link>

    <?php include_once("../template/app-header-includes.php"); ?>
    <link href="../assets/style/rodape.css" rel="stylesheet"></link>

  <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">

</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar" >
   <?php include_once("../template/app-header.php"); ?>
    </div>    
         <div class="app-main"  id="topo" name="topo">
            <?php include_once("../template/app-sidebar.php"); ?>
            </div>    <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                            <div class="page-title-wrapper">
                                    <div class="col-lg-12 text-center">
                                        <div class="page-title-heading page-title-heading-pre-perfil" style="">
                                            <h2 style="font-weight: bold;line-height:54px;margin-top: -25px;">Análise evolutiva e comparativa</h2><br/> 
        
                                        </div> 
                                        <h5 style="margin-bottom: -15px"> Indicadores Amazônia Legal e de seus estados agrupados por tema</h5>
                                        <p class="title-description">Selecione uma área e um indicador para visualizar o conteúdo.</p>                      
                                    </div>
                            </div>  
                    </div>            
                    <div class="tabs-animation" style="margin-top: -30px;">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_demografia.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Demografia</h5>
                                    <i class="fas fa-angle-down demografia" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Demografia" and !in_array(utf8_encode($f["GRUPO"]), $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, utf8_encode($f["GRUPO"]));
                                        } 

                                    }

                                    ?>    
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                          <img class="area-ico" src="../assets/images/svg/Perfil_area_educacao.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Educação</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if(utf8_encode(strtolower($f["AREA"])) == strtolower("Educação") and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_saude.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Saúde</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if(utf8_encode(strtolower($f["AREA"])) == strtolower("Saúde") and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_seguranca.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Segurança</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if(utf8_encode(strtolower($f["AREA"])) == strtolower("Segurança") and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_desenvolvimento-social.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Desenvolvimento social</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Desenvolvimento Social" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_economia.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Economia</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Economia" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                          <img class="area-ico" src="../assets/images/svg/Perfil_area_ciencia-e-tecnologia.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Ciência e tecnologia</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if(utf8_encode(strtolower($f["AREA"])) == strtolower("Ciência e Tecnologia") and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                             array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_infraestrutura.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Infraestrutura</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Infraestrutura" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_saneamento.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Saneamento</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Saneamento" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                            array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_meio-ambiente.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Meio ambiente</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];
                                    
                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Meio Ambiente" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                             array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>
                            <div class="col-sm-6 col-lg-3 text-center">
                                <div class="mb-3 card card-rounded">
                                    <div class="card-header-tab card-header card-header-1" >
                                        <img class="area-ico" src="../assets/images/svg/Perfil_area_institucional.svg"/>
                                    </div>
                                    <h5 class="card-header-title card-header-title-1">Institucional</h5>
                                    <i class="fas fa-angle-down" style=""></i>
                                    <div class="card-body card-body2">
                                    <?php 

                                    $indicadores = [];

                                    foreach($filtro_indicadores as $f){
                                        if($f["AREA"] == "Institucional" and !in_array($f["GRUPO"], $indicadores)){
                                            echo "<a class='link1' href='perfil.php?regiao=".utf8_encode($f["REGIAO"])."&area=".utf8_encode($f["AREA"])."__".$f["id"]."&indicador=".$f["INDICADOR"]."__".$f["id"]."&primeiro'><p>".utf8_encode($f["GRUPO"])."</p></a>";
                                             array_push($indicadores, $f["GRUPO"]);
                                        } 
                                    }

                                    ?> 
                                    </div>
                                </div>  
                            </div>

                           
                        </div>
                       
                    </div>
                </div>  

                <div class="app-wrapper-footer">
                    <?php include_once("../template/app-footer.php"); ?>
                </div>
    </div>
</div>
<?php include_once("../template/app-form-cadastro.php"); ?>
<?php include_once("../template/app-form-login.php"); ?>
<?php include_once("../template/app-form-recuperar-senha.php"); ?>
<?php include_once("../template/app-form-codigo-seguranca-email.php"); ?>

<div class="app-drawer-overlay d-none animated fadeIn"></div><script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script>
<script        src="https://code.jquery.com/jquery-3.5.1.min.js"
              integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous"></script>
<script type="text/javascript" src="./assets/scripts/main-perfil.js"></script>
<script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
<script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
<script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script></body>
</html>
