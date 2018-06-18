<?php

if($my_redirect <> 'events.php') 
{
$truncLen = 50;
if($this_page == 'index.php') { $truncLen = 100; }

$array1 = $dispData->siteEventsFuture();
$event_items 		= $array1['events']; 
array_sort_by_column($event_items, 'date'); 


$eventContent 	   = '';


if(count($event_items) > 0)
{
	$event_groups 	  = array_chunk($event_items, 3, true);
	$event_page 		= $event_groups[0];
	$cont_now	      = strtotime(date('Y-m-d')); 
	$cont_leo	      = date('Ymd',time());
	
	foreach ($event_page as $event_array) 						
	{ //displayArray($event_array);
		$evid		     = $event_array['evid'];
		$cont_dateb	   = $event_array['date'];
		$cont_date 		= date("M d Y", $cont_dateb); 
		$cont_datec       = date('Ymd',$cont_dateb);
		
		$ev_datearr['d']  = date("d", $cont_dateb);
		$ev_datearr['m']  = date("M", $cont_dateb);
		//echoBr( strtotime($cont_date).' - '.strtotime(date('Y-m-d')).' - '.date("m", $cont_dateb));
		$event_past	= '';
		if($cont_dateb < $cont_now) { $event_past = '<span class="txtgreen txt85">[ARCHIVE]</span> '; }
		if($cont_datec == $cont_leo) { $event_past = '<span class="txtred txt85">[TODAY]</span> '; }
		
		
		$evtitle    	 = $event_array['title']; 
		$ev_article 	  = $event_array['description'];
		$evlocation      = $event_array['location']; 
		
		$evtitle 		 = smartTruncateNew($evtitle, 70);
		$ev_brief 	    =  smartTruncateNew(strip_tags_clean($ev_article),$truncLen);
		
		//'events.php?com='.$evcom.'&item='.$evid.'';
		$item_link	   = ' href="'.$event_array['link'].'"'; 
		//$item_link	   = display_linkArticle($evid, '');	
		
		if(trim($evtitle) <> '')
		{
		
		$ev_brief = '';
		$eventContent .=  '<div class="wrap_date_box zebra">
	<div class="date-box heading-font">
		<div class="day">'.$ev_datearr['d'].'</div>
		<div class="month">'.$ev_datearr['m'].'</div>
	</div>
	<div class="event-info">
		<span class="event-venue">'.$event_past.'<a '.$item_link.' data-id="'.$evid.'" class="linkCont">'.$evtitle.'</a> <span class="txtgray txt95">'.$evlocation.'</span></span>
	</div>
	</div>'; 
	

		}
	
	}



	
$boxEqualize = '';
$boxTitleClass = 'box_title box_blue';

$boxStyle = ' style="height: auto; height:250px;  overflow:scroll; overflow-x:hidden; width:100%;"';

$classHome = "linegreen";

//if($this_page == 'index.php') { $carouselEqualize = 'equalized'; }
if($this_page == 'index.php') { 
	$classHome = "";
	$boxStyle = ''; //' style="overflow:scroll; overflow-x:hidden; height:160px; "'; //
	$boxTitleClass = 'box_title box_blue';
}
?>


<div class="box-cont">
	<div class="box-cont-title">Events Calendar</div>
	
<!-- @@events-list -->   
	<div class="box-cont-gut">
	<div id="rbeventswidget-2" class="widget_rbeventswidget">
	
	<?php echo $eventContent; ?>
	
	</div>
	</div>
<!-- @@END - events-list -->

	<?php /*?><div class="box-more"><a href="events.php?com=5" class="postDate read_more_right">VIEW ALL</a></div><?php */?>

</div>

<?php
}
}
?>