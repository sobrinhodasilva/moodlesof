<?php
$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);
$showsidepre = $hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT);
$showsidepost = $hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));
$haslogo = (!empty($PAGE->theme->settings->logo));
//get userpref for col open or closed
sof_initialise_colpos($PAGE);
$usercol = sof_get_colpos();
if($usercol == "headerclosed") {
	$thedisplay = "inherit";
	$themenu = "handleclosed";
} else {
	$thedisplay = "block";
	$themenu = "down";
}


$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

if ($hascustommenu) {
    $bodyclasses[] = 'has_navbar';
}



echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>	
	<title><?php echo $PAGE->title ?></title>	
	<link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon_evsof', 'theme')?>" />
    <link rel="apple-touch-icon" href="<?php echo $OUTPUT->pix_url('favicon_apple-touch-icon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">

	<div id="wrapper">	
	
		<div id="barra-brasil">
			<div class="barra">
				<ul>
					<li><a href="http://www.acessoainformacao.gov.br" target="_blank" class="ai" title="Acesso &agrave; informa&ccedil;&atilde;o">www.sic.gov.br</a></li>
					<li><a href="http://www.brasil.gov.br" target="_blank" class="brasilgov" title="Portal de Estado do Brasil">www.brasil.gov.br</a></li>
				</ul>
			</div>
		</div>	
			
		<!-- start OF header -->
		<div id="header-wrapper" style="display: <?php echo $thedisplay; ?>" class="<?php echo $usercol; ?>">	
			
			
		<div id="page-header" class="page-header-home">
			
			<div id="cabecalho-conteudo">			
				<div id="cabecalho-conteudo-esq">
					<div class="cabecalho-conteudo-esq-titulo">
						<a title="Clique para acessar o s&iacute;tio do Minist&eacute;rio do Planejamento, Or&ccedil;amento e Gest&atilde;o" target="_blank" href="http://www.planejamento.gov.br/"> Minist&eacute;rio do Planejamento, Or&ccedil;amento e Gest&atilde;o </a>
					</div>
					<div class="cabecalho-conteudo-esq-logo">
						<a title="Clique para ir para a p&aacute;gina inicial da Escola Virtual SOF" href=".">
							<?php if ($haslogo) {
										echo html_writer::link(new moodle_url('/'), "<img src='".$PAGE->theme->settings->logo."' id='logo' alt='logo' />");
									} else { ?>
							<img src="<?php echo $OUTPUT->pix_url('logo_escola_virtual_sof', 'theme')?>" id="logo">
							<?php } ?>
						</a>
					</div>
				</div>
				
				<div id="cabecalho-conteudo-dir">

					<?php include('_barra_acessibilidade.php'); ?>
				
					<!-- start of custom menu -->
					<div id="menu-wrap" class="<?php echo $usercol; ?>">	
					<?php if ($hascustommenu) { ?>
					<div id="custommenu">
					<div id="menu-shortname"><?php echo $this->page->course->shortname ?></div>
					<!--a href="#" id="updown" class="<?php //echo $themenu; ?>" title="toggle header"></a-->
					<a href="<?php p($CFG->wwwroot) ?>" id="homer" alt="home" title="home"></a>
					<?php echo $custommenu; ?></div>
					<?php } ?>
					<!-- end of menu -->	
					</div>
				
				
				</div>
			</div>				
			
			<div id="b-wrapper">
				<div id="b-wrapper-inner">
				<!-- start of navbar -->
				<?php if ($hasnavbar) { ?>
					<div class="navbar clearfix">
					  <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
					  <div class="navbutton"><?php echo $PAGE->button; ?></div>
					</div>
				<?php } ?>
				<!-- end of navbar -->
				
				
				<div class="headermenu">
							<?php
								//echo $OUTPUT->login_info();
								//echo $OUTPUT->lang_menu();
								echo $PAGE->headingmenu;
							?>	    
				</div>
				</div>
			</div>
					
		</div>
			

			
			
		<!--div id="b-wrapper">
			<div id="b-wrapper-inner"-->
			<!-- start of navbar -->
			<?php //if ($hasnavbar) { ?>
				<!--div class="navbar clearfix2">
				  <div class="breadcrumb"><?php //echo $OUTPUT->navbar(); ?></div>
				</div-->
			<?php //} ?>
			<!-- end of navbar -->
			
			
			<!--div class="headermenu">
						<?php
						//	echo $OUTPUT->login_info();
						//	echo $OUTPUT->lang_menu();
						//	echo $PAGE->headingmenu;
						?>	    
			</div>
			</div>
		</div-->



	</div>		
	<!-- end of header -->		

		<div id="pagina-inicial">

		<div id="page-content-wrapper">
		<!-- start OF moodle CONTENT -->
		 <div id="page-content">
				<div id="region-main-box">
					<div id="region-post-box_HACK-EDITED-WGA2012">
					
						<div id="region-main-wrap_HACK-EDITED-WGA2012">
							<div id="region-main">
								
								<?php
								
									// Verifica se usu�rio esta logado, se nao estiver, exibe os banners e nome e descri��o dos cursos
									if (isloggedin() == false) {
										include('_template_banner.php');
										include('_template_cursos.php');
									}
								?>
								
								<div class="region-content">
									<?php echo $OUTPUT->main_content() ?>
								</div>
							</div>
						</div>
						
						<?php if ($hassidepre) { ?>
						<div id="region-pre" class="block-region">
							<div class="region-content">
								<?php echo $OUTPUT->blocks_for_region('side-pre') ?>
							</div>
						</div>
						<?php } ?>
						
						<?php if ($hassidepost) { ?>
						<div id="region-post" class="block-region">
							<div class="region-content">
								<?php echo $OUTPUT->blocks_for_region('side-post') ?>
							</div>
						</div>
						<?php } ?>
						
					</div>
				</div>
			</div>
		<!-- end OF moodle CONTENT -->
		<div class="clearer"></div>
		</div>
		<!-- end OF moodle CONTENT wrapper -->

		</div>

		<!-- start of footer -->	
		<div id="page-footer">
		<?php
		//echo $OUTPUT->login_info();
		
		//customiza�ao do rodap� do moodle2
		//echo $OUTPUT->home_link();
		
		//inclusao do rodap�
		include('_template_rodape.php');

		echo $OUTPUT->standard_footer_html();
		?>
		</div>
		<!-- end of footer -->	

		<div class="clearer"></div>

	</div><!-- end #wrapper -->
</div><!-- end #page -->	

		<!-- INICIO--Valida Certificado -->			
		<div class='evsof_popup_tela'>
			<div class='evsof_popup_boxes'>
				<div id='evsof_acesso_dialog' class='evsof_popup_window'>							
					<?php
						//echo '--> include -->aqui<--';
						include('valida_certificado.php');
					?>											
				</div>
				<div class='evsof_popup_mask'></div>
			</div>
		</div>	
		<!-- FIM--Valida Certificado -->
		
<?php echo $OUTPUT->standard_end_of_body_html() ?>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-39528954-1', 'orcamentofederal.gov.br');
	  ga('send', 'pageview');
	</script>

</body>
</html>