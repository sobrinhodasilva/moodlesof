jQuery.fn.toggleText = function(a,b) {
	return   this.html(this.html().replace(new RegExp("("+a+"|"+b+")"),function(x){return(x==a)?b:a;}));
}

$(document).ready(function(){
	//descobrir a URL do servidor - Pega a url e coloca na variavel url
	var $url = window.location;
	// converte em String
	$url = $url.toString();
	// converte em um array separando pelos (.)
	$url = $url.split("/");
	$url = "http://"+$url[2]+"/"; //+$url[3]+"/";
	//alert($url); DEBUG-Verifica URL

	$('.evsof_pergunta_caixa_texto').before('<span class="evsof_pergunta_caixa_titulo_link_mostrar" title="Clique para exibir resposta para a Pergunta Frequente"><img class="evsof_pergunta_caixa_titulo_imagem" src="'+$url+'theme/image.php?theme=sof&image=icone_exibir&component=theme" alt="Clique para exibir resposta para a Pergunta Frequente" title="Clique para exibir resposta para a Pergunta Frequente" /> </span>');
	$('.evsof_pergunta_caixa_texto').css('display', 'none')
	$('span', '.evsof_pergunta_caixa').click(function() {
		$(this).next().slideToggle('slow')
		.siblings('.evsof_pergunta_caixa_texto:visible').slideToggle('fast');
		// aqui começa o funcionamento do plugin
		$(this).toggleText('exibir','ocultar')
		.siblings('span').next('.evsof_pergunta_caixa_texto:visible').prev()
		.toggleText('exibir','ocultar')
	});
})