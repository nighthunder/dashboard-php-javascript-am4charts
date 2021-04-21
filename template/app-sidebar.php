<div class="app-sidebar sidebar-shadow bg-bordo sidebar-text-light">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>    <div class="">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <?PHP
                                $amazoniaLegal = [
                                        "Amazônia Legal",
                                        "Rondônia",
                                        "Acre",
                                        "Amazonas",
                                        "Roraima",
                                        "Pará",
                                        "Amapá",
                                        "Tocantins",
                                        "Maranhão",
                                        "Mato Grosso"
                                ]    
                            ?>
                            <li class="">
                                <?php if (verify_login() and in_array($_SESSION["state"], $amazoniaLegal)){
                                         echo "<a href=\"../home/home.php?regiao=".$_SESSION["state"]."\">
                                         " ;  
                                       }else{
                                        echo "<a href=\"../home/home.php?regiao=Amazônia Legal\">
                                        " ;
                                       }
                                ?>  
                                    <img src="../assets/images/svg/Menu_Home.svg" class="menu-icon">Página inicial
                                </a>
                            </li>
                            <br/> 
                            <li>
                                <?php if (verify_login() and in_array($_SESSION["state"], $amazoniaLegal)){
                                         echo "<a href=\"../dashboard/pre-perfil.php?regiao=".$_SESSION["state"]."\">
                                         " ;  
                                       }else{
                                        echo "<a href=\"../dashboard/pre-perfil.php?regiao=Amazônia Legal\">
                                        " ;
                                       }
                                ?>    
                                     <img src="../assets/images/svg/Menu_Perfil.svg" class="menu-icon">Perfil
                                </a>
                            </li>
                            <br/>
                            <li>
                                <?php
                                    $group_id_educacao = [
                                        "Amazônia Legal" => "100",
                                        "Rondônia" => "243",
                                        "Acre" => "364",
                                        "Amazonas" => "485",
                                        "Roraima" => "606",
                                        "Pará" => "727",
                                        "Amapá" => "848",
                                        "Tocantins" => "969",
                                        "Maranhão" => "1090",
                                        "Mato Grosso" => "1211"
                                    ];

                                    if (verify_login() and in_array($_SESSION["state"], $amazoniaLegal)){
                                        if ($_SESSION["state"] !== "Amazônia Legal" and array_key_exists($_SESSION["state"],$group_id_educacao)){
                                            $regiao_selecionada = $_SESSION["state"];
                                            $group_id = $group_id_educacao[$_SESSION["state"]];
                                        }else{
                                            $regiao_selecionada = "Maranhão";
                                            $group_id = "1090";
                                        }
                                    }else{
                                        $regiao_selecionada = "Maranhão";
                                        $group_id = "1090";
                                    }
                                ?>  

                                <a href="../compare/compare.php?regiao=<?php echo $regiao_selecionada; ?>&regiao1=Roraima&area=Educação__<?php echo $group_id; ?>&indicador=TX_INEP_IDEB_AI_UF__<?php echo $group_id; ?>">
                                    <img src="../assets/images/svg/Menu_Compare.svg" class="menu-icon">Compare
                                </a>
                                <!-- <a href="../compare/compare.php?regiao=Maranhão&regiao1=Amazonas&area=Educação__1090&indicador=TX_INEP_IDEB_AI_UF__1090">
                                    <img src="../assets/images/svg/Menu_Compare.svg" class="menu-icon">Compare
                                </a> -->
                            </li>
                            <br/>
                            <li class="">
                                <?php if (verify_login() and in_array($_SESSION["state"], $amazoniaLegal)){
                                         echo "<a href=\"../desafios/desafios.php?regiao=".$_SESSION["state"]."&area=todas\">
                                         " ;  
                                       }else{
                                        echo "<a href=\"../desafios/desafios.php?regiao=Amazônia Legal&area=todas\">
                                        " ;
                                       }
                                ?>    
                                <img src="../assets/images/svg/Menu_Destaques.svg" class="menu-icon">Desafios
                                </a>
                            </li> 
                            <br/>
                            <li>
                                <?php if (verify_login() and in_array($_SESSION["state"], $amazoniaLegal) and in_array($_SESSION["state"], $amazoniaLegal)){
                                         echo "<a href=\"../atlas/atlas.php?regiao=".$_SESSION["state"]."\">" ;  
                                       }else{
                                        echo " <a href=\"../atlas/atlas.php?regiao=Amazônia Legal\">
                                        " ;
                                       }
                                ?> 
                               
                                     <img src="../assets/images/svg/Menu_Atlas.svg" class="menu-icon">Atlas
                                </a>
                            </li>
                            <br/> 
                            <li class="">
                                <a href="../explore/explore.php?regiao=Amazônia Legal">
                                     <img src="../assets/images/svg/Menu_Explore.svg" class="menu-icon">Explore
                                </a>
                            </li> 
                            <br/> 
                            <li class="">
                                <a href="../sobre/sobre.php">
                                     <img src="../assets/images/svg/Menu_Sobre.svg" class="menu-icon">Sobre
                                </a>
                            </li> 
                            <br/> 
                            <?php

                            if (verify_login()){
                                echo 
                                "<li>
                                    <a href=\"../admin/atualizar-cadastro.php\">
                                    <img src=\"../assets/images/svg/Menu_Admin.svg\" class=\"menu-icon\">Minha conta
                                    </a>
                                </li> ";        
                            }                     
                            ?>                     
                        </ul>
                    </div>
                </div>