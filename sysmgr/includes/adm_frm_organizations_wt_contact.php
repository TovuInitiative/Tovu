<div style="width:100%; margin:0 auto; border:0px solid">
	
	<div style="padding:10px;">
	
<?php
$GLOBALS['FORM_JWYSWYG'] = true;
	
$confDir 			= ucwords($dir);

$pgtitle			= "<h2>New $confDir</h2>";
$formname           = "fm_organization";
$formaction         = "_new";

$fData 		      = array();
$fContact 		  = array();
$fContact['uservalid'] = 1;	
$fContact['published'] = 1;		
		
$cont_option	  	= 'new';
$cont_emailLock		= '';	
$cont_wrap_detail	= ' style = "display:none" ';	
		
//$fData['published'] = 1;

$group[1] = $group[2] = $group[3] = $group[4] = '';	
		
if($op=="edit"){

	if($id){
	
	/*$sqdata="SELECT `mrfc_reg_account`.*, `mrfc_reg_organizations`.* , `mrfc_reg_organizations`.`published` as `org_publish`  FROM `mrfc_reg_organizations` 
	LEFT JOIN `mrfc_reg_account` ON (`mrfc_reg_organizations`.`contact_id` = `mrfc_reg_account`.`account_id`)
	WHERE  (`mrfc_reg_organizations`.`organization_id`  = ".quote_smart($id).")";*/
	
	$sq_org			= "SELECT * FROM `mrfc_reg_organizations` WHERE  (`organization_id`  = ".quote_smart($id).")";	
	$rs_org 		= $cndb->dbQueryFetch($sq_org);	
	$fData 			= current($rs_org);	
	
	$contact_id		= $fData['contact_id'];
		
	if($contact_id <> '') 
	{
		$cont_option 		= 'edit';
		//$cont_emailLock		= 'disabled';
		$cont_wrap_detail	= '';
		
		$sq_cont	= "SELECT * FROM `mrfc_reg_account` WHERE  (`account_id`  = ".quote_smart($contact_id).")";	
		$rs_cont 	= $cndb->dbQueryFetch($sq_cont);	
		$fContact 	= current($rs_cont);	
	}
		
		
	//displayArray($fData);	
	//displayArray($fContact);	
	$pgtitle ="<h2>Edit $confDir</h2>";
	$formaction			= "_edit";
		
		
		$logoname = ($fData['logo'] <> '') ? $fData['logo'] : 'no-image-found.jpg'; /*no_image.png*/
		$logopath = DISP_LOGOS.$logoname;
		$logosrc  = substr($logoname, 0 , 3);	

		/** EXTERNAL IMAGE **/
		if($logosrc == 'htt' or $logosrc == 'www' or $logosrc == 'ftp' or $logosrc == 'ww2') 
		{ $logopath = $logoname;  }	
		
	}
}
	
$published = yesNoChecked($fData['published']);	
$is_partner = yesNoChecked($fData['is_partner']);	
$group[@$fContact['group_id']] = ' selected ';
		
	?>

<div style=" margin:auto;">
<!--<div style="text-align:center"><?php echo $pgtitle; ?></div>-->

	
<form class="rwdform rwdvalid" name="fm_organization" id="fm_organization" method="post" action="adm_posts.php" enctype="multipart/form-data">
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_organization" />
<input type="hidden" name="organization_id" id="organization_id" value="<?php echo @$fData['organization_id']; ?>">
<input type="hidden" name="account_id" id="account_id" value="<?php echo @$fData['contact_id']; ?>">
<input type="hidden" name="redirect" value="home.php?d=<?php echo $dir; ?>" />
<input type="hidden" name="cont_option" value="<?php echo $cont_option; ?>">

<div>
	<div class="padd5"><h3>Organization Details</h3></div>
</div>


<div class="form-group">
<label class="textlabel col-md-3" for="organization">Organization Name</label>
<input type="text" name="org[organization]" id="organization" maxlength="100" class="text form-control col-md-9" value="<?php echo @$fData['organization']; ?>" />
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="organization_profile">Profile</label>

<div class="col-md-9 nopadd">	
<textarea name="org[organization_profile]" id="organization_profile" class="text form-control  wysiwyg"><?php echo @$fData['organization_profile']; ?></textarea>
</div>
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="organization_phone">Phone</label>
<input type="text" name="org[organization_phone]" id="organization_phone" maxlength="50" class="text form-control col-md-9" value="<?php echo @$fData['organization_phone']; ?>" />
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="organization_email">Email</label>
<input type="email" name="org[organization_email]" id="organization_email" maxlength="50" class="text form-control col-md-9" value="<?php echo @$fData['organization_email']; ?>" />
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="organization_website">Website</label>
<input type="url" name="org[organization_website]" id="organization_website" class="text form-control col-md-9" value="<?php echo @$fData['organization_website']; ?>" />
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="">Logo</label>
	<div class="col-md-9 nopadd">
	<?php if($op == "edit"){ ?>	
			<div class="padd20">
			<img src="<?php echo $logopath; ?>" class="" style="max-height:60px;" />
			</div>
		
  	<?php } ?>
  	<input type="file" name="uplogo" id="uplogo" size="" style="width:100%;"   />
  	</div>
