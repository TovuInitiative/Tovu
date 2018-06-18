
<?php 
if($item <> '' or $gal <> '')
{
	$pic_list = array();
	
	if(count(master::$listGallery) == 0) { $dispData->siteGallery(); }
	
	if(is_array(master::$listGallery) and count(master::$listGallery))
	{
		if($item <> '') {
			$acc_conts = (array_key_exists('_cont',master::$listGallery['parent'])) ? master::$listGallery['parent']['_cont'] : '';
			if(is_array($acc_conts) and array_key_exists($item, $acc_conts) )
			{ $pic_list        = $acc_conts[$item]; }
		}

		if($gal <> '') {
			if(is_array(master::$listGallery['link']) and array_key_exists($gal,master::$listGallery['link']))
			{ $pic_list        = master::$listGallery['link'][$gal];  }
		}
	
		$sshow_large = '';
		$sshow_thumb = '';
		  
	 
	  if(count($pic_list)>0)
	  {
		$GLOBALS['CONTENT_HAS_GALL'] = true;
			
		foreach($pic_list as $pic_key)	//=>$pic_arr
		{
			$pic_arr 	    = master::$listGallery['full'][$pic_key]; //displayArray($pic_arr);
			$pic_attr	   = ' class="fncy" ';
			$pic_type_lebo  = '';
			$pic_small	  = '';
			$pic_parent	 = $pic_arr['pic_parent'];
			
			$pic_type 	   = $pic_arr['filetype'];
			$pic_name       = $pic_arr['filename']; //echobr($pic_name);
			$pic_caption    = $pic_arr['title'];			
			$pic_intro	  = smartTruncateNew(strip_tags_clean($pic_arr['details']), 150);	
			
			$pic_present    = 1;
			
				if($pic_intro <> '') 
				{ 
				 	if($pic_intro == $pic_caption) { $pic_intro = ''; } else {
					$pic_intro = ' - <span class="">' . $pic_intro . '</span>';
					}
				}
			//$pic_intro = ' - <span class="">' . $pic_intro . '</span>';
			
				if($pic_type == 'p')	
				{
					$pic_insert 	 = strrpos($pic_name , '.');
					$pic_thmb	   = substr_replace($pic_name, '_t.', $pic_insert, 1);
					
					/*if($pic_parent == '_equip')
					{
						$pic_root = UPL_CA_GALLERY; $pic_rule = DISP_CA_GALLERY;
					}
					else
					{}*/
						$pic_root = UPL_GALLERY; $pic_rule = DISP_GALLERY; 
						
						if(strpos($pic_name,'image/') !== false )
						{ $pic_root = SITE_PATH; $pic_rule = SITE_DOMAIN_LIVE; }
						elseif(strpos($pic_name,'gallery/')  !== false )
						{ $pic_root = UPL_IMAGES; $pic_rule = DISP_IMAGES; }
					
	
					$pic_big 	    = $pic_rule.$pic_name;	
					$pic_small 	  = $pic_rule.$pic_thmb;	
					
					if (!file_exists($pic_root.$pic_name)) { $pic_big = ERR_NO_IMAGE; $pic_present = 0;}
					if (!file_exists($pic_root.$pic_thmb)) { $pic_small = $pic_big; }	
					
					$pic_link	=  $pic_big; 	
					$pic_attr	= ' rel="fancypop" ';	
				}
				elseif($pic_type == 'v')
				{
					$pic_type_lebo   = ' <span class=" txtyellow bold">[Video]</span>';
					$vid_link		= $pic_name; 
					$vid_insert	  = strrpos($vid_link , '/')+1;
					$vid_code		= substr($vid_link, $vid_insert);
					
					$pic_big		 = 'http://img.youtube.com/vi/'.$vid_code.'/hqdefault.jpg';
					$pic_small	   = 'http://img.youtube.com/vi/'.$vid_code.'/mqdefault.jpg';
					
					$pic_link	    = 'https://www.youtube.com/embed/'.$vid_code.'';
					$pic_attr	    = ' class="fancyframe" ';	
				}	
				
			$lnk_gal_beg = '<a href="#">';
			$lnk_gal_end = '</a>';
			
			
			if($pic_present == 1)
			{		
			/*$sshow_large .= '<li>'."\n"
				.'<a href="'.$pic_link.'" '.$pic_attr.' title="'.$pic_caption.'"><img src="'.$pic_big.'" alt="" class="sshow_big"></a>
				<div class="slides-caption">
				<h3>'.$pic_caption. $pic_intro.$pic_type_lebo.'</h3>'."\n"
				.'</div>'."\n"	//'.$pic_details.'<p>&nbsp;</p>
				.'</li>'."\n";
				
			$sshow_thumb .= '<li><img src="'.$pic_small.'" alt="" class="sshow_thumb"></li>'."\n";	*/
			
					$sshow_large .= '<li>
						<div class="slide-image">
							<img src="'.$pic_big.'" class="img-full" />
						</div>
						<div class="slide-caption">
							<div class="wrapper">
								<div class="v-center">
									<h3>'.$pic_caption.'</h3> '.$pic_intro.'
								</div>
							</div>
						</div>
					</li>';
			
			
			}
		}
		

?>

<div class="subcolumns clearfix" style="margin-bottom:15px;">

<section id="site-slider" class="banner_inside">
<div class="slider bxflex bxflex-inner" style="overflow:hidden !important;">
<ul class="bxslider bxinner">
 <?php echo $sshow_large; ?>
</ul>
</div>
</section>

</div>

<?php
	
	  }
	//}
	
	
	}
}
?>
