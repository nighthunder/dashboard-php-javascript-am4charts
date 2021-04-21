<?php

require_once '../app/model/M_User.php';
use app\models\M_User;

$user = new M_User;

$userdata = $user->getUserData($_SESSION["email"]);

// echo "<pre>maoi";
var_dump($userdata)

?>