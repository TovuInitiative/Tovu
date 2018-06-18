<?php require("cls.config.php"); 

function displayArray($array)    { echo "<pre>"; print_r($array); echo "</pre><hr />"; }
function clean_output($str, $useBreak=0) { if($useBreak){ $str = nl2br($str); } $patterns[0] = "/`/"; $patterns[1] = "/’/";  $str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	 $str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));  return $str; } 
function clean_escape($value) { $cndb = new master(); $value = $cndb->quote_si($value);  return $value; }
	

$masterResource = array();
$sq_resource_date = "SELECT UNIX_TIMESTAMP(MAX(`date_updated`)) FROM `mrfc_dt_downloads`; ";
$rs_resource_date = $cndb->dbQuery($sq_resource_date);
$cn_resource_date = $cndb->fetchRow($rs_resource_date);
$date_update 	 = $cn_resource_date[0];


$sq_res_cty_sec = "SELECT DISTINCT
    `mrfc_dt_downloads_parent`.`resource_id`
    , CONCAT(''  , GROUP_CONCAT( `mrfc_dt_downloads_parent`.`county_id` SEPARATOR ',') ) AS `county_id`
    , CONCAT(''  , GROUP_CONCAT( `mrfc_dt_downloads_parent`.`committee_id` SEPARATOR ',') ) AS `committee_id`
FROM
    `mrfc_dt_downloads_parent` 
    WHERE (`mrfc_dt_downloads_parent`.`county_id` >0)
    OR (`mrfc_dt_downloads_parent`.`committee_id` >0)
GROUP BY `mrfc_dt_downloads_parent`.`resource_id`; ";
$rs_res_cty_sec = $cndb->dbQueryFetch($sq_res_cty_sec, 'resource_id');

//displayArray($rs_res_cty_sec);

$sq_resource = "SELECT
    mrfc_dt_downloads.*
    , mrfc_dt_downloads_parent.*
FROM
    `mrfc_dt_downloads`
    INNER JOIN `mrfc_dt_downloads_parent` 
        ON (`mrfc_dt_downloads`.`resource_id` = `mrfc_dt_downloads_parent`.`resource_id`)
WHERE (`mrfc_dt_downloads`.`published` =1)
ORDER BY `mrfc_dt_downloads`.`resource_id` DESC, `mrfc_dt_downloads`.`date_updated` DESC; ";

/*$sq_resource = "SELECT
    mrfc_dt_downloads.*
	, `mrfc_dt_downloads_parent`.`id_menu`
    , `mrfc_dt_downloads_parent`.`id_content`
	, MAX(`mrfc_dt_downloads_parent`.`organization_id`) AS `organization_id`
    , MAX(`mrfc_reg_organizations`.`organization`) AS `organization_other`
    , MAX(`mrfc_dt_downloads_type`.`download_type`) AS `type_other`
	, GROUP_CONCAT(`mrfc_conf_county`.`county` SEPARATOR ',') as `county_other`    
    , MAX(`mrfc_dt_downloads_parent`.`res_type_id`) AS `res_type_id`
    , MAX(`mrfc_dt_downloads_parent`.`county_id`) AS `county_id`
FROM
    `mrfc_dt_downloads`
    LEFT JOIN `mrfc_dt_downloads_parent` 
        ON (`mrfc_dt_downloads`.`resource_id` = `mrfc_dt_downloads_parent`.`resource_id`)
	LEFT JOIN `mrfc_reg_organizations` 
        ON (`mrfc_dt_downloads_parent`.`organization_id` = `mrfc_reg_organizations`.`organization_id`)
    LEFT JOIN `mrfc_dt_downloads_type` 
        ON (`mrfc_dt_downloads_parent`.`res_type_id` = `mrfc_dt_downloads_type`.`res_type_id`)
    LEFT JOIN `mrfc_conf_county` 
        ON (`mrfc_dt_downloads_parent`.`county_id` = `mrfc_conf_county`.`county_id`)
WHERE (`mrfc_dt_downloads`.`published` =1)
GROUP BY `mrfc_dt_downloads`.`resource_id`
ORDER BY `mrfc_dt_downloads`.`resource_id` DESC, `mrfc_dt_downloads`.`date_updated` DESC; ";*/
/*, MAX(`mrfc_conf_county`.`county`) AS `county_other`*/

$rs_resource = $cndb->dbQuery($sq_resource);
$rs_resource_count = $cndb->recordCount($rs_resource);

