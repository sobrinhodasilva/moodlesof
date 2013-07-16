<?php
 //user defined columns to show or now
function sof_initialise_colpos(moodle_page $page) {
    user_preference_allow_ajax_update('theme_sof_chosen_colpos', PARAM_ALPHA);
}

function sof_get_colpos($default='panelopen') {
    return get_user_preferences('theme_sof_chosen_colpos', $default);
}


function sof_process_css($css, $theme) {
	
	
	if (!empty($theme->settings->headercolor)) {
        $headercolor = $theme->settings->headercolor;
    } else {
        $headercolor = null;
    }
    $css = sof_set_headercolor($css, $headercolor);
	
	
    // Set the link color
    if (!empty($theme->settings->linkcolor)) {
        $linkcolor = $theme->settings->linkcolor;
    } else {
        $linkcolor = null;
    }
    $css = sof_set_linkcolor($css, $linkcolor);

	// Set the link hover color
    if (!empty($theme->settings->linkhover)) {
        $linkhover = $theme->settings->linkhover;
    } else {
        $linkhover = null;
    }
    $css = sof_set_linkhover($css, $linkhover);
        

    // Return the CSS
    return $css;
}

/**
 * Sets the link color variable in CSS
 *
 */
 
function sof_set_headercolor($css, $headercolor) {
    $tag = '[[setting:headercolor]]';
    $replacement = $headercolor;
    if (is_null($replacement)) {
        $replacement = '#E2472F';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
} 
 
function sof_set_linkcolor($css, $linkcolor) {
    $tag = '[[setting:linkcolor]]';
    $replacement = $linkcolor;
    if (is_null($replacement)) {
        $replacement = '#0b4a5b';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

function sof_set_linkhover($css, $linkhover) {
    $tag = '[[setting:linkhover]]';
    $replacement = $linkhover;
    if (is_null($replacement)) {
        $replacement = '#666666';
    }
    $css = str_replace($tag, $replacement, $css);
    return $css;
}

