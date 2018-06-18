
<?php 

$contArr = array();
$gutsArr = array();

$contCom = (count(@master::$menuToContents[$com_active])>0) ? master::$menuToContents[$com_active] : array();


if(!isset($_GET['isec'])) {	
echo display_PageTitle($my_page_head . '');
} 

$_SHOW_LIST = true;


if($my_redirect == 'events.php')
{
	$contCom = $dispData->siteEventsList();
	
	$url_path = ($urlpathA <> '') ? $urlpathA : $com;
?>
	<div class="subcolumns clearfix">
		<div class="col-md-6">&nbsp;</div>
		<div class="col-md-6 txtright">
			<a href="<?php echo $url_path; ?>?op=list" title="View as list"><i class="fa fa-list-ul txt24"></i></a> &nbsp;  &nbsp;
			<a href="<?php echo $url_path; ?>?op=calendar" title="View as calendar"><i class="fa fa-calendar txt21"></i></a>
		</div>
	</div>
<?php

	if($op=='calendar'){ 
		$_SHOW_LIST = false;
		$GLOBALS['CONTENT_SHOW_CALENDAR'] = true;
		?>
		<div id="eventCalendarAll"></div>
		<?php
	}
}


/* begin :: SHOW_LIST */
if($_SHOW_LIST)
{

	
$contArr 	=  $contCom; //@master::$menuToContents[$com_active];
$section_items 	= $contArr; 
$numrows 		= count($section_items);

$truncLength   = 250;
$items_per_page = 10;

if(isset($_GET['isec'])) 
{	
	$items_per_page = 3;
	$truncLength   = 160;
}


if($comMenuSection == 12) {
	$truncLength   = 500;
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
	
	
	//echo '<div class="page-bits clearfix">';	
	
	foreach ($contPages as $kk => $contKey) 						
	{
		$image_disp = '';
		
		$contArray 		  = master::$contMainNew[$contKey];
		
		//displayArray($contArray); //exit;
		
		$cont_id			= $contArray['id'];
		$cont_parent_id	 = $contArray['id_menu'];
		$cont_title		 = $contArray['title'];
		$cont_title_sub	 = $contArray['title_sub'];
		$cont_page		  = $contArray['link_menu'];
		$cont_date		  = $contArray['modified']; 
		$cont_hits		  = $contArray['hits']; 
		
		$cont_location	   = $contArray['location'];		
		$cont_article	   = $contArray['article'];
		
		$cont_organization = $contArray['organization'];
		
		$title_sub		= '';
		$title_date		= '';
		$date_label		= 'Updated: ';
		
		if(strlen($cont_title_sub)>=5) 	{ $title_sub	= '<div class="page-bit-head-sub">'.$cont_title_sub.'</div>'; }
		if($this_page =="news.php") 	{ $title_date 	= '<div class="postDate">'.$cont_date.'</div>'; }
		
		$image_disp = '';
		$org_disp = '';
		
		$event_dates 	= $contArray['event_dates'];
		if(is_array($event_dates) and count($event_dates) > 0)
		{
			$nextDate = closestDate($event_dates, time());
    		/*krsort($event_dates); $curr_date = current($event_dates);
			$cont_evdate = $curr_date['ev_date']; $cont_evtime = $curr_date['ev_time_start'];*/
			
			$cont_date = date('M d, Y', $nextDate); //.' '.$cont_evtime;
			$date_label = 'When: '; /*Date:*/
			//$truncLength   = 160;
			//$image_disp = '<span class="bitChopaWrap chopaEvent" style="display:none"><img /></span>';
			
			$cont_organization = ($cont_organization <> '') ? ' <em>(By: '. $cont_organization .')</em>' : '';
			$org_disp   = '<div><span class="postDate nocaps">WHERE: '. ucwords($cont_location) . '' . $cont_organization .'</span></div>';
			
		}
		
		//displayArray($event_dates); exit;
		
		//$item_link		= $cont_page . RDR_REF_BASE . "item=" . $cont_id;	
		

		if($comMenuSection == 12 and $cont_location <> '') {
			$item_link	  = ' href="'.$cont_location.'" ';
			$cont_brief_plain 	= '<div class="trunc400" style="display:none">'.strip_tags_clean($cont_article).' &nbsp;</div>'; 
		} else {
			$item_link		  = display_linkArticle($cont_id, $contArray['link_seo']);
			$cont_brief_plain 	= smartTruncateNew(strip_tags_clean($cont_article),$truncLength); 
		}

/*-------------------------------------------------------------------------------------------------------
@CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/
		
/*$image_disp = '';*/ $image_link = '';

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
 		
	$item_float 	= ' class="page-bit-left bits-new"'; 
	if(intval($loopNum/2) == ($loopNum/2)) { $item_float = ' class="page-bit-right bits-new"';}
	
	$cont_more 	 = '';
	if(strlen($cont_brief_plain) > 0) 
	{ 
	$cont_more = ' &nbsp; <a '.$item_link.' class="read_more"><span>+ </span> More info </a><p class="_more"></p>';
	}
		//<p class="_more"></p>
		
					  
	$headLinkIcon = ''; 
	if($image_disp == '') { $headLinkIcon = ' article '; }
	
	$itemViews = '<divX><span class="postDate">'.$date_label.''.$cont_date.'</span> - </divX>'; // | Viewed '.$cont_hits.' times
	$itemBreak = 'news-bits';
	
	if(isset($_GET['isec'])) { $itemViews = '<br>'; $itemBreak = 'home-bits'; }
	
	$item_box .= '<li>
		<div class="'.$itemBreak.'  padd10_0">'.$image_disp .'<a '.$item_link.' class="'.$headLinkIcon.' txt14 linkCont bold" data-id="'.$cont_id.'">'.$cont_title.'</a><br>
		'.$itemViews.'
		'.$cont_brief_plain . $org_disp . ' &nbsp; &nbsp;</div>
	</li>';
	// <a '.$item_link.' class="linkCont" data-id="'.$cont_id.'">Read More</a>
	
	$loopNum += 1;
	
	}
	
	//echo '<div class="clear"></div>';
	//echo '</div>';
}









?>

<div class="article-tabs">
	<div class="articles-list">
		<ol class="news-display">

<?php echo $item_box; ?>

		</ol>
	</div>				
</div>


<?php
/* ======== @@ PAGINATOR @@ ====== */	
if($numrows > $pages->custom_ipp) {
	echo $pages_head;
}/**/
/* =============================== */


} 
	


}
/* end :: SHOW_LIST */
?>

			