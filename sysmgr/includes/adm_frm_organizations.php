<div style="width:100%; margin:0 auto; border:0px solid">
	
	<div style="padding:10px;">
	
<?php
$GLOBALS['FORM_JWYSWYG'] = true;
	
$confDir 			= ucwords($dir);

$pgtitle			= "<h2>New $confDir</h2>";
$formname           = "fm_organization";
$formaction         = "_new";

$fData 		      = array();
$fData['published'] = 1;		
$fData['is_partner'] = 0;
/*$fContact 		  = array();
$fContact['uservalid'] = 1;	
$fContact['published'] = 1;	*/	
		
$cont_option	  	= 'new';
$cont_emailLock		= '';	
$cont_wrap_detail	= ' style = "display:none" ';	

$cont_drops			= array();		
$contact_id			= '';		


$group[1] = $group[2] = $group[3] = $group[4] = '';	
		
if($op=="edit"){

	if($id)
	{
	
		$sq_org			= "SELECT * FROM `mrfc_reg_organizations` WHERE  (`organization_id`  = ".quote_smart($id).")";	
		$rs_org 		= $cndb->dbQueryFetch($sq_org);	
		$fData 			= current($rs_org);	

		$contact_id		= $fData['contact_id'];

			$sq_contact	= "SELECT `account_id`, concat_ws(' ',`mrfc_reg_account`.`namefirst`, `mrfc_reg_account`.`namelast`) as `name` FROM `mrfc_reg_account` WHERE  (`organization_id`  = ".quote_smart($id).")";	
			$cont_drops = $cndb->dbQueryFetch($sq_contact);	

		$pgtitle 		= "<h2>Edit $confDir</h2>";
		$formaction		= "_edit";
		
		
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
<input type="text" name="org[organization]" id="organization" maxlength="100" class="text form-control col-md-9 required" value="<?php echo @$fData['organization']; ?>" />
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
<input type="email" name="org[organization_email]" id="organization_email" maxlength="50" class="text form-control col-md-9 required" value="<?php echo @$fData['organization_email']; ?>" />
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
	if($op <> 'new'){
?>
<div class="form-group">
	<label class="textlabel col-md-3" for="contact_id">Contact Person</label>
	<div class="col-md-3 nopadd">
		<select name="contact_id" id="contact_id" class="form-control">
			<?php 
			foreach($cont_drops as $cc){
				$cc_id	= $cc['account_id'];
				$cc_name	= $cc['name'];
				$cc_sel	= ($contact_id == $cc_id) ? " selected " : "";
				echo '<option value="'.$cc_id.'" '.$cc_sel.'>'.$cc_name.'</option>'; }
			?>
		</select>
	</div>
	</div>
	
<?php
	}
?>





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