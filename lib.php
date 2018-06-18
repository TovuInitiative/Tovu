<?php
require("classes/cls.constants.php"); 
ob_start();

$file_ref = '';
$item_id = '';
$ref_refer = '';
$res_link = '';

if(isset($_REQUEST['id']) and is_numeric($_REQUEST['id'])) {$item_id=$_REQUEST['id'];} else {$file_ref = trim($_GET['f']);}


	
$dispData->siteDocuments();


if($file_ref <> '')
{ $item_id  	   = master::$listResources['_seo'][$file_ref]; }

if($item_id <> '')
{
	$resArr  		= master::$listResources['full'][$item_id];
	
	$res_name      = trim($resArr['cont_title']);
	$res_file	  = trim($resArr['cont_name']);
	$res_ext       = ".".strtolower(substr(strrchr($res_file,"."),1));
	$res_title	 = trim(html_entity_decode(stripslashes($res_name))).$res_ext;
	$res_type	  = $res_ext; //''.trim($resArr['filetype']).'';
	$res_link	  = UPL_FILES.''.$res_file;
	
	$fieldAction = new hitsLog;	
	$result      = $fieldAction->hitsAdd("".$pdb_prefix."dt_downloads",$item_id);	

	download_file($res_link, $res_title, $res_type, $item_id);
	
	
	$item_time ++;
}



function download_file($ffile, $fname, $mime_type='', $item)
{
 if(!is_file($ffile)) die('File not found.');

 $size = filesize($ffile);
 $name = rawurldecode($fname);

 $known_mime_types=array(
 	"pdf" => "application/pdf",
 	"txt" => "text/plain",
 	"html" => "text/html",
 	"htm" => "text/html",
	"exe" => "application/octet-stream",
	"zip" => "application/zip",
	"doc" => "application/msword",
	"xls" => "application/vnd.ms-excel",
	"ppt" => "application/vnd.ms-powerpoint",
	"gif" => "image/gif",
	"png" => "image/png",
	"jpeg"=> "image/jpg",
	"jpg" =>  "image/jpg",
	"php" => "text/plain"
 );
 


 if($mime_type==''){
	 $file_extension = strtolower(substr(strrchr($file,"."),1));
	 if(array_key_exists($file_extension, $known_mime_types)){
		$mime_type=$known_mime_types[$file_extension];
	 } else {
		$mime_type="application/force-download";
	 };
 };

 ob_end_clean(); 

 // required for IE, otherwise Content-Disposition may be ignored
 if(ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off');

 header('Content-Type: ' . $mime_type);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');
 header("Cache-control: private");
 header('Pragma: private');
 readfile($ffile);
 	
 
}

?>