</div>

<div class="form-group">
<label class="textlabel col-md-3" for="is_partner">Is Partner</label>
<div class="col-md-9 nopadd">
	<label><input type="checkbox" name="org[is_partner]" id="is_partner" <?php echo $is_partner; ?> class="radio" /> <em>(Yes / No)</em></label>
</div></div>


<div class="form-group">
<label class="textlabel col-md-3" for="published">Published / Live</label>
<div class="col-md-9 nopadd">
	<label><input type="checkbox" name="org[published]" id="published" <?php echo $published; ?> class="radio" /> <em>(Yes / No)</em></label>
</div></div>

<?php
	if($cont_option == 'new'){
?>
<div class="form-group note">
<label class="textlabel col-md-3" for="new_contact">Add New Contact?</label>
<div class="col-md-9 nopadd">
	<label><input type="checkbox" name="new_contact" id="new_contact" class="radio" /> <em>(Yes / No)</em></label>
</div></div>
<?php
	}
?>






<div class="info" id="cont_wrap_detail" <?php echo $cont_wrap_detail; ?>>

	<div>
		<div class="padd5"><h3><?php echo ucwords($cont_option); ?> Contact Details</h3></div>
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="namefirst">First Name</label>
	<input type="text" name="user[namefirst]" id="namefirst" maxlength="100" class="text form-control col-md-9" value="<?php echo @$fContact['namefirst']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="namelast">Last Name</label>
	<input type="text" name="user[namelast]" id="namelast" maxlength="100" class="text form-control col-md-9" value="<?php echo @$fContact['namelast']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="email">Email</label>
	<input type="email" name="user[email]" id="email" maxlength="100" class="text form-control col-md-9 email" <?php echo $cont_emailLock; ?> value="<?php echo @$fContact['email']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="phone">Phone</label>
	<input type="text" name="user[phone]" id="phone" maxlength="100" class="text form-control col-md-9"  value="<?php echo @$fContact['phone']; ?>" />
	</div>

	<div class="form-group">
	<label class="textlabel col-md-3" for="group_id">Contact Access Level</label>
	<div class="col-md-3 nopadd">
		<select name="user[group_id]" id="group_id" class="form-control required">
			<option value="1" <?php echo $group[1]; ?>>Administrator</option>
			<option value="2" <?php echo $group[2]; ?>>User</option>
			<option value="3" <?php echo $group[3]; ?>>Editor</option>
			<option value="4" <?php echo $group[4]; ?>>Contributor</option>
		</select>
	</div></div>



	<div class="form-group">
	<label class="textlabel col-md-3" for="uservalid">Verified</label>
	<div class="col-md-9 nopadd">
		<label><input type="checkbox" name="user[uservalid]" id="uservalid" <?php echo @yesNoChecked($fContact['uservalid']); ?> class="radio" /> <em>(Yes / No)</em></label>
	</div></div>	


	<div class="form-group">
	<label class="textlabel col-md-3" for="userpublished">Published / Live</label>
	<div class="col-md-9 nopadd">
		<label><input type="checkbox" name="user[published]" id="userpublished" <?php echo @yesNoChecked($fContact['published']); ?> class="radio" /> <em>(Yes / No)</em></label>
	</div></div>				


	<?php if($cont_option == 'edit'){ ?>
	<div class="form-group"><div class="note txtcenter">Fill in below to change password. Leave blank to keep current password.</div></div>
	<?php } ?>
	
	<div class="form-group">
	<label class="textlabel col-md-3" for="userpass">New Password</label>
	<div class="col-md-9 nopadd">
	<input type="password" name="ac_password" id="ac_password" maxlength="20" class="text form-control col-md-4"  placeholder="New Password" />
	<input type="password" name="ac_passconfirm" id="ac_passconfirm" maxlength="20" equals="ac_password" class="text form-control col-md-4"  placeholder="Repeat Password" />
	</div></div>
	
	

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
	$("#new_contact").click(function () { 
		if($("#new_contact").is(':checked')) {
			$("#cont_wrap_detail").show(); }
		else {
			$("#cont_wrap_detail").hide(); }  
	});
	
	
	
});
</script>




<?php

