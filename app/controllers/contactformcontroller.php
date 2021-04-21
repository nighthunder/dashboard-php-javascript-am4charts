<?php
require_once '../model/M_User.php';
use app\models\M_User;
require_once '../../config/config.php';
require_once '../functions/functions.php';

$user = new M_User;
$user->contactForm($_GET["email"]);

?>