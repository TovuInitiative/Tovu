<?php
	
if(!isset($_GET['isec']) and $my_redirect <> 'sharestory.php') {	
//echo display_PageTitle($my_page_head . '');
}


/*$contKeys 	= @master::$contMain['parent'][$com_active];
$contItems   = array_intersect_key(master::$contMain['full'],$contKeys);
array_sort_by_column($contItems, 'seq', SORT_ASC);*/

$contItems      = $data_arr;
$cont_display = '';
$cont_profs = array();

foreach($contItems as $contArr)	
{	
	//$contArr  		= master::$contMain['full'][$contKey];	
	$cont_id 	    = $contArr['leader_id'];
	$cont_title 	 = $contArr['leader_name'];
	$cont_seo 	   = generate_seo_title($cont_title, '-'); //trim($contArr['title']);
	
    $cont_role 	 =  $contArr['leader_role'];     //($contArr['leader_role_id'] == 1) ? 'Chair' : 'Member';
    $cont_avatar 	 = $contArr['avatar'];
	
	//$cont_link 	  = display_linkArticle($cont_id, $contArr['link_seo']);
	$cont_link	  = ' data-href="ajforms.php?d=cmt_mem_profile&item='.$cont_id.'"  rel="modal:open" ';
	
	//$cont_extra	   = $contArr['extras'];
	//$cont_role	   = (array_key_exists('role',$cont_extra)) ? $cont_extra['role'] : '';
	//$cont_avatar	= (array_key_exists('avatar',$cont_extra)) ? $cont_extra['avatar'] : '';
	
	$cont_pic	   = ($cont_avatar == '' or $cont_avatar == 'no_image.png') ? 'avatar_generic.png' : $cont_avatar;
	
	$image_disp	    = '<img src="'.DISP_AVATARS.$cont_pic.'" >';
	$cont_pic_disp  = '<span class="carChopa profile_pic"><span class="bitChopaWrap" style="display:">'.$image_disp.'</span></span>';
	
	
	$submenu_display = '<span>'.$cont_role.'</span>';
	
	//$cont_seq 	 = ($contArr['seq'] <> 9 and !array_key_exists($contArr['seq'],$cont_profs)) ? $contArr['seq'] : $cont_id;
	//<br>'.$cont_avatar.'
	$cont_profs[] = '<li><div class="block equalized"><a '.$cont_link.' class="menu-column-main">'.$cont_pic_disp.' '.$cont_title.'</a><br /><div class="menu-column-subs">'.$submenu_display.'</div></div></li>';
	
}
	
	echo '<div class="wrap_gallery padd20_0"><ul id="" class="column menu-column">';
	echo implode('',$cont_profs); 
	echo '</ul></div>';
?>