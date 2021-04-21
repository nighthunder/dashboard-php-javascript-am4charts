<?php

namespace app\models;
use app\core\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../model/phpmailer/src/PHPMailer.php';
require_once '../model/phpmailer/src/SMTP.php';
require_once '../model/phpmailer/src/Exception.php';
require_once '../../config/config.php';
require_once '../functions/functions.php';
require_once '../core/Model.php';
use PDO;

class M_Email{

    private $host = "smtp.kinghost.net";
    private $email = "contato@crodemu.kinghost.net";
    private $passwd = "uGFp*plfsC2s";
    private $sender;
    
    function enviaCodigoSegurancaEmail($sender,$senderdata, $securitycode){
        $this->$sender = $sender;

        // echo "<pre>";
        // var_dump($senderdata);
        // echo "</pre>";
        //echo "maiu";

        // Adiciona o arquivo class.phpmailer.php - você deve especificar corretamente o caminho da pasta com o este arquivo.
       
        // Inicia a classe PHPMailer
        $mail = new PHPMailer(true);

        try{
        // DEFINIÇÃO DOS DADOS DE AUTENTICAÇÃO - Você deve auterar conforme o seu domínio!
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = $this->host; // Seu endereço de host SMTP
        $mail->SMTPAuth = true; // Define que será utilizada a autenticação -  Mantenha o valor "true"
        $mail->Port = 587; // Porta de comunicação SMTP - Mantenha o valor "587"
        $mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
        $mail->SMTPAutoTLS = true; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
        $mail->Username = $this->email; // Conta de email existente e ativa em seu domínio
        $mail->Password = $this->passwd; // Senha da sua conta de email
        // DADOS DO REMETENTE
        $mail->Sender = $this->email; // Conta de email existente e ativa em seu domínio
        $mail->From = $this->email; // Sua conta de email que será remetente da mensagem
        $mail->FromName = "Amazônia Legal em Dados"; // Nome da conta de email
        // DADOS DO DESTINATÁRIO
        $mail->AddAddress($sender, 'Nome - Recebe1'); // Define qual conta de email receberá a mensagem
        //$mail->AddAddress('recebe2@dominio.com.br'); // Define qual conta de email receberá a mensagem
        //$mail->AddCC('copia@dominio.net'); // Define qual conta de email receberá uma cópia
        //$mail->AddBCC('copiaoculta@dominio.info'); // Define qual conta de email receberá uma cópia oculta
        // Definição de HTML/codificação
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
        // DEFINIÇÃO DA MENSAGEM
        $mail->Subject  = "Plataforma Amazônia Legal em Dados - Recuperação de senha"; // Assunto da mensagem
        $mail->Body .= " Nome: ".$senderdata[0]["fullname"]."
        "; // Texto da mensagem
        $mail->Body .= " E-mail: ".$sender."
        "; // Texto da mensagem
        $mail->Body .= " Assunto: Plataforma Amazônia Legal em Dados - Recuperação de senha.".""; // Texto da mensagem
        $msg = "O seu código de segurança é (expira em algumas horas): ".$securitycode;
        $mail->Body .= " ".nl2br($msg)."
        "; // Texto da mensagem
        //echo $securitycode;
        // ENVIO DO EMAIL
        //var_dump($mail);
        $enviado = $mail->Send();
        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        // Exibe uma mensagem de resultado do envio (sucesso/erro)
        if ($enviado) {
            return "Código de segurança enviado por email";
            } else {
            return "Não foi possível enviar o e-mail.";
            return "Detalhes do erro: " . $mail->ErrorInfo;
            }
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
          } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
          }
      


    }

}