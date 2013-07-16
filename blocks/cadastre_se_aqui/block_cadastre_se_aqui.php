<?php

defined('MOODLE_INTERNAL') || die();

class block_cadastre_se_aqui extends block_base {
	public function init() {
		$this->title = get_string('cadastre_se_aqui','block_cadastre_se_aqui');
	}
	
    function get_content() {
	
        $this->content->text = '';
		
		$this->content->text .=	"<div class='bloco_autocadastro'>
									<a href='login/signup.php' title='Cadastre-se e acesse os cursos da Escola Virtual da SOF'>
										<img src='http://". $_SERVER['SERVER_NAME'] ."/eadsof/moodle244_teste"."/theme/image.php?theme=sof&image=icone_usuario&component=theme' alt='Cadastre-se e acesse os cursos da Escola Virtual da SOF' title='Cadastre-se e acesse os cursos da Escola Virtual da SOF' align='left' />
										<span class='bloco_autocadastro_texto'>Cadastre-se aqui</span>
									</a>
								 </div>";
								
		// Verifica se usuário esta logado, se estiver, oculta o bloco valida_certificado
		if (isloggedin() == true) {
			$this->content->text = '';			
		}				

		return $this->content;	
	}
}