if($formname=="fm_organization")
{	
	$ac_email 		= @$post['user']['email'];
	$ac_phone 		= @$post['user']['phone']; 
	$ac_namefirst	= @$post['user']['namefirst'];
	$ac_namelast	= @$post['user']['namelast'];
	$ac_group_id	= @$post['user']['group_id'];
	$ac_uservalid	= yesNoPost(@$post['user']['uservalid']); 
	$ac_published	= yesNoPost(@$post['user']['published']); 
	
	
	$org_d 		= $post['org']; //displayArray($org_d); exit;
	$org_seo	= generate_seo_title($org_d['organization'], '-');	
	$org_id		= $post['organization_id'];
	
	$published 	= yesNoPost(@$org_d['published']);
	$is_partner = yesNoPost(@$org_d['is_partner']);
	
	$sq_post[] = "update `mrfc_reg_organizations` set `organization`=".q_si($org_d['organization']).", `organization_seo`=".q_si($org_seo).", `organization_website`=".q_si($org_d['organization_website']).", `organization_email`=".q_si($org_d['organization_email']).", `organization_phone`=".q_si($org_d['organization_phone']).", `organization_profile`=".q_si($org_d['organization_profile']).", `published` = ".q_si($published).", `is_partner` = ".q_si($is_partner)."  where `organization_id` = ".q_si($post['organization_id']).";  "; 
	
	
	
	if($post['account_id'] <> ''){	
		
		/* if($post['user']['email'] == '' or $post['user']['namefirst'] == '' or $post['user']['namelast'] == '' or $post['user']['group_id'] == ''){
			echo '<script>alert("Contact details required"); history.back(-1);</script>'; exit;
		}
		
		$sq_pass = "";
		if($post['ac_password'] <> '') {
			if($post['ac_password'] <> $post['ac_passconfirm']) {
				echo '<script>alert("Passwords dont match"); history.back(-1);</script>'; exit;
			}
			$ac_salt 		= getSalt();
			$ac_password 	= sha1($_POST['ac_password'] . $ac_salt);	
			$sq_pass 		= ", `usersalt`=".q_si($ac_salt).", `userpass`= ".q_si($ac_password)." ";
		}
			
		$sq_post[] = "update `mrfc_reg_account` set `group_id` = ".q_si($ac_group_id).", `namefirst`=".q_si($ac_namefirst).",`namelast`=".q_si($ac_namelast).",`email`=".q_si($ac_email).",`phone`=".q_si($ac_phone).", `uservalid`=".q_si($ac_uservalid).",`published`=".q_si($ac_published)." ".$sq_pass." where `account_id` = ".q_si($post['account_id']).";  "; */
	}
	
	
	$cndb->dbQueryMulti($sq_post);
	
	
	if(isset($_FILES['uplogo']) and strlen($_FILES['uplogo']['name']) > 0) 
	{
		$file_key 	 	= '-'.hash("crc32", $org_id);
		$file_name 	 	= $org_seo; //strtolower(substr(preg_replace('/[^a-zA-Z0-9.]+/', '_', $val),0,38));
		$file_name_new	= $file_name.$file_key;		

		$file_temp 		= $_FILES['uplogo']['tmp_name'];					
		$file_target  	= UPL_LOGOS . $file_name_new; 

		if(move_uploaded_file($file_temp, $file_target))
		{
			$sq_file  = "UPDATE `mrfc_reg_organizations` set `logo` = ".q_si($file_name_new)."  where `organization_id` = ".q_si($org_id)."; "; 
			$cndb->dbQuery($sq_file);					
		}
	}
	
	
	if($new_contact == 'XX1')
	{
		if($post['user']['email'] == '' or $post['user']['namefirst'] == '' or $post['user']['namelast'] == '' or $post['user']['group_id'] == ''){
			echo '<script>alert("Contact details required"); history.back(-1);</script>'; exit;
		}
		if($post['ac_password'] <> $post['ac_passconfirm']) {
			echo '<script>alert("Passwords dont match"); history.back(-1);</script>'; exit;
		}
		

		$ac_salt 		= getSalt();
		$ac_password 	= sha1($_POST['ac_password'] . $ac_salt);	
		$auth_code	    = 'SGN'.strtoupper(md5(uniqid(rand() . $ac_email)));

		$seqpost		= array();
        

		$sq_check = "SELECT `email` FROM `mrfc_reg_account` WHERE (`email` = ".q_si($ac_email).")";
		$rs_check = $cndb->dbQuery($sq_check);
		if($cndb->recordCount($rs_check)>=1)
		{ echo '<script>alert("Email exists."); history.back(-1);</script>'; exit; }


		/* =============================================== */	
		/* get Account, Category | Link Account to Category */
		$account_user_arr = array("organization_id"  =>"".$org_id."",
								  "namefirst"      =>"".$ac_namefirst."",
								  "namelast"   	   =>"".$ac_namelast."",
								  "phone"    	  =>"".$ac_phone."",
								  "group_id"    	  =>"".$ac_group_id."",
								  "usersalt"   	   =>"".$ac_salt."",
								  "userpass"      =>"".$ac_password."",
								  "userauth"    	  =>"".$auth_code."",
								  "uservalid"    	  =>"".$ac_uservalid.""
								  );	
		$acc_id  = $ddSelect->getAddUserAccount($ac_email, $account_user_arr);		
		
		$sq_upd[] = "update `mrfc_reg_account` set `published` = ".q_si($ac_published)." WHERE `account_id` = ".q_si($acc_id)."; ";
		$sq_upd[] = "update `mrfc_reg_organizations` set `contact_id` = ".q_si($acc_id)." WHERE `organization_id` = ".q_si($org_id)."; ";
		$cndb->dbQueryMulti($sq_upd);
		
	
	}
	
	//exit;	
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php exit;	
}
?>