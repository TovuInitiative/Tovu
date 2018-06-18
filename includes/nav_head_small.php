


<?php if($GLOBALS['SOCIAL_CONNECT'] == true) { ?> 
<li>
<div id="google_translate_elementb" style="height:25px !important;"></div>
</li>

<?php
}

//$nav_head_side = $dispData->buildMenu_Main($com_active, 6, 0, 'nav_top');
//echo $nav_head_side;
?>

<?php
if(!isset($_SESSION['sess_mrfc_member'])) {	
?>
<li class="">
	<a data-href="ajforms.php?d=account" id="header-loginc" title="Sign In / Sign Up" rel="modal:open"><i class="fa fa-user"></i>&nbsp; Sign In / Sign Up</a>
</li>

	
<?php } else { ?>
	
		<li class="nav_acc"> <?php echo $us_acc_current; ?>
			<ul>
			<?php echo conf_usAccLinks(1); ?>
			<li class="divider"></li>
			<li><?php echo $us_acc_logout; ?> </li>
			</ul>		
		</li>
<?php
}
?>
