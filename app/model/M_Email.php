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

    public function __construct(){
      $this->db = new \PDO("mysql:dbname=".BANCO.";host=".SERVIDOR,USUARIO,SENHA);
      // $this->host = "smtp.kinghost.net";
      // $this->email = "contato@crodemu.kinghost.net";
      // $this->passwd = "uGFp*plfsC2s";
    }
    
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

    # Enviar por email uma lista de atualizações do site para uma lista de emails
    function enviaAtualizacoesEmail(){
      $sql = "Select distinct email, fullname from user where newsletter = 'S' and email like '%macroplan.com.br%' 
      or email like '%aldo.polastre76@gmail.com%' or email like '%mayamoraiss@gmail.com%'";
      echo $sql;
      $qry = $this->db->query($sql);
      // var_dump($qry);
      if ($qry){
          foreach($qry->fetchAll(PDO::FETCH_ASSOC) as $q){
            $mail = new PHPMailer(true);
            $this->$sender = $q["email"];
            echo "Destinatário: ".$this->$sender."<br/>";
            echo "Remetente: ".$this->email."<br/>";
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
              $mail->FromName = "Plataforma Amazônia Legal em Dados"; // Nome da conta de email
              // DADOS DO DESTINATÁRIO
              $mail->AddAddress($this->$sender, $q["fullname"]); // Define qual conta de email receberá a mensagem
              //$mail->AddAddress('recebe2@dominio.com.br'); // Define qual conta de email receberá a mensagem
              //$mail->AddCC('copia@dominio.net'); // Define qual conta de email receberá uma cópia
              //$mail->AddBCC('copiaoculta@dominio.info'); // Define qual conta de email receberá uma cópia oculta
              // Definição de HTML/codificação
              $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
              $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
              // IMAGES ATTACHED 
              $mail->AddEmbeddedImage('../../assets/images/updatesbyemail/emailheader.jpg', 'emailheader');
              $mail->AddEmbeddedImage('../../assets/images/updatesbyemail/macrologo.png', 'macrologo');
              $mail->AddEmbeddedImage('../../assets/images/updatesbyemail/icontato.png', 'icontato');
              // DEFINIÇÃO DA MENSAGEM
              $mail->Subject  = "Plataforma Amazônia Legal em Dados : atualizações da plataforma"; // Assunto da mensagem
              $mail->Body .= "<head>
              <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\">
              <link href=\"https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,900;1
              ,300;1,400;1,600;1,700;1,900&display=swap\" rel=\"stylesheet\">";
              $mail->Body .= "</head>
                <body>
                <table cellspacing=\"0\" border=\"0\">
                <td width=\"100%\" height=\"145px\" bgcolor=\"#495057​\"><img src=\"cid:emailheader\" style=\"\">
               ";
              $mail->Body .= "<h2>
              <span style=\"position:absolute;top:100px;margin-left:25px;font-size:1.3em;margin-top:15px;color:#ffffff;\">Atualizações da plataforma</span></h2></td>
              </table>";
              $mail->Body .= "<table>
                  <h2 style=\"margin:45px 0 0px 25px;\"><span style=\"
              font-family:'Open Sans',sans-serif;font-weight:600;line-height:50px;font-size:1.5rem;color:rgb(73,80,87);margin-left:25px;\">
              Atualizações de indicadores</span></h2><p style=\"margin-top:-25px;line-height:27px;font-size:16px;color:rgb(73,80,87);margin-left:50px;\">
              Acabamos de atualizar os seguintes indicadores:</p></table><br/>";
              $mail->Body .= "<table style=\"max-width:900px;margin-left:40px;color:#495057​;border: 1px solid lightgray;border-radius:5px;box-shadow:1px 1px 1px solid gray\" cellspacing=\"0\"> 
                <tr >
                  <th style=\"color:rgb(73,80,87)​;color:#495057​;font-family: 'Open Sans',sans-serif;font-weight: 600;text-align:left;width:25%;font-size:16px;padding:10px;\">Tema</th>  
                  <th style=\"color:rgb(73,80,87);color:#495057​;font-family: 'Open Sans',sans-serif;font-weight: 600;border: 1px solid lightgray;text-align:center;font-size:16px;padding:10px;\">Indicador</th>  
                  <th style=\"color:rgb(73,80,87)​;color:#495057​;font-family: 'Open Sans',sans-serif;font-weight: 600;text-align:center;font-size:16px;padding:10px;\">Atualização</th>  
                </tr>
                <tr style='background:#e5e5e5'>
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;border: 1px solid lightgray;font-size:16px;text-align:left;\">Educação</td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Percentual de crianças de até 3 anos frequentando creche </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Novas séries históricas com dados estaduais para o período 2016-2019 e municipais para 2010-2020.  </td>  
                </tr>
                <tr>
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;text-align:left;\">Educação</td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Percentual de crianças de 4 a 5 anos frequentando a pré-escola </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Novas séries históricas com dados estaduais para o período 2016-2019 e municipais para 2010-2020.  </td>  
                </tr>
                <tr style='background:#e5e5e5'>
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;text-align:left;\">Ciência e tecnologia </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Taxa de mestres e doutores </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Nova série histórica com dados para o período 2010-2020.  </td>  
                </tr>
                <tr>
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;text-align:left;\">Ciência e tecnologia </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Percentual de vínculos em ocupações técnico-científicas</td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Nova série histórica com dados para o período 2009-2019.</td>  
                </tr>
                <tr style='background:#e5e5e5'>
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;text-align:left;\">Ciência e tecnologia </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Percentual dos dispêndios totais em C&T </td>  
                  <td style=\"color:rgb(73,80,87)​;color:#495057​;padding:10px;font-family: 'Open Sans',sans-serif;text-align:center;border: 1px solid lightgray;font-size:16px;\">Nova série histórica com dados para o período 2008-2018 .</td>  
               </tr>
              </table>";
              $mail->Body .= "<table style='margin-left:25px;border:1px solid lightgray​'>
                  <h2 style=\"margin:45px 0 35px 15px;\"><span style=\"
                font-family:'Open Sans',sans-serif;font-weight:600;line-height:50px;font-size:1.5rem;
                color:rgb(73,80,87);\">Atualizações de recursos e funcionalidades</span></h2>
                <p style=\"color:#495057​;font-family:'Open Sans',sans-serif;line-height:27px;font-size:16px;
                margin-left:15px;max-width:900px;\"><span style=\"color:#495057;font-family:'Open Sans',sans-serif;line-height: 27px;font-size:16px;\">
                Implementação de módulo de cadastro de usuários: usuários cadastrados poderão receber notificações sobre atualizações 

                da plataforma e fazer navegação customizada com base na sua localização. 
                Novos benefícios serão implementados nas próximas semanas. Aguarde! </span></p>
                <br/>
                <p style=\"font-family:'Open Sans',sans-serif;letter-spacing:0.04em;color:rgb(73,80,87);padding-left:20px;font-size:0.90rem;\">
                <p>Confira em <a href='http://amazonialegalemdados.info' style=\"text-decoration:none;font-weight:600;font-family:'Open Sans',sans-serif;letter-spacing:0.04em;
              color:rgb(73,80,87);font-size:0.9rem;\">http://amazonialegalemdados.info</a></p>
                <p><span style=\"color:#495057;font-family: 'Open Sans',sans-serif;font-size:14px;margin-left:20px;\">
                Atenciosamente</span>,</p>
                <p><span style=\"margin-left:20px;color:#495057;font-family: 'Open Sans',sans-serif;
                letter-spacing:0.04em;font-weight:bold;font-size:16px;\">Equipe Plataforma Amazônia Legal em Dados.
                </span></p>
              </table>";
              $mail->Body .= "<table style='margin-left:25px;'><br/>
              <tr></tr>
              </table><br/><br/>";
              $mail->Body .= "<table style='padding-left:25px;width:100%;height:120px;background-color:rgb(299,299,299)​;
              background:#e5e5e5;padding:30px;color:rgb(73,80,87);border-radius:5px;'>
                <tr>
                  <td width=\"75%\">
                    <p><span style=\"font-weight:600;font-family: 'Open Sans',sans-serif;letter-spacing:0.04em;
                    font-size:1em;margin-bottom:0px;margin-left:15px;font-size:1.1em;\">Dúvidas ou sugestões sobre a plataforma?</span></p>
                    <p style=\"letter-spacing:0.04em;margin-top:-15px;font-family: 'Open Sans', 
                    sans-serif;font-weight:600;margin-left:15px;margin-top:-10px;font-size:1.1em;line-height:1px;\">Entre em contato com a gente</p>
                    <p><a href='mailto:contato@amazonialegalemdados.info' 
                    style=\"text-decoration:none;font-weight:600;font-family:'Open Sans',sans-serif;letter-spacing:0.04em;
                    color:rgb(73,80,87);line-height:45px;\"><img src=\"cid:icontato\" style='padding:5px;vertical-align:middle;font-size:0.90rem;'>contato@amazonialegalemdados.info</a></p>
                  </td>
                  <td>
                    <img src='cid:macrologo' style='margin-bottom:25px;'>
                  </td>
                </tr>
              </table>
              </body>";
              $mail->Body .= " ".nl2br($msg).""; // Texto da mensagem
              //var_dump($mail);
              $enviado = $mail->Send();
              // Limpa os destinatários e os anexos
              $mail->ClearAllRecipients();
              $mail->ClearAddresses();  // each AddAddress add to list
              $mail->ClearCCs();
              $mail->ClearBCCs();
              // Exibe uma mensagem de resultado do envio (sucesso/erro)
              if ($enviado) {
                echo "E-mail enviado para ".$q["email"]."<br/>";
              } else {
                echo "Não foi possível enviar o e-mail para ".$q["email"]."<br/>";
                echo "Detalhes do erro: " . $mail->ErrorInfo."<br/>";
              }
            } catch (phpmailerException $e) {
              echo "roi";
              echo $e->errorMessage(); //Pretty error messages from PHPMailer
            } catch (Exception $e) {
              echo  "roi";
              echo $e->getMessage(); //Boring error messages from anything else!
            }
          }
      }      
   
    }

}