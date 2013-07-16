<?php

function conecta() {

	//print "<h2>CONECTAR AO BANCO NO POSTGRESQL</h2>";
	//moodle server latitude.eng.br/moodle2
	$db   = 'eadsof_moodle22';
	$host = 'localhost';
	$user = 'moodle22';
	$pass = 'eadsof@W0RKadm!n'; 
	$port = '5432';

	//moodle server localhost
	//$db   = 'moodle222postgres_sof2';
	//$host = 'localhost';
	//$user = 'postgres';
	//$pass = 'postgres'; 
	//$port = '5432';

	$string_connect = "host=$host port=$port dbname=$db user=$user password=$pass"; // Variável com os parâmetros de conexão
	$dbconn = pg_pconnect($string_connect) OR die("Erro de conexao!"); // Comando para conectar-se ao servidor
}

function consulta_certificado($codigo) {
	//Acesso direto as funcoes SQL
	$query = "SELECT * FROM mdl_certificate_issues c LEFT JOIN mdl_user u ON c.userid = u.id WHERE code = '{$codigo}';";
	$result = pg_query($query) or die('falha na query'.pg_last_error());

	return $result;	
}


function fecha_conexao() {

	// Closing connection
	pg_close($dbconn);

}

?>
