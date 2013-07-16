<?php

defined('MOODLE_INTERNAL') || die();

class block_valida_certificado extends block_base {
	public function init() {
		$this->title = get_string('valida_certificado','block_valida_certificado');
	}
	
    function get_content() {
	
        $this->content->text = '';
		
		$this->content->text .=	"<div class='bloco_valide_certificado'>
									<a href='#evsof_acesso_dialog' name='modal' title='Valide o certificado da Escola Virtual SOF'>
										<img src='http://". $_SERVER['SERVER_NAME'].'/eadsof/moodle244_teste/' . "/theme/image.php?theme=sof&image=icone_certificado&component=theme' alt='Valide o certificado da escola virtual SOF' title='Valide o Certificado da Escola Virtual SOF' align='left' />
										<span class='bloco_valide_certificado_texto'>Valide o Certificado</span>
									</a>
								</div>";					
								

        return $this->content;	
	}
	
	
}
