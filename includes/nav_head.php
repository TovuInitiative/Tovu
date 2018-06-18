<style type="text/css">
.goog-te-gadget-simple { background: none !important; border: none;}
.goog-te-gadget-icon { display: none !important;}
</style>
<div id="nav_head_right" class="subcolumns clearfix showall padd10_r" >
<!--sf-menu sf-small sf-menu-right sf-arrows-->
<ul class="sf-menu nav navbar-nav navbar-right" style="height:;">


<?php if($GLOBALS['SOCIAL_CONNECT'] == true) { ?> 
<li>
<div id="google_translate_element" style="height:25px !important;"></div>
<script type="text/javascript">
</script>
</li>

<?php
}

    $nav_header = $dispData->buildMenu_Main($com_active, 6, 0, 'nav_top'); 
    echo $nav_header; 
?>
<!--<li class="button-search"><a id="slide-search" title="Search"><i class="fa fa-search txt17"></i></a></li>-->

<?php
if(!isset($_SESSION['sess_mrfc_member'])) {	
?>
<!--<li class=""><a data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.register.php?rel=modal"; ?>" id="header-signup" title="Sign In / Sign Up" rel="modal:open"> Sign Up</a></li>-->
<li class=""><a data-href="<?php echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.login.php?rel=modal"; ?>" id="header-login" title="Sign In / Sign Up" rel="modal:open">Sign In</a></li>
	
<?php } else { 
	
	?>
		
		<li class="dropdown profile_details_drop">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<div class="profile_img">	
						<span class="prfil-img"><img src="assets/image/avatars/<?php echo $sess_mbr['u_avatar']; ?>" alt=""> </span> 
						<div class="user-name"><?php echo $us_fname; ?> <span>(<?php echo $sess_mbr['u_type']; ?>) </span>&nbsp;</div>
					</div>	
				</a>
				<ul class="dropdown-menu drp-mnu">
					<?php echo conf_usAccLinks(1); ?>
				</ul>
			</li>
<?php
}
?>


</ul>
</div>
<script type="text/javascript">
var menu_header = '<?php echo str_replace("'","",$nav_header) ; ?>';
</script>

