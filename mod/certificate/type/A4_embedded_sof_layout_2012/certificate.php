<?php


/********************************************************************************************************
 ******************** FUNÇÕES CRIADAS PARA ATENDER O CERTIFICADO DA EVSOF *******************************
 ********************************************************************************************************/

 
/********
 * Retorna o periodo do curso e data de emissao do certificado do curso
 * Periodo: data de inicio do curso + quantidade de topicos/semanas
 *
 * @author Wesley Gongora de Almeida - julho/2012 (hack em 30-10-2012 para $duracao e $dataEmissao)
 *
 * @param stdClass $certificate
 * @param stdClass $course
 * @return string the date
 *******/
function certificate_get_date_course($course) {
    global $DB, $USER;

	$sql_dtInicio = "SELECT startdate
					 FROM {course} c
					 WHERE
					 c.id = :courseid";
				
	if ($timeCouseStart = $DB->get_record_sql($sql_dtInicio, array('courseid'=>$course->id))) {
		$courseStart = $timeCouseStart->startdate; 
		
		//utiliza a funcao get_field() para obter o numero de semanas/tópicos do curso. 
		//Utilizado para descobrir a data de término
		$duracao = $DB->get_field('course_format_options', 'value', array('courseid' => $course->id, 'name' => 'numsections'), MUST_EXIST);
	}
	

	/* A partir da quantidade de topicos/semanas, sera possivel descobrir o termino do curso:
	 * Padrao SOF - Metade da quantidade de semanas dividido, menos 2 dias (sabado e domingo)
	 * 10 semanas: Orçamento Público, 33 dias de curso (5 semanas)
	 * 6 semanas: Básico em OP,       19 dias de curso (3 semanas)
	 */
	$duracao = ($duracao * 3.5) - 3; //0,5 * 7 (metade de semanas * 7 dias da semana, menos sabado,domingo e primeiro dia)
	$dataInicio  = date("d/m/Y", $courseStart);	
	$dataTermino = date("d/m/Y", strtotime("+{$duracao} day", $courseStart ) ); 
	
	$dataEmissao = date("Y-m-d", strtotime("+{$duracao} day", $courseStart ) ); //último dia de realização do curso		
	
	$periodo_realizacao_curso['dataInicio']  = $dataInicio; 
	$periodo_realizacao_curso['dataTermino'] = $dataTermino;
	$periodo_realizacao_curso['duracao']     = $duracao;
	$periodo_realizacao_curso['dataEmissao'] = $dataEmissao;	 
	
	//debug
	//echo '<br/>periodo_realizacao_curso[dataInicio]:'.$periodo_realizacao_curso['dataInicio'] ; 
	//echo '<br/>periodo_realizacao_curso[dataTermino]'.$periodo_realizacao_curso['dataTermino'];
	//echo '<br/>periodo_realizacao_curso[duracao]'.$periodo_realizacao_curso['duracao']    ;
	//echo '<br/>periodo_realizacao_curso[dataEmissao]'.$periodo_realizacao_curso['dataEmissao'];	
	
	
    //return $dataInicio.' a '.$dataTermino;
    return $periodo_realizacao_curso;
}




/************
 * utilizado a funcao abaixo com adaptacoes nas margens 
 * cert_printtext($pdf, $x, $y, $align, $font, $style, $size, $text)
 * 
 * Sends text to output given the following params.
 *
 * @param stdClass $pdf
 * @param int $x horizontal position
 * @param int $y vertical position
 * @param char $align L=left, C=center, R=right
 * @param string $font any available font in font directory
 * @param char $style ''=normal, B=bold, I=italic, U=underline
 * @param int $size font size in points
 * @param string $text the text to print
 * @return null
 */
/* function cert_printtext_ajusteMargem($pdf, $x, $y, $align, $font, $style, $size, $text) {
    $pdf->setFont($font, $style, $size);
    $pdf->SetXY($x, $y);
    $pdf->writeHTMLCell(0, 0, '', '', $text, array('LTRB' => array('width' => 32, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0))), 0, 0, true, $align);
}*/

