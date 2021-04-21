<?php

require_once "../app/functions/functions.php";
require_once "../config/config.php";
require_once '../app/model/M_Perfil.php';
require_once '../app/model/M_User2.php';
require_once "../config/config2.php";
use app\core\Model;
use app\models\M_User2;
use app\models\M_Perfil;
verify_session();
$user = new M_User2();
$perfil = new M_Perfil();
$userdata = $user->getUserData($_SESSION["email"]);
$sexes = $user->getUserSexes($_SESSION["email"]);
$states = $perfil->getBrazilStates();
$activities = $perfil->getActivities();
// echo "<pre>";
// var_dump($userdata);
// echo "</pre>";

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Área de administração.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
    />
    <meta name="description" content="Build whatever layout you need with our Architect framework.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="./main.87c0748b313a1dda75f5.css" rel="stylesheet">
    <link href="../assets/style/rodape.css" rel="stylesheet"> 
    <link href="../assets/style/modal.css" rel="stylesheet"> 
    <link href="../assets/style/main2021.css" rel="stylesheet"> 
  <link href="../template/assets/styles/loginForm/loginForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/recuperarSenhaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/loginForm/codigoSegurancaForm.css" rel="stylesheet">
    <link href="../template/assets/styles/registerForm/registerForm.css" rel="stylesheet">
    <?php include_once("../template/app-header-includes.php"); ?>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
     <?php include_once("../template/app-header.php"); ?>
    </div>    
    <div class="app-main" style="" id="topo">
             <?php include_once("../template/app-sidebar.php"); ?>
            </div> <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                         <div class="page-title-wrapper">
                                <div class="row row-especial" style="float: left">
                                    <div class="col-lg-12">
                                        <div class="page-title-heading">
                                            <h2 style="padding:20px;">Área de administração</h2>  
                                        </div>                              
                                    </div> 
                                </div>  
                            </div>  
                    </div>          
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">Meus dados pessoais</h5>
                                    <form class="" method="POST" action="../app/controllers/updateusercontroller.php" >
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleEmail11" class="">Email</label><br/><div class="email"><?php echo $userdata[0]["email"]; ?></div></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="position-relative form-group"><label for="exampleEmail11" class="">Data de nascimento</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend datepicker-trigger">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar-alt"></i>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" data-toggle="datepicker-icon" value="<?php echo convertDateToBrazilDate($userdata[0]["birth_date"]); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" im-insert="true" name="birth_date">
                                                </div>
                                            </div>
                                        </div></div>
                                        <div class="position-relative form-group"><label for="firstname" class="">Nome completo</label><input name="firstname" id="firstname" placeholder="Seu nome completo" type="text" class="form-control" value="<?php echo utf8_encode($userdata[0]["fullname"]); ?>"></div>
                                        <!-- <div class="form-row">
                                            <div class="col-md-6"><div class="position-relative form-group"><label for="exampleAddress" class="">Endereço</label><input name="address" id="exampleAddress" placeholder="Rua Amazônia Legal nº 15" type="text" class="form-control" value="<?php echo utf8_encode($userdata[0]["address"]); ?>"></div></div>
                                            <div class="col-md-6"><div class="position-relative form-group"><label for="exampleZip" class="">Cep</label><input name="zip" id="exampleZip" placeholder="CEP" class="form-control input-mask-trigger" data-inputmask="'mask': '9999-9999'" im-insert="true" value="<?php echo $userdata[0]["zip_code"]; ?>"></div></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleEmail11" class="">Telefone celular</label><input name="phone" id="examplePhone" placeholder="Seu telefone" class="form-control input-mask-trigger" value="<?php echo $userdata[0]["phone"]; ?>" data-inputmask="'mask': '([99]) 99999-9999'" im-insert="true"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleState" class="">Sexo</label>
                                                <select name="selectSex" id="exampleSelect" class="form-control" disable>    
                                                    <?php
                                                    // $sxs = array ("feminino", "masculino");
                                                    // foreach ($sxs as $s){
                                                    //     echo $userdata[0]["sex"];
                                                    //     if ($userdata[0]["sex"] == $s){
                                                    //      echo "<option value='".$userdata[0]["sex"]."' selected='selected'>".$userdata[0]["sex"]."</option>";
                                                    //     }else{
                                                    //          echo "<option value='".$s."'>".$s."</option>";
                                                    //     }
                                                    // }    
                                                    ?>
                                                </select></div>
                                            </div>    
                                        </div> -->
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleState" class="">Estado</label>
                                                <select name="selectState" id="exampleSelect" class="form-control">
                                                    <?php 
                                                    foreach ($states as $st){

                                                        if ($userdata[0]["state"] == $st["nome"]){
                                                          echo "<option value='".utf8_encode($st["nome"])."' selected='selected'>".utf8_encode($st["nome"])."</option>";
                                                        }else{
                                                             echo "<option value='".utf8_encode($st["nome"])."'>".utf8_encode($st["nome"])."</option>";
                                                        }
                                                       
                                                    }
                                                    ?>
                                                </select></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="municipio" class="">Município</label><input name="county" id="county" placeholder="Município" class="form-control" value="<?php echo $userdata[0]["county"]; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="exampleState" class="">Atividade</label>
                                                <select name="selectActivity" id="exampleSelect" class="form-control">
                                                    <?php 
                                                    foreach ($activities as $st){

                                                        if ($userdata[0]["activity"] == $st["activity"]){
                                                          echo "<option value='".utf8_encode($st["activity"])."' selected='selected'>".utf8_encode($st["activity"])."</option>";
                                                        }else{
                                                             echo "<option value='".utf8_encode($st["activity"])."'>".utf8_encode($st["activity"])."</option>";
                                                        }
                                                       
                                                    }
                                                    ?>
                                                </select></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="institution" class="">Instituição</label><input name="institution" id="institution" placeholder="Instituição" class="form-control" value="<?php echo $userdata[0]["institution"]; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="office" class="">Cargo</label><input name="office" id="office" placeholder="Cargo" class="form-control" value="<?php echo $userdata[0]["office"]; ?>"></div>
                                            </div>        
                                        </div>
                                        <div class="position-relative form-check"><input name="newsletter" id="newsletter" type="checkbox" class="form-check-input" onclick=" if(document.getElementById('newsletter').checked != true){ this.value = 'N';} else {this.value = 'S';}" value="<?php echo $userdata[0]["newsletter"] ?>" <?php echo ($userdata[0]['newsletter']=='S' ? 'checked' : '');?>><label for="exampleCheck" class="form-check-label" style="font-weight: normal;font-size: 13px;">Aceito receber novidades por e-mail.</label></div>
                                        <div class="form-row" style="margin-top: 15px">
                                            <button class="mt-2 btn btn-primary bg-bordo">Atualizar</button>
                                            <div class="container-success" style="margin-top: 14px">
                                                <p class="text-success" id="text-sucess1"></p>
                                            </div>  
                                        </div>    
                                    </form>
                                </div>
                            </div>
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">Minha senha</h5>
                                    <div>
                                        <form class="form-inline" id="signupForm" method="POST" action="../app/controllers/updateuserpasscontroller.php" id="signupForm2">
                                            <div class="position-relative form-group form-group-1"><label for="examplePassword44" class="sr-only">Senha nova</label><input name="password" id="password" placeholder="Senha nova" type="password" class="mr-2 form-control"></div>
                                            <div class="position-relative form-group form-group-1"><label for="examplePassword44" class="sr-only">Redigite a senha nova</label><input name="confirm_password" id="confirm_passwd" placeholder="Redigite a senha nova" type="password" class="mr-2 form-control"></div>
                                            <button class="btn btn-primary bg-bordo">Atualizar</button>
                                            <div class="container-success">
                                                <p class="text-success">
                                                    <?php

                                                    if(strpos($_SERVER['REQUEST_URI'],"?") !== false){
                                                        $url_path = explode("?",$_SERVER['REQUEST_URI']);

                                                        if ($url_path[1] == "success"){
                                                            echo "Senha alterada com sucesso.";
                                                        }    
                                                    }        
                                                    ?> 
                                                </p>       
                                            </div>  
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">Grid</h5>
                                    <form class="" method="POST" id="signupForm">
                                        <div class="position-relative row form-group"><label for="exampleEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10"><input name="email" id="exampleEmail" placeholder="e-mail" type="email" class="form-control" readonly="true"></div>
                                        </div>
                                        <div class="position-relative row form-group"><label for="examplePassword" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10"><input name="password" id="examplePassword" placeholder="password placeholder" type="password" class="form-control"></div>
                                        </div>
                                        <div class="position-relative row form-group"><label for="exampleSelect" class="col-sm-2 col-form-label">Select</label>
                                            <div class="col-sm-10"><select name="select" id="exampleSelect" class="form-control"></select></div>
                                        </div>
                                        <div class="position-relative row form-group"><label for="exampleSelectMulti" class="col-sm-2 col-form-label">Select Multiple</label>
                                            <div class="col-sm-10"><select multiple="" name="selectMulti" id="exampleSelectMulti" class="form-control"></select></div>
                                        </div>
                                        <div class="position-relative row form-group"><label for="exampleText" class="col-sm-2 col-form-label">Text Area</label>
                                            <div class="col-sm-10"><textarea name="text" id="exampleText" class="form-control"></textarea></div>
                                        </div>
                                        <div class="position-relative row form-group"><label for="exampleFile" class="col-sm-2 col-form-label">File</label>
                                            <div class="col-sm-10"><input name="file" id="exampleFile" type="file" class="form-control-file">
                                                <small class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                                            </div>
                                        </div>
                                        <fieldset class="position-relative row form-group">
                                            <legend class="col-form-label col-sm-2">Radio Buttons</legend>
                                            <div class="col-sm-10">
                                                <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Option one is this and that—be sure to include why it's great</label></div>
                                                <div class="position-relative form-check"><label class="form-check-label"><input name="radio2" type="radio" class="form-check-input"> Option two can be something else and selecting it will deselect option
                                                    one</label></div>
                                                <div class="position-relative form-check disabled"><label class="form-check-label"><input name="radio2" disabled="" type="radio" class="form-check-input"> Option three is disabled</label></div>
                                            </div>
                                        </fieldset>
                                        <div class="position-relative row form-group"><label for="checkbox2" class="col-sm-2 col-form-label">Checkbox</label>
                                            <div class="col-sm-10">
                                                <div class="position-relative form-check"><label class="form-check-label"><input id="checkbox2" type="checkbox" class="form-check-input"> Check me out</label></div>
                                            </div>
                                        </div>
                                        <div class="position-relative row form-check">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button class="btn btn-secondary bg-bordo">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <?php include_once("../template/app-footer.php"); ?>
                    </div>
                </div>    </div>
    </div>
