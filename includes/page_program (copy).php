

<div>
<?php include("includes/nav_crumbs.php"); ?>
</div>


<div class="page_width">
<div class="padd15_0">
<div class="subcolumns clearfix" style="overflow:visible;">

	<div class="col-md-1">
		<div class="padd20_t"></div>
		<?php 
		/*if($my_redirect == 'library.php') 
		{ 
			echo '<div class="padd20_t">';
			include("includes/nav_downloads-search_small.php");
			echo '</div>';
		}
		
			echo '<div class="padd20_t">';
			include("includes/nav_downloads-latest.php");
			echo '</div>';*/
		?>
	</div>
	
	<div class="col-md-10">
		<div class="padd15_r padd15_l" style="min-height:300px;">
		
			<div id="wrapper" class="">
			<?php 
			//echobr($my_redirect);
			switch($my_redirect)
			{ 
				case "gallery.php":
					include("includes/inc.gallery.main.php");
					break;
					
				case "library.php":
					include("includes/nav_downloads-main.php");
					break;
					
				/*case "events.php":
					include("includes/inc.events-main.php");
					break;*/
					
				case "contacc.php":
					include("includes/inc.cont.accordion.php");
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
				
				case "program.php":
					include("includes/inc.cont.program.list.php");
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
	
	<div class="col-md-1">
		<div class="padd15_l padd5_t">
				
		<?php //echo display_PageTitle('Right Bar', 'h3'); ?>
		
		<?php //include("includes/nav_articles_side.php"); ?>
		
		<?php //include("includes/nav_downloads-popular.php"); ?>
		
		<?php //include("includes/nav_quicklinks.php"); ?>
		
		<?php //include("includes/nav_social_feeds_tabs.php"); ?>			
			
		</div>		
	</div>
	
</div>
</div>
</div>