/**
 * Sends text to output given the following params.
 *
 * @param stdClass $pdf
 * @param int $x horizontal position
 * @param int $y vertical position
 * @param char $align L=left, C=center, R=right
 * @param string $font any available font in font directory
 * @param char $style ''=normal, B=bold, I=italic, U=underline
 * @param int $size font size in points
 * @param string $text the text to print
 */
function certificate_print_text_ajusteMargem($pdf, $x, $y, $align, $font='freeserif', $style, $size=10, $text) {
    $pdf->setFont($font, $style, $size);
    $pdf->SetXY($x, $y);
    $pdf->writeHTMLCell(0, 0, '', '', $text, 0, 0, 0, true, $align);
}





/* WESLEY-WGA: Data por extenso na Data de Emissão do Cerificado */
function data_extenso($data_emissao) {
	
	//debug
	//echo 'debug echo data_emissao:'.$data_emissao;
	
	$data_emissao = explode("-",$data_emissao);

	$dia = $data_emissao[2];
	$mes = $data_emissao[1];
	$ano = $data_emissao[0];
	
	switch ($mes){

		case 1:  $mes = "janeiro"; break;
		case 2:  $mes = "fevereiro"; break;
		case 3:  $mes = "março"; break;
		case 4:  $mes = "abril"; break;
		case 5:  $mes = "maio"; break;
		case 6:  $mes = "junho"; break;
		case 7:  $mes = "julho"; break;
		case 8:  $mes = "agosto"; break;
		case 9:  $mes = "setembro"; break;
		case 10: $mes = "outubro"; break;
		case 11: $mes = "novembro"; break;
		case 12: $mes = "dezembro"; break;
	}

	//$mes=strtolower($mes);

	return ("$dia de $mes de $ano");

}







