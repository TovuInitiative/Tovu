<?php



if($item <> '')
{
    $contArr = $dispDt->get_commiteeMembers('single', $item, '');
    //displayArray($contArr);
    
	$cont_title 	 = $contArr['title'];
	$cont_article    = $contArr['description'];
    $cont_role 	     = $contArr['leader_role']; 
	
	$cont_extra	    = $contArr['extras'];
	$cont_email	    = @$cont_extra['email']; //.'@email.com';
	$cont_phone	    = @$cont_extra['phone']; //.'727275';
	$cont_mobile	= @$cont_extra['mobile']; //.'727275';
    
    $cont_county_id 	 = $contArr['county_id'];
    
    $cont_county    = $dispDt->get_countyItems('single', $cont_county_id);    
    $cont_title     = $cont_title . ', ' . $cont_county['title'];
    //displayArray($cont_county);
	
	$cont_pic	   = ($contArr['avatar'] <> '') ?  $contArr['avatar'] : 'avatar_generic.png';
	//$cont_pic	   = (@$cont_extra['avatar'] == '' or $cont_extra['avatar'] == 'no_image.png') ? 'avatar_generic.png' : @$cont_extra['avatar'];
	$image_disp	    = "<span class=\"carChopa profile_pic\"><img src=\"".DISP_AVATARS.$cont_pic."\" ></span>";
	// style=\"width:200px; min-height:150px;\"
	$cont_display   = '';
	$cont_wrap_head   = '';
	$cont_head      = array();
	
	if($cont_role <> '') { $cont_role = '<h1 class="nobold">Committee Role: <span class="bold">'.$cont_role.'</span></h1>'; }
	if($cont_email <> '') { $cont_head[] = '<span class="bold"><i class="fa fa-envelope-o"></i> &nbsp;<a href="mailto:'.$cont_email.'">'.$cont_email.'</a></span>'; }
	if($cont_mobile <> '') { $cont_head[] = '<span class="txtright bold"><strong><i class="fa fa-mobile txt17"></i></strong> &nbsp;<a href="tel:'.$cont_mobile.'" title="Mobile">'.$cont_mobile.'</a></span>'; }
	if($cont_phone <> '') { $cont_head[] = '<span class="txtright bold"><strong><i class="fa fa-phone txt15X"></i></strong> &nbsp;<a href="tel:'.$cont_phone.'" title="Direct Line">'.$cont_phone.'</a></span>'; }
	
	
	if(count($cont_head) > 0) { $cont_wrap_head = '<div class="subcolumns txt14">'.implode(' &nbsp;&nbsp; | &nbsp;&nbsp; ',$cont_head).'</div>'; }
	//$cont_display .= '<div class="padd5_t txtjustify">'.$cont_article.'</div>';
	
	echo '<div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title">'.$cont_title.'</h4> </div> <div class="modal-body modal-long nano"><div class="nano-content">';
	?>
	<div class="subcolumns padd15_0">
	    <div class="col-md-4"><?php echo $image_disp; ?></div>
	    <div class="col-md-8">
       <?php 
            echo $cont_role;
            echo $cont_wrap_head;
            echo '<div class="padd5_t txtjustify">';
                if($cont_article <> '')
                {  echo $cont_article; } else
                {  echo display_noContent(); }
            echo '</div>';
        ; ?></div>
	</div>
	<?php
	echo '</div></div> </div> </div>';
}
