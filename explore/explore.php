<?php
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
    <meta name="description" content="Visão integrada do território formado pelos nove estados da Amazônia Legal">
    <title>Amazônia Legal em Dados</title>
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script>
    <!-- ============================================ imports bibliotecas JS ============================================ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/build/ol.js"></script>
    <script src="https://unpkg.com/ol-layerswitcher@3.6.0"></script> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <!-- ================================================================================================================ -->
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <!-- ============================================ imports bibliotecas CSS ============================================ -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.4.3/css/ol.css">
    <link rel="stylesheet" href="https://unpkg.com/ol-layerswitcher@3.6.0/src/ol-layerswitcher.css" /> -->
    <!-- ================================================================================================================= -->
    <!-- ============================================ imports CSS ============================================ -->
    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link rel="stylesheet" href="explore.css">
    <link href="../assets/style/modal.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/style/main2021.css">
    <!-- ===================================================================================================== -->    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
	<script src="utils.js"></script>
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
    <link href="../assets/style/modal.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style/main.css">
  <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <link href="../assets/style/rodape.css" rel="stylesheet"></link>
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
                                <h1 class="title-atlas col-lg-6">Explore</h1> 
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
                            <button class="btn btn-secondary bg-bordo rpa reionalizacao"> INDICADOR X INDICADOR    </button>
                            <button class="btn btn-secondary bg-bordo rqa reionalizacao">              QUATRO AMAZÔNIAS X INDICADOR</button>
                            <div class="ambos"></div>
                            <div class="rpaHR"></div>
                            <div class="rqaHR"></div>

                            <div class="selects-header-indicadores">
                                <img class="filtro-ico area-ico" src="../assets/images/svg/filtro-area.svg">
                                <select class="area form-control" name="select">
                                    <option value="" disabled selected>Área</option>
                                    <option value="ciencia_e_tecnologia">Ciência e Tecnologia</option>  
                                    <option value="desenvolvimento_social">Desenvolvimento Social</option>  
                                    <option value="demografia">Demografia</option>
                                    <option value="economia">Economia</option>
                                    <option value="educacao">Educação</option>
                                    <!-- <option value="infraestrutura">Infraestrutura</option>
                                    <option value="institucional">Institucional</option> -->
                                    <option value="meio_ambiente">Meio Ambiente</option>
                                    <option value="saneamento">Saneamento</option>
                                    <option value="saude">Saúde</option>
                                    <option value="seguranca">Segurança</option>
                                </select>
                                <img class="filtro-ico indicador-ico" src="../assets/images/svg/filtro-indicador.svg">
                                <select class="indicador form-control" name="select">
                                    <option value="" disabled selected>Indicador</option>
                                </select>
                                <img class="filtro-ico area1-ico" src="../assets/images/svg/filtro-area.svg">
                                <select class="seletorArea area1 form-control" name="select">
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
                                <img class="filtro-ico indicador1-ico" src="../assets/images/svg/filtro-indicador.svg">
                                <select class="seletorIndicador indicador1 form-control" name="select">
                                </select>
                                <img class="filtro-ico area2-ico" src="../assets/images/svg/filtro-area.svg">
                                <select class="seletorArea area2 form-control" name="select">
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
                                <img class="filtro-ico indicador2-ico" src="../assets/images/svg/filtro-indicador.svg">
                                <select class="seletorIndicador indicador2 form-control" name="select">
                                    <option value="" disabled selected>PIB per capita </option>
                                </select>
                                <img class="filtro-ico territorio-ico" src="../assets/images/svg/filtro-quatro-amazonias.svg">
                                <select class="territorio form-control" name="select">
                                    <option value="" disabled selected>Quatro Amazônias</option>
                                    <option value="Arco do Desmatamento">Arco do Desmatamento</option> 
                                    <option value="Cidades">Cidades</option>
                                    <option value="Região Antropizada">Região Antropizada</option>
                                    <option value="Região Conservada">Região Conservada</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>

                            <div class="selects-header">
                                <img class="filtro-ico ano-ico" src="../assets/images/svg/filtro-ano.svg">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <select multiple="multiple" class="ano">
                                            <option value="" disabled selected>Ano</option>
                                            <option value="2007" class="2007">2007</option>
                                            <option value="2008" class="2008">2008</option>
                                            <option value="2009" class="2009">2009</option>
                                            <option value="2010" class="2010">2010</option>
                                            <option value="2011" class="2011">2011</option>
                                            <option value="2012" class="2012">2012</option>
                                            <option value="2013" class="2013">2013</option>
                                            <option value="2014" class="2014">2014</option>
                                            <option value="2015" class="2015">2015</option>
                                            <option value="2016" class="2016">2016</option>
                                            <option value="2017" class="2017">2017</option>
                                            <option value="2018" class="2018">2018</option>
                                            <option value="2019" class="2019">2019</option>
                                            <option value="2020" class="2020">2020</option>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    var $select = $(".ano")
                                    $(function() {
                                        $(".ano").multipleSelect({
                                            multiple: true,
                                            multipleWidth: 160,
                                            selectAll: true,
                                            // textTemplate: "Ano",
                                            // locale: 'pt-BR'
                                            minimumCountSelected: 3,
                                            ellipsis : true,
                                            formatAllSelected () {
                                                return 'Todos selecionados'
                                            },
                                            formatCountSelected (count, total) {
                                                return count + ' de ' + total + ' selecionados'
                                            },
                                        })
                                        
                                        $("select.indicador1").change(function (){
                                            //$select.multipleSelect('uncheckAll')
                                        });
                                        $("select.indicador2").change(function (){
                                            //$select.multipleSelect('uncheckAll')
                                        });
                                    })
                                </script> 
                                <img class="filtro-ico regiao-ico" src="../assets/images/svg/filtro-recorte-geografico.svg">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <select multiple="multiple" class="regiao">
                                            <option value="" disabled selected>Recorte geográfico</option>
                                            <option value="Amazonas" checked="true">Amazonas</option>
                                            <option value="Acre" checked="true">Acre</option>
                                            <option value="Amapá" checked="true">Amapá</option>
                                            <option value="Roraima" checked="true">Roraima</option>
                                            <option value="Rondônia" >Rondônia</option>
                                            <option value="Pará" checked="checked">Pará</option>
                                            <option value="Maranhão">Maranhão</option>
                                            <option value="Mato Grosso">Mato Grosso</option>
                                            <option value="Tocantins">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    $(function() {
                                        $(".regiao").multipleSelect({
                                            multiple: true,
                                            multipleWidth: 160,
                                            locale: 'pt-BR',
                                            minimumCountSelected: 3,
                                            ellipsis : true,
                                            formatAllSelected () {
                                                return 'Todos selecionados'
                                            },
                                            formatCountSelected (count, total) {
                                                return count + ' de ' + total + ' selecionados'
                                            },
                                        })
                                    })
                                </script> 
                                <button class="btn btn-secondary bg-bordo pesquisar" id="btn-rpa" type="button">Pesquisar</button>
                                <button class="btn btn-secondary bg-bordo pesquisar" id="btn-rqa" type="button">Pesquisar</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>            
            <div class="tabs-animation">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-lg-7">
                        <div class="mb-3 card">
                            <!-- <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lgfont-weight-normal evolucao">
                                
                                </div>
                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                    
                                </div> 

                            </div> -->
                            <div class="card-body">  

                                <!-- <div class="card-header">
                                    <h5 id="titulo"></h5>
                                    <h6 id="status"></h6>
                                </div>         -->
                                
                                <!-- <div class="card-body"> -->
                                    <div class="tab-content">
                                        <!-- <div id="map" class="map">
                                            <div id="map_tooltip"></div>
                                        </div> -->
                                        <!-- <div style="width:100%">
                                            <canvas id="canvas"></canvas>
                                        </div> -->
                                        <canvas id="myChart"></canvas>
                                    </div>
                                <!-- </div> -->

                            </div>
                            <!-- <button id="randomizeData">Randomize Data</button> -->
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-5">
                        <div class="mb-3 card">
                            <!-- <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lgfont-weight-normal evolucao">
                                
                                </div>
                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                    
                                </div> 

                            </div> -->
                            <div class="card-body">  

                                <div class="card-header">
                                    <h5 id="titulo">Correlação de Pearson</span><div class='tip'>
                                    <div class='tip-conteudo' style='display:none'>
                                        Nota: A correlação de Pearson é uma medida de associação entre duas variáveis, ou seja, mede o grau pelo qual elas tendem a mudar juntas, variando de -1 a 1. Quanto mais próxima de -1 ou 1, mais forte a relação entre as variáveis. E quanto mais próxima de zero, mais fraca é essa relação.- Quando a correlação é positiva (> 0), indica uma relação linear positiva entre as variáveis, isto é, quando ocorre um aumento (ou diminuição) em uma, ocorrerá um aumento (ou diminuição) proporcional na outra.- Quando é negativa (< 0), indica uma relação linear negativa, isto é, as mudanças que ocorrem são inversamente proporcionais, quando uma aumenta, a outra tende a diminuir.- Quando é nula (= 0), indica que não existe uma relação linear entre as variáveis. Apesar de medir a relação entre as variáveis, esta medida não implica em causalidade.
                                    </div></div></h5>
                                    <!-- <h6 id="status"></h6> -->
                                </div>        
                                
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div id="coefi-person" class="offset-lg-4 offset-md-2"></div>
                                        <div id="notePearson" class="notePearson">Não há uma relação significativa entre o <b>Desmatamento acumulado</b> e <b>PIB per capita (em R$ bilhões de 2018)</b>, considerando as observações selecionadas e apresentadas no gráfico.<br/></div>
                                        <!-- <div id="map" class="map">
                                            <div id="map_tooltip"></div>
                                        </div> -->
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

    <?php include_once("../template/app-form-cadastro.php"); ?>
    <?php include_once("../template/app-form-login.php"); ?>
    <!-- ============================================ imports JS ============================================ -->
    <script type="text/javascript" src="utils.js"></script>
    <script type="text/javascript" src="filtro_quatro_amazonias.js"></script>
    <script type="text/javascript" src="grafico_indicador_indicador.js"></script>
    <script type="text/javascript" src="pearson_indicador_indicador.js"></script>
    <script type="text/javascript" src="grafico_quantro_amazonias_indicador.js"></script>
    <script type="text/javascript" src="pearson_quantro_amazonias_indicador.js"></script>
    <script type="text/javascript" src="./assets/scripts/main-perfil.js"></script> 
    <script type="text/javascript" src="./assets/scripts/main-rodape.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <script type="text/javascript" src="filter.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
    <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
    <!-- <script type="text/javascript" src="map.js"></script> -->
    <!-- ==================================================================================================== --> 
</body>
</html>
