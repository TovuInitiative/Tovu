
  <?php //require("../../../classes/cls.constants.php");
	  
$sshow_large = '';
$sshow_thumb = '';
$bImages   = '';
$bImagesSide   = '';

$section_items 	= master::$listGallery['type']['v']; 
$section_pages 	= array_chunk($section_items, 5, true);

if(count($section_pages))
{
	$contPages 		= $section_pages[0];
	$loopNum 		  = 1;
	
	foreach ($contPages as $contKey) 						
	{
		$contArray	     	= master::$listGallery['full'][$contKey]; //displayArray($contArray);
		
		$id_pic				= $contArray['id'];
		$pic_parent_id	 	= $contArray['pic_parent_id'];
		$pic_parent			= $contArray['pic_parent'];
		$pic_parent_title  	= '';
		$pic_name		  	= $contArray['filename'];
		
		$pic_title		 	= $contArray['title'];
		$pic_date		 	= date('m d, Y', strtotime($contArray['modified']));
		
		$pic_type		  = $contArray['filetype'];
		$pic_desc		  = ($contArray['details'] <> '') ? smartTruncateNew(strip_tags($contArray['details']),200) : '';
		
		$pic_page		  = 'gallery.php';
		
		$sector_id		 = ''; //$contArray['sector_id'];
		$sector			= 'News';
		
		if($sector <> '') { $sector = '<span class="highbtn">'.$sector.'</span>';}
		
		$item_lebo         	= 'item';
		$gall_link			= '';
		
			if($pic_parent == '_cont') { 				
				$pic_content   = master::$contMain['full'][$pic_parent_id]; 	
				$gall_link	   = display_linkArticle($pic_parent_id, $pic_content['link_seo']);				
			}
			
			
			if($pic_parent == '_link') { 				
				$pic_content   = master::$menusFull[$pic_parent_id]; 	
				$gall_link 	  = display_linkMenu($pic_content['link_menu'], $pic_content['menu_seo_name']);
			}
			
			$pic_parent_title  = $pic_content['title'];
			
			if($pic_type == 'p')
			{
				$pic_type_lebo = '';
				$pic_big 	  = DISP_GALLERY.$pic_name;
				$pic_thmb	 = getThumbName($pic_name);
				if (!file_exists(UPL_GALLERY.$pic_thmb)) { $pic_thmb = $pic_name; }				
				$pic_small     = DISP_GALLERY.$pic_thmb;
			}	
			elseif($pic_type == 'v')
			{
				$pic_type_lebo = ' <em class="txt11">(Video)</em>';
				$vid_link		= $pic_name; 
				$vid_insert	  = strrpos($vid_link , '/')+1;
				$vid_code		= substr($vid_link, $vid_insert);
				
				$pic_big		 = 'http://img.youtube.com/vi/'.$vid_code.'/hqdefault.jpg';
				$pic_small	   = 'http://img.youtube.com/vi/'.$vid_code.'/mqdefault.jpg';
			}	
		
		
			//$pic_link		= $pic_page.'?com='.$pic_menu_id.'&'.$item_lebo.'='.$pic_cont_id.'&';
			
			$lnk_gal_beg = '<a '.$gall_link.'>';	// href="'.$pic_link.'" target="_blank"
			$lnk_gal_end = '</a>';
			
			
			if(trim(strtolower($pic_content['title'])) == trim(strtolower($pic_title))) {
				$pic_title = '';
			}
			
		$bMore 			= $lnk_gal_beg.'&nbsp; <span class="btn_bg_orange padd2 txt10 txtwhite"> Proceed </span></a>'; 
		$pic_title_b	  = '<p> <a '.$gall_link.'>'.$pic_title.'</a></p>'; 
		
		
		$pic_caption 	= ($pic_desc <> '') ? '<div class="padd15"><h2 class="text-space">'.$pic_desc.'</h2></div>' : '';
		$pic_more		= '<br /><a '.$gall_link.' target="_parent" class="btn btn-warning">VIEW MORE</a>';
		
		
		/*$bImages .= '<li class="col-md-3">
			<div class="slide-image">
				'.$lnk_gal_beg.'<img src="'.$pic_big.'" title="'.$pic_title.'" class="img-full" />'.$lnk_gal_end.'
			</div>
			<div class="slide-caption padding-all head_width">		
				<div class="v-center">
					'.$pic_caption.' 
					<!--more-->
				</div>		
			</div>
		</li>';*/
		
		
		$bImages .= '<div class="item">
			<div class="slide-image">
				'.$lnk_gal_beg.'<img src="'.$pic_big.'" title="'.$pic_title.'" class="img-full" />'.$lnk_gal_end.'
			</div>
			<div class="slide-caption padding-all head_width">		
				<div class="v-center">
					'.$pic_title.' 
					<!--more-->
				</div>		
			</div>
		</div>';
		
		/*$bImages .= '<div class="item">
						<div class="slider-post post-height-1">
							<a href="#" class="news-image"><img src="'.$pic_big.'" alt="" class="img-responsive"></a>
							<div class="post-text">
								<span class="post-category">Innovation</span>
								<h2><a href="#">'.$pic_desc.' </a></h2>
								<ul class="authar-info">
									<!--<li class="authar"><a href="#">by david hall</a></li>-->
									<li class="date">'.$pic_date.'</li>
									<!--<li class="view"><a href="#">25 views</a></li>-->
								</ul>
							</div>
						</div>
					</div>';*/
		
			
	}
	
	//echo $bImagesXX;
?>


<!--<section id="site-slider" class="banner_home">
<div class="slider bxflex bxflex-home" style=""> 
<ul class="bxslider">-->
<?php //echo $bImages; ?>
<!--</ul>
</div>

<div class="banner_home_mask"></div>
<div class="banner_home_intro"></div>
</section>-->

<div class="owl-carousel-vid owl-theme-vid">
           <?php echo $bImages; ?>
          </div>

<?php
}
?>