

<div class="">
<?php //include("includes/nav_crumbs.php"); ?>
</div>


<div class="page_width">
<div class="padd15_0X">



<div class="containerX">	
	
<?php
if(isset($_SESSION['sess_mrfc_member'])) {
	//include("includes/wrap_nav_profile.php");
} 
	
 ?>
 <?php include("includes/nav_crumbs.php"); ?>

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
					//include("includes/inc.cont.main.php"); 
					include("includes/inc.portal.dash.php");
			}
			
			?>
			</div>
			
		</div>
	</div>
	
	
	
</div>
</div>

</div>
</div>







