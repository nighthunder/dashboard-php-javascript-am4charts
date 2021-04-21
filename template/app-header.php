<div class="app-header bg-green header-shadow header-text-dark">
        <div class="app-header__logo">
            <div class="header__pane ml-auto" style="margin-left: -5px !important">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class=""><img src="../assets/images/AML/logo.png"/ id="logo" width="155px" style="margin-top: -15px;margin-left: 45px;margin-right: 10px;"></div>
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
        </div>    <div class="app-header__content">
            <div class="app-header-left">
            
            </div>    
            <div class="app-header-right">
                
                <div class="">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper mr-4">
                            <?php
                            if (verify_login()){

                            ?>    
                                <div class="widget-content-left">
                                <div class="btn-group">
                                    <div class="avatar bg-bordo"><?php echo utf8_encode($_SESSION["acronym"]); ?></div>
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn" style="margin-top: 7px;">
                                        <i class="fa fa-angle-down ml-2 opacity-8" style="margin-top: 5px"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner">
                                                <div class="menu-header-image" style="background-image: url('../assets/images/AML/header.png');"></div>
                                                <div class="menu-header-content text-left">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">

                                                            <div class="widget-content-left mr-4">
                                                               <div class="avatar bg-bordo"><?php echo utf8_encode($_SESSION["acronym"]); ?></div>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    <?php

                                                                        echo ucfirst($_SESSION["name"]);
                                                                    ?>
                                                                </div>
                                                                <div class="widget-subheading opacity-8">Seja bem vindo(a).
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-right mr-2">
                                                                <form method="POST" action="../app/controllers/loggoutcontroller.php">
                                                                    <button type="submit" class="btn-pill btn-shadow btn-shine btn btn-focus">Sair
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scroll-area-xs" style="height: 75px;">
                                            <div class="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-header nav-item">Minha conta
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="../admin/atualizar-cadastro.php" class="nav-link nav-link-header">Detalhes da minha conta
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item-divider nav-item">
                                            </li>
                                            <li class="nav-item-btn text-center nav-item">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>   
                            <?php }
                            ?>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading user-name">
                                    <?php 
                                        if (verify_login()){
                                            echo ucfirst($_SESSION["name"]);
                                        }else{
                                            echo "<div class=\"registerLoginDiv\">
                                                <p class=\"openLoginDialog\" style=''>Entrar</p>                                                
                                                <button class=\"openRegisterDialog btn btn-primary bg-bordo\" data-target=\"#rankingModalDCNT\" data-toggle=\"modal\">Cadastre-se</button>
                                            </div>";
                                        }
                                    ?>
                                </div>
                                <div class="widget-subheading">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>