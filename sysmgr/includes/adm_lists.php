<?php
$adm_editLock = false;
$adm_dispFront = 0;
if($sys_us_admin['actype_id'] == 2){
    $adm_editLock = true;
    $adm_dispFront = 1;
}

?>
<div style="padding:5px; text-align:right; font-size:14px; font-weight:bold;"> <a href="hforms.php?d=<?php echo $dir; ?>&op=new" style="color:#FF0000">[ ADD NEW ]</a> </div>
<?php
//echo $dir;

if($dir == 'menus')
{	  
	
	 $sqList = "SELECT  `".$pdb_prefix."dt_menu`.`id`, case when trim(`".$pdb_prefix."dt_menu`.`title_alias`) <>'' then concat_ws(' / ', `".$pdb_prefix."dt_menu`.`title`, `".$pdb_prefix."dt_menu`.`title_alias`) else `".$pdb_prefix."dt_menu`.`title` end as `title`, `".$pdb_prefix."dt_menu`.`id_section`, `".$pdb_prefix."dd_menu_type`.`title` as `category type`, `".$pdb_prefix."dt_menu 1`.`title` AS `parent`, case when `".$pdb_prefix."dt_menu`.`link` ='' then `".$pdb_prefix."dd_sections`.`link` else `".$pdb_prefix."dt_menu`.`link` end as `link`,   `".$pdb_prefix."dd_sections`.`title` AS `section`, COUNT(`".$pdb_prefix."dt_content_parent`.`id_content`) AS `items` ,  `".$pdb_prefix."dt_menu`.`seq` as `pos.`,  `".$pdb_prefix."dt_menu`.`published` as `active` , `".$pdb_prefix."dt_menu`.`id_parent1`  FROM    ((((`".$pdb_prefix."dt_menu` LEFT JOIN `".$pdb_prefix."dd_menu_type` ON `".$pdb_prefix."dt_menu`.`id_type_menu`=`".$pdb_prefix."dd_menu_type`.`id`) LEFT JOIN `".$pdb_prefix."dd_sections` ON `".$pdb_prefix."dt_menu`.`id_section`=`".$pdb_prefix."dd_sections`.`id`) LEFT JOIN `".$pdb_prefix."dt_menu_parent` ON `".$pdb_prefix."dt_menu`.`id`=`".$pdb_prefix."dt_menu_parent`.`id_menu` and `".$pdb_prefix."dt_menu_parent`.`id_portal` = `".$pdb_prefix."dt_menu`.`id_portal` ) LEFT JOIN `".$pdb_prefix."dt_menu` `".$pdb_prefix."dt_menu 1` ON `".$pdb_prefix."dt_menu_parent`.`id_parent`=`".$pdb_prefix."dt_menu 1`.`id`)  LEFT JOIN `".$pdb_prefix."dt_content_parent`  ON (`".$pdb_prefix."dt_menu`.`id` = `".$pdb_prefix."dt_content_parent`.`id_parent`) GROUP BY `".$pdb_prefix."dt_menu`.`id`  order by  `".$pdb_prefix."dd_menu_type`.`id`, `".$pdb_prefix."dt_menu`.`seq` ASC , `".$pdb_prefix."dt_menu`.`id_parent1`;";  
	  echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}

