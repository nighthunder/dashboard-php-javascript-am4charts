<?php

require_once "../app/functions/functions.php";
require_once "../config/config2.php";
require_once '../app/model/M_Destaques.php';
require_once '../app/model/M_Perfil.php';
use app\models\M_Destaques;
use app\models\M_Perfil;
session_start();
$destaques = new M_Destaques; 
$perfil = new M_Perfil; 
$filtro_areas = $perfil->getArea(); // Area filtro 
$filtro_regioes = $perfil->getRecorteGeografico(); // Regiao filtro
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
    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link href="../assets/style/rodape.css" rel="stylesheet">
    <link href="./assets/style/modal.css" rel="stylesheet">
    <link href="./desafios2021.css" rel="stylesheet">
    <link href="../assets/style/main2021.css" rel="stylesheet">
  <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <?php include_once("../template/app-header-includes.php"); ?>
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
                                <div class="row row-especial" style="float: left">
                                    <div class="col-lg-6">
                                        <div class="page-title-heading">
                                            <h2>Desafios</h2>  
                                        </div>                              
                                    </div> 
                                    <div class="col-lg-6 page-title-actions text-right float-right"> 
                                        <script>
                                            var _subject = encodeURI("Conheça o perfil do indicador - Plataforma Amazônia Legal");
                                            var _body = encodeURIComponent("Um amigo está te recomendando a página do indicador: ");
                                            var _url = encodeURIComponent(window.location.href);
                                            var _body2 = encodeURIComponent("\n ============================================= \n Este email foi enviado via Plataforma da Amazônia Legal. \"A região da Amazônia Legal corresponde a cerca de 60% do território brasileiro e 28,2 milhões de habitantes correspondendo a 14% do total nacional e é formada por estados e 808 municípios.\" \n ")

                                            function enviarEmail(){
                                               window.location.href='mailto:mail@example.org?subject='+_subject+'&body='+_body+_url+_body2;
                                            }
                                        </script>
                                        <a class="link-indicador" href="#" onclick="javascript: enviarEmail()">    
                                        <img class="btn-email" src="../assets/images/svg/Enviar_Email.svg" alt="Enviar a página por e-mail"></a>
                                    </div>                          
                                    <div class="col-lg-12 col-sm-12">
                                     <form class="" id="form-search" method="GET" action="./desafios.php" >
                                        <div class="form-row">
                                                <input type="hidden" id="group_id" value=""></input>
                                                <div class="col-md-3 col-lg-2 mr-5">
                                                        <div class="position-relative form-group">
                                                        <img class="filtro-ico" src="../assets/images/svg/filtro-recorte-geografico.svg"/>
                                                        <select name="regiao" id="opt_regiao" class="form-control form-control-1">
                                                            <!--  <option value="" disabled selected hidden>&nbsp;Recorte geográfico</option> -->

                                                            <?php 
                                                            sort($filtro_regioes); 
                                                            foreach ($filtro_regioes as $regiao){
                                                                 echo "<option value='".utf8_encode($regiao["REGIAO"])."'>&nbsp;".utf8_encode($regiao["REGIAO"])."</option>";
                                                            }
                                                            ?>
                                                        </select></div>
                                                </div>
                                                <div class="col-md-3 col-lg-3 ml-5 mr-5">
                                                        <div class="position-relative form-group">
                                                        <img class="filtro-ico" src="../assets/images/svg/filtro-area.svg"/>    
                                                        <select name="area" id="opt_area" class="form-control form-control-2">
                                                        <option value="todas" disabled selected hidden>Área</option>
                                                        <?php            
                                                            $areas = []; // áreas do Amazônia Legal das regiões
                                                            $area_atual = "";
      
                                                            foreach ($filtro_areas as $ind){

                                                                $id_grupo = $perfil->getAreaRegiaoID(utf8_encode($ind["AREA"]),utf8_encode($ind["REGIAO"]));


                                                                if(utf8_encode($ind["REGIAO"]) != $area_atual and $area_atual != ""){
                                                                    echo "</optgroup>";
                                                                }

                                                                if (!in_array(utf8_encode($ind["REGIAO"]), $areas)){
                                                                    echo "<optgroup label = '".utf8_encode($ind["REGIAO"])."'>";
                                                                    $area_atual = utf8_encode($ind["REGIAO"]);
                                                                    array_push($areas, $area_atual);
                                                                }

                                                                    echo "<option data-region='".utf8_encode($ind["REGIAO"])."' value='".utf8_encode($ind["AREA"])."'>".utf8_encode($ind["AREA"])."</option>";
                                                            }
                                                            ?>
                                                        </select></div>
                                                </div>
                                                <div class="col-md-3 col-lg-1 ml-5 position-relative row form-check btn-pesquisar">
                                                    <div class="col-sm-11 col-lg-11 offset-lg-1">
                                                        <button class="btn btn-secondary bg-bordo btn-pesquisar-1">Pesquisar</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </form>
                                </div>  
                            </div>  
                        </div>
                        <div>

                        </div>    

                    </div>            
                    <div class="tabs-animation">
                        <div class="row">
                            <div class="col-sm-12 col-lg-8 text-center desafio-texto" style="margin:auto; max-width: 700px;">
                                <div class="mb-3 card">
                                    <div class="card-header-tab card-header">
                                        <div class="card-header-title font-size-lg font-weight-normal text-center">
                                            <h4 class="header-1">Quais são os desafios <?php echo avaliaArtigoDe($_GET["regiao"]); ?> <?php echo $_GET["regiao"]; ?>? </h4>
                                        </div>
                                    </div>
                                    <div class="card-body card-body-grande">
                                       
                                        <p class="sub-header"> Classificação de 35 indicadores selecionados em seis grupos de desafios definidos a partir da comparação com valor atual e com a variação média do país</p>
                                        <span> Selecione o indicador para visualizar o detalhamento </span>
                                    </div>        
                                </div>                  
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 ">
                            <div class="mb-3 card setas-hierarquia "></div>    
                        </div>
                        <div class="row row-desafios">    
                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="mb-3 card card-desafio bo-bordo">
                                        <div class="card-header bg-bordo text-center">
                                            <h6>Defasagem crítica</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li>Pior que a média Brasil</li>
                                                <li>Piorou ou estagnou na década</li>
                                            </ul> 
                                                
                                        </div>    
                                    </div>

                                </div>                                
                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="mb-3 card card-desafio bo-marrom">
                                        <div class="card-header bg-marrom text-center">
                                            <h6>Defasagem em ampliação</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li>Pior que a média Brasil</li>
                                                <li>Melhorou menos que a média Brasil na década</li>
                                            </ul>      
                                        </div> 
                                    </div>
 
                                </div>                                 
                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="mb-3 card card-desafio bo-laranja">
                                        <div class="card-header bg-laranja text-center">
                                            <h6>Defasagem em redução</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li>Pior que a média Brasil</li>
                                                <li>Melhorou mais que a média Brasil na década</li>
                                            </ul>   
                                        </div>  
                                    </div>

                                </div>                                 
                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="mb-3 card card-desafio bo-laranja-claro ">
                                        <div class="card-header bg-laranja-claro text-center">
                                            <h6>Vantagem em degradação</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li class="pdth-2">Melhor que a média Brasil</li>
                                                <li>Piorou ou estagnou na década</li>
                                            </ul>    
                                        </div>
                                    </div>
  
                                </div> 
                                <div class="col-sm-6 col-lg-2">
                                    <div class="mb-3 card card-desafio bo-azul">
                                        <div class="card-header bg-azul text-center">
                                            <h6>Vantagem em Redução</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li class="pdth-2">Melhor que a média Brasil</li>
                                                <li>Melhorou menos que a média Brasil na década</li>
                                            </ul>   
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-sm-6 col-lg-2 ">
                                    <div class="mb-3 card card-desafio bo-verde">
                                        <div class="card-header bg-verde text-center">
                                            <h6>Vantagem em ampliação</h6>
                                        </div>                                        
                                        <div class="card-body">
                                            <ul class="ul-card">
                                                <li class="pdth-2">Melhor que a média Brasil</li>
                                                <li>Melhorou mais que a média Brasil na década</li>
                                            </ul>
                                        </div>  
                                        
                                    </div>

                                </div>     
                        </div>
                        <div class="row">        
                                <div class="col-sm-6 col-lg-2 ">
                                    <?php 

                                    if ($_GET["area"] != "todas"){

                                           if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],1))){

                                            $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],1);

                                            $vez = 1;

                                            $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                            echo "<div class=\"setas seta-bordo\"></div>";

                                            foreach ($destaque as $d){

                                                if ($vez == 1){
                                                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-bordo-fraco\">
                                                            <div class=\"card-header bg-bordo-fraco\">
                                                            <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                            <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                    $vez++; 
                                                }
                                          
                                                echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";
                                           
                                            }
                                            echo  "</ul></div></div>";
                                         }  

                                    }else{
                                            $destaques->getTodosDestaques($_GET["regiao"],1,"bordo");
                                    }
                                    ?>  
                                </div>                                
                                <div class="col-sm-6 col-lg-2 ">
                                    <?php 
                                    if ($_GET["area"] != "todas"){
                                        if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],2))){

                                        $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],2);

                                        $vez = 1;

                                        $indicadores = [];

                                        $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                        echo "<div class=\"setas seta-marrom\"></div>";

                                        foreach ($destaque as $d){

                                            if ($vez == 1){
                                                echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-marrom-fraco\">
                                                        <div class=\"card-header bg-marrom-fraco \">
                                                        <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                        <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                $vez++; 
                                            }

                                            if (!in_array(utf8_encode($d["INDICADOR"]), $indicadores)){

                                            echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";

                                            array_push($indicadores, utf8_encode($d["INDICADOR"]));
                                       

                                            }

                                        }

                                        echo  "</ul></div></div>";
                                    } 

                                    }else{
                                         $destaques->getTodosDestaques($_GET["regiao"],2,"marrom");
                                    }    
                                     
                                    ?>   
    
                                </div>                                 
                                <div class="col-sm-6 col-lg-2 ">
                                    <?php 
                                        if ($_GET["area"] != "todas"){
                                            if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],3))){

                                            $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],3);

                                            $vez = 1;

                                            $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                            echo "<div class=\"setas seta-laranja-escuro\"></div>";

                                            foreach ($destaque as $d){

                                                if ($vez == 1){
                                                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-laranja-escuro-fraco\">
                                                            <div class=\"card-header bg-laranja-escuro-fraco \">
                                                            <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                            <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                    $vez++; 
                                                }
                                          
                                                echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";
                                           
                                            }

                                            echo  "</ul></div></div>";
                                         }    
                                        }else{
                                           $destaques->getTodosDestaques($_GET["regiao"],3,"laranja-escuro");
                                        }
                                    ?>   
                                </div>                                 
                                <div class="col-sm-6 col-lg-2 ">
                                    <?php
                                    if ($_GET["area"] != "todas"){   
                                        if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],4))){

                                            $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],4);

                                            $vez = 1;

                                            $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                            echo "<div class=\"setas seta-laranja-claro\"></div>";

                                            foreach ($destaque as $d){

                                                if ($vez == 1){
                                                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-laranja-claro-fraco\">
                                                            <div class=\"card-header bg-laranja-claro-fraco \">
                                                            <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                            <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                    $vez++; 
                                                }
                                          
                                                echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";
                                           
                                            }

                                            echo  "</ul></div></div>";
                                        } 
                                    }else{
                                        $destaques->getTodosDestaques($_GET["regiao"],4,"laranja-claro");
                                    }       
                                    ?>   
                                </div> 
                                <div class="col-sm-6 col-lg-2">
                                    <?php 
                                    if ($_GET["area"] != "todas"){  
                                        if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],5))){

                                            $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],5);

                                            $vez = 1;

                                            $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                            echo "<div class=\"setas seta-azul\"></div>";

                                            foreach ($destaque as $d){

                                                if ($vez == 1){
                                                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-azul-fraco\">
                                                            <div class=\"card-header bg-azul-fraco \">
                                                            <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                            <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                    $vez++; 
                                                }
                                          
                                                echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";
                                           
                                            }

                                            echo  "</ul></div></div>";
                                        } 
                                    }else{
                                         $destaques->getTodosDestaques($_GET["regiao"],5,"azul");
                                    }       
                                    ?>   
                                </div> 
                                <div class="col-sm-6 col-lg-2 ">
                                    <?php 
                                    if ($_GET["area"] != "todas"){  
                                        if (!empty($destaques->getDestaques($_GET["regiao"],$_GET["area"],6))){

                                            $destaque = $destaques->getDestaques($_GET["regiao"],$_GET["area"],6);

                                            $vez = 1;

                                            $d1 = $destaques->getIDCombinacaoAreaRegiao($_GET["area"],$_GET["regiao"]);

                                            echo "<div class=\"setas seta-verde\"></div>";

                                            foreach ($destaque as $d){

                                                if ($vez == 1){
                                                    echo "<div class=\"mb-3 card card-desafio card-area card-indicadores bo-verde-fraco\">
                                                            <div class=\"card-header bg-verde-fraco \">
                                                            <img class=\"area-icone\" src=\"../assets/images/destaques/area-".removeAcentosEspacosPoeCaixaBaixa($d["AREA"]).".svg\"/>
                                                            <h6>".utf8_encode($d["AREA"])."</h6></div> ";
                                                    echo "<div class=\"card-body\"><ul class=\"ul-card\">";
                                                    $vez++; 
                                                }
                                          
                                                echo "<a class=\"link-indicador\" href='../dashboard/perfil.php?regiao=".utf8_encode($d["REGIAO"])."&area=".utf8_encode($d["AREA"])."__".$d1[0]["id"]."&indicador=".utf8_encode($d["INDICADOR_NOME"])."__".$d1[0]["id"]."'><li>".utf8_encode($d["INDICADOR"])."</li></a>";
                                           
                                            }

                                            echo  "</ul></div></div>";
                                        }    
                                    }else{
                                        $destaques->getTodosDestaques($_GET["regiao"],6,"verde");
                                    }   
                                    ?>   
                                </div>     
                        </div>
                       
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <?php include_once("../template/app-footer.php"); ?>
                </div>    </div>
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
              <script type="text/javascript" src="./assets/scripts/main-perfil.js"></script><script type="text/javascript" src="./assets/scripts/main-rodape.js"></script>
                <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
</body>
</html>