// This file is part of the Certificate module for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * A4_embedded certificate type
 *
 * @package    mod
 * @subpackage certificate
 * @copyright  Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


 
 
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from view.php
}


	/* Variaveis criadas para personalização do certificado
	 *
	 * NOME DO CURSO				$nome_curso              : 		é o ($course->fullname) até o primeiro traço (-). Após o traço informações sobre a oferta e Status "aberta/encerrado/etc".
	 * DATA TÉRMINO	PRORROGADA		$data_termino_prorrogada :		Campo $certificate->customtext até encontrar 
	 * PERIODO REALIZAÇÃO DO CURSO	$periodo_realizacao_curso:		TEXTO PERSONALIZADO no formato "termino:dd/mm/aaaa" em $certificate->customtext
	 * TEXTO DO CERTIFICADO FRENTE	$texto_certificado_frente: 		texto do certificado na frente. Contem o ($nome_curso), nome do aluno ($certificate->name), 
	 
	 * Nome do curso: $nome_curso                é o $certrecord->classname até o traço (-)
	 * Data inicio  : $datasCurso['dataInicio']
	 * Data termino : $datasCurso['dataTermino'] ou 
	 *                $data_termino_prorrogada (caso tenha sido prorrogado)
	 * Data Emissao : $dataEmissaoPadrao ou
	 *				  $data_hoje (caso estudante emita certificado antes da data de termino do curso)			
	 * Data registro: $dia_emissao e $hora_emissao (na segunda página)
	 */


	/* NOME DO CURSO 
	 * é o "nome completo do curso". regra de negócio: tudo que está após o primeiro traço (-) é ignorado (nome da oferta)
	 * retira o texto antes do traço (-) no completo do curso ($course->fullname)
	 */
	$temp_curso_array = explode("-",$course->fullname); 
	$nome_curso = trim($temp_curso_array[0]);

	
 
	/* 
 	 * DATA TÉRMINO PRORROGADA
	 * verifica se o curso foi prorrogado, 
	 * atraves da existencia da expressao, OBRIGATORIAMENTE na última linha do TEXTO PERSONALIZADO, no formato "termino:dd/mm/aaaa" em $certificate->customtext (texto personalizado em cada certificado)
	 */
	$temp_customtext = explode('termino:',$certificate->customtext); 
	if ( count($temp_customtext) == 2 ) { //SE maior que 1, ENTÃO curso foi prorrogado
		$certificate->customtext   = $temp_customtext[0]; //VAR $certificate->customtext recebe somente a parte da ementa
		$data_termino_prorrogada   = $temp_customtext[1]; //data termino caso curso prorrogado
	}

	
	//PERIODO REALIZAÇÃO DO CURSO
	$temp_periodo_realizacao_curso = certificate_get_date_course($course); //funcao criada para atender EVSOF, no final deste arquivo
	//caso a data tenha sido prorrogada, utiliza a nova data, informada via TEXTO PERSONALIZADO do Certificado
	if (isset($data_termino_prorrogada) ) {
		$periodo_realizacao_curso = $temp_periodo_realizacao_curso['dataInicio'] . ' a ' . $data_termino_prorrogada;
	} else {
		$periodo_realizacao_curso = $temp_periodo_realizacao_curso['dataInicio'] . ' a ' . $temp_periodo_realizacao_curso['dataTermino'];
		
		//debug
		//echo '<br/>$periodo_realizacao_curso:'.$periodo_realizacao_curso;
	}
	//data de emissão do certificado
	$dataEmissaoPadrao  = $temp_periodo_realizacao_curso['dataEmissao']; //$certdate;//$datasCurso['dataTermino']; //str_replace(' 0', '', strftime('%d de %B de %Y', strtotime($datasCurso['dataTermino']) ));	
	
	
	
	//debug
	//echo '<br/>LINHA 224:debug--$temp_periodo_realizacao_curso[dataEmissao]:'.$temp_periodo_realizacao_curso['dataEmissao'].'<br/>';

	
	
	//TEXTO DO CERTIFICADO FRENTE
	$texto_certificado_frente = '<div>Certificamos que <b>'.fullname($USER).'</b> concluiu o curso <b>'.$nome_curso.'</b>, na modalidade de Ensino a Dist&acirc;ncia realizado no per&iacute;odo de<i> '.$periodo_realizacao_curso.'</i>, pela Escola Virtual da Secretaria de Or&ccedil;amento Federal.';
		
	
	$data_hoje = date('Y-m-d');	//utilizada para verificar se a data de solicitacao de emissao é anterior a data atual
	/* 
	 * DATA DE EMISSÃO DO CERTIFICADO. 
	 *	2 Verificações, para então alterar a data de emissão:
	 * 				1)Verificar se a data foi prorrogada, para então alterar a data de emissão
	 *				2)Verificar se a $data_hoje é menor que a data termino padrão, 
	 * 
	 * se a data na qual o certificado esta sendo emitido é anterior a data de 
	 * termino do curso (data de emissao padrao), entao data de emissao é a data atual
	 */
	if (isset($data_termino_prorrogada) ) { //#wesley - melhorar a estrutura dpois

		//formata data de dd/mm/AAAA para YYYY-mm-dd, variável $data_termino_prorrogada
		$d=explode("/",$data_termino_prorrogada);
		$data_termino_prorrogada=$d[2]."-".$d[1]."-".$d[0];	
	 

		if ($data_hoje <= $data_termino_prorrogada){
			$data_certificado_formatada = data_extenso($data_hoje);
		} else {
			$data_certificado_formatada = data_extenso($data_termino_prorrogada);
		}

	} else {

		if ($data_hoje < $dataEmissaoPadrao){
			$data_certificado_formatada = data_extenso($data_hoje);
		} else {
			//echo '<br/>------debug--dataEmissaoPadrao:'.$dataEmissaoPadrao.'| data_hoje:'.$data_hoje.'<br/>';
			$data_certificado_formatada = data_extenso($dataEmissaoPadrao);
		}
	}	
	
	
	

//FIM-WESLEY EDICAO

	//WESLEY-SO 1LINHA - ORIGINAL COMENTADO - CORRGIR
	//$texto_certificado_frente .= "<br/><br/>Bras&iacute;lia, ".$dataEmissaoPadrao.".</div>";
	$texto_certificado_frente .= "<br/><br/>Bras&iacute;lia, ".$data_certificado_formatada.".</div>";
//}

//echo $texto_certificado_frente;exit();


	

