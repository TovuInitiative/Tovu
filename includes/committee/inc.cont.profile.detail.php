<?php

$data_arr = $dispDt->get_commiteeMembers('single', $item, '');
//displayArray($data_arr);

if($item <> '')
{
	$contArr  		= master::$contMain['full'][$item];	
	$cont_title 	 = $contArr['title'];
	$cont_article   = $contArr['article'];
	
	$cont_extra	 = $contArr['extras'];
	$cont_email	 = @$cont_extra['email'];
	$cont_phone	 = @$cont_extra['phone'];
	$cont_mobile	= @$cont_extra['mobile'];
	
	//$cont_pic	   = (@$cont_extra['avatar'] <> '') ?  @$cont_extra['avatar'] : 'no_image.png';
	$cont_pic	   = (@$cont_extra['avatar'] == '' or $cont_extra['avatar'] == 'no_image.png') ? 'avatar_generic.png' : @$cont_extra['avatar'];
	$image_disp	 = "<span class=\"carChopa profile_pic\"><img src=\"".DISP_AVATARS.$cont_pic."\" ></span>";
	// style=\"width:200px; min-height:150px;\"
	$cont_display   = '';
	$cont_head      = array();
	
	if($cont_email <> '') { $cont_head[] = '<span class="bold"><i class="fa fa-envelope-o"></i> &nbsp;<a href="mailto:'.$cont_email.'">'.$cont_email.'</a></span>'; }
	if($cont_mobile <> '') { $cont_head[] = '<span class="txtright bold"><strong><i class="fa fa-mobile txt17"></i></strong> &nbsp;<a href="tel:'.$cont_mobile.'" title="Mobile">'.$cont_mobile.'</a></span>'; }
	if($cont_phone <> '') { $cont_head[] = '<span class="txtright bold"><strong><i class="fa fa-phone txt15X"></i></strong> &nbsp;<a href="tel:'.$cont_phone.'" title="Direct Line">'.$cont_phone.'</a></span>'; }
	
	
	if(count($cont_head) > 0) { $cont_display .= '<div class="subcolumns txt14">'.implode(' &nbsp;&nbsp; | &nbsp;&nbsp; ',$cont_head).'</div>'; }
	$cont_display .= '<div class="padd5_t txtjustify">'.$cont_article.'</div>';
	
	echo '<div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title">'.$cont_title.'</h4> </div> <div class="modal-body modal-long nano"><div class="nano-content">';
	?>
	<div>
	<table class="nopadd noborder">
		<tr>
			<td style="width:200px; overflow:hidden;"><?php echo $image_disp; ?></td>
			<td><div class="padd15_l"> <?php echo $cont_display; ?> </div></td>
		</tr>
	</table>
	
	</div>
	<?php
	echo '</div></div> </div> </div>';
}
