<style type="text/css">
.billboard {
    background-image: -moz-linear-gradient(top,rgba(0,0,0,.03),rgba(255,255,255,.03));
    background-image: -webkit-linear-gradient(top,rgba(0,0,0,.03),rgba(255,255,255,.03));
    background-image: linear-gradient(top,rgba(0,0,0,.03),rgba(255,255,255,.03));
    -moz-border-radius: 0 0 3px 3px;
    -webkit-border-radius: 0 0 3px 3px;
    border-radius: 0 0 3px 3px;
    border-top: 0;
    -moz-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.01);
    -webkit-box-shadow: inset 0 0 2px 0 rgba(0,0,0,.01);
    box-shadow: inset 0 0 2px 0 rgba(0,0,0,.01);
	margin: 0px auto 18px;
    padding: 10px 15px;
	
}




</style>

<?php

//echobr($com_active);
//$dispData->siteContent($com_active);
//displayArray(master::$contMain);
if (is_array(@master::$contMain['intros']) and array_key_exists($comMenuID, master::$contMain['intros']) and $item == '') 
{
	$contArrIntro = master::$contMain['intros'][$comMenuID];
	
	//if(count($contArrIntro) > 0)  {}
	$introKey		   	= current($contArrIntro); 
	$introArray 	   	= master::$contMain['full'][$introKey];

	$intro_title		= $introArray['title'];
	$intro_title_sub	= $introArray['title_sub'];
	$intro_page		  	= $introArray['link_menu'];
	$intro_article	   	= $introArray['article'];
	
	if($my_page_head <> $intro_title) { $intro_title = '<h3>'.$intro_title.'</h3>'; } else { $intro_title = ''; }
	
	echo '<div class="billboard">';
	echo $intro_title;
	echo '<div class="trunc400X" style="display:">'.$intro_article.' &nbsp;</div>';
	echo '</div>';	
	

}

?>
