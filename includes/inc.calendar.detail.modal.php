


<?php
if($item <> '')
{
	$gutsArr 		= master::$contMainNew[$item];
	
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
		$artEventData   .= '<h4><u>Details:</u></h4>';
		
		if($artBooking == 1 and $artBooking_amount > 0) {
			$artEventData   .= '<h6>Charges:</h6><div><strong>'.$artBooking_amount.'</strong><p>&nbsp;</p></div>';	
		}
			
	}
	
	
	if(preg_match('/<img[^>]+\>/i',$artArticle,$regs)) { 
		if(count($regs) > 0)
		{
			$artArticle 	  = str_replace('"image/', '"'.SITE_DOMAIN_LIVE.'image/', $artArticle);
		}
	} 
	
	$breakStart 	     = 200;
	$string	     = $artArticle;
	$pageLoops	  = ceil((strlen($string) / $breakStart)); 
	$start = 0;
	
	$title_sub	  = '';
	$title_date	 = '';
	
	echo modHeader($artTitle);
	
	echo '<div class="modal-body modal-long nano nopadd"><div class="nano-content"><div class="subcolumns clearfix">';
	
	echo '<div class="article-area"><div id="articleContent">';
	
		//echo display_PageTitle($artTitle);
		include("includes/inc.gallery.cont.php");

		if($artSection == 2 or $artSection == 12) {	/*NEWS*/
		$title_date = '<div class="info noborder padd2 padd15_l"><span class="postDate nocaps txt11">Updated: '.$artStamp.'</span></div>';}
	
		echo '<div class="main-guts">'. $title_date . $artEventData . $artArticle.'</div>';	
	
	echo '</div></div>';	
	
	include("includes/nav_social_share.php");
	
	echo '</div></div></div>';	
	
	
	
	echo modFooter();
}
	
	
?>


