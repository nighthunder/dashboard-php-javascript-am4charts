<?php

require_once '../model/M_Login.php';
use app\models\M_Login;

$login = new M_Login();

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";


echo $login->validate_account($_POST["email"],$_POST["senha"]);

?>