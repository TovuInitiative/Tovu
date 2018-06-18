

<?php  



	
$contArr 	    = $data_arr; //@master::$menuToContents[$com_active];
$section_items 	= $contArr; 
$numrows 		= count($section_items);

$truncLength   = 250;
$items_per_page = 12;


$item_box	= '';	
$item_box_grid	= '';	
	

//echobr($numrows);	
	
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

    /* @@ CONTENT COMMITTEE && COUNTY */    
    $contTags_arr   = $dispDt->get_contentParents($cont_id, 1); 
    $contTags_committee     = (array_key_exists('committee', $contTags_arr)) ? implode($contTags_arr['committee'], '; ') : '';    
    $contTags_county        = (array_key_exists('county', $contTags_arr)) ? implode($contTags_arr['county'], '; ') : '';    
     
    /* @@ COMMITTEE TO CONTENT*/     
        if($contTags_committee <> ''){
            $contTags_committee = '<div class="txtgraylight txt11">Sector: '.$contTags_committee.'</div>';
        }
    /* -------------------- */
        
    /* @@ COUNTY TO CONTENT*/  
        if($contTags_county <> ''){
            $contTags_county = '<div class="txtgraylight txt11">County: '.$contTags_county.'</div>';
        }    
    /* -------------------- */
        
        
        
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
	
    $item_rating  = '';    
    $item_rating  = '<div class="padd10_t txt11 noborder nohover">'. rating_bar($cont_id, 'content', '', 'static') . '</div>'; 
        
        
	/*$item_box .= '<li>
		<div class="'.$itemBreak.'  padd10_0">'.$image_disp .'<a '.$item_link.' class="'.$headLinkIcon.' txt14 linkCont bold" data-id="'.$cont_id.'">'.$cont_title.'</a><br>
		'.$itemViews.'
		'.$cont_brief_plain . $org_disp . ' &nbsp; &nbsp;
        '.$contTags_committee.'
        '.$contTags_county.'
        </div>
	</li>';*/
	// <a '.$item_link.' class="linkCont" data-id="'.$cont_id.'">Read More</a>
	
        
        $item_box_grid .= '<div class="grid-item equalizedX ">
<div class="panel panel-default panel-home-guts shadow">
    <div class="panel-heading clearfix txtleft bg-white">
       <div class="nopadd"><h3 class=""><a '.$item_link.' class="'.$headLinkIcon.' txt14 linkCont bold" data-id="'.$cont_id.'">'.$cont_title.'</a></h3></div>
    </div>
    '.$image_link.'
    <div class="panel-body">

        <div class="cardContent">
        
        
        <p>'.$cont_brief_plain.' </p>
        '.$contTags_committee.'
        '.$contTags_county.'
        '.$item_rating.'
        </div>
    </div>
</div>
        </div>';
        
	$loopNum += 1;
	
	}
	
	//echo '<div class="clear"></div>';
	//echo '</div>';
}



if($my_redirect <> 'program.php' )
{
?>

    <!--<div class="article-tabs">
        <div class="articles-list">
            <ol class="news-display">
                <?php  //echo $item_box; ?>
            </ol>
        </div>				
    </div>-->

<?php
}
 elseif($my_redirect == 'program.php' )
{ }
 ?>

    <div class="grid">
        <?php echo $item_box_grid; ?>
    </div>

<?php


 
/* ======== @@ PAGINATOR @@ ====== */	
if($numrows > $pages->custom_ipp) {
	echo $pages_head;
}/**/
/* =============================== */


} 
	


?>

			