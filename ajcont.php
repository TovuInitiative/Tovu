<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); require('assets/ajaxrating/ratingdraw.php'); ?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET['tab']) and is_numeric($_GET['tab'])) { $tab = $_GET['tab'];} else { $tab=1; }
$cty_sec = (isset($request['cty_sec'])) ? $request['cty_sec'] : 'stories';

//echobr($cty_sec);

    $tab_title['stories']   = 'Good Practices & Innovations';
    $tab_title['indicators']   = 'General Indicators';
    $tab_title['budgets']   = 'Budget Data';
    $tab_title['factsheets']   = 'County Factsheets';
    $tab_title['about']     = 'About';
    $tab_title['news']      = 'News and Events';    
    $tab_title['resources'] = 'Resources';
    
    /*$tab_title['projects']  = 'Projects';
    $tab_title['members']   = 'Members';*/
   
    
    $cont_county_id = (array_key_exists('fcty', $request)) ? $request['fcty'] : '';    
    $cont_sector_id = (array_key_exists('fsec', $request)) ? $request['fsec'] : '';
    
?>


<div id="content" class="padd15_t">  
<?php 


/* ========================================== */
/* @@ ABOUT */
if($cty_sec == 'about'){
    ?>
    <div class="subcolumns">
		<?php //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>', '', 'nobold' );  ?>
			
			<div style="text-align: justify;"><?php echo $county_detail['description']; ?></div>
			
		</div>
    <?php
}
/* ------------------------------------------ */


/* ========================================== */
/* @@ NEWS */
if($cty_sec == 'news' or $cty_sec == 'stories'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>' ); 
            //$data_arr = $dispDt->get_countyTabContent($cty_id, $cont_sector_id, $cty_sec);
            $sq_crit = "";
    
            if($cty_sec == 'news') { $sq_crit = " AND `mrfc_dt_content`.`id_section` IN (2,6) "; }
            if($cty_sec == 'stories') { $sq_crit = " AND `mrfc_dt_content`.`id_section` = 1 "; }
        
    
            if($cont_county_id <> ''){
                $sq_crit_cty = "";
                if($cont_county_id == 48 and $cty_sec == 'stories'){
                    $sq_crit_cty = " and `mrfc_dt_content_parent`.`county_id` <> '0'  ";
                }
                if($cont_county_id <> 48){
                    $sq_crit_cty = " and `mrfc_dt_content_parent`.`county_id` = ".q_si($cont_county_id)." ";
                }
                $sq_cty = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE `mrfc_dt_content`.`published` =1 ".$sq_crit_cty." ".$sq_crit." ;";
                //echobr($sq_cty);
                $rs_cty = $cndb->dbQueryFetch($sq_cty, 'id_content');
            }

            if($cont_sector_id <> ''){
                $cont_sector_id_arr = explode(',', $cont_sector_id);
                //$sq_crit = " and `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$cont_sector_id_arr).") ";
                
                $sq_sec = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE `mrfc_dt_content`.`published` =1 and `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$cont_sector_id_arr).") ".$sq_crit." ;";
                $rs_sec = $cndb->dbQueryFetch($sq_sec, 'id_content');
            }
    
            //echobr($sq_cty);
            //echobr($sq_sec);
    
            if($cont_county_id <> '' and $cont_sector_id <> ''){ //echobr('0');
                $data_arrx = array_intersect_key($rs_cty, $rs_sec );
            }
    
            if($cont_county_id <> '' and $cont_sector_id == ''){ //echobr('a');
                $data_arrx = $rs_cty;
            }
    
            if($cont_county_id == '' and $cont_sector_id <> ''){ //echobr('b');
                $data_arrx = $rs_sec;
            }
            
            $data_arr = array_keys($data_arrx);
            /* $sq_qryx = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE `mrfc_dt_content`.`published` =1 ". $sq_crit ." ;";
            
            echobr($sq_qryx);
        
            $rs_qryx = $cndb->dbQueryFetch($sq_qryx, 'id_content');*/
    //displayArray($rs_cty);
    //displayArray($rs_sec);
            //displayArray($data_arr);
    
             /*$sq_sec = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`county_id` IN (".implode(',',$cty_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` = 1);";*/
    
            
            if(count($data_arr) > 0)
            {  include("includes/county/county.content.list.php"); } else
            {  echo display_noContent(); }
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    
    
    

/* ========================================== */
/* @@ RESOURCES */
if($cty_sec == 'resources'){
    ?>
    <div class="subcolumns">
		<?php 
    
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>' ); 
            $data_arr = $dispDt->get_countyTabContent($cty_id, $cont_sector_id, $cty_sec);
            //displayArray($data_arr);
            if(count($data_arr) > 0)
            {  include("includes/county/county.resources.list.php"); } else
            {  echo display_noContent(); }
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    
    
    
    
    

/* ========================================== */
/* @@ COUNTY INDICATORS */
if($cty_sec == 'indicators'){
    ?>
    <div class="subcolumns">
		<?php 
            echo display_PageTitle($county_detail['title'] .': <span class="txtgraylight">Sectoral Indicators </span>' ); 
        ?>
        <iframe src="<?php echo DOMAIN_OPENCOUNTY; ?>mrc_indicators.php?cid=<?php echo $cty_id; ?>" style="width:100%; height:2700px;" scrolling="yes"></iframe>
			
		</div>
    <?php
}
/* ------------------------------------------ */   
    
    
    

/* ========================================== */
/* @@ COUNTY BUDGETS */
if($cty_sec == 'budgets'){
    ?>
    <div class="subcolumns">
		<?php 
            echo display_PageTitle($county_detail['title'] .': <span class="txtgraylight">Budget Data </span>' ); 
        ?>
        <iframe src="<?php echo DOMAIN_OPENCOUNTY; ?>mrc_budgets.php?cid=<?php echo $cty_id; ?>" style="width:100%; height:2300px;" scrolling="yes"></iframe>
			
		</div>
    <?php
}
/* ------------------------------------------ */   
    
    
    

/* ========================================== */
/* @@ COUNTY FACTSHEETS */
if($cty_sec == 'factsheets'){
    ?>
    <div class="subcolumns">
		<?php 
            echo display_PageTitle($county_detail['title'] .': <span class="txtgraylight">Factsheet </span>' ); 
        ?>
        <iframe src="<?php echo DOMAIN_OPENCOUNTY; ?>factsheet.php?cid=<?php echo $cty_id; ?>" style="width:100%; height:2700px;" scrolling="yes"></iframe>
			
		</div>
    <?php
}
/* ------------------------------------------ */      
    
    
    

    
    
/* ========================================== */
/* @@ MEMBERS */
if($cty_sec == 'members'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>' ); 
            $data_arr = $dispDt->get_commiteeMembers('members', '', $cty_id);
            //displayArray($data_arr);
    
            include("includes/committee/inc.cont.profile.list.php");
        ?>
			
		</div>
    <?php
}
/* ------------------------------------------ */    


?>  	

</div>

<link rel="stylesheet" type="text/css" href="assets/ajaxrating/js/ajaxrating.css" />  
<script type="text/javascript" src="assets/ajaxrating/js/ajaxrating.js"></script>
</body>
</html>


