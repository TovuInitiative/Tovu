<?php
$request = $_REQUEST;
$modal_head = $modal_foot = '';
if(isset($_REQUEST['rel'])){
	require_once("../../../classes/cls.constants.php");	 
	$urequest = array_map("clean_request", $_REQUEST); 
	//displayArray($urequest);
	$modal_head = modHeader('Sign Up');
	$modal_foot = modFooter();
}
echo $modal_head;
?>
	<form  method="post"  action="<?php echo $GLOBALS['MODULAR_ACCOUNTS_POST']; ?>" name="fm_pass" class="rwdformX rwdfull rwdvalid">

	<div class="form-group">
		<label for="currentpass" class="col-md-3">Current Password</label>
		<input type="password" class="form-control required col-md-9" maxlength="12" minlength="6" name="currentpass" id="currentpass" value="" placeholder="Current Password" />
		<!--<span class="help-block">Your Current Account Password.</span>-->
	</div>
	<div class="form-group">
		<label for="password" class="col-md-3">New Password</label>
		<input type="password" class="form-control required col-md-9" maxlength="12" minlength="6" name="password" id="password" value="" placeholder="New Password" />
		<!--<span class="help-block">Type a new Password for your Account.</span>-->
	</div>
	<div class="form-group">
		<label for="password_r" class="col-md-3">Confirm New Password</label>
		<input type="password" class="form-control required col-md-9"  equalto="#password" maxlength="12" minlength="6" name="password_r" id="password_r" value="" placeholder="Repeat New Password"  />
		<!--<span class="help-block">Please type your desired Password again. Passwords MUST Match.</span>-->
	</div>

	<div class="form-group">
		<label class="col-md-3">&nbsp;</label>
		<div class="col-md-9 padd0_l">
		<button type="input" name="submit" value="updatePass" class="btn btn-success btn-icon"><i class="fa fa-check-square-o"></i> Update</button>
		<input name="formname" type="hidden" value="fm_profile_pass" />
		<input name="nah_snd" id="nah_snd" type="text">  
		<input name="redirect" type="hidden" value="<?php echo SITE_DOMAIN_LIVE; ?>profile.php?ptab=profile" />
		</div>
	</div>
</form>


<?php echo $modal_foot; ?>