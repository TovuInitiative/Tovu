<?php require("cls.config.php"); 

function displayArray($array)    { echo "<pre>"; print_r($array); echo "</pre><hr />"; }
function clean_output($str, $useBreak=0) { if($useBreak){ $str = nl2br($str); } $patterns[0] = "/`/"; $patterns[1] = "/’/";  $str = trim(html_entity_decode(stripslashes($str),ENT_QUOTES,'UTF-8'));	 $str = iconv("ISO-8859-15", "UTF-8", iconv("UTF-8", "ISO-8859-15//IGNORE", $str));  return $str; } 
function clean_escape($value) { $cndb = new master(); $value = $cndb->quote_si($value);  return $value; }




	
$masterMenus = array();
$sq_mainlinks_date = "SELECT max(`date_update`) FROM `mrfc_dt_menu`; ";
$rs_mainlinks_date = $cndb->dbQuery($sq_mainlinks_date);
$cn_mainlinks_date = $cndb->fetchRow($rs_mainlinks_date);
$date_update 	   = $cn_mainlinks_date[0];
		
$sq_mainlinks = "SELECT `mrfc_dt_menu`.`id`, `mrfc_dt_menu`.`title`, `mrfc_dt_menu`.`title_alias`, `mrfc_dt_menu`.`title_brief`, `mrfc_dt_menu`.`id_section`, `mrfc_dt_menu`.`id_type_menu`, `mrfc_dt_menu`.`description`, `mrfc_dt_menu`.`link` AS `menu_link`, `mrfc_dd_sections`.`link` AS `section_link`, `mrfc_dt_menu`.`metawords`, `mrfc_dd_sections`.`title` AS `section_title`, `mrfc_dd_menu_type`.`title` AS `type_title`, `mrfc_dt_menu`.`id_access`, `mrfc_dt_menu`.`target`, `mrfc_dt_menu`.`published`, `mrfc_dt_menu`.`seq`, `mrfc_dt_menu_parent`.`id_parent`, `mrfc_dt_menu`.`static` as `to_footer`, `mrfc_dt_menu`.`quicklink`, `mrfc_dt_menu`.`image`, `mrfc_dt_menu`.`image_show`, `mrfc_dt_menu`.`title_seo` , `mrfc_dt_menu`.`date_update`
FROM (((`mrfc_dt_menu` 
LEFT JOIN `mrfc_dt_menu_parent` ON `mrfc_dt_menu`.`id`=`mrfc_dt_menu_parent`.`id_menu` ) 
INNER JOIN `mrfc_dd_sections` ON `mrfc_dt_menu`.`id_section`=`mrfc_dd_sections`.`id`) 
LEFT JOIN `mrfc_dd_menu_type` ON `mrfc_dt_menu`.`id_type_menu`=`mrfc_dd_menu_type`.`id`) 
 WHERE (`mrfc_dt_menu`.`published` =1) ORDER BY `mrfc_dt_menu`.`seq` ASC, `mrfc_dt_menu`.`id_type_menu` ASC,  `mrfc_dt_menu_parent`.`id_parent` ASC,  `mrfc_dt_menu`.`title` ASC "; 

$rs_mainlinks=$cndb->dbQuery($sq_mainlinks);
$rs_mainlinks_count=$cndb->recordCount($rs_mainlinks);

//$date_update = 0;

