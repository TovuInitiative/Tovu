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
						<img src="../assets/image/avatars/avatar_generic.png" alt="" /> <?php echo @$sys_us_admin['adminname']; ?> <span style="font-size:12px; font-weight:normal; color:#C4CCDF">(<?php echo $sys_us_admin['actype']; ?>)</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu dropdown-menu-usermenu pull-right">							
						<li><a href="javascript:;" data-toggle="modal" data-target="#logout_mdl"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
						<!--<li><a href="#logout_mdl" rel="modal:open"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>-->
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
		<div class="breadcrumb-wrapper"> <!--{breadcrumbs}--> </div>
	</div>
	<!-- content-title - END -->		
	
				
	<!-- PageContent -->			
	<div class="contentpanel ">
		<!--{content}-->
		
		<?php
		//displayArray($_SESSION['sess_mrfc_admin']);
		//echobr(time() - (60*60*24*14));
		include("includes/adm_lists.php"); ?>

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
