<div style="width:auto; min-width:320px; float:rightS">

<div class="panel panel-defaultX" style="background:#f8f8f8; padding: 15px;">

	<div class="panel-heading">
		<h1 class="panel-title"><strong class="txtblack">Reset Account Password</strong></h1>
		<div class="clearfixX"></div>
	</div><?php /*?><?php */?>

	<div class="panel-body padd10_t">
	
<form  method="post" action="posts.php" name="fm_pass" class="rwdform rwdfull rwdvalid">
	
	<!--<div class="form-group">
		<label for="passcurr">Current Password</label>
		<input type="password" class="form-control required" name="passcurr" id="passcurr" value="" placeholder="Current Password" />
	</div>-->
	<div class="form-group">
		<label for="passnew">New Password</label>
		<input type="password" class="form-control required" maxlength="12" minlength="6" name="passnew" id="passnew" value="" placeholder="New Password" />
		<!--<span class="help-block">Type a new Password for your Account.</span>-->
	</div>
	<div class="form-group">
		<label for="passconf">Confirm New Password</label>
		<input type="password" class="form-control required"  equalto="#passnew" maxlength="12" minlength="6" name="passconf" id="passconf" value="" placeholder="Repeat New Password"  />
		<!--<span class="help-block">Please type your desired Password again. Passwords MUST Match.</span>-->
	</div>
	
	<div class="form-group">
		<input name="passauth" id="passauth" value="<?php echo $reg_ac; ?>" type="hidden">
		<button type="input" name="submit" value="updatePass" class="btn btn-success btn-icon"><i class="fa fa-check-square-o"></i> Update</button>
		<input name="formname" type="hidden" value="ac_pwchange" />
		<input name="nah_snd" id="nah_snd" type="text">  
		<input name="redirect" type="hidden" value="index.php?d=login" />
	</div>
</form>
	
	<div id="reg_result"></div>
	
</div>
</div>
</div>


<script language="javascript">

jQuery(document).ready(function($){
	$("#frm_pwchange").validate({ submitHandler: function(form) { $.ajax({ url: 'posts.php',type: form.method, data: $(form).serialize(), beforeSend: function() { $('#frm_pwchange').hide(); $('#reg_result').html('<img src="image/icons/a-loader.gif" alt="loading..."  />'); }, success: function(response) { $('#reg_result').html(response);}  }); } }); 
	
});
</script>
