<div style="width:100%; margin:0 auto; border:0px solid">
	
	<div style="padding:10px;">
	
<?php
$GLOBALS['FORM_JWYSWYG'] = true;
	
$confDir 			= 'Account Details'; //ucwords($dir);

$pgtitle			= "<h2>New $confDir</h2>";
$formname           = "fm_member_account";
$formaction         = "_new";

$fData 		      = array();
$fData 		  = array();
$fData['uservalid'] = 1;	
$fData['published'] = 1;	
$fData['role_id']	= 2;		
		
$cont_option	  	= 'new';
$cont_emailLock		= '';	
$cont_wrap_detail	= ' style = "display:none" ';	
		
//$fData['published'] = 1;

$group[1] = $group[2] = $group[3] = $group[4] = '';	
		
if($op=="edit"){

	if($id){
	
	$sq_item		= "SELECT * FROM `mrfc_reg_account` WHERE  (`account_id`  = ".quote_smart($id).")";	
	$rs_item 		= $cndb->dbQueryFetch($sq_item);	
	$fData 			= current($rs_item);	
	//displayArray($fData);	
		
	$pgtitle ="<h2>Edit $confDir</h2>";
	$formaction			= "_edit";
		
		
		$logoname = ($fData['avatar'] <> '') ? $fData['avatar'] : 'avatar_generic.png'; 
		$logopath = DISP_AVATARS.$logoname;
		$logosrc  = substr($logoname, 0 , 3);	

		/** EXTERNAL IMAGE **/
		if($logosrc == 'htt' or $logosrc == 'www' or $logosrc == 'ftp' or $logosrc == 'ww2') 
		{ $logopath = $logoname;  }	
		
	}
}
		
if($op=="new"){
	if(isset($request['org_id'])) { $fData['organization_id'] = $request['org_id']; }
}		
	
$published = yesNoChecked($fData['published']);	
$uservalid = yesNoChecked($fData['uservalid']);	
$group[@$fData['role_id']] = ' selected ';
		
	?>

<div style=" margin:auto;">
<div style="text-align:center"><?php echo $pgtitle; ?></div>

	
<form class="rwdform rwdvalid" name="fm_organization" id="fm_organization" method="post" action="adm_posts.php" enctype="multipart/form-data">
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_member_account" />
<input type="hidden" name="account_id" id="account_id" value="<?php echo @$fData['account_id']; ?>">
<input type="hidden" name="redirect" value="home.php?d=<?php echo $dir; ?>" />




	<div>
		<div class="padd5">&nbsp;</div>
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="namefirst">First Name</label>
	<input type="text" name="user[namefirst]" id="namefirst" maxlength="100" class="text form-control col-md-9" value="<?php echo @$fData['namefirst']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="namelast">Last Name</label>
	<input type="text" name="user[namelast]" id="namelast" maxlength="100" class="text form-control col-md-9" value="<?php echo @$fData['namelast']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="email">Email</label>
	<input type="email" name="user[email]" id="email" maxlength="100" class="text form-control col-md-9 email" <?php echo $cont_emailLock; ?> value="<?php echo @$fData['email']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="phone">Phone</label>
	<input type="text" name="user[phone]" id="phone" maxlength="100" class="text form-control col-md-9"  value="<?php echo @$fData['phone']; ?>" />
	</div>



	<div class="form-group">
	<label class="textlabel col-md-3" for="organization_id">Organization</label>
	<div class="col-md-3 nopadd">
		<select name="user[organization_id]" id="organization_id" class="form-control">
			<?php echo $ddSelect->dropper_select("mrfc_reg_organizations", "organization_id", "organization", @$fData['organization_id']); ?>
		</select>
	</div>
	</div>
	
	<div class="form-group">
	<label class="textlabel col-md-3" for="role_id">Access Level</label>
	<div class="col-md-3 nopadd">
		<select name="user[group_id]" id="role_id" class="form-control required">
		    <?php echo $ddSelect->dropper_select("mrfc_reg_roles", "role_id", "role_title", @$fData['role_id']); ?>
			<!--<option value="1" <?php echo $group[1]; ?>>Administrator</option>
			<option value="2" <?php echo $group[2]; ?>>User</option>
			<option value="3" <?php echo $group[3]; ?>>Editor</option>
			<option value="4" <?php echo $group[4]; ?>>Contributor</option>-->
		</select>
	</div></div>



	<div class="form-group">
	<label class="textlabel col-md-3" for="uservalid">Verified</label>
	<div class="col-md-9 nopadd">
		<label><input type="checkbox" name="user[uservalid]" id="uservalid" <?php echo @yesNoChecked($fData['uservalid']); ?> class="radio" /> <em>(Yes / No)</em></label>
	</div></div>	


	<div class="form-group">
	<label class="textlabel col-md-3" for="userpublished">Published / Live</label>
	<div class="col-md-9 nopadd">
		<label><input type="checkbox" name="user[published]" id="userpublished" <?php echo @yesNoChecked($fData['published']); ?> class="radio" /> <em>(Yes / No)</em></label>
	</div></div>				


	<?php if($formaction == '_new'){ ?>
	<div class="form-group"><div class="note txtcenter">Fill in below to change password. <!--Leave blank to keep current password.--></div></div>
	
	
	<div class="form-group">
	<label class="textlabel col-md-3" for="userpass">New Password</label>
	<div class="col-md-9 nopadd">
	<input type="password" name="ac_password" id="ac_password" maxlength="20" class="text form-control col-md-4"  placeholder="New Password" />
	<input type="password" name="ac_passconfirm" id="ac_passconfirm" maxlength="20" equals="ac_password" class="text form-control col-md-4"  placeholder="Repeat Password" />
	</div></div>
	
	<?php } ?>


<div>
	<div class="padd5"></div>
</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="">Avatar</label>
		<div class="col-md-9 nopadd">
		<?php if($op == "edit"){ ?>	
				<div class="padd20">
				<img src="<?php echo $logopath; ?>" class="" style="max-height:60px;" />
				</div>

		<?php } ?>
		<input type="file" name="upavatar[]" id="upavatar" size="" style="width:100%;"   />
		</div>
	</div>

<div>
	<div class="padd5"></div>
</div>		

<div class="form-group">
	<label class="col-md-3" for="">&nbsp;</label>
	<div class="col-md-3 nopadd"><input type="submit" name="submit" id="Submit" value="Submit" /></div>
</div>	


	
</form>
</div>


	
			

	</div>
</div>






<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	
	
});
</script>