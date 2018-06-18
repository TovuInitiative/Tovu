<?php require("cls.config.php"); 

function displayArray($array)    { echo "<pre>"; print_r($array); echo "</pre><hr />"; }
function clean_output($str, $useBreak=0) { if($useBreak){ $str = nl2br($str); } $patterns[0] = "/`/"; $patterns[1] = "/’/";  $str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	 $str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));  return $str; } 
function clean_escape($value) { $cndb = new master(); $value = $cndb->quote_si($value);  return $value; }



function contentDates($cont_id)
{
	$cndb = new master();
	
	$sq_eventlinks = "SELECT DATE_FORMAT(`date`, '%Y%m%d') AS `ev_date`, DATE_FORMAT(`date`,'%l:%i %p') AS `ev_time_start`,  DATE_FORMAT(`end_date`, '%l:%i %p') AS `ev_time_end`, UNIX_TIMESTAMP(DATE_FORMAT(`date`, '%Y%m%e')) AS `ev_date_unix` FROM mrfc_dt_content_dates WHERE (`id_content` =".clean_escape($cont_id).") ORDER BY `ev_date_unix` ;";
	// `mrfc_dt_content_dates`.`date` >=CURRENT_DATE() and 
	
	$rs_eventlinks = $cndb->dbQuery($sq_eventlinks);	
	$rs_eventlinks_count = $cndb->recordCount($rs_eventlinks);
	
	$eventDates    = array();
	
	if($rs_eventlinks_count>=1)
	{
		while($cn_eventlinks = $cndb->fetchRow($rs_eventlinks, 'assoc'))
		{
			$eventDates[] = array 
			(
				'ev_date'	    => 	''.strtotime($cn_eventlinks['ev_date']).'',
				'ev_time_start'  => 	''.$cn_eventlinks['ev_time_start'].'',
				'ev_time_end'    => 	''.$cn_eventlinks['ev_time_end'].''
			);				
		}
	}
	return $eventDates;
}	
	
	
	
	
$masterContent = array();
$sq_contlinks_date = "SELECT UNIX_TIMESTAMP(MAX(`date_modified`)) FROM `mrfc_dt_content`; ";
$rs_contlinks_date = $cndb->dbQuery($sq_contlinks_date);
$cn_contlinks_date = $cndb->fetchRow($rs_contlinks_date);
$date_update 	   = $cn_contlinks_date[0];

$cont_parents     = array();

/* @@ CONTENT TO PROJECT LINKS */
/*$projLinks = array();
$sq_proj_links = "SELECT `sector_id`,`project_id`,`id_content` FROM `mrfc_app_project_links` WHERE (`id_content` <> '0')";
$rs_proj_links = $cndb->dbQuery($sq_proj_links); 	
while( $cn_proj_links = $cndb->fetchRow($rs_proj_links, 'assoc') ) 
{ $projLinks[$cn_proj_links['id_content']] = $cn_proj_links; }*/
/* == END == */



		
$sq_contlinks = " SELECT  `mrfc_dt_content`.`id`, `mrfc_dt_content`.`id_section`, `mrfc_dt_content_parent`.`id_parent`, `mrfc_dt_menu`.`title` AS `parent`, `mrfc_dt_content`.`title`, `mrfc_dt_content`.`title_sub`, `mrfc_dt_content`.`article`, DATE_FORMAT(`mrfc_dt_content`.`date_created`,'%b %d, %Y') as `date_created`, `mrfc_dt_content`.`published`, `mrfc_dt_content`.`frontpage`, `mrfc_dt_content`.`seq`, `mrfc_dt_menu`.`link` AS `link_menu`, `mrfc_dd_sections`.`link` AS `link_section`, `mrfc_dt_content`.`date_created` as `dated`, `mrfc_dt_content`.`sidebar`, `mrfc_dt_content`.`arr_extras`, `mrfc_dt_content`.`id_owner`, `mrfc_dt_content`.`link_static`, `mrfc_dt_content`.`status`, `mrfc_dt_content`.`id_access`, `mrfc_dt_content`.`hits`, `mrfc_dt_content`.`url_title_article`, `mrfc_dd_sections`.`title` as `section`, `mrfc_dt_content`.`arr_images`, `mrfc_dt_content`.`organization_id`, `mrfc_dt_content_parent`.`county_id`, `mrfc_dt_content_parent`.`committee_id`
   FROM 
      (((`mrfc_dt_content` LEFT JOIN `mrfc_dt_content_parent` ON `mrfc_dt_content`.`id`=`mrfc_dt_content_parent`.`id_content`) 
	  INNER JOIN `mrfc_dd_sections` ON `mrfc_dt_content`.`id_section`=`mrfc_dd_sections`.`id`) 
	  LEFT JOIN `mrfc_dt_menu` ON `mrfc_dt_content_parent`.`id_parent`=`mrfc_dt_menu`.`id`) WHERE `mrfc_dt_content`.`published` = 1 and  `mrfc_dt_content`.`approved` = 1 order by `mrfc_dt_content`.`date_created` DESC ";
		
		
