<br /><h4>Your User Details</h4> 

<div>
<?php

	$sqdata = "SELECT * FROM `".$pdb_prefix."reg_account` WHERE (`account_id` = ".q_si($us_id)."); ";
	
	$rsdata = $cndb->dbQueryFetch($sqdata);
	$fData  = current($rsdata);
	//displayArray($fData);	
	$newsletter = yesNoChecked(@$fData['newsletter']);
?>
<form  name="fm_profile"  id="fm_profile" class="fm_base" action="<?php echo $GLOBALS['MODULAR_ACCOUNTS_POST']; ?>" method="post" >
<div class="errorBox">Highlighted fields are required!</div>



<div class="form-group">
	<label for="ac_namefirst" class="col-md-3">Full Name</label>
	<div class="col-md-9">
		<INPUT TYPE="text"  id="namefirst" NAME="namefirst"  class="required form-control col-md-6" maxlength="50" placeholder="First Name" value="<?php echo @$fData['namefirst']; ?>"  />
		<INPUT TYPE="text"  id="namelast" NAME="namelast"  class="required form-control col-md-6" maxlength="100" placeholder="Last Name" value="<?php echo @$fData['namelast']; ?>"  /> 
	</div>
</div>


<div class="form-group">
	<label for="ac_email" class="col-md-3">Email</label>
	<div class="col-md-9">
		<input type="email" class="form-control required" name="email" id="email" disabled="disabled" readonly="readonly"  maxlength="50" value="<?php echo @$fData['email']; ?>" placeholder="Your Email" />
	</div>
</div>	


<div class="form-group">
	<label for="phone" class="col-md-3">Mobile</label>
	<div class="col-md-9">
		<input type="text" class="form-control required" name="phone" id="phone"  maxlength="100" placeholder="Mobile Number"  value="<?php echo @$fData['phone']; ?>" />
	</div>
</div>	


<div class="form-group">
	<label for="organization" class="col-md-3">Organization</label>
	<div class="col-md-9">
		<input type="text" class="form-control required" name="organization" id="organization"  maxlength="50" placeholder="Organization Name" />
	</div>
</div>	

<div class="form-group">
	<label for="" class="col-md-3">&nbsp;</label>
	<div class="col-md-9">
	<div class="form-check">
      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="newsletter" <?php echo $newsletter; ?> id="newsletter" />  Subscribe for Updates
      </label>
    </div>
    </div>
</div>	


<div class="form-group">
	<label for="" class="col-md-3">Select Preferences</label>
	<div class="col-md-9 nopadd">
     <?php echo $ddSelect->checks("mrfc_forum_categories", "cat_id", "cat_name", "") ?>
    </div>
</div>	


<div class="form-group">
	<label class="col-md-3">&nbsp;</label>
	<div class="col-md-9">
		<div class="col-md-4 nopadd">
			<button type="input" name="submit" id="submitProfile" value="submit" class="btn btn-primary btn-icon col-md-12">Update Profile </button>
		</div>
		<div class="col-md-1 nopadd">
			<input  NAME="formname" type="hidden" value="fm_profile_edit" />
			<input  NAME="nah_snd" id="nah_snd" type="text" />  
			<input name="redirect" type="hidden" value="<?php echo SITE_DOMAIN_LIVE; ?>profile.php?ptab=profile" /> 
		</div>
		<div class="col-md-7 padd10_t txtright"> 
			
		</div>
	</div>
</div>


</form>
</div>

<!--<p>&nbsp;</p>-->
