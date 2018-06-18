
<?php

$item_Content = '';

$section_items 	= master::$menuToContents[11]; //master::$contMain['section'][2];
$section_pages 	= array_chunk($section_items, 4, true);

if(count($section_pages)) 
{
	$boxes_home = '';
	$boxes_home_long = '';
	$truncFilter 	 = ""; //<a>,<br>,,<strong>,<b><img>
	$truncChars 	  = 50;
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
	if($pic_small <> '') { $image_link  = '<img src="'.$pic_small.'" alt="'.$cont_title.'" />'; } 
} 
else { $image_link  = getContGalleryPic($cont_id, $cont_title, '', ' class="story listing " data-behavior="bgfill" '); }

if($image_link == '') { $image_link = '<img src="image/logo_cont.jpg" alt="'.$cont_title.'" />'; }
if($image_link <> '') {  } 
$image_disp		= '<span class="bitChopa" style="display:none">'.$image_link.'</span>';

/*-------------------------------------------------------------------------------------------------------
@@ END: CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/ 
	
	
		$title_sub		= '';
		$title_date		= ''; //'<span class="scrollDate txtgreen txt10">'.$cont_date.' - </span>';
	
		
		if($loopNum <= 4)	
		{
			
			$item_Content .=  '<li> <div class="subcolumns padd5_t padd10_b" ><div class="">
				<div class="project_name"> <a '.$item_link.'  data-id="'.$cont_id.'" class="linkCont txt14 bold">'.$cont_title.'</a>'.$title_sub.' </div>
				<div style="position:relative;">
				<div class="project_padd" style="min-height:50px">'. $image_disp .''.$title_date.' '. $cont_brief_plain .' '. $sector .'</div>
				</div>
				</div> </div>
			</li>'; 
			
			/*$item_Content .=  '<div class="col-md-3"><div class="article short">
					<a href='.$item_link.'>
						<div class="wrapper"><span class="bg added" style="background-image: url(assets/image/strategy.jpg);">'.$image_link.'</span>
							<div class="content"><time datetime="2017-06-21" pubdate="">'.$title_date.'</time>
								<h2><span>'.$cont_title.'</span></h2>
								<p class="article__intro">'. $cont_brief_plain .'</p>
							</div>
							<footer></footer>
						</div>
					</a>
				</div></div>'; */
		}
			
		$loopNum += 1;
	
	}
	


$boxEqualize = '';
$boxTitleClass = 'box_title box_pink';

?>


<?php //echo display_PageTitle('What we do', 'h3', 'txtgray txtcenter linegray '); ?>


<div class="box-contX">
<div class="section-title"><h4 class="txtbrown" >What we do</h4></div>

<div>
	<ol class="news-display news-home">
		<?php echo $item_Content; ?>
	</ol>			
</div>

</div>

<?php
}
?>