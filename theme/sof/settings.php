<?php

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

// logo image setting
	$name = 'theme_sof/logo';
	$title = get_string('logo','theme_sof');
	$description = get_string('logodesc', 'theme_sof');
	$setting = new admin_setting_configtext($name, $title, $description, '', PARAM_URL);
	$settings->add($setting);

	// link color setting
	$name = 'theme_sof/headercolor';
	$title = get_string('headercolor','theme_sof');
	$description = get_string('headercolordesc', 'theme_sof');
	$default = '#E2472F';
	$previewconfig = NULL;
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
	$settings->add($setting);
	
	// link color setting
	$name = 'theme_sof/linkcolor';
	$title = get_string('linkcolor','theme_sof');
	$description = get_string('linkcolordesc', 'theme_sof');
	$default = '#0b4a5b';
	$previewconfig = NULL;
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
	$settings->add($setting);

	// link hover color setting
	$name = 'theme_sof/linkhover';
	$title = get_string('linkhover','theme_sof');
	$description = get_string('linkhoverdesc', 'theme_sof');
	$default = '#666666';
	$previewconfig = NULL;
	$setting = new admin_setting_configcolourpicker($name, $title, $description, $default, $previewconfig);
	$settings->add($setting);
}