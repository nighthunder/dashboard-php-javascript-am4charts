<?php

namespace app\models;
use app\core\Model;
require_once "../app/functions/functions.php";
require_once "../config/config2.php";
require_once '../app/model/M_Noticias.php';
// require_once '../app/model/M_Email.php';
// require_once("../assets/js/phpmailer/src/PHPMailer.php");
// require_once("../assets/js/phpmailer/src/SMTP.php");
// require_once("../assets/js/phpmailer/src/Exception.php");
use app\models\M_Noticias;
// use app\model\M_Email;
$noticias = new M_Noticias;
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Amazônia Legal em Dados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Plataforma Amazonia Legal em Dados">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="https://amazonialegalemdados.info/"/>
    <meta property="og:title" content="Amazonia Legal em Dados"/>
    <meta property="og:description" content="Portal com acesso liberado a qualquer pessoa, proporciona de forma inédita uma visão integrada dos 9 Estados da Amazônia Legal, reunindo 113 indicadores em 11 temas como ciência e tecnologia, demografia, desenvolvimento social, educação, economia, infraestrutura, institucional meio ambiente, saneamento, saúde e segurança."/>
    <meta property="og:image" content="https://amazonialegalemdados.info/assets/images/share/share_amazonia_legal_2.png"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:image:width" content="1193"/> 
    <meta property="og:image:height" content="855"/>
    <meta property="og:image" content="https://amazonialegalemdados.info/assets/images/share/share_amazonia_legal_3.png"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:image:width" content="1188"/> 
    <meta property="og:image:height" content="618"/>
    <meta property="og:image" content="https://amazonialegalemdados.info/assets/images/share/share_amazonia_legal_4.png"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:image:width" content="1192"/> 
    <meta property="og:image:height" content="426"/>
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link href="./assets/style/home2021.css" rel="stylesheet">
    <link href="./assets/style/modal.css" rel="stylesheet">
    <link href="../assets/style/rodape.css" rel="stylesheet">    
    <link href="../assets/style/main2021.css" rel="stylesheet">  
    <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/style/slideshow.css"/>
