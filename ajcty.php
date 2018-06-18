<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(isset($_GET['tab']) and is_numeric($_GET['tab'])) { $tab = $_GET['tab'];} else { $tab=1; }
$cty_sec = (isset($request['cty_sec'])) ? $request['cty_sec'] : 'stories';
$sec_id  = (isset($request['fsec'])) ? $request['fsec'] : '';

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
    <script>
    //var pathname = window.location.href.split('#')[0]; //console.log(pathname);
    </script>
		<?php 
    //echbr($cty_sec);
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>' ); 
            $data_arr = $dispDt->get_countyTabContent($cty_id, $sec_id, $cty_sec);
            //displayArray($data_arr);
    
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
            $data_arr = $dispDt->get_countyTabContent($cty_id, $sec_id, $cty_sec);
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
            echo display_PageTitle($county_detail['title'] .': <span class="txtgraylight">Performance Data (Indicators) </span>' ); 
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
    

    
    
/* ========================================== */
/* @@ MAPPING */
if($cty_sec == 'mapping'){
    ?>
    <div class="subcolumns">
		<?php 
            //echo display_PageTitle($committee_detail['title'] .': <span class="txtgraylight">'. $tab_title[$cty_sec] .' </span>' ); 
            //$data_arr = $dispDt->get_commiteeMembers('members', '', $cty_id);
            //displayArray($data_arr);
    
            //include("includes/page_mapping.php");
        ?>
            <div id="wrapper" class="">
			    <div class="row">
			        <div class="col-md-7"><?php echo display_PageTitle('National Projects ', '', ''); ?></div>
			        <div class="col-md-3 pull-right txtright"> </div>
			    </div>
			
			    <iframe src="mapping/index.html" style="width:100%; height:520px;" scrolling="no"></iframe>
			
			</div>
			
		</div>
    <?php
}
/* ------------------------------------------ */    


?>  	

</div>

  
</body>
</html>


