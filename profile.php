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
if(empty($_SESSION['sess_mrfc_member'])) {
    echo '<p>&nbsp;</p><div class="warning txtcenter"><h2>You are not logged in.</h2></div>';
	include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.login.php");
} else { ?>
	
	
	
	
	

<?php if($GLOBALS['MODULAR_ACCOUNTS'] == true  && isset($_SESSION['sess_mrfc_member'])) { /* ?>
	
	
	<div class="row"><h3>Account Register</h3></div>
	<div class="row">
		<?php include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.register.php"); ?>		
	</div>
	
	<div class="row"><h3>Account Login</h3></div>
	<div class="row">
		<?php include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.login.php"); ?>		
	</div>
	
	
	
	
	<div class="row"><h3>Account profile View</h3></div>
	<div class="row">
		<?php include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_view.php"); ?>		
	</div>
	
	<div class="row"><h3>Account profile Edit</h3></div>
	<div class="row">
		<?php include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_edit.php"); ?>		
	</div>
	
	
	<div class="row"><h3>Account profile Avatar</h3></div>
	<div class="row">
		<?php include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_edit_avatar.php"); ?>		
	</div>
	

<?php */ } ?>
	
</div>



<div class="subcolumns clearfix">

	<div class="col-md-2">
		<div class="padd20_t"></div>
		<ul class="nav_side">
			<?php 
			if($ptab <> 'dashboard'){
			echo conf_usAccLinks(2); } ?>
		</ul>
	</div>
	
	
	
	<div class="col-md-10">
		<div class="padd15_r padd15_l padd20_t" style="min-height:300px;">
		
			<div id="wrapper" class="row">
			<?php 
			//echobr($ptab);
			switch($ptab)
			{ 
				/*case "dashboard":
					include("includes/form.stats.php"); 
					break;*/
				
                case "dashboard":    
				case "profile":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_view.php"); 
					break;
					
					
				case "profile_edit":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/profile_edit.php");
					break;	
					
					
				case "resources":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/mem_resources.php");
					break;
					
					
				case "resources_edit":
					include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/mem_resources_form.php");
					break;
                    
                    
                case "contributions":
					include("includes/form.contribute.list.php");
					break;    
                    
					
				/*case "events.php":
					include("includes/inc.events-main.php");
					break;*/
					
				case "dashboard":
					include("includes/inc.portal.dash.php");
					
					break;
			
				case "sitemap.php":
					include("includes/nav_sitemap.php");
					break;
					
				case "contact.php":
					include("includes/inc.cont.main.php");
					include("includes/form.feedback.php");
					break;
				
				case "profiles.php":
					include("includes/inc.cont.profile.list.php");
					break;	
				
				case "register.php":
					include("includes/form.conference.register.php");
					break;
					
				case "projects.php":
					if($pj == ''){ include("includes/inc.project.list.php"); }
					else { include("includes/inc.project.detail.php");  }
					break;	
				
				
				case "places.php":
					//include("includes/inc.cont.places.list.php");
					echo '<div id="places_container" data-menu="'.$com_active.'" data-page="0"><div class="infinite-loading"></div></div>';
					break;
						
						
				default:
					//echo display_PageTitle($my_page_head . '', '');
					include("includes/inc.cont.main.php"); 
			}
			
				/*if($my_redirect <> 'sitemap.php') 
				{
					include("includes/nav_gut_tabs.php"); 
					
					include("includes/inc.cont.main.php"); 
					
					if($my_redirect == 'contact.php') 
					{ include("includes/form.feedback.php"); } 
				}
				elseif($my_redirect == 'sitemap.php') 
				{ include("includes/nav_sitemap.php"); } */
			?>
			</div>
			
		</div>
	</div>
	
	
	
</div>


<?php  } ?>
</div>

<div class="subcolumns clearfix">
&nbsp;
</div>


<?php include("includes/wrap_foot.php"); ?>
<?php include("zscript_vary.php"); ?>

</body>
</html>
