<?php
require_once('cls.base.php');

define('DB_HOST', 		'localhost');
define('DB_CHARSET', 	 'utf8');

if($_SERVER['HTTP_HOST'] == "localhost") { 
	define('DB_NAME', 'infohub-platfom');	
	define('DB_USER', '');
	define('DB_PASSWORD', '');
} else {
	define('DB_NAME', 		'');	
	define('DB_USER', 	 	'');
	define('DB_PASSWORD', 	''); 
}

$pdb_prefix = 'mrfc_';

?>
