<?php include("sec_head.php"); ?>
	
		
<section>
<!-- section - STARTS -->



<!-- Left Section -->
<?php include("includes/nav_left.php"); ?>	
<!-- Left Section - ENDS -->		
		
		
		
		
		
		
<!-- mainpanel -->	
<div class="mainpanel ">

	<!-- headerbar -->
	<div class="headerbar ">
		<a class="menutoggle"><i class="fa fa-bars"></i></a>				
		<div class="header-right">
			<ul class="headermenu">
			<li>
				<div class="btn-group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<img src="../assets/image/avatars/avatar_generic.png" alt="" /> <?php echo $sys_us_admin['adminname']; ?> <span style="font-size:12px; font-weight:normal; color:#C4CCDF">(<?php echo $sys_us_admin['actype']; ?>)</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-usermenu pull-right">							
						<li><a href="javascript:;" data-toggle="modal" data-target="#logout_mdl"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					</ul>
				</div>
			</li>
			</ul>
		</div>		
	</div>
	<!-- headerbar - END -->
	
	
	
	<!-- content-title -->
	<div class="pageheader ">
		<h2><i class="fa fa-tachometer"></i> <?php echo clean_title(ucwords($dir)); ?> &raquo; </h2>
		<div class="breadcrumb-wrapper"> <!--{breadcrumbs} --></div>
	</div>
	<!-- content-title - END -->		
	
				
	<!-- PageContent -->			
	<div class="contentpanel ">
		<!--{content}-->
		
		
		
<?php
        $frmNoEdit 	= '';
		/*displayArray($sys_us_admin);*/
        
switch($dir)
{ 
	
	case "menus":
		include("includes/adm_frm_menus.php");
		break;
	
	case "articles":
		include("includes/adm_frm_articles.php");
		break;
	
	case "events":
		include("includes/adm_frm_events_b.php");
		break;
	
	
	// RESOURCES	
	case "resources":
		include("includes/adm_frm_resources.php");
		break;
		
	
	// GALLERIES	
	case "gallery":
		include("includes/adm_frm_gallery.php");
		break;
			
	/*case "image and video uploads":
		include("includes/adm_gallery_pics.php");
		break;
	
	case "video gallery":
		include("includes/adm_gallery_vids.php");
		break;*/
	
	
	case "organizations":
		//include("includes/adm_frm_organizations.php");
		include("includes/adm_organization_page.php");
		break;
	
	case "members":
		include("includes/adm_frm_accounts.php");
		break;
	
		
	case "video gallery":
		include("includes/adm_gallery_vids.php");
		break;
	
    
        /* COMMITTEES */  

        case "committee":
            include("includes/adm_committee_page.php");
            break;    


        /* COP Forums */    
        case "cop-forums":
            ?>		
            <iframe src="../assets/forum/manager.php?fitm=cat&fopt=list" frameborder="0" scrolling="no" id="profiframe" style="width:100%; height:700px; border:none; background:#FFF"></iframe>	
            <?php
            break;    
        
        
        
        
    // ADMINS	
	case "admins":
		include("includes/adm_admins.php");
		break;
        
	
	// COURSES	
	case "courses":
		include("includes/adm_courses_page.php");
		break;
        
        
	
}

//$dirListOne = trim(substr($dir,0,15));


?>



	</div>
	<!-- PageContent - ENDS -->	
			
					
</div>
<!-- mainpanel - ENDS -->	
		



	
<!-- rightpanel - STARTS -->
<div class="rightpanel "></div>
<!-- rightpanel - ENDS -->




<!-- BEGIN BACK TO TOP BUTTON -->
<div id="back-top">
	<a href="#top"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- END BACK TO TOP -->
		
		
		
<!-- section - ENDS -->			
</section>

					
<?php include("sec_foot.php"); ?>					
