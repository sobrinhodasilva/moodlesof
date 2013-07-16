<?php // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'pgsql';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'eadsof_moodle22_migrado_244';
$CFG->dbuser    = 'postgres';
$CFG->dbpass    = 'S0fL4titude';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbsocket' => '',
  'dbport' => '8080',
);
#$CFG->reverseproxy = true;
#$CFG->sslproxy = true;
//$CFG->wwwroot   = 'http://186.202.16.22/moodle2';
//$CFG->wwwroot   = 'http://186.202.16.22';
//$CFG->wwwroot = 'http://'.$_SERVER["HTTP_HOST"];
//$CFG->wwwroot = 'http://ead.orcamentofederal.gov.br'; 
//$CFG->wwwroot = 'http://164.41.222.133/eadsof_moodle22'; 
$CFG->wwwroot = 'http://164.41.222.139/eadsof/moodle244_teste'; 

//versao moodle22
$CFG->dataroot  = '/var/eadsof/eadsof_moodledata22';
//$CFG->dataroot  = '/var/eadsof/moodledata237_teste';

$CFG->admin     = 'admin';

$CFG->directorypermissions = 0777;

$CFG->passwordsaltmain = 'o77~6lW1g6Nu^GY;e5EV  H;g!M';

require_once(dirname(__FILE__) . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
