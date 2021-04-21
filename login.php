<?php

require_once "config/config.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Plataforma Amazônia Legal em Dados</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Visão integrada do território formado pelos nove estados da Amazônia Legal">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link href="./assets/style/main2021.css" rel="stylesheet">
</head>

<?php include_once("./template/app-header-includes-1.php"); ?>

<body class="bg-bordo">
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="d-none d-lg-block col-lg-4">
                        <div class="slider-light">
                            <div class="slick-slider">
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('./assets/images/banner1_2.jpg');"></div>
                                        <div class="slider-content"><h3>6,1 milhões de km²</h3>
                                            <p>60% do território brasileiro, maior que a Índia.</p></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('assets/images/banner2_2.jpg');"></div>
                                        <div class="slider-content"><h3>28,2 milhões de habitantes</h3>
                                            <p>14% do Brasil, maior que a população da Austrália.</p></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                        <div class="slide-img-bg" style="background-image: url('assets/images/banner3_2.jpg');"></div>
                                        <div class="slider-content"><h3>1,2 milhões de km² de área de conservação</h3>
                                            <p>83% da nacional.</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8 bg-bordo">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                            <div class="app-logo"><img src="./assets/images/logo-white.png"/ width="200px"></div>
                            <h4 class="mb-0">
                                <?php

                                if(strpos($_SERVER['REQUEST_URI'],"?") !== false){
                                     $url_path = explode("?",$_SERVER['REQUEST_URI']);

                                       if ($url_path[1] == "loggout"){
                                            echo "<span class=\"d-block\">Até mais. Te vejo mais tarde.</span>";
                                       }else if ($url_path[1] == "nonexist"){
                                            echo "<span class=\"d-block error invalid-feedback\" style=\"font-style: italic; font-size: 0.6em\">O e-mail não está cadastrado.</span>";
                                       }else if ($url_path[1] == "nonpass"){
                                            echo "<span class=\"d-block error invalid-feedback\" style=\"font-style: italic; font-size: 0.6em;\">Senha incorreta.</span>";
                                       } 

                                }else{
                                    echo "<span class=\"d-block\">Bem-vindo(a) à Plataforma Amazônia Legal em Dados. </span>";
                                    echo "<span>Por favor, preencha seus dados de acesso.</span>";
                                }    

                              

                                ?>
                            </h4>    
                            <div>
                                <form id="signupForm" class="" method="POST" action="./app/controllers/logincontroller.php">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><input name="email" id="Email" placeholder="Email ..." type="email" class="form-control"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><input name="password" id="Password" placeholder="Senha ..." type="password"
                                                                                                                                                   class="form-control"></div>
                                        </div>
                                    </div>
<!--                                     <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Me mantenha conectado</label></div> -->
                                    
                                    <div class="d-flex align-items-center">
                                        <div class="ml-auto"><!-- <a href="javascript:void(0);" class="btn-lg btn btn-link">Recuperar senha</a> -->
                                            <button class="btn btn-primary btn-lg bg-green">Entrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script></body>
</html>
