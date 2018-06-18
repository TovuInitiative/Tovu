<?php
require_once('cls.base.php');
/*
define('SITE_FOLDER', '/'.$adminConfig['SITE_FOLDER'].'/'  );	
$domain_www_off 	= $_SERVER['HTTP_HOST']; 	
$site_path_text = $_SERVER['DOCUMENT_ROOT'].SITE_FOLDER;

define('SITE_DOMAIN_LIVE', "http://".$domain_www_off.SITE_FOLDER );	
define('SITE_PATH',   $site_path_text);	*/

if($_SERVER['HTTP_HOST'] == "localhost") { 
	define('SITE_FOLDER', $adminConfig['SITE_FOLDER'].'/'  );	
	$domain_url 	 = $_SERVER['HTTP_HOST'].$adminConfig['SITE_ALIAS'].'/'; 	
	$stroke 		= pathSlash($_SERVER['CONTEXT_DOCUMENT_ROOT'],-1);
	$domain_root    = $_SERVER['CONTEXT_DOCUMENT_ROOT'].$stroke.SITE_FOLDER; 
} 
else{
	define('SITE_FOLDER', '/'.$adminConfig['SITE_FOLDER'].'/'  );	
	$domain_url 	 = $_SERVER['HTTP_HOST']; 	
	$domain_root    = $_SERVER['DOCUMENT_ROOT'].SITE_FOLDER; 
}

define('SITE_DOMAIN_LIVE', 	   "http://".$domain_url.SITE_FOLDER );	
define('SITE_PATH',   		  $domain_root);	

//echo(SITE_PATH);
?>