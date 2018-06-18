<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); ?>
<?php include("zscript_meta.php"); ?>

<body>
<?php include("includes/wrap_head.php"); ?>


<?php
 //echo '<div class="clearfix padd20_l">'.REF_ACTIVE_URL.' => '.$my_redirect .' id: '.$com_active .' sec: '.$comMenuSection.' type:'.$comMenuType.' seo:'.$seo_name.'</div>';
	
	//displayArray($_SESSION['sess_mrfc_member']);
?>

<div class="page_width">

<div class="containerX">
	
	
<?php
if(isset($_SESSION['sess_mrfc_member'])) {
	//include("includes/wrap_nav_profile.php");
} 
	
 ?>
	
	
	
	
	

<div class="subcolumns clearfix">

	<div class="col-md-2">
		<div class="padd20_t"></div>
		<!--<ul class="nav_side">
			
			<?php
			/*$nav_Sitemap = $dispData->buildMenu_Main($com_active, 4, 0, '');
			echo $nav_Sitemap;*/
			?>
	
		</ul>-->
		
		<?php //echo $dispData->build_navColumnsFoot($com_active);  ?>
	</div>
	
	
	
	<div class="col-md-10">
		<div class="padd15_r padd15_l padd20_t" style="min-height:300px;">
		
			<div id="wrapper" class="row">
			<?php 
			//echobr($ptab);
			switch($ptab)
			{ 
				case "profile":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_view.php"); 
					break;
					
					
				case "profile_edit":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_edit.php");
					break;	
					
					
				
				default:
					//echo display_PageTitle($my_page_head . '', '');
					include("includes/inc.cont.main.php"); 
			}
			
			?>
			</div>
			
		</div>
	</div>
	
	
	
</div>
</div>


</div>

<div class="subcolumns clearfix">
&nbsp;
</div>


<?php include("includes/wrap_foot.php"); ?>
<?php include("zscript_vary.php"); ?>

</body>
</html>
