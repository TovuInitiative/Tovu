<?php	
require("../../classes/cls.config.php");
require("../../classes/cls.formats.php");
//'Alliance Française'
//echo $rage= 'Kenya’s Songs, Alliance Française'. '<br>';
//echo remove_special_chars($rage);

$sq_events_up = "SELECT `bvds_dt_content_dates`.`id_content`
    ,    UNIX_TIMESTAMP(`bvds_dt_content_dates`.`date`) AS `date`
    ,  `bvds_dt_content`.`arr_extras` AS `location`
	 ,  `bvds_dt_content`.`url_title_article`
	 ,  `bvds_dt_content`.`article`
	, `bvds_dt_content`.`title`
FROM
    `bvds_dt_content_dates`
    INNER JOIN `bvds_dt_content` 
        ON (`bvds_dt_content_dates`.`id_content` = `bvds_dt_content`.`id`)
WHERE (`bvds_dt_content`.`published` = 1)
GROUP BY `bvds_dt_content`.`title`, `bvds_dt_content_dates`.`id_content`
ORDER BY `bvds_dt_content_dates`.`date` DESC  LIMIT 0 , 3;";
	//echo $sq_events_up;
	//`bvds_dt_content_dates`.`date` >=CURRENT_DATE() and 
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
			
			$evcom      = $evid;
			
			$evtitle 	= clean_output($cn_events_up['title']); 
			$evurl 	  = $cn_events_up['url_title_article'];
			$evarticle  = strip_tags_clean(clean_output($cn_events_up['article'])); 
			$evbrief 	= smartTruncateNew($evarticle, 250);
			
			
			$eventContent .= '  { "date": "'.$evdate.'000", "type": "event", "title": "'.$evtitle.'", "description": "'.$evbrief.'", "url": "'.$evid.'/'.$evurl.'/" }';
			
			
			if($r < $rs_events_up_count) { $eventContent .= ','; }
			$r++;
		}
		
echo '[';
echo $eventContent;
echo ']';
	}
?>

   
