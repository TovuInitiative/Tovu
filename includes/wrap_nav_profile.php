

<div class="rowX">
	<!-- @@ Menu Bar -->
	<nav class="navbar navbar-default">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<!--<a href="#" class="navbar-brand"><span class="glyphicon glyphicon-home"></span></a>-->
	</div>
	<!-- Collection of nav links and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse">
		<div class="col-md-2">
			<img src="<?php echo SITE_LOGO; ?>" alt="<?php echo SITE_TITLE_LONG; ?>" id="logo-img" style="height:48px;">
		</div>
		<?php //include($GLOBALS['MODULAR_CONTENT_PATH'] . "php/menu_main.php"); ?>

		<!--<form class="navbar-form navbar-left">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
		</form>-->

		<?php //include($GLOBALS['MODULAR_CONTENT_PATH'] . "php/menu_head.php"); ?>	

		<!--sf-menu sf-small sf-menu-right sf-arrows-->
		<ul class="nav navbar-nav navbar-right "> 
			<?php 
				$nav_profile = $dispData->buildMenu_Main($com_active, 1, 0, 'nav_top', 1, 2); 
				echo $nav_profile;
			?>
			<li id="m2" class=" sf-withX-ul dropdown"><a  href="portal.php"   class=" dropdown-toggle  linkMenu "  data-id="2">About KM Champions</a>
				<ul id="" class=" dropdown-menu ">
				<li id="m6" class=""><a  href="faq/"   class=" linkMenu "  data-id="6">FAQ</a></li>
				</ul>
			</li>

			<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<div class="profile_img">	
						<span class="prfil-img"><img src="assets/image/avatars/avatar_generic.png" alt=""> </span> 
						<div class="user-name">
							<p><?php echo $us_fname; ?> <span>(<?php echo $sess_mbr['u_type']; ?>) </span>&nbsp;</p>								
						</div>
						<div class="clearfix"></div>	
					</div>	
				</a>
				<ul class="dropdown-menu drp-mnu">
					<?php echo conf_usAccLinks(1); ?>
					<?php //echo conf_usAccLinks(2); ?>
					<!--<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>
					<li> <a href="#"><i class="fa fa-sign-out"></i> Logout</a> </li>--> 
				</ul>
			</li>
		</ul>
	</div>
</nav>

</div>