</div>
<div class="app-drawer-wrapper">
    <div class="drawer-nav-btn">
        <button type="button" class="hamburger hamburger--elastic is-active">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
    </div>
    <div class="drawer-content-wrapper">
        <div class="scrollbar-container">
            <h3 class="drawer-heading">Servers Status</h3>
            <div class="drawer-section">
                <div class="row">
                    <div class="col">
                        <div class="progress-box"><h4>Server Load 1</h4>
                            <div class="circle-progress circle-progress-gradient-xl mx-auto">
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="progress-box"><h4>Server Load 2</h4>
                            <div class="circle-progress circle-progress-success-xl mx-auto">
                                <small></small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="progress-box"><h4>Server Load 3</h4>
                            <div class="circle-progress circle-progress-danger-xl mx-auto">
                                <small></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="mt-3"><h5 class="text-center card-title">Live Statistics</h5>
                    <div id="sparkline-carousel-3"></div>
                    <div class="row">
                        <div class="col">
                            <div class="widget-chart p-0">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers text-warning fsize-3">43</div>
                                    <div class="widget-subheading pt-1">Packages</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="widget-chart p-0">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers text-danger fsize-3">65</div>
                                    <div class="widget-subheading pt-1">Dropped</div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="widget-chart p-0">
                                <div class="widget-chart-content">
                                    <div class="widget-numbers text-success fsize-3">18</div>
                                    <div class="widget-subheading pt-1">Invalid</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="text-center mt-2 d-block">
                        <button class="mr-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button>
                        <button class="border-0 btn-transition btn btn-outline-success">Support Center</button>
                    </div>
                </div>
            </div>
            <h3 class="drawer-heading">File Transfers</h3>
            <div class="drawer-section p-0">
                <div class="files-box">
                    <ul class="list-group list-group-flush">
                        <li class="pt-2 pb-2 pr-2 list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left opacity-6 fsize-2 mr-3 text-primary center-elem">
                                        <i class="fa fa-file-alt"></i>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading font-weight-normal">TPSReport.docx</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                            <i class="fa fa-cloud-download-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pt-2 pb-2 pr-2 list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left opacity-6 fsize-2 mr-3 text-warning center-elem">
                                        <i class="fa fa-file-archive"></i>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading font-weight-normal">Latest_photos.zip</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                            <i class="fa fa-cloud-download-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pt-2 pb-2 pr-2 list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left opacity-6 fsize-2 mr-3 text-danger center-elem">
                                        <i class="fa fa-file-pdf"></i>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading font-weight-normal">Annual Revenue.pdf</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                            <i class="fa fa-cloud-download-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="pt-2 pb-2 pr-2 list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left opacity-6 fsize-2 mr-3 text-success center-elem">
                                        <i class="fa fa-file-excel"></i>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading font-weight-normal">Analytics_GrowthReport.xls</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                            <i class="fa fa-cloud-download-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <h3 class="drawer-heading">Tasks in Progress</h3>
            <div class="drawer-section p-0">
                <div class="todo-box">
                    <ul class="todo-list-wrapper list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="todo-indicator bg-warning"></div>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-2">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox1266" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomCheckbox1266">&nbsp;</label></div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Wash the car
                                            <div class="badge badge-danger ml-2">Rejected</div>
                                        </div>
                                        <div class="widget-subheading"><i>Written by Bob</i></div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="border-0 btn-transition btn btn-outline-success">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="todo-indicator bg-focus"></div>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-2">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox1666" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomCheckbox1666">&nbsp;</label></div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Task with hover dropdown menu</div>
                                        <div class="widget-subheading">
                                            <div>By Johnny
                                                <div class="badge badge-pill badge-info ml-2">NEW</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <div class="d-inline-block dropdown">
                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="border-0 btn-transition btn btn-link">
                                                <i class="fa fa-ellipsis-h">
                                                </i>
                                            </button>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right"><h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                <button type="button" disabled="" tabindex="-1" class="disabled dropdown-item">Action</button>
                                                <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="todo-indicator bg-primary"></div>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-2">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox4777" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomCheckbox4777">&nbsp;</label></div>
                                    </div>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading">Badge on the right task</div>
                                        <div class="widget-subheading">This task has show on hover actions!</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="border-0 btn-transition btn btn-outline-success">
                                            <i class="fa fa-check">
                                            </i>
                                        </button>
                                    </div>
                                    <div class="widget-content-right ml-3">
                                        <div class="badge badge-pill badge-success">Latest Task</div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="todo-indicator bg-info"></div>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-2">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox2444" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomCheckbox2444">&nbsp;</label></div>
                                    </div>
                                    <div class="widget-content-left mr-3">
                                        <div class="widget-content-left"><img width="42" class="rounded" src="assets/images/avatars/1.jpg" alt=""/></div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Go grocery shopping</div>
                                        <div class="widget-subheading">A short description ...</div>
                                    </div>
                                    <div class="widget-content-right widget-content-actions">
                                        <button class="border-0 btn-transition btn btn-sm btn-outline-success">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="border-0 btn-transition btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="todo-indicator bg-success"></div>
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-2">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" id="exampleCustomCheckbox3222" class="custom-control-input">
                                            <label class="custom-control-label" for="exampleCustomCheckbox3222">&nbsp;</label></div>
                                    </div>
                                    <div class="widget-content-left flex2">
                                        <div class="widget-heading">Development Task</div>
                                        <div class="widget-subheading">Finish React ToDo List App</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="badge badge-warning mr-2">69</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <button class="border-0 btn-transition btn btn-outline-success">
                                            <i class="fa fa-check">
                                            </i>
                                        </button>
                                        <button class="border-0 btn-transition btn btn-outline-danger">
                                            <i class="fa fa-trash-alt">
                                            </i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <h3 class="drawer-heading">Urgent Notifications</h3>
            <div class="drawer-section">
                <div class="notifications-box">
                    <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                        <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                <div class="vertical-timeline-element-content bounce-in"><p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item dot-success vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Build the production release
                                        <div class="badge badge-danger ml-2">NEW</div>
                                    </h4>
                                    <span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Something not important
                                        <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/1.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/2.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/3.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/4.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/5.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/6.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/7.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm">
                                                <div class="avatar-icon"><img
                                                        src="assets/images/avatars/8.jpg"
                                                        alt=""></div>
                                            </div>
                                            <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                <div class="avatar-icon"><i>+</i></div>
                                            </div>
                                        </div>
                                    </h4>
                                    <span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item dot-info vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">This dot has an info state</h4><span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon is-hidden"></span>
                                <div class="vertical-timeline-element-content is-hidden"><h4 class="timeline-title">This dot has a dark state</h4><span class="vertical-timeline-element-date"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("../template/app-form-cadastro.php"); ?>
<?php include_once("../template/app-form-login.php"); ?>
<?php include_once("../template/app-form-recuperar-senha.php"); ?>
<?php include_once("../template/app-form-codigo-seguranca-email.php"); ?>
<div class="app-drawer-overlay d-none animated fadeIn"></div><script type="text/javascript" src="./assets/scripts/main.87c0748b313a1dda75f5.js"></script><script        src="https://code.jquery.com/jquery-3.5.1.min.js"
              integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous"></script><script type="text/javascript" src="./assets/scripts/main-perfil.js"></script>
              <script type="text/javascript" src="../assets/scripts/main-rodape.js"></script>
                     <script type="text/javascript" src="../template/assets/scripts/loginForm/loginForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/recuperarSenhaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/loginForm/codigoSegurancaForm.js"></script>
              <script type="text/javascript" src="../template/assets/scripts/registerForm/registerForm.js"></script>
</body>
</html>
