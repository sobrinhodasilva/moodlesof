<div class='evsof_popup_titulo'>
  	<p>Validar o certificado</p>
    <div class='evsof_popup_fechar'>
        <a href='#' class='evsof_popup_fechar'>
            <div class='evsof_popup_fechar_link'>Fechar</div>
        <img src='<?php echo $OUTPUT->pix_url('icone_erro', 'theme')?>' alt='Fechar' title='Fechar' border='0' />
        </a>
	</div>
</div>

<div class='evsof_popup_conteudo'>
	<p><label for='evsof_cadastro_nome'>Informe o código do certificado que consta no verso do mesmo:</label></p>

    <p>
		<form id="formValidaCertificado" action="javascript:func()" method="post">
			<input type='text' class='evsof_input_portal' name='evsof_certificado_codigo' id='evsof_certificado_codigo' title='Informe o código do certificado que consta no verso do mesmo' tabindex='1' />
			<input type='submit' name='modal' class='evsof_button_portal'  id='evsof_cadastro_consultar' title='Clique consultar o código do certificado que consta no verso do mesmo' value='Consultar' tabindex='2'/>
		</form>

	</p> 
	
	<div id="status"></div>
	<!--div id="status" style="display: none;"></div-->

	
</div>
	
<div class='evsof_popup_footer'>
	<p>
    Minist&eacute;rio do Planejamento, Or&ccedil;amento e Gest&atilde;o - MP<br />
	Secretaria de Orçamento Federal - SOF<br />
	Escola Virtual SOF
	</p>
</div>