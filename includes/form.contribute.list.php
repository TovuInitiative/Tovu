<?php
echo display_PageTitle('My Contributions', '');

$sqList = "SELECT
    `mrfc_dat_contributions`.`contrib_id`
    , `mrfc_dat_contributions`.`contrib_date` AS `date_posted`
    , `mrfc_dat_contributions`.`post_title` AS `title`
    , `mrfc_dat_contributions`.`post_type` AS `post_type`
    
    
    , `mrfc_dat_contributions`.`post_resources_num` AS `items`
    , `mrfc_dat_contributions`.`post_comments` AS `comments`
    , `mrfc_dat_contributions`.`approved`
FROM
    `db_oi_maarifacentre_sj`.`mrfc_dat_contributions`
    LEFT JOIN `db_oi_maarifacentre_sj`.`mrfc_reg_county` 
        ON (`mrfc_dat_contributions`.`post_county` = `mrfc_reg_county`.`county_id`)
WHERE (`mrfc_dat_contributions`.`poster_id` = ".q_si($us_id).") ORDER BY `date_posted` DESC; ";
/*
, `mrfc_dat_contributions`.`post_description` AS `description`
, `mrfc_reg_county`.`county`
*/

	//echobr($sqList); exit;
	echo $m2_data->getData($sqList,"#", 1);
?>