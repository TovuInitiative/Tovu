<?php	
require("../../classes/cls.constants.php");

if(!array_key_exists('events', $dispData->contEvents))
{ $dispData->siteEventsJson(); }

$event_items 		= $dispData->contEvents['events'];
$event_items_num    = count($event_items);

$truncLen 		   = 50;
$event_content      = '';

//displayArray($_SESSION['sess_bvds_events']); exit;

if($event_items_num > 0)
{
	//$event_groups 	  = array_chunk($event_items, 3, true);
	//$event_page 		= $event_groups[0];
	//$cont_now	      = strtotime(date('Y-m-d')); //time();
	//$cont_leo	      = date('Ymd',time());
	$r=1;
	foreach ($event_items as $event_array) 						
	{
		$evid       = $event_array['evid'];
		$evdate     = date('Y-m-d H:i:00', $event_array['date']);
		$evtitle    = clean_output($event_array['title']);
		  //$evtitle 	= smartTruncateNew($evtitle, 70);
		$evdesc 	 = clean_output($event_array['description']);
		  $evdesc     = smartTruncateNew(strip_tags_clean($evdesc),$truncLen);
		$evlocation = clean_output($event_array['location']);	
		$evlink     = $event_array['link'];
		
		$event_content .= '  { "date": "'.$evdate.'", "type": "event", "title": "'.$evtitle.'", "description": "'.$evlocation.'", "url": "'.$evlink.'" }';
		
		if($r < $event_items_num) { $event_content .= ','; }
		$r++;
	}
	
echo '[';
echo $event_content;
echo ']';	
}

?>

   
