<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); ?>
<?php include("zscript_meta.php"); ?>

<body>
<?php include("includes/wrap_head.php"); ?>


<?php
 //echo '<div class="clearfix padd20_l">'.REF_ACTIVE_URL.' => '.$my_redirect .' id: '.$com_active .' sec: '.$comMenuSection.' type:'.$comMenuType.' seo:'.$seo_name.' page_'.$this_page.'</div>';
    //displayArray($request);
?>
<div class="padd10"></div>
<div class="page_width">
<div class="subcolumns clearfix">

	<div class="col-md-9 bg-white">
	<div class="col_gutsl">
		
		
		<div class="subcolumns">
		<div id="wrapper">
		
		<div style="min-height:400px;">
			<?php include("includes/inc.cont.search.php"); 
			$dir_keywords = ' '; ?>
		</div>
		
		</div>
		</div>				

	</div>
	</div>
	
	
	
	<div class="col-md-3 padd10_t">
		<div class="col_cont">
		<div class="themeFlag">
		<div class="tcol4">
		<?php
		
		//include("includes/inc.cont.box.featured.php");
			//include("includes/inc.events-datebox.php"); 
			//include("includes/inc.downloads-box.php"); 
			//include("includes/nav_social_feeds_tabs.php"); 
		//include("includes/nav_gut_side.php"); 
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
