
/*****************************
 * Funcoes Personalizadas SOF
 * 02/06/2012
 * Roberto Sobrinho da Silva
 * sobrinhodasilva@gmail.com
 *****************************
 * Editado em 06/07/2012
 * Wesley Gongora de Almeida
 * wesley.gongora de Almeida
 * Botoes 'Imprimir' e 'EnviarEmail' nas <pages>
 ************************************************/
 
$(document).ready(function(){

	//formatação de máscaras nos campos
    $(".form_mascara_cpf").mask("999.999.999-99");	

	//onclick show hide
	$('#custommenu .yui3-menu-content li').first().addClass('firstmenu');
	$("#updown").click(function() {

	if ($('#menu-wrap').hasClass('nowfixed')) {
		$("html, body").animate({ scrollTop: 0 }, "fast");
	}

		 if ($('#header-wrapper').hasClass('headerclosed')) {
		  $('#header-wrapper, #menu-wrap').removeClass("headerclosed");
		  var slids = "panelopen";
		  M.util.set_user_preference('theme_cover_chosen_colpos', slids);
		 } else {
		   $('#header-wrapper, #menu-wrap').addClass("headerclosed");
		   var slids = "headerclosed";
		   M.util.set_user_preference('theme_cover_chosen_colpos', slids);
		 }

	 });

	var stickyPanelOptions = {
		topPadding: 0,
		afterDetachCSSClass: "nowfixed",
		savePanelSpace:false
	};
	
	$("#menu-wrap").stickyPanel(stickyPanelOptions);	    

	//Saiba Mais 

		$("#saibaMais").addClass("ui-widget-content ui-corner-all");
		$("#saibaMais").hide();
		$("#saibaMais").before("<a href='#' id='saibaMaisButton' class='ui-state-default ui-corner-all'>Saiba Mais</a>");
		$("#saibaMaisButton").click(function(){
			$("#saibaMais").toggle( 'blind', 500);
		});


	//Tabelas Efeito Zebra
		$(".region-content TABLE TBODY TR:even").addClass("zebra");
                $(".sem-efeito-zebra").removeClass("zebra");        
		
	//TABS
		$('#tabs').tabs();
		
	//Botoes 'Imprimir' e 'EnviarEmail' nas <pages>
	$("#pageheading").append("<div class='evsof_miolo_titulo_imprimir'><a href='#' onclick='javascript:imprimir();' title='Clique para imprimir esta p&aacute;gina'>Imprimir</a></div>");
	$("#pageheading").append("<div class='evsof_miolo_titulo_mail'><a href='#' onclick='javascript:popup_enviar_email();' title='Clique para enviar esta p&aacute;gina por e-mail para um amigo'>Enviar por e-mail</a></div>");

	//adiciona o ID=pagina_site - utilizado na funcao do botao Imprimir
	$('.pagina_site').attr("id", "pagina_site");		


	//Sanfona
	$( "#sanfona" ).accordion({
		collapsible: true,
		autoHeight: false,
		navigation: true
		});

    //Dialog

    $( "#dialog" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            modal: true
        });


    $( "#opener").click(function() {
        $( "#dialog" ).dialog( "open" );
        return false;
    });

    $([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]).each(function() { 
        var num = this; 
        $( "#dialog"+num ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            modal: true
        });
        $( "#opener"+num).click(function() {
            $( "#dialog"+num ).dialog( "open" );
            return false;
        });
    });

    $( "#largedialog" ).dialog({
        autoOpen: false,
        show: "blind",
        hide: "explode",
        modal: true,
        width: 600
    }); 

    $( "#largeopener").click(function() {
        $( "#largedialog" ).dialog( "open" );
        return false;
    });

    $([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]).each(function() { 
        var num = this; 
        $( "#largedialog"+num ).dialog({
                autoOpen: false,
                show: "blind",
                hide: "explode",
                modal: true,
                width: 600
            });
        $( "#largeopener"+num).click(function() {
            $( "#largedialog"+num ).dialog( "open" );
            return false;
        });
    });   

}); //Ready

	function popup_enviar_email(){
		window.open('../../theme/sof/layout/pagina_enviar_email/form_enviar_email.html', 'Pagina', 'toolbar=no, status=yes, TOOLBAR=NO, location=no, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=NO, TOP=10, LEFT=10, WIDTH=450, HEIGHT=480');
	}

	function enviar_email(){
		var pagina = document.getElementById("pagina_site").innerHTML;
		var novaJanela = window.open('','_blank','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		novaJanela.document.write("<head>");
		novaJanela.document.write("<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' />");
		novaJanela.document.write("<style tyle='text/css' media='print'>button{display: none;}</style>");
		novaJanela.document.write("<style tyle='text/css' media='all'>a{color: #0000FF;}</style>");
		novaJanela.document.write("</head>");
		novaJanela.document.write("<label>Nome</label><input type='text'/>");
		novaJanela.document.write("<label>Email</label><input type='text'/>");
		novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir P&aacute;gina</button>");
		//novaJanela.document.write(pagina);
		novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir P&aacute;gina</button>");
	}
	

	function imprimir(){
		var pagina = document.getElementById("pagina_site").innerHTML;
		var novaJanela = window.open('','_blank','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		novaJanela.document.write("<head>");
		novaJanela.document.write("<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' />");
		novaJanela.document.write("<style tyle='text/css' media='print'>button{display: none;}</style>");
		novaJanela.document.write("<style tyle='text/css' media='all'>a{color: #0000FF;}</style>");
		novaJanela.document.write("</head>");
		novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir P&aacute;gina</button>");
		novaJanela.document.write(pagina);
		novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir P&aacute;gina</button>");
	}

	function imprimirBook(id_book){
		var novaJanela = window.open('../../mod/book/tool/print/index.php?id='+id_book,'_blank','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		return false;
	}

	function imprimirBookCapitulo(id_book, id_capitulo){
		var novaJanela = window.open('../../mod/book/tool/print/index.php?id='+id_book+'&chapterid='+id_capitulo,'_blank','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		return false;
	}	
