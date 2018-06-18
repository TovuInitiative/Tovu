
<?php  if(!isset($_GET['isec']) and $my_redirect <> 'sharestory.php') {	
echo display_PageTitle($my_page_head . '');
} ?>

<?php
//displayArray(master::$listGallery);
//$dispData->siteGalleryTop();
$item_box	= '';

$collection_items 	= master::$listGallery['parent']['_link'][$comMenuID]; 
//displayArray($collection_items);
$numrows 		= count($collection_items);

if($numrows > 0)
{

	$truncFilter 	= "<img>"; //<a>,<br>,
	//$contPages 		= $section_pages[$page_to_display];
	//$loopNum 		= 1;
	
	
	foreach ($collection_items as $collection_id) 						
	{
		$contArray 		 = master::$listGallery['full'][$collection_id];
		
		$id_pic			= $contArray['id'];
		$pic_parent_id	 = $contArray['pic_parent_id'];
		$pic_parent		= $contArray['pic_parent'];
		$pic_name		  = $contArray['filename'];
		$pic_type		  = $contArray['filetype'];
		$pic_count		 = @$contArray['pic_total'];
		$pic_page		  = 'gallery.php';
		
		$pic_title		 = $contArray['title'];		
		$pic_title 		 = smartTruncateNew(strip_tags($pic_title),150);
		
		$headLinkIcon 	  = ''; 
		
		$item_lebo         = 'item';		
			
		if($pic_parent == '_cont') { 				
			$pic_content   = master::$contMainNew[$pic_parent_id]; 				
			$gall_link	   = display_linkArticle($pic_parent_id, $pic_content['link_seo']);				
		}
		
		if($pic_parent == '_link') { 				
			$pic_content   = master::$menusFull[$pic_parent_id]; 	
			$item_lebo	  = 'gal';
			$pic_view_call  = 'fcall=view';				
			$gall_link 	  = display_linkMenu($pic_content['link_menu'], $pic_content['menu_seo_name']);				
		}
			
		$pic_parent_title  = $pic_content['title'];
		
        
        $link_rel = '';
			
		if($pic_type == 'p')
		{
			$pic_type_lebo = '';		
			
			$pic_big 	  = DISP_GALLERY.$pic_name;
			if (!file_exists(UPL_GALLERY.$pic_name)) { $pic_big = ''; }
			else {
				$pic_thmb	 = getThumbName($pic_name);
				if (!file_exists(UPL_GALLERY.$pic_thmb)) { $pic_thmb = $pic_name; }				
				$pic_small     = DISP_GALLERY.$pic_thmb;
			}
			$pic_link		=  $pic_big; 	
			$pic_attr	    = 'modalpic';	
		}	
		elseif($pic_type == 'v')
		{
			$pic_type_lebo = ' <em class="txt11">(Video)</em>';
			$vid_link		= $pic_name; 
			$vid_insert	  = strrpos($vid_link , '/')+1;
			$vid_code		= substr($vid_link, $vid_insert);
			
			$pic_big		 = 'http://img.youtube.com/vi/'.$vid_code.'/hqdefault.jpg';
			$pic_small	   = 'http://img.youtube.com/vi/'.$vid_code.'/mqdefault.jpg';
			$pic_link	    = 'https://www.youtube.com/embed/'.$vid_code.'';
			//$pic_link	    = 'ajforms.php?d=video&vid='.$vid_code.'';
			$pic_attr	    = 'modalvid';	
			
            //$link_rel     = ' rel="modal:open" ';
            
			//if($GLOBALS['SOCIAL_CONNECT'] == false) { $pic_big = DISP_IMAGES.'icons/youtube.jpg'; }
		}	
		
		
			$item_box  .= '<li><div class="block equalized"><a href="'.$pic_link.'" class="txtgray '.$pic_attr.'" data-id="'.$pic_parent_id.'" title="'.$pic_title.'" '.$link_rel.'><span class="carChopa"><img src="'.$pic_big.'" alt="'.$pic_title.'" class="sshow_big"></span> <span>'.$pic_title.'</span></a><br>&nbsp;</div></li>';
		
			
		
			
	}
	




	echo '<div class="wrap_gallery"><ul class="column menu-column column_halfX">';
	echo $item_box;
	echo '</ul></div> ';
	
	
	echo '<div class="clearfix padd10"></div>';


} 
?>
            
<!--
<button class="btn btn-default btn-lg video" data-video="https://www.youtube.com/embed/HBdcL7YsdBY" data-toggle="modal" data-target="#videoModal">Play Video 2</button>
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <iframe width="100%" height="350" src="" frameborder="0" allowfullscreen></iframe>
    </div>
  </div>
</div>
</div> -->           

			