if($rs_mainlinks_count>=1)
{
	$menu_loop=1;
	while($cn_mainlinks=$cndb->fetchRow($rs_mainlinks))
	{
		
		//if(intval($cn_mainlinks['date_update']) > $date_update)
		//{ $date_update 	= intval($cn_mainlinks['date_update']); }
		
		$menu_link 		= $cn_mainlinks['menu_link'];
		$section_link 	 = $cn_mainlinks['section_link'];
		
		if(strlen($menu_link) >= 2 or $menu_link == "#" ) 
		{ $link = $menu_link; } else { $link = $section_link; }
		
		$id_link 		  = $cn_mainlinks['id'];
		$id_menu_type     = $cn_mainlinks['id_type_menu'];
		$id_section       = $cn_mainlinks['id_section'];
		$id_parent        = $cn_mainlinks['id_parent'];
		
		$title   			= clean_output($cn_mainlinks['title']);
		$title_alias      = clean_output($cn_mainlinks['title_alias']);
		$metawords        = clean_output($cn_mainlinks['metawords']);
		$menu_seo_name	= $cn_mainlinks["title_seo"];
		
		
		$image 	  	    = $cn_mainlinks['image'];
		$image_show       = $cn_mainlinks['image_show'];
		$quicklink        = $cn_mainlinks['quicklink'];
		$to_footer        = $cn_mainlinks['to_footer'];
		
		
		$menuItem = array 
		(						
			'id'			  => 	''.$id_link.'',
			'title'		   => 	''.$title.'',
			'title_alias'	 => 	''.$title_alias.'',	
			'menu_seo_name'   => 	''.$menu_seo_name.'',					
			'id_section'	  => 	''.$id_section.'',
			'id_menu_type'	=> 	''.$id_menu_type.'',
			'link_menu'	   => 	''.$link.'',					
			'metawords'	   => 	''.$metawords.'',
			'to_footer'	   => 	''.$to_footer.'',
			'to_quick'		=> 	''.$quicklink.'',
			'id_access'	  => 	''.$cn_mainlinks["id_access"].''													
		);
		
		
		$masterMenus['full'][$id_link] 	  			  = $menuItem;
		$masterMenus['type'][$id_menu_type][$id_link]   = $id_link;
		$masterMenus['section'][$id_section][$id_link]  = $id_link;
		
		$masterMenus['seo'][$menu_seo_name] = $id_link;
		
		
		if($id_parent <> '') 
		{   $masterMenus['child'][$id_parent][$id_link] = $id_link; 
			$masterMenus['mom']['_link'][$id_link] 	  = $id_parent;
		}
		
		
		//@@ Menu Header
		if($quicklink == 1) 
		{
			if (!@array_key_exists($id_link, $masterMenus['type'][6])) {
				$masterMenus['type'][6][$id_link] = $id_link;  
			}
		}
		
		
		//@@ Sitemap Base
		if($id_menu_type == 6 or $id_menu_type == 5 or $id_menu_type == 1) 
		{
			//if (!@array_key_exists($id_link, $masterMenus['_tree'])) {}
				$masterMenus['type']['_tree'][$id_link] = $id_link;  			
		}
		
		//@@ Menu Groups
		if($id_menu_type == 4)
		{
			//if (!array_key_exists($id_link, $this->menuGroups)) {}
				$masterMenus['group'][$id_link] = $id_link;  			
		}
	
		//@@ Tab Links
		if($id_menu_type == 3) 
		{
			$masterMenus['tabs'][$id_parent][$id_link] = $id_link;
		}
		
		
		//@@ Directory Categories
		if($id_section == 13) 
		{
			//master::$directoryCatsMenu
			$masterMenus['dircat'][''.$menu_seo_name.''] = $title;
		}
		
		
		
		//@@ Footer Links
		if($to_footer == 1) 
		{ 
			if (!@array_key_exists($id_link, $masterMenus['type'][5])) {
				$masterMenus['type'][5][$id_link] = $id_link; 
			}
		}
		
		//if($cn_mainlinks["id_access"] == 2) 
		//{ master::$menuLocks[$id_link] = get_MenuAccess($id_link); }
		
		
		
	}
}
$masterMenus['_modstamp'] = $date_update;	
//displayArray($masterMenus); exit;
$cachMenu = serialize($masterMenus);	
$sq_cach_menu  = " replace into `mrfc_cache_vars` ( `cache_id`, `cache_date`, `cache_data` ) values ('menuChest', ".clean_escape($date_update).", ".clean_escape($cachMenu).");";
$rs_cach_menu  = $cndb->dbQuery($sq_cach_menu);
echo $date_update; 


?>