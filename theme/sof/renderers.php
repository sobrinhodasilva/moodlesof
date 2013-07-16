<?php
 
include_once($CFG->dirroot . "/blocks/navigation/renderer.php"); 
 
class theme_sof_block_navigation_renderer extends block_navigation_renderer {
  
    public function navigation_node($items, $attrs=array(), $expansionlimit=null, array $options = array(), $depth=1) {
        global $USER, $CFG;

        $pages_text = array('Escola Virtual', 'Cursos', 'EAD - Educação a Distância', 'Orçamento Público', 'Básico em Orçamento Público', 'Lei de diretrizes orçamentárias para municípios', 'Receita Pública', 'Tutoria', 'Federalismo', 'Parceiros', 'Universidade de Brasília', 'Banco do Brasil', 'Escola da Advocacia-Geral da União', 'Perguntas Frequentes ', 'Fale conosco', 'Rede Nacional de Planejamento e Orçamento','Fundação Escola de Governo de Mato Grosso do Sul');

        //Oculta as páginas acima do bloco de navegação
        foreach ($items as $item) {
            if ($item->title == 'Página' && in_array($item->text,$pages_text)) {
                $item->display = false;
            }
        }

        return parent::navigation_node($items, $attrs, $expansionlimit, $options, $depth);
    }
}
