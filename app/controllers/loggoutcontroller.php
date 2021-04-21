<?php

require_once '../model/M_Login.php';
use app\models\M_Login;

$login = new M_Login;

$login->loggout();

?>