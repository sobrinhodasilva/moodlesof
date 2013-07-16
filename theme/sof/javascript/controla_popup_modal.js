$(document).ready( function() {	
	
	$('a[name=modal]').click(function(e) {			
		e.preventDefault();
		
		var id = $(this).attr('href');
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('.evsof_popup_mask').css({'width':maskWidth,'height':maskHeight});

		$('.evsof_popup_mask').fadeIn(1000);	
		$('.evsof_popup_mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		$(id).fadeIn(2000); 
	
	});
	
	$('#evsof_resposta_dialog').click(function(e) {
		e.preventDefault();
		
		var id = $(this).attr('href');
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('.evsof_popup_mask').css({'width':maskWidth,'height':maskHeight});

		$('.evsof_popup_mask').fadeIn(1000);	
		$('.evsof_popup_mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		$(id).fadeIn(2000); 
	
	});
	
	$('.evsof_popup_window .evsof_popup_fechar').click(function (e) {
		e.preventDefault();
		$('.evsof_popup_mask').hide();
		$('.evsof_popup_window').hide();
	});
	
	$('.evsof_popup_mask').click(function () {
        $(this).hide();
        $('.evsof_popup_window').hide();
    });

	// Quando o formulário for enviado, essa função é chamada
	$('input[type="submit"]').click(function(){
	
		// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
		var evsof_certificado_codigo = $("#evsof_certificado_codigo").val();
			
		$("#status").html("<img src='theme/sof/pix/ajax-loader.gif' alt='Enviando' />");
		// Fazemos a requisão ajax com o arquivo <valida_certificado_resultado.php> e enviamos os valores de cada campo através do método POST
		$.post('blocks/valida_certificado/valida_certificado_resultado.php', {evsof_certificado_codigo: evsof_certificado_codigo}, function(resposta) {
			//exibe o resultado recebido
			$("#status").html(resposta);		
		});
	});	
});