elseif($dir == 'articles')
{	  
	//, `".$pdb_prefix."dt_menu`.`title` AS `parent link`
    
	$sqList = "SELECT `".$pdb_prefix."dt_content`.`id`
	, `".$pdb_prefix."dt_content`.`id_section`
	, `".$pdb_prefix."dt_content`.`date_created` AS `item date`
	, case when (`".$pdb_prefix."dt_content`.`title_sub`<>'') then concat_ws(' | ',`".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`title_sub`) else `".$pdb_prefix."dt_content`.`title` end as `title`	
    , group_concat( `".$pdb_prefix."dt_menu`.`title` separator ',') AS `parent link`
	, `".$pdb_prefix."dd_sections`.`title` AS `section`
	, `".$pdb_prefix."dt_content`.`id_section`		
	, `".$pdb_prefix."dt_content`.`seq` as `pos.`	
	, `".$pdb_prefix."dt_content`.`published` as `show`
	FROM (((`".$pdb_prefix."dt_content` LEFT JOIN `".$pdb_prefix."dt_content_parent` ON    `".$pdb_prefix."dt_content`.`id`=`".$pdb_prefix."dt_content_parent`.`id_content`) 
	LEFT JOIN `".$pdb_prefix."dt_menu` ON `".$pdb_prefix."dt_content_parent`.`id_parent`=`".$pdb_prefix."dt_menu`.`id`) 
	INNER JOIN `".$pdb_prefix."dd_sections` ON `".$pdb_prefix."dt_content`.`id_section`=`".$pdb_prefix."dd_sections`.`id`) 	
	GROUP BY `".$pdb_prefix."dt_content`.`id`
 ORDER BY `".$pdb_prefix."dt_content`.`date_created` DESC, `".$pdb_prefix."dt_content`.`title` ";
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}

elseif($dir == 'events')
{	  
	 $sqList = "SELECT
    `".$pdb_prefix."dt_content`.`id`
    , MIN(`".$pdb_prefix."dt_content_dates`.`date`) AS `date`
    , `".$pdb_prefix."dt_content`.`title`
	, `".$pdb_prefix."dd_sections`.`title` AS `section`
    , `".$pdb_prefix."dt_content`.`arr_extras` AS `location`
	, case when `".$pdb_prefix."dt_content`.`id_owner` > 0 then concat('USER:: ',`".$pdb_prefix."reg_account`.`email`)
	      else 'ADMIN' end as `posted by`
	, `".$pdb_prefix."dt_content`.`approved`
    , `".$pdb_prefix."dt_content`.`published` AS `active`
FROM
    `".$pdb_prefix."dt_content_dates`
    RIGHT JOIN `".$pdb_prefix."dt_content` ON (`".$pdb_prefix."dt_content_dates`.`id_content` = `".$pdb_prefix."dt_content`.`id` and `".$pdb_prefix."dt_content_dates`.`id_portal` = `".$pdb_prefix."dt_content`.`id_portal`) 
	INNER JOIN `".$pdb_prefix."dd_sections` ON `".$pdb_prefix."dt_content`.`id_section`=`".$pdb_prefix."dd_sections`.`id`
	LEFT JOIN `".$pdb_prefix."reg_account` ON (`".$pdb_prefix."dt_content`.`id_owner` = `".$pdb_prefix."reg_account`.`account_id`)
	
	where `".$pdb_prefix."dt_content`.`id_section` = '6'	
GROUP BY `".$pdb_prefix."dt_content_dates`.`id_content`, `".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`id_portal`  
 HAVING `".$pdb_prefix."dt_content`.`id_portal` = '$adm_portal_id'  
ORDER BY `".$pdb_prefix."dt_content_dates`.`date` DESC ;";
	// or `".$pdb_prefix."dt_content`.`id_section` = '7'  	
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}

elseif($dir == 'courses')
{	  
	 $sqList = "SELECT
    `".$pdb_prefix."dt_content`.`id`
    , MIN(`".$pdb_prefix."dt_content_dates`.`date`) AS `date`
    , `".$pdb_prefix."dt_content`.`title`
	, `".$pdb_prefix."dd_sections`.`title` AS `section`
    , `".$pdb_prefix."dt_content`.`arr_extras` AS `course_cost`
	, case when `".$pdb_prefix."dt_content`.`id_owner` > 0 then concat('USER:: ',`".$pdb_prefix."reg_account`.`email`)
	      else 'ADMIN' end as `posted by`
	, `".$pdb_prefix."dt_content`.`approved`
    , `".$pdb_prefix."dt_content`.`published` AS `active`
FROM
    `".$pdb_prefix."dt_content_dates`
    RIGHT JOIN `".$pdb_prefix."dt_content` ON (`".$pdb_prefix."dt_content_dates`.`id_content` = `".$pdb_prefix."dt_content`.`id` and `".$pdb_prefix."dt_content_dates`.`id_portal` = `".$pdb_prefix."dt_content`.`id_portal`) 
	INNER JOIN `".$pdb_prefix."dd_sections` ON `".$pdb_prefix."dt_content`.`id_section`=`".$pdb_prefix."dd_sections`.`id`
	LEFT JOIN `".$pdb_prefix."reg_account` ON (`".$pdb_prefix."dt_content`.`id_owner` = `".$pdb_prefix."reg_account`.`account_id`)
	
	where `".$pdb_prefix."dt_content`.`id_section` = '6' or `".$pdb_prefix."dt_content`.`id_section` = '7'  		
GROUP BY `".$pdb_prefix."dt_content_dates`.`id_content`, `".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`id_portal`  
 HAVING `".$pdb_prefix."dt_content`.`id_portal` = '$adm_portal_id'  
ORDER BY `".$pdb_prefix."dt_content_dates`.`date` DESC ;";
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}

elseif($dir == 'resources')
{	  
	 /*$sqListx = "SELECT
    `".$pdb_prefix."dt_downloads`.`resource_id` AS `id`
    , `".$pdb_prefix."dt_downloads`.`date_created` AS `posted`
    , `".$pdb_prefix."dt_downloads`.`resource_title` AS `title`
    , `".$pdb_prefix."dt_downloads`.`resource_file` AS `filename`
	, case when `".$pdb_prefix."dt_downloads_parent`.`id_menu` > 0 then concat('MENU:: ',`".$pdb_prefix."dt_menu`.`title`)
	       when `".$pdb_prefix."dt_downloads_parent`.`id_content` > 0 then concat('CONT.:: ',`".$pdb_prefix."dt_content`.`title`)
	       else NULL end as `parent item`	
    , `".$pdb_prefix."dt_downloads`.`hits` as `downloads`
	, `".$pdb_prefix."dt_downloads`.`published` AS `active`
FROM
    `".$pdb_prefix."dt_downloads`
    LEFT JOIN `".$pdb_prefix."dt_downloads_parent` ON (`".$pdb_prefix."dt_downloads`.`resource_id` = `".$pdb_prefix."dt_downloads_parent`.`resource_id`)
    LEFT JOIN `".$pdb_prefix."dt_menu` ON (`".$pdb_prefix."dt_downloads_parent`.`id_menu` = `".$pdb_prefix."dt_menu`.`id`)
    LEFT JOIN `".$pdb_prefix."dt_content` 
        ON (`".$pdb_prefix."dt_downloads_parent`.`id_content` = `".$pdb_prefix."dt_content`.`id`)
GROUP BY `".$pdb_prefix."dt_downloads`.`resource_id`, `".$pdb_prefix."dt_downloads_parent`.`id_menu`, `".$pdb_prefix."dt_downloads_parent`.`id_content`
ORDER BY `".$pdb_prefix."dt_downloads`.`date_updated` DESC;";*/
    
    
    /*
    , GROUP_CONCAT(CASE WHEN `mrfc_dt_downloads_parent`.`id_menu` > 0 THEN CONCAT('<br>MENU:: ',`mrfc_dt_menu`.`title`) 
            WHEN `mrfc_dt_downloads_parent`.`id_content` > 0 THEN CONCAT('<br>CONT:: ',`mrfc_dt_content`.`title`)  
            WHEN `mrfc_dt_downloads_parent`.`committee_id` > 0 THEN CONCAT('CMTE:: ',`mrfc_app_committee`.`title`) 
            WHEN `mrfc_dt_downloads_parent`.`county_id` > 0 THEN CONCAT('<br>CNTY:: ',`mrfc_reg_county`.`county`)
            ELSE NULL END) AS `parent_item` 
    */
	 $sqList = "SELECT
`mrfc_dt_downloads`.`resource_id`  AS `id`	
    , `mrfc_dt_downloads`.`date_created` AS `posted`
    , `mrfc_dt_downloads`.`resource_title` AS `title`
    , `mrfc_dt_downloads`.`resource_file` AS `filename`
    , GROUP_CONCAT(CASE WHEN `mrfc_dt_downloads_parent`.`id_menu` > 0 THEN CONCAT('MENU:: ',`mrfc_dt_menu`.`title`) 
            WHEN `mrfc_dt_downloads_parent`.`id_content` > 0 THEN CONCAT('CONT:: ',`mrfc_dt_content`.`title`)
             END) AS `parent_item` 
    , GROUP_CONCAT(`mrfc_app_committee`.`title`) AS `committee`
    , GROUP_CONCAT(`mrfc_reg_county`.`county`) AS `county`
     , `".$pdb_prefix."dt_downloads`.`hits`
	, `".$pdb_prefix."dt_downloads`.`published` AS `active` 
FROM
    `mrfc_dt_downloads`
    LEFT JOIN `mrfc_dt_downloads_parent` 
        ON (`mrfc_dt_downloads`.`resource_id` = `mrfc_dt_downloads_parent`.`resource_id`)
    LEFT JOIN `mrfc_dt_menu` 
        ON (`mrfc_dt_downloads_parent`.`id_menu` = `mrfc_dt_menu`.`id`)
    LEFT JOIN `mrfc_dt_content` 
        ON (`mrfc_dt_downloads_parent`.`id_content` = `mrfc_dt_content`.`id`)
    LEFT JOIN `mrfc_app_committee` 
        ON (`mrfc_dt_downloads_parent`.`committee_id` = `mrfc_app_committee`.`committee_id`)
    LEFT JOIN `mrfc_reg_county` 
        ON (`mrfc_dt_downloads_parent`.`county_id` = `mrfc_reg_county`.`county_id`)
        
GROUP BY `mrfc_dt_downloads`.`resource_id`
ORDER BY `".$pdb_prefix."dt_downloads`.`date_created` DESC;";
	  
	  /*$sqList = "SELECT
    `".$pdb_prefix."dt_downloads`.`resource_id` as `id`
    , `".$pdb_prefix."dt_downloads`.`date_created` AS `posted`
    , `".$pdb_prefix."dt_downloads`.`resource_title` as `title`
    
	, `".$pdb_prefix."dt_downloads`.`county` 	
	, `".$pdb_prefix."dt_downloads`.`content_type` as `category` 	
	, case when `".$pdb_prefix."dt_downloads`.`posted_by` > 0 then concat('USER:: ',`".$pdb_prefix."reg_account`.`email`)
	      else 'ADMIN' end as `posted by`		   
    , `".$pdb_prefix."dt_downloads`.`status` 
   
FROM
    `".$pdb_prefix."dt_downloads`
    LEFT JOIN `".$pdb_prefix."dt_downloads_parent` 
        ON (`".$pdb_prefix."dt_downloads`.`resource_id` = `".$pdb_prefix."dt_downloads_parent`.`resource_id`)
    LEFT JOIN `".$pdb_prefix."dt_menu` 
        ON (`".$pdb_prefix."dt_downloads_parent`.`id_menu` = `".$pdb_prefix."dt_menu`.`id`)
    LEFT JOIN `".$pdb_prefix."dt_content` 
        ON (`".$pdb_prefix."dt_downloads_parent`.`id_content` = `".$pdb_prefix."dt_content`.`id`)
	LEFT JOIN `".$pdb_prefix."reg_account` 
        ON (`".$pdb_prefix."dt_downloads`.`posted_by` = `".$pdb_prefix."reg_account`.`account_id`)
GROUP BY `".$pdb_prefix."dt_downloads`.`resource_id`
ORDER BY `".$pdb_prefix."dt_downloads`.`date_updated` DESC;";*/
	
    //echobr($sqList);
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&", 0, 180);
}





elseif($dir == 'gallery')
{	  
	 $sqList = "SELECT
    `".$pdb_prefix."dt_gallery_photos`.`id`
    , `".$pdb_prefix."dt_gallery_photos`.`date_modify` AS `date`
    , `".$pdb_prefix."dt_gallery_photos`.`title`
	, CASE WHEN `".$pdb_prefix."dt_gallery_photos_parent`.`id_link` > 0 THEN CONCAT('[MENU] ',`".$pdb_prefix."dt_menu`.`title`)
	       WHEN `".$pdb_prefix."dt_gallery_photos_parent`.`id_content` > 0 THEN CONCAT('[CONT] ',`".$pdb_prefix."dt_content`.`title`)
		   ELSE NULL END AS `parent item`
	, `".$pdb_prefix."dt_gallery_category`.`gall_path`	   
	, `".$pdb_prefix."dt_gallery_photos`.`filename` 
    , CASE WHEN `".$pdb_prefix."dt_gallery_photos`.`filetype` = 'p' THEN CONCAT(`".$pdb_prefix."dt_gallery_category`.`title`,' (pic)')
		   ELSE CONCAT(`".$pdb_prefix."dt_gallery_category`.`title`,' (vid)')  END AS `category`
    , `".$pdb_prefix."dt_gallery_photos`.`published` AS `active`
	
FROM
    `".$pdb_prefix."dt_gallery_photos`
    LEFT JOIN `".$pdb_prefix."dt_gallery_photos_parent` 
        ON (`".$pdb_prefix."dt_gallery_photos`.`id` = `".$pdb_prefix."dt_gallery_photos_parent`.`id_photo`)
    LEFT JOIN `".$pdb_prefix."dt_gallery_category` 
        ON (`".$pdb_prefix."dt_gallery_photos`.`id_gallery_cat` = `".$pdb_prefix."dt_gallery_category`.`id`)
    LEFT JOIN `".$pdb_prefix."dt_content` 
        ON (`".$pdb_prefix."dt_gallery_photos_parent`.`id_content` = `".$pdb_prefix."dt_content`.`id`)
    LEFT JOIN `".$pdb_prefix."dt_menu` 
        ON (`".$pdb_prefix."dt_menu`.`id` = `".$pdb_prefix."dt_gallery_photos_parent`.`id_link`)
ORDER BY `date` DESC; "; 
	//echo $sqList;
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}




elseif($dir == 'contacts directory')
{
$sqList = "SELECT
    `".$pdb_prefix."reg_account`.`account_id` as `id`
	, concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `contact`
    , `".$pdb_prefix."reg_cats`.`title` AS `category`
    , `".$pdb_prefix."reg_account`.`email`
    , `".$pdb_prefix."reg_account`.`phone`
    , `".$pdb_prefix."reg_account`.`date_record` AS `date`
    , `".$pdb_prefix."reg_account`.`country`
    , `".$pdb_prefix."reg_account`.`published` AS `active`
FROM
    `".$pdb_prefix."reg_account`
    LEFT JOIN `".$pdb_prefix."reg_cats_links` 
        ON (`".$pdb_prefix."reg_account`.`account_id` = `".$pdb_prefix."reg_cats_links`.`account_id`)
    LEFT JOIN `".$pdb_prefix."reg_cats` 
        ON (`".$pdb_prefix."reg_cats_links`.`id_category` = `".$pdb_prefix."reg_cats`.`id_category`)
ORDER BY `date` DESC;";
	
	echo $m2_data->getData($sqList,"hforms.php?d=$dir&");

}



elseif($dir == 'registered accounts' or $dir == 'members')
{
	/*
    , DATE_FORMAT(`".$pdb_prefix."reg_account`.`date_created`, '%b%e%Y') AS `ev_date`
    , `".$pdb_prefix."reg_account`.`country`
    */
	$sqList = "SELECT
    `".$pdb_prefix."reg_account`.`account_id` as `id`
	, `".$pdb_prefix."reg_account`.`date_record` AS `date`	
	, concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `name`
    , `".$pdb_prefix."reg_account`.`email` as `email address`
    , `".$pdb_prefix."reg_account`.`phone`    
    
	, `".$pdb_prefix."reg_groups`.`group_title` as `user type`
	, `".$pdb_prefix."reg_organizations`.`organization`
	, `".$pdb_prefix."reg_account`.`uservalid` AS `approved`
    , `".$pdb_prefix."reg_account`.`published` AS `active`
FROM
    `".$pdb_prefix."reg_account`
    LEFT JOIN `".$pdb_prefix."reg_cats_links` ON (`".$pdb_prefix."reg_account`.`account_id` = `".$pdb_prefix."reg_cats_links`.`account_id`)
	LEFT JOIN `".$pdb_prefix."reg_organizations`   ON (`".$pdb_prefix."reg_account`.`organization_id` = `".$pdb_prefix."reg_organizations`.`organization_id`)
	LEFT JOIN `".$pdb_prefix."reg_groups` ON (`".$pdb_prefix."reg_account`.`role_id` = `".$pdb_prefix."reg_groups`.`group_id`) 
	GROUP BY `".$pdb_prefix."reg_account`.`account_id`		
ORDER BY `".$pdb_prefix."reg_account`.`date_record` DESC;"; //WHERE (`".$pdb_prefix."reg_cats_links`.`id_category` =2)
	//echobr($sqList); exit;
	echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}



elseif($dir == 'organizations')
{	  
	 $sqList = "SELECT
    `".$pdb_prefix."reg_organizations`.`organization_id` as `id`
	, `".$pdb_prefix."reg_organizations`.`date_update` as `dated`
    , `".$pdb_prefix."reg_organizations`.`organization` as `title`
    , `".$pdb_prefix."reg_organizations`.`organization_website` as `website`
	, `".$pdb_prefix."reg_organizations`.`organization_phone` as `phone`
	, `".$pdb_prefix."reg_organizations`.`organization_email` as `org_email`
    , concat_ws(' ', `".$pdb_prefix."reg_account`.`namefirst` , `".$pdb_prefix."reg_account`.`namelast`) as `contact`    
    , `".$pdb_prefix."reg_organizations`.`is_partner` as `partner`
    , `".$pdb_prefix."reg_organizations`.`published` as `active`
FROM
    `".$pdb_prefix."reg_organizations`
    LEFT JOIN `".$pdb_prefix."reg_account` ON (`".$pdb_prefix."reg_organizations`.`contact_id` = `".$pdb_prefix."reg_account`.`account_id`)
ORDER BY `".$pdb_prefix."reg_organizations`.`organization_id` DESC;";
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}




elseif($dir == 'feedback posts')
{	  
	 $sqList = " SELECT `id`,DATE_FORMAT(`date_record` ,'%b %d, %Y') as `date posted`, `name` as `sender`, `email`, `phone`, `subject`
   FROM  `".$pdb_prefix."dt_feedback` order by `date_record` desc"; 
	 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}



elseif($dir == 'user_logs')
{	  
	 /*$sqList = "SELECT `".$pdb_prefix."sys_logs`.`log_id`, `".$pdb_prefix."sys_logs`.`log_date`, `".$pdb_prefix."sys_logs`.`log_type`, `".$pdb_prefix."sys_logs`.`log_action`, `".$pdb_prefix."sys_logs`.`log_item_id`, `".$pdb_prefix."sys_logs`.`log_details`, `".$pdb_prefix."sys_logs`.`log_by`, concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `user name`, `".$pdb_prefix."reg_organizations`.`organization` FROM `".$pdb_prefix."sys_logs` LEFT JOIN `".$pdb_prefix."reg_account` ON (`".$pdb_prefix."sys_logs`.`log_by` = `".$pdb_prefix."reg_account`.`account_id`) LEFT JOIN `".$pdb_prefix."reg_organizations`  ON (`".$pdb_prefix."reg_account`.`organization_id` = `".$pdb_prefix."reg_organizations`.`organization_id`) WHERE (`".$pdb_prefix."sys_logs`.`log_action` <> 'log_in') ORDER BY `".$pdb_prefix."sys_logs`.`log_id` DESC;"; */
    
    
	   $sqList = "SELECT `".$pdb_prefix."sys_logs`.`log_id` as `id`, `".$pdb_prefix."sys_logs`.`log_date`, `".$pdb_prefix."sys_logs`.`log_type`, `".$pdb_prefix."sys_logs`.`log_action`, `".$pdb_prefix."sys_logs`.`log_item_id`, `".$pdb_prefix."sys_logs`.`log_details`, `".$pdb_prefix."sys_logs`.`log_by` FROM `".$pdb_prefix."sys_logs` WHERE (`".$pdb_prefix."sys_logs`.`log_action` <> 'log_in') ORDER BY `".$pdb_prefix."sys_logs`.`log_date` DESC;"; 
	  
	  
		 echo $m2_data->getData($sqList,"#", $adm_dispFront);
}




/* ADMINS */ 

elseif($dir == 'admins')
{	  
    
    //echo $btn_add_new;
    
	  $sqList = "SELECT 
      `".$pdb_prefix."admin_accounts`.`admin_id` AS `id`, `".$pdb_prefix."admin_accounts`.`admin_fname` AS `name`, `".$pdb_prefix."admin_types`.`title` AS `type`, `".$pdb_prefix."admin_accounts`.`admin_email` AS `email`,  `".$pdb_prefix."admin_accounts`.`published` AS `active`
   FROM 
      (`".$pdb_prefix."admin_accounts` INNER JOIN `".$pdb_prefix."admin_types` ON `".$pdb_prefix."admin_accounts`.`admintype_id`=`".$pdb_prefix."admin_types`.`admintype_id`) where `".$pdb_prefix."admin_accounts`.`admin_id` <> 1 "; 
		
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&", $adm_dispFront);
}


/* COMMITTEES */ 

elseif($dir == 'committee')
{	  
	 $sqList = "SELECT
    `mrfc_app_committee`.`committee_id`  as `id`
    , `mrfc_app_committee`.`title`
    , `mrfc_app_committee`.`description`
    , COUNT(`mrfc_app_committee_members`.`record_id`) AS `members`
    , `mrfc_app_committee`.`published` AS `active`
FROM
    `mrfc_app_committee_members`
    RIGHT JOIN `mrfc_app_committee` 
        ON (`mrfc_app_committee_members`.`committee_id` = `mrfc_app_committee`.`committee_id`)
WHERE (`mrfc_app_committee_members`.`status_id` =1)  OR ISNULL(`mrfc_app_committee_members`.`status_id`)
GROUP BY `mrfc_app_committee`.`committee_id`;"; 
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}

/* CONTRIBUTIONS */ 

elseif($dir == 'contributions')
{	  
	 $sqList = "SELECT
    `mrfc_dat_contributions`.`contrib_id` AS `id`
    , `mrfc_dat_contributions`.`contrib_date` AS `date_posted`
    , concat_ws(' ',`mrfc_reg_account`.`namefirst`, `mrfc_reg_account`.`namelast`) as `posted_by`
    , `mrfc_dat_contributions`.`post_title` AS `title`
    , `mrfc_dat_contributions`.`post_type`
    , `mrfc_reg_county`.`county`
    , `mrfc_dat_contributions`.`post_resources_num` AS `items`
    , `mrfc_dat_contributions`.`post_comments` AS `comments`
    , `mrfc_dat_contributions`.`approved`
FROM
    `mrfc_dat_contributions`
    INNER JOIN `mrfc_reg_account` 
        ON (`mrfc_dat_contributions`.`poster_id` = `mrfc_reg_account`.`account_id`)
    INNER JOIN `mrfc_reg_county` 
        ON (`mrfc_dat_contributions`.`post_county` = `mrfc_reg_county`.`county_id`)
ORDER BY `date_posted` DESC, `mrfc_dat_contributions`.`approved` ASC;"; 
	  
	  
		 echo $m2_data->getData($sqList,"hforms.php?d=$dir&");
}



?>
