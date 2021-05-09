<?php

require_once '../model/M_Email.php';
use app\models\M_Email;
require_once '../../config/config.php';
require_once '../functions/functions.php';

$mail = new M_Email;

$mail->enviaAtualizacoesEmail();
?>