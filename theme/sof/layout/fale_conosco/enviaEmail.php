<html>
<head>
<title>PHPMailer SMTP - naoresponder@ead.orcamentofederal.gov.br</title>
</head>
<body>

<?php

error_reporting(E_ALL);
//error_reporting(E_STRICT);
//error_reporting(0);

header('Content-Type: text/html; charset=iso-8859-1');




$nome		= $_POST["evsof_fale_nome"];	// Pega o valor do campo Telefone
$email		= $_POST["evsof_fale_email"];	// Pega o valor do campo Email
$mensagem	= $_POST["evsof_fale_mensagem"];	// Pega os valores do campo Mensagem


// Vari�vel que junta os valores acima e monta o corpo do email
$body		= "Sua mensagem foi encaminhada com sucesso! Aguarde que em breve iremos entrar em contato.<br/>";
$body 	   .= "Escola Virtual SOF - Mensagem enviada atrav�s do <b>Fale Conosco</b><br/><br/>";
$body 	   .= "Nome: $nome<br/>";
$body      .= "E-mail: $email<br/>";
$body      .= "Mensagem: $mensagem<br/><br/><br/>";
$body	   .= "--------------------------------------------------------<br/>";
$body      .= "c�pia enviada ao Suporte da Escola Virtual SOF ";

//date_default_timezone_set('America/Toronto');

require_once('../PHPMailer_v5.1/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$mail->CharSet    = 'utf8';

$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  						// enable SMTP authentication
$mail->SMTPSecure = "tsl";                 					// sets the prefix to the servier
$mail->Host       = "mail.ead.orcamentofederal.gov.br"; 		// sets GMAIL as the SMTP server
$mail->Port       = 25;                   						// set the SMTP port for the GMAIL server
$mail->Username   = "naoresponder@ead.orcamentofederal.gov.br";	// GMAIL username
$mail->Password   = "escolavirtual!23";       					// GMAIL password

$mail->SetFrom('naoresponder@ead.orcamentofederal.gov.br', 'Escola Virtual SOF');

//$mail->AddReplyTo("escolavirtualsof@gmail.com","Escola Virtual SOF");

$mail->Subject    = "Fale Conosco - Escola Virtual SOF";
$mail->MsgHTML($body);

$mail->AddAddress($email, $nome); //envia email para interessado que acionou fale conosco
$address = "naoresponder@ead.orcamentofederal.gov.br";
$mail->AddBcc($address, "Administrador EVSOF"); //copia oculta para administrador EVSOF responder

if ( empty($nome) OR empty($email) OR empty($mensagem) ) {
  header('Location:fale_conosco_msg_err.html');
  exit();
} else {

	if(!$mail->Send()) {
	  include('fale_conosco_msg_err.html');
	} else {
	  include('fale_conosco_msg_suc.html');
	}
}

?>

</body>
</html>
