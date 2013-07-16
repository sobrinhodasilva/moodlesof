<html>
<head>
<title>Escola Virtal SOF</title>
</head>
<body>

<?php

error_reporting(E_ALL);
//error_reporting(E_STRICT);
//error_reporting(0);

header('Content-Type: text/html; charset=iso-8859-1');



$emailto	= $_POST["evsof_email_mailto"];	        // Email destinatario
$nome		= $_POST["evsof_nome_remetente"];	    // Nome de quem esta indicando
$emailfrom	= $_POST["evsof_email_emailRemetente"];	// Email de quem esta indicando
$mensagem	= $_POST["evsof_email_mensagem"];	    // Valor do campo Mensagem



// Variável que junta os valores acima e monta o corpo do email
$body		= "Esta mensagem foi enviada por seu(a) amigo(a):<br/>";
$body 	   .= "$nome ($emailfrom)<br/><br/>";
$body 	   .= "P&Aacute;GINA: Escola Virtual da SOF - http://ead.orcamentofederal.gov.br<br/><br/>";
$body      .= "COMENT&Aacute;RIO DO(A) SEU(A) AMIGO(A):<br/>";
$body      .= "$mensagem<br/><br/><br/>";
$body	   .= "--------------------------------------------------------<br/>";
$body      .= "cópia enviada ao email $emailfrom";

//date_default_timezone_set('America/Toronto');

require_once('../PHPMailer_v5.1/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$mail->CharSet    = 'utf8';

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "escolavirtualsof@gmail.com";  // GMAIL username
$mail->Password   = "W0RKadm!n@escolavirtualsof";            // GMAIL password

$mail->SetFrom('escolavirtualsof@gmail.com', 'Escola Virtual SOF');

//$mail->AddReplyTo("escolavirtualsof@gmail.com","Escola Virtual SOF");

$mail->Subject    = "Escola Virtual SOF - Seu amigo indicou esta p&aacute;gina";
$mail->MsgHTML($body);

$mail->AddAddress($emailto, $nome); //envia email para interessado que acionou
$mail->AddBcc($emailfrom, $nome); //copia oculta para administrador EVSOF responder

if ( empty($nome) OR empty($emailto) OR empty($emailfrom) ) {
  //header('Location:fale_conosco_msg_err.html');
  //exit();
} else {

	if(!$mail->Send()) {
	  include('indiqueSite_erro.html');
	} else {
	  include('indiqueSite_suc.html');
	}
}

?>

</body>
</html>