</head>
<?php include_once("../template/app-header-includes.php"); ?>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
     <?php include_once("../template/app-header.php"); ?>

    </div>    
    <div class="app-main" style="padding-top: 45px;" id="topo">
             <?php include_once("../template/app-sidebar.php"); ?>
            </div> <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                                <div class="col-lg-12 text-center">
                                    <div class="col-lg-12">
                                        <div class="page-title-heading page-title-heading-pre-perfil" style="">
                                            <h2 style="font-weight: bold;line-height:54px;margin-top: -10px;">Amazônia Legal em Dados</h2> 
                                        </div> 
                                        <h4 style="margin-bottom: -15px">Visão integrada do território formado pelos nove estados da Amazônia Legal</h4>     
                                        <p  class="title-description" style="">Acre, Amapá, Amazonas, Maranhão, Mato Grosso, Pará, Rondônia, Roraima e Tocantins</p>                      
                                    </div>
                                </div>
                         </div> 
                         <div class="col-lg-12 row col-destaques">
                             <div class="col-lg-4 card">
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_municipios.svg"/></div> 
                                <div class="data">
                                    <h6>808 municípios</h6>
                                    <p>14,5% dos muncipios do país</span>
                                </div>
                             </div>
                             <div class="col-lg-4 card">
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_territorio.svg"/></div> 
                                 <div class="data">
                                    <h6>5,1 milhões de km²</h6>
                                    <p>60% do território brasileiro</span>
                                </div>
                             </div>
                             <div class="col-lg-4 card">
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_habitantes.svg"/></div> 
                                <div class="data">
                                    <h6>29,3 milhões de habitantes</h6>
                                    <p>14% do Brasil</span>
                                </div>
                             </div>
                             <div class="col-lg-4 card">
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_cobertura_natural.svg"/></div> 
                                <div class="data">
                                    <h6>4,2 milhões de km² de área de cobertura natural</h6>
                                    <p>72% da área natural do país</span>
                                </div>
                             </div>
                             <div class="col-lg-4 card"> 
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_pib.svg"/></div>                                
                                 <div class="data">
                                    <h6>PIB de R$ 623 bilhões</h6>
                                    <p>9% do nacional</span>
                                </div>
                            </div>
                             <div class="col-lg-4 card">
                                <div class="icon-d"><img src="../assets/images/home/icones/destaque_ocupados.svg"/></div> 
                                <div class="data">
                                    <h6>11,2 milhões de ocupados</h6>
                                    <p>12% do Brasil</p>
                                </div>
                             </div>
                         </div>
                    </div>           
                    <div class="tab-content" >
                        <div class="tabs-animation" id="tab-content-1" role="tabpanel" >
                           <div class="row">
                                <div class="col-sm-12 col-lg-4 offset-lg-2 mb-lg-4">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3><a href="../dashboard/pre-perfil.php?<?php echo $_SESSION["state"]; ?>">Perfil</a></h3>
                                                    <p>Análise evolutiva e comparativa de indicadores<br/> da Amazônia Legal e de seus estados</p>
                                                </div>
                                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                </div> 
                                            </div>
                                            <div class="card-body">
                                                <!-- <a href="../dashboard/pre-perfil.php?<?php //echo $_SESSION["state"]; ?>"><img class="img-slider" src="../assets/images/home/Print_Perfil.png"/></a> -->
                                                
                                                <div class="slideshow-container">

                                                <div class="mySlides">
                                                <div class="numbertext">1 / 3</div>
                                                <img src="../assets/images/home/Perfil1.png" style="width:100%">
                                                </div>

                                                <div class="mySlides">
                                                <div class="numbertext">2 / 3</div>
                                                <img src="../assets/images/home/Perfil2.png" style="width:100%">
                                                </div>

                                                <div class="mySlides">
                                                <div class="numbertext">3 / 3</div>
                                                <img src="../assets/images/home/Perfil3.png" style="width:100%">
                                                </div>

                                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                                </div>
                                                <br>

                                                <div style="text-align:center; position:relative; z-index:999; margin:-45px auto;">
                                                <span class="dot" onclick="currentSlide(1)"></span> 
                                                <span class="dot" onclick="currentSlide(2)"></span> 
                                                <span class="dot" onclick="currentSlide(3)"></span> 
                                                </div>
                                            </div>
                                        </div>    
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3><a href="../compare/compare.php?regiao=Amazonas&regiao1=Roraima&area=Educação__485&indicador=TX_INEP_IDEB_AI_UF__485">Compare</a></h3>
                                                    <p>Visualização simultânea da análise evolutiva e<br/> comparativa de indicadores de dois estados</p>
                                                </div>
                                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                </div> 
                                            </div>
                                            <div class="card-body">
                                            <a href="../compare/compare.php?regiao=Amazonas&regiao1=Roraima&area=Educação__485&indicador=TX_INEP_IDEB_AI_UF__485"><img class="img-slider" src="../assets/images/home/Print_Compare.png"/></a>
                                            
                                        </div>
                                        </div>    
                                </div>
                                <div class="col-sm-12 col-lg-4 offset-lg-2 mb-lg-4">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3><a href="../desafios/desafios.php?regiao=<?php echo $_SESSION["state"];?>&area=todas">Desafios</a></h3>
                                                    <p> Classificação dos principais desafios a serem<br/> superados pela região e por seus estados </p>
                                                </div>
                                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                </div> 
                                            </div>
                                            <div class="card-body">
                                            <a href="../desafios/desafios.php?regiao=<?php echo $_SESSION["state"];?>&area=todas"><img class="img-slider" src="../assets/images/home/Print_Desafios.png"/>
                                            </div>
                                        </div>    
                                </div>
                                <div class="col-sm-12 col-lg-4">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3><a href="../atlas/atlas.php">Atlas</a></h3>
                                                    <p>Visualização de indicadores em mapas interativos<br/> por estado e por município</p> 
                                                </div>
                                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                </div> 
                                            </div>
                                            <div class="card-body">
                                            <a href="../atlas/atlas.php"><img class="img-slider" src="../assets/images/home/Print_Atlas.png"></a>
                                            </div>
                                        </div>    
                                </div>
                                <div class="col-sm-12 col-lg-4 offset-lg-4 mb-lg-4">
                                        <div class="mb-3 card">
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3><a href="../explore/explore.php">Explore</a></h3>
                                                    <p>Análise exploratória da relação entre indicadores<br/>estaduais e municipais</p>
                                                </div>
                                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                                </div> 
                                            </div>
                                            <div class="card-body">
                                            <a href="../explore/explore.php"><img class="img-slider" src="../assets/images/home/Print_Explore.png"></a>
                                            </div>
                                        </div>    
                                </div>
                            </div>  
                        </div>  
                    </div>
                    </div>
                    <div class="tabs-animation" id="tab-content-2" role="tabpanel" >  
                            <div class="row" style="background-color: #fff; margin-left: -45px; margin-right:0px;">  
                                <div class="col-sm-6 col-lg-12 text-center" >
                                            <div class="card-header-tab card-header">
                                                <div class="card-header-title font-size-lg font-weight-normal evolucao">
                                                    <h3>Notícias</h3>
                                                    <p class="noticias">Principais notícias da região relacionadas aos temas e indicadores da Amazônia Legal em Dados</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="news-carrousel mobile-hide" style="display:none">
                                                    <?php
                                                    $data_noticias = $noticias->getNoticias(); 
                                                    foreach ($data_noticias as $d){
                                                            echo "<div class=\"card card-noticia text-left\" style='display:inline-block'>";
                                                                echo "<div class=\"left float-left text-left\">";
                                                                    echo "<p style='display:inline-block'>".utf8_encode($d["VEICULO"])." - ".$d["DATA"]."</p>";
                                                                    echo "<h5><a target='_blank' href='http://".utf8_encode($d["LINK"])."'>".utf8_encode($d["TITULO"])."</a></h5>";
                                                                    echo "<p class=\"read-more\"><a href='http://".utf8_encode($d["LINK"])."'>Leia mais</a></p>";
                                                                echo "</div>";
                                                                echo "<div class=\"right float-right\">";
                                                                // if (fileExists($d["IMAGEM"])){
                                                                //     echo "<p><img src='".$d["IMAGEM"]."'/></p><BR/>";    
                                                                // }else{
                                                                //     echo "<p><img src='../assets/images/AML/defaultNoticia.png'/ width='32px'></p><BR/>";    
                                                                // }
                                                                echo "<p><img src='".$d["IMAGEM"]."'/></p><BR/>"; 
                                                                echo "</div>";
                                                            echo "</div>";
                                                    }     
                                                    ?>
                                                </div>
                                                <div class="news-carrousel desktop-hide">
                                                    <?php
                                                    $data_noticias = $noticias->getNoticias(); 
                                                    foreach ($data_noticias as $d){
                                                            echo "<div class=\"card card-noticia text-left\" style='display:inline-block'>";
                                                                echo "<div class=\"left float-left text-left\">";
                                                                    echo "<p style='display:inline-block'>".utf8_encode($d["VEICULO"])." - ".$d["DATA"]."</p>";
                                                                    echo "<h5><a target='_blank' href='http://".utf8_encode($d["LINK"])."'>".utf8_encode($d["TITULO"])."</a></h5>";
                                                                    echo "<p class=\"read-more\"><a href='http://".utf8_encode($d["LINK"])."'>Leia mais</a></p>";
                                                                echo "</div>";
                                                                echo "<div class=\"right float-right\">";
                                                                // if (fileExists($d["IMAGEM"])){
                                                                //     echo "<p><img src='".$d["IMAGEM"]."'/></p><BR/>";    
                                                                // }else{
                                                                //     echo "<p><img src='../assets/images/AML/defaultNoticia.png'/ width='32px'></p><BR/>";    
                                                                // }
                                                                echo "<p><img src='".$d["IMAGEM"]."'/></p><BR/>"; 
                                                                echo "</div>";
                                                            echo "</div>";
                                                    }     
                                                    ?>
                                                </div>
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
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
              integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous"></script>
<?php include_once("../template/app-form-cadastro.php"); ?>
<?php include_once("../template/app-form-login.php"); ?>
<?php include_once("../template/app-form-recuperar-senha.php"); ?>
<?php include_once("../template/app-form-codigo-seguranca-email.php"); ?>
<div class="app-drawer-overlay d-none animated fadeIn"></div><script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script><script type="text/javascript" src="./assets/scripts/main-perfil.js"></script><script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
              <script type="text/javascript" src="./assets/scripts/main-rodape.js"></script>
              <script type="text/javascript" src="../assets/scripts/main2021.js"></script>
              <script type="text/javascript" src="../assets/scripts/slideshow.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
</body>
</html>