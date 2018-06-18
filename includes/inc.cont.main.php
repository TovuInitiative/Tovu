
<?php
$item_rating = '';
$contArr = array();
$gutsArr = array();

$contCom = ( (array_key_exists($com_active, master::$menuToContents)) and count(@master::$menuToContents[$com_active])>0) ? master::$menuToContents[$com_active] : array();

//displayArray(master::$contMain['section'][2]);

if($comMenuSection == 6 or $comMenuSection == 2){	
	$contSec = master::$contMain['section'][$comMenuSection];
	
	foreach($contSec as $kk => $vv){
		if(!array_key_exists($kk, @$contCom)){
			$contCom[$kk] = $vv;
		}
	}
}


$contNumber = count($contCom); 

if($contNumber == 0)
{
	echo display_PageTitle($my_page_head, '');
}
else
{
	if($item) 	{	$contArr[$item] 	= $contCom[$item]; }
	else 		{	$contArr 	=  $contCom; }


 
    

//if(count($contArr) == 1) 
    /* SINGLE ITEM OR CONTACT MENU */
if($item or (count($contArr) == 1)) // and $comMenuSection == 11
{
	$contKey 		= current($contArr); 	
	
	$gutsArr 		= master::$contMainNew[$contKey];
	//displayArray( $gutsArr);
	$item 		   = $gutsArr['id'];	
	$artSection 	 = $gutsArr['id_section'];
	$artTitle 	   = $gutsArr['title'];
	$artTitleSub 	= $gutsArr['title_sub'];
	$artArticle	 = $gutsArr['article'];
	$artStamp	   = $gutsArr['modified'];
	$artLocation	= $gutsArr['location'];
	$artBooking	 = $gutsArr['booking'];
	$artBooking_amount = $gutsArr['booking_amount'];
	
	$nicedate       = array();
	$artEventData   = '';
	
	if($artSection == 6) 
	{
		$artDates	   = $gutsArr['event_dates'];
		if(is_array($artDates) and count($artDates)) {
			foreach($artDates as $dateArr) {
				$nicedate[] = '&nbsp; &bull; &nbsp; '. date('l M d, Y',$dateArr['ev_date']).' '.$dateArr['ev_time_start'].' - '.$dateArr['ev_time_end'] . '';
			}
		}
		
		$artEventData   .= '<h4><u>When:</u></h4><div class="bold">'. implode('<br>', $nicedate) .'</div><br>';
		$artEventData   .= '<h4><u>Where:</u></h4><div><strong>&nbsp; &bull; &nbsp; '.$artLocation.'</strong></div><br>';
		//$artEventData   .= '<h4><u>Details:</u></h4>';
		
		if($artBooking == 1 and $artBooking_amount > 0) {
			$artEventData   .= '<h6>Charges:</h6><div><strong>'.$artBooking_amount.'</strong><p>&nbsp;</p></div>';	
		}
			
	}
	
	
	if(preg_match('/<img[^>]+\>/i',$artArticle,$regs)) { 
		if(count($regs) > 0)
		{
			$artArticle 	  = str_replace('"assets/image/', '"'.SITE_DOMAIN_LIVE.'assets/image/', $artArticle);
		}
	} 
	
	$breakStart 	     = 200;
	$string	     = $artArticle;
	$pageLoops	  = ceil((strlen($string) / $breakStart)); 
	$start = 0;
	
	$title_sub	  = '';
	$title_date	 = '';
	
	echo '<div class="article-area"><div id="articleContent">';
	echo display_PageTitle($artTitle);
	
	include("includes/inc.gallery.cont.php");
	
	
	if($artSection == 2 or $artSection == 12)  
	{	}
       /* NEWS*/
		$title_date = ''; //'<div class="info noborder padd2 padd15_l"><span class="postDate nocaps txt11">Updated: '.$artStamp.'</span></div>';
	
    //displayArray($_SERVER);
    
    
    if($my_redirect <> 'contact.php')
    {
        /* ============================================================================== 
        /*	@RATING SCRIPT
        /* ------------------------------------------------------------------------------ */			
        //require('assets/ajaxrating/ratingdraw.php'); 			
        $item_rating  = '<span class="btn btn-infoX txt11 noborder nohover">'. rating_bar($item, 'content') . '</span>';    
    
    
        ?>

        <div class="row padd5_t marg0_5" style="background: #f5f5f5">
                <div class="col-md-6"><span class="postDate nocaps"><i class="fa fa-clock-o"></i> Updated on: <?php echo $artStamp; ?></span></div>
                <div class="col-md-6 txtright"><?php echo $item_rating; ?></div>
            </div>	
        <?php
	}
    
    
    /* @@ CONTENT COMMITTEE && COUNTY */    
    $contTags_arr           = $dispDt->get_contentParents($item, 1); 
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
        
    
	echo '<div class="main-guts">
    
    '. $title_date . $artEventData .'    
    '. $artArticle.'
    '.$contTags_committee.'
        '.$contTags_county.'    
    </div>';	//$title_sub .
	
	
	
	echo '</div></div>';	
	
	include("includes/nav_downloads_cont.php");
	
	//include("includes/form_comment.php");
	
}
else
{
	include("includes/inc.cont.main.list.php");
}


/*count($contArr) == 1*/
if(isset($item) and $this_page <> "contacc.php" and $this_page <> "contact.php")
{ include("includes/nav_social_share.php"); }

}
?>
