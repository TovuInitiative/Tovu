
<?php /*?><a href="rss.php?id=17&amp;mode=category" target="_blank" title="RSS"><img src="images/rss.png" style="vertical-align:middle; " alt="RSS Feed" border="0"></a><span class="subscribe-category"><a href="subscribe.php?id=17&amp;type=cat" title="Subscribe to Category"><img src="images/icon-user.png" style="vertical-align:middle;" alt="Icon Subscriber"> Subscribe</a></span><?php */?>

<?php  if(!isset($_GET['isec']) and $my_redirect <> 'sharestory.php') {	
echo display_PageTitle($my_page_head . '');
} ?>

<?php
/*displayArray(master::$listGallery);*/
//echobr($comMenuSection);
$dispData->siteGalleryTop();
$section_items 	= master::$listGallery_top; 

//displayArray($section_items);

//if($com_active)
//$contArr 	=  @master::$menuToContents[$com_active];
//$section_items 	= $contArr; 
$numrows 		= count($section_items);

$truncLength   = 90;
$items_per_page = 20;

if(isset($_GET['isec'])) 
{	
	$items_per_page = 3;
	$truncLength   = 150;
}


if($comMenuSection == 12) {
	//$truncLength   = 500;
}

$item_box	= '';	
	
if($numrows > 0)
{

/*******************************************************
  @@ PAGINATOR
====================================================== */	
$pages = new Paginator;
$pages->items_total = $numrows;
$pages->mid_range = 7; 
$pages->custom_ipp = $items_per_page;
$pages->paginate();

$pages_head="<div class=\"paginator\" style=\"margin-top:20px;\">".$pages->display_pages()."<span class=\"pagejump\">".$pages->display_jump_menu()."</span></div>";

if(isset($_GET['isec']))  { 
$pages_head= '<div class="padd5_t box-more"><a href="content.php?com='.$com_active.'" class="postDate read_more_right">VIEW MORE </a></div>'; 
}

/* ====================================================== */

$page_to_display = $pages->current_page - 1;

$section_pages 	= array_chunk($section_items, $items_per_page, true);

if(count($section_pages))
{
	$truncFilter 	= "<img>"; //<a>,<br>,
	$contPages 		= $section_pages[$page_to_display];
	$loopNum 		= 1;
	
	
	foreach ($contPages as $contArray) 						
	{
		
		$id_pic			= $contArray['id'];
		$pic_parent_id	 = $contArray['pic_parent_id'];
		$pic_parent		= $contArray['pic_parent'];
		$pic_name		  = $contArray['filename'];
		$pic_type		  = $contArray['filetype'];
		$pic_count		 = @$contArray['pic_total'];
		$pic_page		  = 'gallery.php';
		
		$pic_title		 = ($contArray['pic_parent_title'] <> '') ?  $contArray['pic_parent_title'] : $contArray['title'];		
		$pic_title 		 = smartTruncateNew(strip_tags($pic_title),150);
		
		$pic_desc		  = ($contArray['details'] <> '') ? smartTruncateNew(strip_tags($contArray['details']), $truncLength) : $contArray['title'];
		$pic_desc		  = ($pic_title == $pic_desc) ? '' : $pic_desc;
		$headLinkIcon 	  = ''; 
		
		$item_lebo         = 'item';		
			
		if($pic_parent == '_cont') { 				
			$pic_content   = master::$contMainNew[$pic_parent_id]; 				
			$gall_link	   = display_linkArticle($pic_parent_id, $pic_content['link_seo']);	
			
			if($pic_content['id_section'] == 18){
				$gall_link	  = ' data-href="ajforms.php?d=vprofile&item='.$pic_content['id'].'"  rel="modal:open" ';
			}
		}
		
		if($pic_parent == '_link') { 				
			$pic_content   = master::$menusFull[$pic_parent_id]; 	//echobr($pic_content['menu_seo_name']);
			$item_lebo	  = 'gal';
			$pic_view_call  = 'fcall=view';				
            if($pic_content['menu_seo_name'] == $currMenu['menu_seo_name']) 
            {  $gall_link = ' href= "gallery/?op=v"';  } else 
            {  $gall_link 	  = display_linkMenu($pic_content['link_menu'], $pic_content['menu_seo_name']);	 }
		}
			//displayArray($pic_content);
		$pic_parent_title  = $pic_content['title'];
			
			
		if($pic_type == 'p')
		{
			$pic_type_lebo = '';		
			
			$pic_big 	  = DISP_GALLERY.$pic_name;
			if (!file_exists(UPL_GALLERY.$pic_name)) { $pic_big = ''; }
			else {
				$pic_thmb	 = getThumbName($pic_name);
				if (!file_exists(UPL_GALLERY.$pic_thmb)) { $pic_thmb = $pic_name; }				
				$pic_small     = DISP_GALLERY.$pic_thmb;
				$pic_big		= $pic_small;
			}
		}	
		elseif($pic_type == 'v')
		{
			$pic_type_lebo = ' <em class="txt11">(Video)</em>';
			$vid_link		= $pic_name; 
			$vid_insert	  = strrpos($vid_link , '/')+1;
			$vid_code		= substr($vid_link, $vid_insert);
			
			$pic_big		 = 'http://img.youtube.com/vi/'.$vid_code.'/hqdefault.jpg';
			$pic_small	   = 'http://img.youtube.com/vi/'.$vid_code.'/mqdefault.jpg';
			
			if($GLOBALS['SOCIAL_CONNECT'] == false) { $pic_big = DISP_IMAGES.'icons/youtube.jpg'; }
		}	
		
		
			$item_box  .= '<li><div class="block equalized"><a '.$gall_link.' class="'.$headLinkIcon.'" data-id="'.$pic_parent_id.'"><span class="carChopa"><img src="'.$pic_big.'" alt="'.$pic_title.'" class="sshow_big"></span> 
			<span class="txt14X bold">'.$pic_title.'</span><br>
			<span class="txt12 txtgray">'.$pic_desc.'</span></a></div></li>';
		
			
		
			
	}
	
	
}





	echo '<div class="wrap_gallery"><ul class="column column_half">';
	echo $item_box;
	echo '</ul><div class="clear">&nbsp;</div></div>';
	
	if($numrows > $pages->custom_ipp) {
		echo $pages_head;
	}

	echo '<div style="clear: both"><p>&nbsp;</p></div>';



?>

<?php /*?><div class="article-tabs">
	<div class="articles-list">
		<ol class="news-displayX column column_half">

<?php echo $item_box; ?>

		</ol>
	</div>				
</div><?php */?>


<?php
/* ======== @@ PAGINATOR @@ ====== */	
/**/
/* =============================== */


} 
?>

			