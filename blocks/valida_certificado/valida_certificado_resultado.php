<?php

	include('valida_certificado_conexao_db.php');
		
	$codigo = $_POST['evsof_certificado_codigo'];
	
	conecta();
	$resultado = '';
	$resultado = consulta_certificado($codigo);

	$retorno = 
		"
		<div class='evsof_popup_confirma'>
			<div class='evsof_popup_confirma_esq'>				
			</div>
			<div class='evsof_popup_confirma_dir'>
			<p><br/>Certificado não localizado!</p>
			<p>Código informado: {$codigo}</p>
			</div>
		</div>
		";
				
	// Printing results in HTML
	while ($dado = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
		
		$estudante = $dado['studentname'];
		$curso = $dado['classname'];			
		
		$retorno = 
			"
			<div class='evsof_popup_confirma'>
				<div class='evsof_popup_confirma_esq'>
					<img src='theme/sof/pix/icone_sucesso.png' title='Certificado Verificado com Sucesso' alt='Certificado Verificado com Sucesso' />
				</div>
				<div class='evsof_popup_confirma_dir'>
				<p>Certificado verificado com sucesso!</p>
				<p>Aluno: {$estudante}<br />
				  Curso: {$curso}<br />
				  Certificado: {$codigo}
				</p>
				</div>
			</div>
			";
	}		
	
	echo $retorno;

?>
