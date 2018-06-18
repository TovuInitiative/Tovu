<?php
include("fckeditor.php") ;

// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "fck_rage" ) ) ;

$oFCKeditor = new FCKeditor('article') ;
$oFCKeditor->BasePath = $sBasePath ;
$oFCKeditor->ToolbarSet = 'Default';
$oFCKeditor->Width = '100%';

$oFCKeditor->Value = $article ;
$oFCKeditor->Create() ;
?>	