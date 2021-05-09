<?php

require_once '../model/M_User2.php';
use app\models\M_User2;
require_once '../../config/config.php';
require_once '../functions/functions.php';

$user = new M_User2;

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$user->updateUserData($_POST);

?>