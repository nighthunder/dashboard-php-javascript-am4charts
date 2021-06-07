<?php

// echo "teste";

require_once "../app/functions/functions.php";
require_once "../config/config2.php";

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <title>Atlas</title>

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <!-- ============================================ imports bibliotecas JS ============================================ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
    <script src="https://unpkg.com/ol-layerswitcher@3.6.0"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script src="./assets/scripts/domToImage.js"></script>
    <script src="./assets/scripts/html2canvas.js"></script>
    <!-- ================================================================================================================ -->
    
    <script src="https://d3js.org/d3.v4.min.js"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> -->
    

    <!-- ============================================ imports bibliotecas CSS ============================================ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css">
    <link rel="stylesheet" href="https://unpkg.com/ol-layerswitcher@3.6.0/src/ol-layerswitcher.css" />
    <!-- ================================================================================================================= -->

    <!-- ============================================ imports CSS ============================================ -->
    <link rel="stylesheet" href="map.css">
    <link href="../assets/style/modal.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/rodape.css">
    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style/main.css">
    <link rel="stylesheet" href="./assets/style/downloadMapa.css">
    <link rel="stylesheet" href="../assets/style/main2021.css">
    <!-- ===================================================================================================== -->    
    <div class="app-drawer-overlay d-none animated fadeOut"></div><script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script>
    <link href="./rodape.css" rel="stylesheet"></link>
</head>

