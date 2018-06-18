<?php require("cls.config.php"); 

function displayArray($array)    { echo "<pre>"; print_r($array); echo "</pre><hr />"; }
function clean_output($str, $useBreak=0) { if($useBreak){ $str = nl2br($str); } $patterns[0] = "/`/"; $patterns[1] = "/’/";  $str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	 $str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));  return $str; } 
function clean_escape($value) { $cndb = new master(); $value = $cndb->quote_si($value);  return $value; }

	

$masterGallery = array();
$sq_gallery_date = "SELECT UNIX_TIMESTAMP(MAX(`date_modify`)) FROM `mrfc_dt_gallery_photos`; ";
$rs_gallery_date = $cndb->dbQuery($sq_gallery_date);
$cn_gallery_date = $cndb->fetchRow($rs_gallery_date);
$date_update 	 = $cn_gallery_date[0];

		
$sq_gallery = "SELECT
`mrfc_dt_gallery_photos`.`id`
, `mrfc_dt_gallery_photos`.`id_gallery_cat`
, `mrfc_dt_gallery_photos`.`title`
, `mrfc_dt_gallery_photos`.`filename`
, `mrfc_dt_gallery_photos`.`description`
, `mrfc_dt_gallery_photos_parent`.`id_content`
, `mrfc_dt_gallery_photos_parent`.`id_link`
, `mrfc_dt_gallery_photos_parent`.`id_product`
, `mrfc_dt_gallery_photos_parent`.`id_resource`
, `mrfc_dt_gallery_photos_parent`.`parent_type`
, `mrfc_dt_gallery_photos`.`filetype`
, `mrfc_dt_gallery_photos`.`date_modify`
, `mrfc_dt_gallery_photos`.`tags`	
, `mrfc_dt_gallery_category`.`gall_code`
, `mrfc_dt_gallery_photos`.`published`	
, CASE WHEN ISNULL(`mrfc_dt_content`.`published`)  THEN 
		`mrfc_dt_menu`.`published` 
	 ELSE `mrfc_dt_content`.`published`
	 END AS `pub_parent` 
FROM
`mrfc_dt_gallery_photos`
LEFT JOIN `mrfc_dt_gallery_photos_parent` 
	ON (`mrfc_dt_gallery_photos`.`id` = `mrfc_dt_gallery_photos_parent`.`id_photo`)
LEFT JOIN `mrfc_dt_content` 
	ON (`mrfc_dt_gallery_photos_parent`.`id_content` = `mrfc_dt_content`.`id`)
LEFT JOIN `mrfc_dt_menu` 
	ON (`mrfc_dt_gallery_photos_parent`.`id_link` = `mrfc_dt_menu`.`id`)
INNER JOIN `mrfc_dt_gallery_category` 
        ON (`mrfc_dt_gallery_photos`.`id_gallery_cat` = `mrfc_dt_gallery_category`.`id`)	
WHERE (`mrfc_dt_gallery_photos`.`published` =1) 
ORDER BY `mrfc_dt_gallery_photos`.`date_modify` DESC; ";


$rs_gallery = $cndb->dbQuery($sq_gallery);
$rs_gallery_count = $cndb->recordCount($rs_gallery);

if($rs_gallery_count>=1)
{
	
	while($cn_gallery = $cndb->fetchRow($rs_gallery))
	{
		if($cn_gallery['pub_parent'] == 1 or $cn_gallery['pub_parent'] == '')
		{
			$mod_date = strtotime($cn_gallery['date_modify']);
					
			$id_photo     = $cn_gallery['id'];
			$id_content   = $cn_gallery['id_content'];
			$id_link 	  = $cn_gallery['id_link'];
			$id_product   = $cn_gallery['id_product'];	
			$id_resource  = $cn_gallery['id_resource'];		
			$parent_type  = $cn_gallery['parent_type'];		
			
			$gallery_cat  = $cn_gallery['id_gallery_cat'];
			$gallery_code = clean_output($cn_gallery['gall_code']);
			
			$pic_parent   = '';			
			if($id_link > 0)      { $pic_parent = '_link';    $pic_parent_id = $id_link; }
			if($id_content > 0)   { $pic_parent = '_cont';    $pic_parent_id = $id_content; }
			if($id_product > 0)   { $pic_parent = '_product'; $pic_parent_id = $id_product; }
			//if($id_resource > 0)  { $pic_parent = '_resource'; $pic_parent_id = $id_resource; }
			
			
			$filetype	 = trim($cn_gallery['filetype']);
			$pic_tags	 = clean_output($cn_gallery['tags']);
			//$ca_tags	  = ''; //@unserialize($ca_tags);
			
			
			/* @@ GALLERY TO PROJECT LINKS */
			/*$sector_id	= ''; $project_id   = '';			
			if(array_key_exists($id_photo,$projLinks)) { 
				$sector_id  = $projLinks[$id_photo]['sector_id'];
				$project_id = $projLinks[$id_photo]['project_id'];
				
				if($pic_parent == '' and $project_id <>'') { $pic_parent = '_project'; $pic_parent_id = $project_id;}
				if($pic_parent == '' and $project_id =='') { $pic_parent = '_sector'; $pic_parent_id = $sector_id;}
			}*/
			/* == END == */
			
			$gallery_item = array 
				(
					'id'			 => 	''.$id_photo.'',
					'title'		  => 	''.clean_output($cn_gallery['title']).'',						
					'filename'	   => 	''.trim($cn_gallery['filename']).'',
					'filetype'	   => 	''.$filetype.'',
					'modified'       => 	''.$cn_gallery['date_modify'].'',
					'details'	    => 	''.clean_output($cn_gallery['description']).'',
					'id_gallery_cat' => 	''.$cn_gallery['id_gallery_cat'].'',
					'gallery_code'   => 	''.$gallery_code.'',
					'pic_parent'     => 	''.$pic_parent.'',
					'pic_parent_id'  => 	''.$pic_parent_id.'',
					'pic_tags'       => 	''.$pic_tags.'',
					'pic_site'  	   => 	'jtsl',
					//'sector_id'      => 	''.$sector_id.'',
					//'project_id'     => 	''.$project_id.''
				);
				
			$masterGallery['full'][$id_photo] = $gallery_item; 
			$masterGallery['type'][''.$filetype.''][$id_photo] = $id_photo; 			
			$masterGallery['cat'][''.$gallery_code.''][$id_photo] = $id_photo;
			$masterGallery['parent'][''.$pic_parent.''][$pic_parent_id][$id_photo] = $id_photo;
		
		}
	}
}
//$masterGallery['_projgall'] = $projLinks;		
$masterGallery['_modstamp'] = $date_update;	
//displayArray($masterGallery); exit;

$cachGallery = serialize($masterGallery);	
$sq_cach_Gallery  = " replace into `mrfc_cache_vars` ( `cache_id`, `cache_date`, `cache_data` ) values ('galleryChest', ".clean_escape($date_update).", ".clean_escape($cachGallery).");";
$rs_cach_Gallery  = $cndb->dbQuery($sq_cach_Gallery);
echo $date_update .' - '. date('Y-m-d H:i:a',$date_update); 

?>