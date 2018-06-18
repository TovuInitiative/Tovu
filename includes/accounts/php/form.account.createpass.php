<?php
$showForm = false;
$sqdata = "SELECT `email` FROM `".$pdb_prefix."reg_account` WHERE  (`userauth` = ".quote_smart($request['ac']).")";
$rsdata = $cndb->dbQueryFetch($sqdata); 

if(count($rsdata))
{
	$showForm = true;
	$fData 	  = current($rsdata);
	//displayArray($fData);
	$formaction = "_edit";	
?>
<div class="padd20" style="margin:0 auto; max-width:900px;">
<form  method="post" action="posts.php" name="fm_invite_accept" id="fm_invite_accept" class="rwdfull rwdvalid">
<input name="auth" type="hidden" value="<?php echo $request['ac']; ?>" />

	<div class="form-group">
		<label for="email" class="col-md-3">Account Email</label>
		<input type="email" class="form-control required col-md-9" name="email" id="email" readonly value="<?php echo $fData['email']; ?>" />
	</div>
	
	<div class="form-group">
		<label for="password" class="col-md-3">New Password</label>
		<input type="password" class="form-control required col-md-9" maxlength="20" minlength="8" name="password" id="password" value="" placeholder="New Password" />
	</div>
	
	<div class="form-group">
		<label for="password_r" class="col-md-3">Repeat Password</label>
		<input type="password" class="form-control required col-md-9"  equalto="#password" maxlength="20" minlength="8" name="password_r" id="password_r" value="" placeholder="Repeat New Password"  />
	</div>

	<div><div class="padd5"></div></div>
	
	<div class="form-group">
		<label class="col-md-3">&nbsp;</label>
		<div class="col-md-9 nopadd">
		<div class="radio_group">
		<input type="checkbox" class="radio required" name="ac_agreeterms" id="ac_agreeterms" /> <label for="ac_agreeterms" class="label-checkbox">I agree to the <a href="terms/" class="txtorange bold" target="_blank">Terms of Use</a> </label>
		</div>
		</div>
	</div>
	
	<div><div class="padd5"></div></div>
	
	<div class="form-group">
		<label class="col-md-3">&nbsp;</label>
		<div class="col-md-9 padd0_l">
		<button type="input" name="submit" value="updatePass" class="btn btn-success btn-icon"><i class="fa fa-check-square-o"></i> Setup Account</button>
		<input name="formname" type="hidden" value="fm_invite_accept" />
		<input name="nah_snd" id="nah_snd" type="text">  
		<input name="redirect" type="hidden" value="profile.php?ptab=profile" />
		</div>
	</div>
</form>
</div>
<?php
}
else{
	echo '<div class="warning">Nothing to display here!</div>';
}
?>