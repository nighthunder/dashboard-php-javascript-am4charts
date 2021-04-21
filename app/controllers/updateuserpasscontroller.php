<?php

require_once '../model/M_User.php';
use app\models\M_User;
require_once '../../config/config.php';
require_once '../functions/functions.php';

$user = new M_User;

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

session_start();

$user->updatePasswd($_SESSION["email"], $_POST["password"]);
header("Location: ".URL_BASE."admin/atualizar-cadastro.php?success");

?>