$pdf = new PDF($certificate->orientation, 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetTitle($certificate->name);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage();

// Define variables
// Landscape
if ($certificate->orientation == 'L') {
    $x = 10;
    $y = 30;
    $sealx = 30;
    $sealy = 150;
    $sigx = 47;
    $sigy = 155;
    $custx = 47;
    $custy = 155;
    $wmarkx = 40;
    $wmarky = 31;
    $wmarkw = 212;
    $wmarkh = 148;
    $brdrx = 0;
    $brdry = 0;
    $brdrw = 297;
    $brdrh = 210;
    $codey = 175;
} else { // Portrait
    $x = 10;
    $y = 40;
    $sealx = 150;
    $sealy = 220;
    $sigx = 30;
    $sigy = 230;
    $custx = 30;
    $custy = 230;
    $wmarkx = 26;
    $wmarky = 58;
    $wmarkw = 158;
    $wmarkh = 170;
    $brdrx = 0;
    $brdry = 0;
    $brdrw = 210;
    $brdrh = 297;
    $codey = 250;
}

// Add images and lines

/*INICIO-HACK-WESLEY-WGA********************/
$certificate->borderstyle = 'certificado_evsof_frente.png';
/*FIM-HACK-WESLEY-WGA*******************/
certificate_print_image($pdf, $certificate, CERT_IMAGE_BORDER, $brdrx, $brdry, $brdrw, $brdrh);

// Imagens nao utilizadas
	//certificate_draw_frame($pdf, $certificate);
	// Set alpha to semi-transparency
	//$pdf->SetAlpha(0.2);
	//certificate_print_image($pdf, $certificate, CERT_IMAGE_WATERMARK, $wmarkx, $wmarky, $wmarkw, $wmarkh);
	//$pdf->SetAlpha(1);
	//certificate_print_image($pdf, $certificate, CERT_IMAGE_SEAL, $sealx, $sealy, '', '');

/*INICIO_EVSOF_CUSTONIZACAO - WESLEY-WGA: Centralizar a assinatura*/
$sigx_assinatura = 121; /*valor original de $sigx = 30;*/
$sigy_assinatura = 162; /*valor original de $sigy = 230;*/
certificate_print_image($pdf, $certificate, CERT_IMAGE_SIGNATURE, $sigx_assinatura, $sigy_assinatura, '', '');
/*FIM_EVSOF_CUSTONIZACAO - WESLEY-WGA: Centralizar a assinatura*/




// Add text
$pdf->SetTextColor(0, 0, 0);

/* #EVSOF_CUSTOMIZACAO - Wesley2013 */
//cert_printtext_ajusteMargem($pdf, $x + 15, $y + 60, 'C', 'freesans', '', 15, $texto_certificado_frente);
certificate_print_text_ajusteMargem($pdf, $x + 15, $y + 76, 'C', 'freesans', '', 15, $texto_certificado_frente);
/* #EVSOF_CUSTOMIZACAO_FIM - Wesley2013 */




/********************************************************************************************************
 **************************************** Segunda Página (verso) ****************************************
 ********************************************************************************************************/
 
$pdf->AddPage();

// Define variables
// Landscape
if ($certificate->orientation == 'L') {
    $x = 10;
    $y = 30;
    $sealx = 30;
    $sealy = 150;
    $sigx = 47;
    $sigy = 155;
    $custx = 47;
    $custy = 155;
    $wmarkx = 40;
    $wmarky = 31;
    $wmarkw = 212;
    $wmarkh = 148;
    $brdrx = 0;
    $brdry = 0;
    $brdrw = 297;
    $brdrh = 210;
    $codey = 175;
} else { // Portrait
    $x = 10;
    $y = 40;
    $sealx = 150;
    $sealy = 220;
    $sigx = 30;
    $sigy = 230;
    $custx = 30;
    $custy = 230;
    $wmarkx = 26;
    $wmarky = 58;
    $wmarkw = 158;
    $wmarkh = 170;
    $brdrx = 0;
    $brdry = 0;
    $brdrw = 210;
    $brdrh = 297;
    $codey = 250;
}

// Add images and lines

/*INICIO-HACK-WESLEY-WGA********************/
$certificate->borderstyle = 'certificado_evsof_verso.png';
/*FIM-HACK-WESLEY-WGA*******************/
certificate_print_image($pdf, $certificate, CERT_IMAGE_BORDER, $brdrx, $brdry, $brdrw, $brdrh);

certificate_draw_frame($pdf, $certificate);
// Set alpha to semi-transparency
$pdf->SetAlpha(0.2);
certificate_print_image($pdf, $certificate, CERT_IMAGE_WATERMARK, $wmarkx, $wmarky, $wmarkw, $wmarkh);
$pdf->SetAlpha(1);
certificate_print_image($pdf, $certificate, CERT_IMAGE_SEAL, $sealx, $sealy, '', '');



// Add text
//$pdf->SetTextColor(0, 0, 120);
//certificate_print_text($pdf, $x, $y, 'C', 'freesans', '', 30, get_string('title', 'certificate'));
$pdf->SetTextColor(0, 0, 0);

/* #EVSOF_CUSTOMIZACAO - Wesley2013 */
//cert_printtext_ajusteMargem($pdf, $x + 15, $y + 60, 'C', 'freesans', '', 15, $texto_certificado_frente);
//certificate_print_text_ajusteMargem($pdf, $x + 15, $y + 76, 'C', 'freesans', '', 15, $texto_certificado_frente);
/* #EVSOF_CUSTOMIZACAO_FIM - Wesley2013 */



//certificate_print_text($pdf, $x, $y + 20, 'C', 'freeserif', '', 20, get_string('certify', 'certificate'));
//certificate_print_text($pdf, $x, $y + 36, 'C', 'freesans', '', 30, fullname($USER));
//certificate_print_text($pdf, $x, $y + 55, 'C', 'freesans', '', 20, $texto_certificado_frente ); //texto do certificado - frente
//certificate_print_text($pdf, $x, $y + 72, 'C', 'freesans', '', 20, $course->fullname);
//certificate_print_text($pdf, $x, $y + 92, 'C', 'freesans', '', 14,  certificate_get_date($certificate, $certrecord, $course));
certificate_print_text($pdf, $x, $y + 102, 'C', 'freeserif', '', 10, certificate_get_grade($certificate, $course));
certificate_print_text($pdf, $x, $y + 112, 'C', 'freeserif', '', 10, certificate_get_outcome($certificate, $course));

//if ($certificate->printhours) {
   // certificate_print_text($pdf, $x, $y + 122, 'C', 'freeserif', '', 10, get_string('credithours', 'certificate') . ': ' . $certificate->printhours);
//}

$i = 0;
if ($certificate->printteacher) {
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if ($teachers = get_users_by_capability($context, 'mod/certificate:printteacher', '', $sort = 'u.lastname ASC', '', '', '', '', false)) {
        foreach ($teachers as $teacher) {
            $i++;
            certificate_print_text($pdf, $sigx, $sigy + ($i * 4), 'L', 'freeserif', '', 12, fullname($teacher));
        }
    }
}

/* INICIO _ EVSOF_CUSTOMIZACAO - #WESLEY-WGA */
$custx_verso = 21;
$custy_verso = 45;
certificate_print_text($pdf, $custx_verso, $custy_verso, 'L', 'freesans', null, 16, $certificate->customtext.'<br/><b>Carga-horária: '.$certificate->printhours.' horas</b>');
/* FIM _ EVSOF_CUSTOMIZACAO - #WESLEY-WGA */


// Mostra o "code number" independente das configurações do cerficado, comentando o "if ($certificate->printnumber)"
//$code = '';
//if ($certificate->printnumber) {
    $codigo = $certrecord->code;
//}
certificate_print_text($pdf, 215, 173, 'C', 'freesans', '', 14, $codigo );


// data de impressão do certificado
$dia_emissao  = date("d/m/Y"); 
$hora_emissao = date("H:i");
certificate_print_text($pdf, 94, 172, 'C', 'freesans', '', 10, 'Certificado registrado na Escola Virtual');
certificate_print_text($pdf, 90, 176, 'C', 'freesans', '', 10, 'SOF em '.$dia_emissao. ' &agrave;s '.$hora_emissao.' horas');



?>