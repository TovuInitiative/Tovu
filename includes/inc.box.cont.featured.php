
<?php

//$contLatest = master::$contMain['front']; //$dispData->contFront;
$item_Content = '';

//$section_items 	= master::$contMain['front'];
$section_items 	= master::$contMain['section'][1];
$section_pages 	= array_chunk($section_items, 4, true);

if(count($section_pages)) 
{
	$boxes_home = '';
	$boxes_home_long = '';
	$truncFilter 	 = ""; //<a>,<br>,,<strong>,<b><img>
	$truncChars 	  = 150;
	//if($this_page == 'index.php') { $truncChars = 100; }
	
	$contPages 		= $section_pages[0];
	//array_sort_by_column($newsItems, 1);
	
	$loopNum 		= 1;
	
	
	foreach ($contPages  as $contVal) 						
	{
		$itemArr	        = master::$contMain['full'][$contVal]; //displayArray($itemArr);
		$cont_id			= $itemArr['id'];
		$cont_parent_id	 = $itemArr['id_menu'];
		$cont_title		 = smartTruncateNew($itemArr['title'],200); 
		
		$cont_title_sub	 = $itemArr['title_sub'];
		$cont_date		  = $itemArr['modified'];
		
		$cont_article		= $itemArr['article'];
		//$cont_brief_plain 	= smartTruncateNew(strip_tags($cont_article),$truncChars, ' ');
		$cont_brief_plain	= string_truncate(strip_tags_clean($cont_article), $truncChars, ' ');	
		
		$item_link	   	 = display_linkArticle($cont_id, $itemArr['link_seo']);	
		$other_link		= @$itemArr['extras']['other_link'];
		if($other_link <> '') {
			$item_link = 'href="'.$other_link.'"';
		}
		
		$sector			= '';
		/*$sector_id		 = $itemArr['sector_id'];
		$sector			= ($sector_id <> '') ? $ddSelect->getProjectParents('sectors', $sector_id) : 'News';
		if($sector <> '') { $sector = '<span class="highbtn hcont">'.$sector.'</span>';}*/
		
/*-------------------------------------------------------------------------------------------------------
@CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/
		
$image_disp = ''; $image_link = '';
        
if(preg_match('/<img[^>]+\>/i',$cont_article,$regs)) { 
	$image_item = $regs[0];  $pic_small  = autoThumbnail($image_item); 	
	if($pic_small <> '')  { $image_link		= '<img src="'.$pic_small.'" alt="'.$cont_title.'" />'; } 
} 
else { $image_link  = getContGalleryPic($cont_id, $cont_title); }

if($image_link <> '') 
{ $image_disp		= '<span class="bitChopaWrap" style="display:none">'.$image_link.'</span>'; }         

/*-------------------------------------------------------------------------------------------------------
@@ END: CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/ 
	
	
		$title_sub		= '';
		$title_date		= ''; //'<span class="scrollDate txtgreen txt10">'.$cont_date.' - </span>';
	
		
		if($loopNum <= 4)	
		{
		  /*$boxes_feat .= '<div class="home-bits" style=" margin-bottom: 15px">			
			<div class="padd15_b  " style="overflow:hidden;">
			 '. $image_disp .'
			<div style="border-bottom:1px dotted #999;"><a href="'.$item_link.'" class="'.$headLinkIcon.' txt13 linkCont" data-id="'.$cont_id.'">'.$cont_title.'</a></div> <div class="grey-text">Viewed '.$cont_hits.' times  | Published  '.$title_date.' </div>
			 '. $cont_brief .'
			</div> 
			</div>';*/
            $item_Content .=  '<div class="home-bits" style=" margin-bottom: 15px"> <div class="subcolumns padd5_t padd10_b" ><div class="">
				<div class="project_name"> <a '.$item_link.'  data-id="'.$cont_id.'" class="linkCont txt19 bold">'.$cont_title.'</a>'.$title_sub.' </div>
				<div style="position:relative;">
				<div class="project_padd txt15" style="min-height:50px">'. $image_disp .''.$title_date.' '. $cont_brief_plain .' '. $sector .'</div>
				</div>
				</div> <a '.$item_link.' class="linkCont" data-id="'.$cont_id.'">Read More</a></div>
			</div>'; 
				
		$loopNum += 1;
		}
			
		$loopNum += 1;
	
	}
	


$boxEqualize = '';
$boxTitleClass = 'box_title box_pink';

$boxStyle = ' style="height:190px;overflow:scroll; overflow-x:hidden; "'; //
//if($this_page == 'index.php') { $carouselEqualize = 'equalized'; }
if($this_page == 'index.php') { $boxStyle = ' style="height:300px; overflow:scroll; overflow-x:hidden;"'; $boxEqualize = 'equalized'; }
?>

<?php /*?><div class="<?php echo $boxEqualize; ?>">
	<h3 class="txtupper">Whats New</h3>
	<!-- @@news-list -->
	<div class="subcolumns coolScroll " <?php echo $boxStyle; ?>>
		
	</div>
	<!-- @@END - news-list -->
</div><?php */?>

<?php echo $item_Content; 
}
?>






