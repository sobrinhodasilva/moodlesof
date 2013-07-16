<!--Retirado em 04-04-2013 solicitado por Suzana via Roberto. Retirado tag <blink></blink> de Inscricoes abertas-->
<!--WGA - Efeito de Texto Piscando - Blink no IE e FireFox (chrome nao funciona) --> 
<!-- basta colocar o texto entre as tags <blink></blink>-->

<!-- IE Blink -->
<!--script type="text/javascript">
if (window.attachEvent) {
	window.attachEvent('onload', function() {
		var sAgent = navigator.userAgent.toLowerCase();
		if((new RegExp("msie\ ")).test(sAgent)) {
			setInterval(function(){
				var aBlink = document.getElementsByTagName('BLINK');
				for(var i=0; i < aBlink.length; i++) {
					if(aBlink[i].style.visibility == 'hidden') {
						aBlink[i].style.visibility = 'visible';
					} else {
						aBlink[i].style.visibility = 'hidden';
					}
				}
			}, 600);
		}
	});
}
</script-->
<!-- End of IE Blink -->


<!-- FIM_WGA - Edicao para piscar-->


<div class="evsof_miolo_cursos">
	<div class="evsof_miolo_cursos_topo">
        <div class="evsof_miolo_cursos_titulo">Cursos</div>
        <div class="evsof_miolo_cursos_todas"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=239" title="Clique para vizualizar todos os cursos">Todos os Cursos</a></div>
    </div>
    <div class="evsof_miolo_cursos_bloco_01">
		<!-- Inclu&iacute;ndo o curso n&uacute;mero 01 /-->
                <a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=233" title="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico">
                <img src="<?php echo $OUTPUT->pix_url('banners/orcamento_publico_200_x_80', 'theme')?>" alt="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico" title="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico" border="0" /></a>
                <p class="evsof_miolo_cursos_bloco_tit"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=233" title="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico">Or&ccedil;amento P&uacute;blico</a></p>
                <p><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=233" title="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico">O or&ccedil;amento p&uacute;blico &eacute; uma das ferramentas mais importantes para a gest&atilde;o dos recursos p&uacute;blicos de um pa&iacute;s. Em sua origem, era basicamente um instrumento de controle dos gastos do Poder Executivo contendo previs&atilde;o de receita e autoriza&ccedil;&atilde;o de despesa...</a></p>
                <p class="evsof_miolo_cursos_bloco_mais"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=233" title="Clique para saber mais sobre o Curso de Or&ccedil;amento P&uacute;blico">Saiba Mais</a></p>
		<!--p class="evsof_miolo_cursos_bloco_mais"><a style="color:#FE4800;" href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=233" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico">Inscri&ccedil;&otilde;es Abertas</a></p-->
    </div>
	
    <div class="evsof_miolo_cursos_bloco_02">
        <!-- Inclu&iacute;ndo o curso n&uacute;mero 02 /-->
        <a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=236" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico">
                <img src="<?php echo $OUTPUT->pix_url('banners/basico_em_orcamento_publico_200_x_80', 'theme')?>" alt="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico" border="0" />
        </a>
        <p class="evsof_miolo_cursos_bloco_tit"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=236" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico">B&aacute;sico em Or&ccedil;amento P&uacute;blico</a></p>
        <p><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=236" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico">No Curso B&aacute;sico em Or&ccedil;amento P&uacute;blico voc&ecirc; aprender&aacute; os conceitos fundamentais e a import&acirc;ncia do Or&ccedil;amento P&uacute;blico para cada cidad&atilde;o e cidad&atilde;. Ver&aacute; que existem Leis, Normas e t&eacute;cnicas que o regem...</a></p>
        <br/>
		<!--p class="evsof_miolo_cursos_bloco_mais"><a style="color:#FE4800; text-decoration:blink" href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=236" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico"><blink>Inscri&ccedil;&otilde;es Abertas</blink></a></p-->
                <p class="evsof_miolo_cursos_bloco_mais"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=236" title="Clique para saber mais sobre o Curso de B&aacute;sico em Or&ccedil;amento P&uacute;blico">Saiba Mais</a></p>
	</div>
	
    <div class="evsof_miolo_cursos_bloco_03">
         <!-- Inclu&iacute;ndo o curso n&uacute;mero 03 /-->
			<a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=859" title="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento">
            <img src="<?php echo $OUTPUT->pix_url('banners/renop_200_x_80', 'theme')?>" alt="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento" title="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento" border="0" /></a>
            <p class="evsof_miolo_cursos_bloco_tit"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=859" title="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento">Rede Nacional de Planejamento e Orçamento</a></p>
            <p><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=859" title="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento">No curso Rede Nacional de Planejamento e Orçamento - ReNOP você conhecerá conceitos, normas e informações relevantes para atuar como participante da referida rede...</a></p>
            <br/>
			<p class="evsof_miolo_cursos_bloco_mais"><a href="<?php p($CFG->wwwroot) ?>/mod/page/view.php?id=859" title="Clique para saber mais sobre o Curso Rede Nacional de Planejamento e Orçamento">Saiba Mais</a></p>
	</div>
</div>
