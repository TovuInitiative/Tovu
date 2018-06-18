<?php

$item_Content = '';

$section_items 	= master::$contMain['news_events'];
$section_pages 	= array_chunk($section_items, 3, true);
//displayArray($section_items);

$ico_blank 	= 'assets/image/maarifa_favi.png';

if(count($section_pages)) 
{
	$boxes_home = '';
	$boxes_home_long = '';
	$truncFilter 	 = ""; //<a>,<br>,,<strong>,<b><img>
	$truncChars 	  = 50;
	//if($my_redirect == 'index.php') { $truncChars = 70; }
	
	$contPages 		= $section_pages[0];
	//array_sort_by_column($newsItems, 1);
	
	$loopNum 		= 1;
	
	
	foreach ($contPages  as $contVal) 						
	{
		$itemArr	        = master::$contMain['full'][$contVal]; //displayArray($itemArr);
		$cont_id			= $itemArr['id'];
		$cont_parent_id	    = $itemArr['id_menu'];
		$cont_title		    = smartTruncateNew($itemArr['title'],100); 
		
		$cont_title_sub	    = $itemArr['title_sub'];
		$cont_date		    = $itemArr['modified'];
		
		$cont_article		= $itemArr['article'];
		$cont_brief_plain 	= smartTruncateNew(strip_tags($cont_article),$truncChars);
		
		$sector			= ' - ';
		
		$cont_section	 = $itemArr['id_section'];
		if($cont_section == 6){
			$event_date = current($itemArr['event_dates'])['ev_date'];
			$cont_date	= date('M d, Y', $event_date);
			//displayArray($event_dates);
			$ico_blank 	= 'assets/image/icons/ico_calendar.png';
			
			$sector = ', <em class="postDate txtcapital txt10">'.$itemArr['location'].'</em> - '; /*Venue: */
		}
		
		$item_link	   	 = display_linkArticle($cont_id, $itemArr['link_seo']);	
		
		
		/*$sector_id		 = $itemArr['sector_id'];
		$sector			= ($sector_id <> '') ? $ddSelect->getProjectParents('sectors', $sector_id) : 'News';
		if($sector <> '') { }*/
		
/*-------------------------------------------------------------------------------------------------------
@CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/
		
$image_disp = ''; $image_link = '';

if(preg_match('/<img[^>]+\>/i',$cont_article,$regs)) { 
	$image_item = $regs[0];  $pic_small  = autoThumbnail($image_item); 	
	if($pic_small <> '') { $image_link  = '<img src="'.$pic_small.'" alt="'.$cont_title.'" />'; } 
} 
else { $image_link  = getContGalleryPic($cont_id, $cont_title); }

if($image_link == '') { $image_link = '<img src="'.$ico_blank.'" alt="'.$cont_title.'" />'; }
		
if($image_link <> '') {  } 
$image_disp		= '<span class="bitChopa" style="display:none">'.$image_link.'</span>';

/*-------------------------------------------------------------------------------------------------------
@@ END: CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/ 
	
	
		$title_sub		= '';
		$title_date		= '<span class="scrollDate txtgreen txt10">'. $cont_date . '</span>';
	
		
		if($loopNum <= 4)	
		{
			//<div class="project_name"> <a '.$item_link.'  data-id="'.$cont_id.'" class="linkCont bold">'.$cont_title.'</a>'.$title_sub.' </div>
			$item_Content .=  '<li class="row marg15_b padd10_b	"> <div class="subcolumns project_itemX" ><div class="project_wrapX">				
				<div style="position:relative;">
				<div class="project_padd" style="min-height:70px;line-height:1.4">'. $image_disp .'<a '.$item_link.'  data-id="'.$cont_id.'" class="linkCont bold block">'.$cont_title.'</a>'.$title_date.''. $sector .' '. $cont_brief_plain .' </div>
				</div>
				</div> </div>
			</li>'; 
            
		}
			
		$loopNum += 1;
	
	}
	


$boxEqualize = '';
$boxTitleClass = 'box_title box_pink';

?>

<div class="bxslider-news">
<?php //echo display_PageTitle('News and Events', 'h4', ''); ?>

<div>
	<ol class="bxslider bxinner">
		<?php echo $item_Content; ?>
	</ol>			
</div>

</div>

<?php
}
?>