<!DOCTYPE html>
<html>
<head>
  <!--conteudo do head-->
  <meta charset="UTF-8">
  <link href="estilos2.css" type="text/css" media="all" rel="stylesheet" />
</head>
<body>
  <div id=tudo>
    <div id=menu>
      <div class=popup style='display:block'>
        <div class=texto>


<?php
require_once("phpmailer/class.phpmailer.php");

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
	$mail->Host = 'smtp.zoho.com';	// SMTP utilizado
	$mail->Port = 465;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = 'sherlon@labhacker.org.br';
	$mail->Password = 'a5hl0n@L4b';
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = '<p>Agradecemos sua participação, sua mensagem foi enviada com sucesso!</p>';
		return true;
	}
}

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }


    $email_to = "sherlon@labhacker.org.br";
    $email_subject = $_POST['hidden'] . ' - ' .$_POST['subject'];


    $email_message .= "Nome: ".clean_string($_POST['from_name'])."\n";
    $email_message .= "Email: ".clean_string($_POST['from'])."\n\n";
    $email_message .= clean_string($_POST['hidden'])." - ".clean_string($_POST['subject'])."\n";
    $email_message .= "Texto: ".clean_string($_POST['body'])."\n";




smtpmailer('sherlon.assis@usp.br', 'sherlon@labhacker.org.br', 'Sherlon Assis', $email_subject, $email_message);

if (!empty($error)) echo $error;

?>
<h3><a href=index.html alt='Retornar ao site' title='Retornar ao site'>X</a></h3>
</div></div></div></div>
</body>
</html>

