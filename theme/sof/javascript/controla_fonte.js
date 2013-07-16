//Constantes
var MAX_FONTE = 13;
var MIN_FONTE = 10;
var AUMENTAR = 1;
//Variavel que armazena o tamanho corrente
var fonteCorrente = 11; //Definir o tamanho inicial com o tamanho da fonte do css padrao.
var fonteClasse = 11; //Definir o tamanho inicial com o tamanho da fonte do css padrao.
function zoomClasse(tipoOperacao) { //1 para reduzir, 2 para aumentar
	if (tipoOperacao == AUMENTAR) {
		if (fonteClasse < MAX_FONTE) 
			fonteClasse++;
	}
	else { //Se nao for aumentar, reduz.
		if (fonteCorrente > MIN_FONTE) 
			fonteClasse--;				
	}
	$('#page-content, #page-content *').css({'font-size': fonteClasse + 'px'});
}