if($rs_resource_count>=1)
{
	
	while($cn_resource = $cndb->fetchRow($rs_resource, 'assoc'))
	{
		
		
		$mod_date = strtotime($cn_resource['date_updated']);

		$id_file			= $cn_resource['resource_id'];
		$item_date		   	= strtotime($cn_resource['date_created']);

		$item_name		   	= clean_output($cn_resource['resource_file']);
		$item_title		  	= clean_output($cn_resource['resource_title']);
		$item_type		  	= clean_output($cn_resource['content_type']);// (strlen(trim($cn_resource['content_type'])) > 5) ? clean_output($cn_resource['content_type']) : clean_output($cn_resource['type_other']);
		$item_type_other	= clean_output(@$cn_resource['type_other']);
		$item_article		= clean_output($cn_resource['resource_description']);
		$item_brief			= htmlentities(strip_tags($item_article, '<img>'));			
		$item_author		= (trim($cn_resource['publisher']) <> '') ? clean_output($cn_resource['publisher']) : clean_output(@$cn_resource['organization_other']);
		//echo($cn_resource['county_other']).'<hr>';
		$aCounty			= (@$cn_resource['county_other'] <> '') ? explode(',', $cn_resource['county_other']) : array(); //array($cn_resource['county'], $cn_resource['county_other']);
		$aCounty 			= array_map("trim", $aCounty);
		if((@$cn_resource['county'] <> '') and (!in_array($cn_resource['county'], $aCounty))){ $aCounty[] = $cn_resource['county']; }
		//$item_county		= (trim($cn_resource['county']) <> '') ? clean_output($cn_resource['county']) : clean_output($cn_resource['county_other']);
		$item_county		= implode(',', $aCounty);
			
		$item_language		= clean_output($cn_resource['language']);
		$item_cover			= clean_output($cn_resource['resource_image']);

		$id_content   		= $cn_resource['id_content'];
		$id_menu 	  		= $cn_resource['id_menu'];	

		$featured 	 		= $cn_resource['featured'];		
		$file_seo	 		= $cn_resource['resource_slug'];
		$access_id	 		= $cn_resource['access_id'];

        $pic_parent_id      = '';
        $pic_parent       = '';
		if($id_menu <> 0)      { $pic_parent = '_link'; $pic_parent_id = $id_menu; }
		if($id_content <> 0)   { $pic_parent = '_cont'; $pic_parent_id = $id_content; }

		//$pic_parent = '_link'; $pic_parent_id = 5;

		$files 	= array(
			'cont_id' 	 		=> ''.$id_file.'',
			'cont_date'     	=> ''.$item_date.'',
			'cont_title'    	=> ''.$item_title.'',
			'cont_name'    		=> ''.$item_name.'',
			'cont_type'    		=> ''.$item_type.'',
			'cont_type_other'   => ''.$item_type_other.'',
			'cont_brief' 		=> ''.$item_article.'',
			'cont_author' 		=> ''.$item_author.'',
			'cont_language' 	=> ''.$item_language.'',
			'cont_parent_type' 	=> ''.$pic_parent.'',
			'cont_parent_id'  	=> 	''.$pic_parent_id.'',				
			'cont_seo'       	=> 	''.$file_seo.'',
			'cont_cover'       	=> 	''.$item_cover.'',
            'cont_access'       => 	''.$access_id.'', 

			//'source_url' 		=> ''.clean_output($cn_resource['source_url']).'',
			'resource_size' 		=> ''.clean_output($cn_resource['resource_size']).'',
			'resource_tags' 		=> ''.clean_output($cn_resource['resource_tags']).'',
			//'county' 			=> ''.$item_county.'',
			'resource_extension' 		=> ''.clean_output($cn_resource['resource_extension']).'',
			//'devolved_functions' 		=> ''.clean_output($cn_resource['devolved_functions']).'',
			'alternative_title' 		=> ''.clean_output($cn_resource['alternative_title']).'',
			'year_published' 		=> ''.clean_output($cn_resource['year_published']).''            
		);

        /*
        @@ COUNTY PARENT && SECTOR / COMMITTEE PARENT
        */
        if(array_key_exists($id_file, $rs_res_cty_sec)){
            //$fcounty_id = str_replace(',0', '', $rs_res_cty_sec[$id_file]['county_id']);
            //$cty_sec['fcounty_id'] = explode(',', $rs_res_cty_sec[$id_file]['county_id']);
            //$cty_sec['fsector_id'] = explode(',', $rs_res_cty_sec[$id_file]['committee_id']); 
            $masterResource['fcounty_id'][$id_file] = explode(',', $rs_res_cty_sec[$id_file]['county_id']);
            $masterResource['fsector_id'][$id_file] = explode(',', $rs_res_cty_sec[$id_file]['committee_id']); 
            
            //$masterResource['cty_sec'][$id_file] = $cty_sec; 
        }
        
        if($access_id <> 1){
            $masterResource['private'][$id_file] = $files; 
        } else {
		    $masterResource['full'][$id_file] = $files; 
        }
		$masterResource['_seo'][$file_seo] = $id_file;
		$masterResource[''.$pic_parent.''][$pic_parent_id][$id_file] = $id_file; 

			if($featured == 1)
			{   $masterResource['_feat'][$id_file] = $id_file; }						
						
		//displayArray($cn_resource);
		//displayArray($masterResource); exit;
	}
}
		
$masterResource['_modstamp'] = $date_update;	
/*displayArray($masterResource); exit;*/

$cachResource = serialize($masterResource);	
$sq_cach_resource  = " replace into `mrfc_cache_vars` ( `cache_id`, `cache_date`, `cache_data` ) values ('resourceChest', ".$cndb->quote_si($date_update).", ".$cndb->quote_si($cachResource).");";
$rs_cach_resource  = $cndb->dbQuery($sq_cach_resource);
echo $date_update .' - '. date('Y-m-d H:i:a',$date_update); 

?>