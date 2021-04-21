<?php
require_once "../app/functions/functions.php";
require_once "../config/config2.php";
require_once '../app/model/M_Noticias.php';
use app\models\M_Noticias;
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
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="./assets/style/main.css" rel="stylesheet">
    <link href="./assets/style/sobre.css" rel="stylesheet">
    <link href="../assets/style/rodape.css" rel="stylesheet">
    <link href="../assets/style/main2021.css" rel="stylesheet">
  <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
</head>
<?php include_once("../template/app-header-includes.php"); ?>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <?php include_once("../template/app-header.php"); ?>
    </div>    
    <div class="app-main" style="padding-top: 45px;" id="topo">
             <?php include_once("../template/app-sidebar.php"); ?>
    </div> 
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <section class="sectionAbout">
                        <h2 class="headerSectionAbout">Sobre a Amazônia Legal em Dados</h2>
                        
                        
                        
                        
                        <p class="textSectionAbout">
                            A plataforma Amazônia Legal em Dados é uma iniciativa fomentada por <a class="linkSectionAbout" target="_blank" rel="noopener noreferrer"  href="http://www.pagina22.com.br/uma-concertacao-pela-amazonia/">Uma Concertação Pela Amazônia</a>, desenvolvida pela <a class="linkSectionAbout" target="_blank" rel="noopener noreferrer" href="http://www.macroplan.com.br">Consultoria Macroplan</a> com apoio do <a class="linkSectionAbout" target="_blank" rel="noopener noreferrer"  href="http://www.arapyau.org.br/">Instituto Arapyaú</a>.
                        </p>
                        <p class="textSectionAbout">
                            A plataforma, com acesso liberado a qualquer pessoa, proporciona de forma inédita uma visão integrada dos nove estados da Amazônia Legal, reunindo 113 indicadores em 11 temas como ciência e tecnologia, demografia, desenvolvimento social, educação, economia, infraestrutura, institucional, meio ambiente, saneamento, saúde e segurança.                        </p>
                        <p class="textSectionAbout">
                        A ferramenta traz análises comparativas e evolutivas da região nos últimos 10 anos. Também disponibiliza projeções de indicadores até 2030. Os dados podem ser visualizados para o conjunto da região, por estado, por município e para as quatro grandes divisões da Amazônia: arco do desmatamento, cidades, região antropizada e região conservada.
                        </p>
                        <p class="textSectionAbout">
                            Como parte da iniciativa Uma Concertação pela Amazônia, a plataforma é uma entrega do eixo Indicadores de Desenvolvimento, um dos 15 Eixos de Entendimento da Amazônia.
                        </p>
                        <div class="imageContainerSectionAbout">
                            <img class="spiralImageSectionAbout" src="../assets/images/espiralSobre2.png"/>
                        </div>
                        <section class="sectionAboutConsortium">
                            <h3 class="headerSectionAboutConsortium">Sobre a Concertação pela Amazônia</h3>
                            <p class="textSectionAbout">
                                A iniciativa nasceu em 2020 sob a premissa de que é preciso gerar conhecimento, promover o debate e buscar consensos sobre os diversos 
                                aspectos e dimensões que envolvem a região amazônica. Fazem parte da iniciativa mais de 250 lideranças que priorizaram o entendimento 
                                da complexidade da Amazônia como condição essencial para o desenvolvimento do país. São representantes de toda a sociedade brasileira, 
                                como  governos,  entidades  filantrópicas,  setor  econômico,  comunidades  locais  e  academia,  que  buscam  soluções  de  conservação  e  de 
                                desenvolvimento sustentável da região. 
                            </p>
                            <p class="textSectionAbout">Mais informações:</p>
                            <a class="linkSectionAboutConsortium" target="_blank" rel="noopener noreferrer" href="https://pagina22.com.br/uma-concertacao-pela-amazonia">Acessar Site</a>
                        </section>
                    </section>
                </div>
            </div>
</div>
            <div class="app-wrapper-footer">
                <?php include_once("../template/app-footer.php"); ?>
            </div>
            
            <?php include_once("../template/app-form-cadastro.php"); ?>
            <?php include_once("../template/app-form-login.php"); ?>
            <script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"
              integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous"></script>
              <script type="text/javascript" src="./assets/scripts/main-perfil.js"></script>
              <script type="text/javascript" src="./assets/scripts/main-rodape.js"></script>
                     <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
</body>


</html>