<?php include_once("../template/app-header-includes.php"); ?>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <?php include_once("../template/app-header.php"); ?>
    </div>    
    <div class="app-main">
        <?php include_once("../template/app-sidebar.php"); ?>
    </div>    
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="row" style="float: left">
                        <div class="col-lg-12">
                            <div class="page-title-heading">
                                <h1 class="title-atlas col-lg-6">Atlas</h1> 
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
                                        <a href="#" onclick="javascript: enviarEmail()">    
                                        <img class="btn-email" src="../assets/images/svg/Enviar_Email.svg" alt="Enviar a página por e-mail"></a>
                                    </div>                             
                            </div>
                            <button class="btn btn-secondary bg-bordo rpa reionalizacao"> REGIONALIZAÇÃO POLÍTICO-ADMINISTRATIVA</button>
                            <button class="btn btn-secondary bg-bordo rqa reionalizacao"> REGIONALIZAÇÃO QUATRO AMAZÔNIAS</button>
                            <div class="ambos"></div>
                            <div class="rpaHR"></div>
                            <div class="rqaHR"></div>
                            <div class="selects-header">
                                <img class="filtro-ico regiao-ico" src="../assets/images/svg/filtro-recorte-geografico.svg">
                                <select class="regiao form-control" name="select">
                                    <option value="" disabled selected>Amazônia Legal</option>
                                    <option value="amazoniaLegal">Amazônia Legal</option> 
                                    <option value="amazonas">Amazonas</option>
                                    <option value="acre">Acre</option>
                                    <option value="amapa">Amapá</option>
                                    <option value="roraima">Roraima</option>
                                    <option value="rondonia">Rondônia</option>
                                    <option value="para">Pará</option>
                                    <option value="maranhao">Maranhão</option>
                                    <option value="matoGrosso">Mato Grosso</option>
                                    <option value="tocantins">Tocantins</option>
                                </select>
                                <img class="filtro-ico" src="../assets/images/svg/filtro-area.svg">
                                <select class="area form-control" name="select">
                                    <option value="" disabled selected>Educação</option>
                                    <option value="ciencia_e_tecnologia">Ciência e Tecnologia</option> 
                                    <option value="desenvolvimento_social">Desenvolvimento Social</option> 
                                    <option value="demografia">Demografia</option>
                                    <option value="economia">Economia</option>
                                    <option value="educacao">Educação</option>
                                    <option value="infraestrutura">Infraestrutura</option>
                                    <option value="institucional">Institucional</option>
                                    <option value="meio_ambiente">Meio Ambiente</option>
                                    <option value="saneamento">Saneamento</option>
                                    <option value="saude">Saúde</option>
                                    <option value="seguranca">Segurança</option>
                                </select>
                                <img class="filtro-ico" src="../assets/images/svg/filtro-indicador.svg">
                                <select class="indicador form-control" name="select">
                                    <option value="" disabled selected>Ideb Ensino Médio</option>
                                </select>
                                <img class="filtro-ico" src="../assets/images/svg/filtro-ano.svg">
                                <select class="ano form-control" name="select">
                                    <option value="" disabled selected>Ano</option>
                                </select>
                                <img class="filtro-ico territorio-ico" src="../assets/images/svg/filtro-quatro-amazonias.svg">
                                <select class="territorio form-control" name="select">
                                    <option value="" disabled selected>Território</option>
                                    <option value="Arco do Desmatamento">Arco do Desmatamento</option> 
                                    <option value="Cidades">Cidades</option>
                                    <option value="Região Antropizada">Região Antropizada</option>
                                    <option value="Região Conservada">Região Conservada</option>
                                    <option value="Outros">Outros</option>
                                </select>
                                <img class="filtro-ico ajust-ico" src="../assets/images/svg/filtro-proporcao.svg">
                                <div class="row">
                                    <div class="col-sm-10 ajust">
                                        <select multiple="multiple" class="pct">
                                            <option value="" disabled selected>Proporção</option>
                                            <option value="0">0% a 10%</option>
                                            <option value="1">10% a 20%</option>
                                            <option value="2">20% a 30%</option>
                                            <option value="3">30% a 40%</option>
                                            <option value="4">40% a 50%</option>
                                            <option value="5">50% a 60%</option>
                                            <option value="6">60% a 70%</option>
                                            <option value="7">70% a 80%</option>
                                            <option value="8">80% a 90%</option>
                                            <option value="9">90% a 100%</option>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    $(function() {
                                        $("body > div > div.app-main > div.app-main__outer > div > div > div.page-title-wrapper > div > div > div.selects-header > div > div > select").multipleSelect({
                                            multiple: true,
                                            multipleWidth: 160
                                        })
                                    })
                                </script>                                    
                                <button class="btn btn-secondary bg-bordo pesquisar" id="btn-rpa" type="button" disabled>Pesquisar</button>
                                <button class="btn btn-secondary bg-bordo pesquisar" id="btn-rqa" type="button" disabled>Pesquisar</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>            
            <div class="tabs-animation">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="mb-3 card">
                            <!-- <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lgfont-weight-normal evolucao">
                                
                                </div>
                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                    
                                </div> 

                            </div> -->
                            <div class="card-body">  

                                <div class="card-header">
                                    <h5 id="titulo"></h5>
                                    <h6 id="status"></h6>

                                </div>        

                                <section class="mapDownloader">
                                   <?php if (verify_login()){
                                       echo " <button class=\"mapDownloadButton\"><img style=\"float: right\" src=\"../assets/images/svg/Download.svg\"/></button>";
                                   }else{
                                    echo "<img src=\"../assets/images/svg/Download.svg\" style=\"float: right; position: absolute; top: 126px; right: 30px;z-index:99;\" onclick=\"\" data-target=\"#alertaNaoCadastrado\" class=\"float:right\" data-toggle=\"modal\"/>";
                                   } ?>
                                  
                                    
                                </section>
                                
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div id="map" class="map">
                                            <div id="map_tooltip"></div>
                                        </div>
                                    </div>
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
    <div class="modal fade" id="alertaNaoCadastrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title card-header-title" id="ex
                ampleModalLongTitle">Amazônia Legal em Dados</h5>
                <div class="btn-actions-pane-right actions-icon-btn">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> 
                </div>
            </div>
            <div class="modal-body">
               <p> Cadastre-se para habilitar esta funcionalidade. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
    </div>    
<?php include_once("../template/app-form-cadastro.php"); ?>
<?php include_once("../template/app-form-login.php"); ?>
<?php include_once("../template/app-form-recuperar-senha.php"); ?>
<?php include_once("../template/app-form-codigo-seguranca-email.php"); ?>
    <!-- ============================================ imports JS ============================================ -->
    <script type="text/javascript" src="PoliticoAdministrativoMapa.js"></script>
    <script type="text/javascript" src="QuatroAmazoniasMapa.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script type="text/javascript" src="map.js"></script>
    <script type="text/javascript" src="./assets/scripts/main-perfil.js"></script>
    <script type="text/javascript" src="./assets/scripts/main-rodape.js"></script>
    <script type="text/javascript" src="./assets/scripts/mapDownload.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
    <!-- ==================================================================================================== --> 
</body>
</html>
