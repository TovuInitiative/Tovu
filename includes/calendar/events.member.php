<?php	
require_once("../../classes/cls.config.php");
require_once("../../classes/cls.formats.php");
require_once("../../classes/cls.sessions.php");

//displayArray($sess_mbr);
$u_organization_id = ($sess_mbr['u_organization_id'] <> '') ? $sess_mbr['u_organization_id'] : '';

	$sq_crit = " WHERE `mrfc_dt_content`.`published` = '1' AND `mrfc_dt_content`.`approved` = '1'  AND `mrfc_dt_content`.`id_owner` = ".q_si($us_id)."  ";
if($us_org_id <> ''){
	$sq_crit .= " OR `mrfc_dt_content`.`published` = '1' AND `mrfc_dt_content`.`approved` = '1' AND `mrfc_dt_content`.`organization_id` = ".q_si($us_org_id)."  ";
}


$sq_events_up = "SELECT `mrfc_dt_content_dates`.`id_content`
    ,    UNIX_TIMESTAMP(`mrfc_dt_content_dates`.`date`) AS `date`
    ,  `mrfc_dt_content`.`arr_extras` AS `location`
	 ,  `mrfc_dt_content`.`url_title_article`
	 ,  `mrfc_dt_content`.`article`
	, `mrfc_dt_content`.`title`
	, DATE_FORMAT(`mrfc_dt_content_dates`.`date`,'%l:%i %p') AS `ev_time_start`
FROM
    `mrfc_dt_content_dates`
    INNER JOIN `mrfc_dt_content` 
        ON (`mrfc_dt_content_dates`.`id_content` = `mrfc_dt_content`.`id`)
   ".$sq_crit."
ORDER BY `mrfc_dt_content_dates`.`date` DESC ;"; 

/*GROUP BY `mrfc_dt_content`.`title`, `mrfc_dt_content_dates`.`id_content`*/



	//echo $sq_events_up;
	//`mrfc_dt_content_dates`.`date` >=CURRENT_DATE() and 
	$rs_events_up=$cndb->dbQuery($sq_events_up);
	$rs_events_up_count=$cndb->recordCount($rs_events_up);
	
	$eventContent = '';
	
	if($rs_events_up_count>0)
	{
		$r=1;	
	while($cn_events_up=$cndb->fetchRow($rs_events_up))
		{
			$evid       = $cn_events_up['id_content'];
			$evdate     = date('Y-m-d H:i:00', $cn_events_up['date']); 
			$evtime     = $cn_events_up['ev_time_start'];
			
			$evcom      = $evid;
			
			$evtitle 	= clean_output($cn_events_up['title']); 
			$evurl 	  = $cn_events_up['url_title_article'];
			$evarticle  = strip_tags_clean(clean_output($cn_events_up['article'])); 
			$evbrief 	= smartTruncateNew($evarticle, 250);
			
			
			/*$eventContent .= '  { "date": "'.$evdate.'000", "type": "event", "title": "'.$evtitle.'", "description": "'.$evbrief.'", "url": "'.$evid.'/'.$evurl.'/" }';*/
			$eventContent .= '  { "date": "'.$evdate.'000", "type": "event", "title": "'.$evtitle.'", "description": "'.$evbrief.'", "datahref": "ajforms.php?d=cont_event&item='.$evid.'", "time": "'.$evtime.'" }';
			
			
			if($r < $rs_events_up_count) { $eventContent .= ','; }
			$r++;
		}
		
echo '[';
echo $eventContent;
echo ']';
	}
?>

   