$rs_contlinks = $cndb->dbQuery($sq_contlinks);
$rs_contlinks_count = $cndb->recordCount($rs_contlinks);

if($rs_contlinks_count>=1)
{
	$patterns[0] = "/`/";
	$patterns[1] = "/’/";
	

	while($cn_contlinks=$cndb->fetchRow($rs_contlinks))
	{
		if( strlen($cn_contlinks[11]) <= 5 && $cn_contlinks[11] <> "#" ) 
		{ $link = $cn_contlinks[12]; } else 
		{ $link = $cn_contlinks[11]; }
		
		
		$cID	  = $cn_contlinks['id'];
		$cDate	= strtotime($cn_contlinks['dated']);
		
		$cTitle   = clean_output($cn_contlinks['title']);
		$cTitle   = preg_replace($patterns,'',$cTitle);
		
		$cTitle_sub = clean_output($cn_contlinks['title_sub']);
		$cTitle_sub = preg_replace($patterns,'',$cTitle_sub);
		
		$cParentID	  = $cn_contlinks['id_parent'];
		$cParent = clean_output($cn_contlinks['parent']);
		$cParent = preg_replace($patterns,'',$cParent);
		
		$cArticle = clean_output($cn_contlinks['article']);
		$cArticle = preg_replace($patterns,'',$cArticle);					
		
		$cSection = $cn_contlinks['id_section'];
		$cSection_title = clean_output($cn_contlinks['section']);
		
		$cEventDates   = '';
		
		if($cSection == 6 or $cSection ==7) {
			$cEventDates = contentDates($cID); 
			if(count($cEventDates)>0) {
				//$masterContent['events'][$cID] = $cEventDates;
				$cDate = $cEventDates[0]['ev_date'];
			}
		}
		
		$cLocation = clean_output($cn_contlinks[15]);
		$cBooking  = 0;
		$cBooking_amount = '';
		
		$contExtras = (array) '';
		
		$arr_extras = @unserialize($cn_contlinks[15]); 
		if(is_array($arr_extras) and count($arr_extras) > 0) 
		{
			foreach($arr_extras as $akey => $aval)
			{
				$contExtras[$akey] = @clean_output($aval);
			}
			
			if($cn_contlinks['arr_images'] <> '')
			{
				$contExtras['avatar'] = @clean_output($cn_contlinks['arr_images']);
			}
						
			
			$cLocation = clean_output(@$arr_extras['location']);
			$cBooking  = @$arr_extras['book_form'];
			$cBooking_amount = @$arr_extras['book_amount'];						
		}
		
		$cLocation 	  = preg_replace($patterns,'',$cLocation);
		
		$article_extras = @unserialize($cn_contlinks[15]);
		
		$article_seo_url = $cn_contlinks['url_title_article'];
		
		
		/* @@ CONTENT TO OTHER PARENT LINKS */
        $county_id      = $cn_contlinks['county_id'];
        $committee_id   = $cn_contlinks['committee_id'];
		$sector_id	= ''; $project_id   = '';			
		/*if(array_key_exists($cID,$projLinks)) { 
			$sector_id  = $projLinks[$cID]['sector_id'];
			$project_id = $projLinks[$cID]['project_id'];
		}*/
		/* == END == */
		

		//$cArticle = '';
		$contItem = array 
		(
			'id'			=> 	''.$cn_contlinks[0].'',
			'title'			=> 	''.$cTitle.'',
			'title_sub'		=> 	''.$cTitle_sub.'',
			'id_menu'		=> 	''.$cParentID.'',
			'parent'		=> 	''.$cParent.'',
			'article'		=> 	''.$cArticle.'',
			'modified'		=> 	''.$cn_contlinks[7].'',
			'show'			=> 	''.$cn_contlinks[8].'',
			'id_section'	  => 	''.$cSection.'',
			'frontpage'	   => 	''.$cn_contlinks[9].'',
			'link_menu'		=> 	''.$link.'',
			'link_seo'		=> 	''.$article_seo_url.'',
			'seq'			=> 	''.$cn_contlinks[10].'',
			'dated'			=> 	''.$cDate.'',
			'event_dates'	 => 	$cEventDates,
			'location'		=> 	''.$cLocation.'',
			'booking'		=> 	''.$cBooking.'',
			'booking_amount'		=> 	''.$cBooking_amount.'',
			'theme_tab'		=> 	''.$cn_contlinks[19].'',
			'id_access'		=> 	''.$cn_contlinks['id_access'].'',
			'hits'			=> 	''.$cn_contlinks['hits'].'',
			'organization_id'      => 	''.$cn_contlinks['organization_id'].'',
			'organization'      => 	''.clean_output(@$cn_contlinks['organization']).'',
			'extras'     => 	$contExtras
			
		);
					
			//displayArray($contItem);
			
		$masterContent['full'][$cID] 			= $contItem;
		$masterContent['section'][$cSection][$cID] 	= $cID;
        
        if($cn_contlinks['id_section'] <> 17){
		  $masterContent['parent'][$cParentID][$cID] 	= $cID;	/* Menu Content */
		}
		
        if($cSection == 6 or $cSection == 2)	/* Combined News and Events */
		{ $masterContent['news_events'][$cID] = $cID; }
        
        if($cSection == 17)   /* Menu Intros */
		{ $masterContent['intros'][$cParentID][$cID] 	= $cID; }	
        
		if($cn_contlinks['frontpage'] == 1)	/* Featured Front */
		{ $masterContent['front'][$cID] = $cID; }
		
        //$cont_parents[$cID] = array();
        //array_push($cont_parents, $cID);
		
        if($county_id <> 0)	/* county */
		{
            if(@!array_key_exists('cty', $cont_parents[$cID])) { $cont_parents[$cID]['cty'] = array(); }             
            $masterContent['county'][$county_id][$cID] = $cID; 
            array_push($cont_parents[$cID]['cty'], $county_id);  /*$cont_parents[$cID]['county'][] = [$county_id];*/            
            
        }
			
        if($committee_id <> 0)	/* committee_id */
		{ 
            if(@!array_key_exists('cmt', $cont_parents[$cID])) { $cont_parents[$cID]['cmt'] = array(); }
            $masterContent['committee'][$committee_id][$cID] = $cID; 
            array_push($cont_parents[$cID]['cmt'], $committee_id); /*$cont_parents[$cID]['committee'][] = [$committee_id];*/ 
        }
			
					
		
		
	}
        $masterContent['cont_parents'] = $cont_parents;
	
}

//$masterContent['_projgall'] = $projLinks;			
$masterContent['_modstamp'] = $date_update;	
//displayArray($cont_parents); exit;
//displayArray($masterContent); exit;

$cachContent = serialize($masterContent);	
$sq_cach_cont  = " replace into `mrfc_cache_vars` ( `cache_id`, `cache_date`, `cache_data` ) values ('contentChest', ".clean_escape($date_update).", ".clean_escape($cachContent).");";
$rs_cach_cont  = $cndb->dbQuery($sq_cach_cont);
echo $date_update;


?>