<?php
$GLOBALS['FORM_KEYTAGS'] = true;
$GLOBALS['LOWER_ACCOUNT'] = 0;

$frmNoEdit 	= '';
$showForm 	= false;
$postBy		= '';
$access[1] 	= '';
$access[2] 	= '';
$resource_file  = '';
$resource_cover = '';
$uploadRequire	= '';
$fDataParent	= array();

$tweet_action = 0;

$status_comments = '';
$item_ext = '';

if($op=="edit" or $op=="view"){

	if($id)
	{
		$sq_posted_by = ""; //"  and `posted_by` = ".quote_smart($us_id)." ";
		if($us_org_id <> '' and $us_type_id == 1){ $sq_posted_by = ""; }
		
		$sqdata = "SELECT * FROM `".$pdb_prefix."dt_downloads` WHERE  (`resource_id` = ".quote_smart($id)." ".$sq_posted_by.")";
		$rsdata = $cndb->dbQueryFetch($sqdata); 
		
		if(count($rsdata))
		{
			$showForm 			= true;
			$fData 				= current($rsdata);	
			
			$postBy 			= $fData['posted_by'];
			$postByProfile 		= $dispDt->get_userProfile($postBy);  
			$postByGroupID		= $postByProfile['role_id'];
			$postByName			= $postByProfile['namefirst'].' '.$postByProfile['namelast'];
			
			$res_attr 			= @unserialize($fData['resource_attributes']); 

			$formaction			= "_edit";		
			$upload_picy		= " ";
			$upload_picn		= " checked ";
			
			$file_name 			= $fData['resource_file'];
			$item_protocol  	= substr($file_name,0,3);
			$item_ext 			= pathinfo($file_name, PATHINFO_EXTENSION);
			
			$resource_image 	= $fData['resource_image'];
			
			$tweet_action		= $fData['tweet_action'];
				
			$sq_item_parent = "SELECT `resource_id`, `id_menu`, `organization_id`, `res_type_id`, `county_id` FROM `".$pdb_prefix."dt_downloads_parent` WHERE (`resource_id` =".quote_smart($id)."); "; 
			$rs_item_parent = $cndb->dbQuery($sq_item_parent);
			if( $cndb->recordCount($rs_item_parent)) {
				while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
				{ 
					if($cn_item_parent['organization_id'] <> 0) { $fDataParent['organization_id'][] = $cn_item_parent['organization_id']; }
					if($cn_item_parent['res_type_id'] <> 0) { $fDataParent['res_type_id'][] = $cn_item_parent['res_type_id']; }
					if($cn_item_parent['county_id'] <> 0) { $fDataParent['county_id'][] = $cn_item_parent['county_id']; }
				}
			}
			
			if($fData['status'] == 'Decline'){
				$sq_comments = "SELECT * FROM `".$pdb_prefix."dt_downloads_notes` WHERE (`resource_id` =".quote_smart($id).") order by `note_id` DESC limit 0,1; "; 
				$rs_comments = current($cndb->dbQueryFetch($sq_comments));
				$status_comments = $rs_comments['details'];
			}
			
			
			//EXTERNAL
			if($item_protocol == 'htt' or $item_protocol == 'www' or $item_protocol == 'ftp' or $item_protocol == 'ww2') 
			{ $link = ' href="'.$file_name.'" ';  } 
			else 
			{ 
				$link = ' href="'.DISP_FILES.$file_name.'" ';
				if($item_ext == "mp4") { $link = ' href="'.SITE_DOMAIN_LIVE.'image/video/'.$file_name.'" ';  }
			}	
			
			if($fData['resource_file'] <> ''){
				$resource_file = '<div class="col-md-12 padd0_l"><a '.$link.'>'.$fData['resource_file'].'</a></div>'; 
			}
			$file_box_link	= '';
			$file_box_upload  = ' style="display: none"';
			
			
			if($fData['resource_image'] <> ''){
				$cov_link 		= DISP_COVERS . $fData['resource_image'];
				$resource_cover = '<label class="col-md-3"></label><div class="col-md-9 padd0_l"><a href="'.$cov_link.'" target="_blank"><img src="'.$cov_link.'" style="max-height:100px" /></a></div>'; 
			}
			
			/* @@ Only edit if owner */
			if( $us_type_id == 2 and $us_id !== $postBy ){
				//$frmNoEdit = 'frmNoEdit';
			}
			
		}
		
		
	}
} 
else
{
	$showForm = true;
	$formaction			   = "_new";

	$upload_picy			= " checked ";
	$upload_picn			= "";
	$uploadRequire	= 'required';
	$fData['date_created'] = date('Y-m-d');
	$fData['status'] = 'pending approval';
	
	$fData['posted_by'] = $us_id;
	$fDataParent['organization_id'] = $us_org_id;
	$fData['access_id'] = 2;
	
	$postByGroupID		= $us_type_id;
}

/*displayArray($fData);*/
/*displayArray($postByProfile);*/

/*echobr($postByGroupID);*/
/*echobr($us_type_id);*/



if($us_type_id == 1) {
	$GLOBALS['LOWER_ACCOUNT'] = 1;
}
elseif($us_type_id == 3 and $postByGroupID == 2 ){
	$GLOBALS['LOWER_ACCOUNT'] = 1;
}
elseif(($us_type_id <> 1 and $postByGroupID == 1) or ($us_type_id == 2 and $postByGroupID == 3) ){
	$GLOBALS['LOWER_ACCOUNT'] = 0;
	$frmNoEdit = 'frmNoEdit';
}


//displayArray($sess_mbr);


@$access[$fData['access_id']] = ' selected ';	


//if($us_type_id == 2){ $frmNoEdit = 'frmNoEdit'; }

echo '<br /><h4>Resource Details</h4> ';
if($showForm)
{
?>

<form class="rwdform rwdfull rwdstripes rwdvalid <?php echo $frmNoEdit; ?>" name="fm_vds" id="fm_vds" method="post" action="posts.php" enctype="multipart/form-data" >
<input type="hidden" name="formtab" value="_documents" />
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_resources" />
<input type="hidden" name="id" value="<?php echo @$fData['resource_id']; ?>" />
<input type="hidden" name="posted_by" value="<?php echo @$fData['posted_by']; ?>" />
<input type="hidden" name="redirect" value="profile.php?ptab=<?php echo $ptab; ?>" />
<input type="hidden" name="resource_key" value="<?php echo @$fData['resource_key']; ?>" />
<input type="hidden" name="resource_slug" id="resource_slug" value="<?php echo @$fData['resource_slug']; ?>"  />
<input type="hidden" name="resource_extension" value="<?php echo $item_ext; ?>" />
<input type="hidden" name="tweet_action" value="<?php echo $tweet_action; ?>" />
<div class=""></div>


<div class="form-group form-row">
<label for="resource_title" class="col-md-3 required">Resource Title: </label>
	<div class="col-md-9 padd0_l padd0_r">	
	<input type="text" name="resource_title" id="resource_title" class="form-control required" value="<?php echo @$fData['resource_title']; ?>"  />
	</div>
</div>


<div class="form-group form-row">
	<label for="resource_description" class="col-md-3">Resource Description: </label>
	<div class="col-md-9 padd0_l padd0_r">
	<textarea name="resource_description" id="resource_description" class="form-control wysiwyg" ><?php echo @$fData['resource_description']; ?></textarea>
	<?php //include("fck_rage/article_sm.php");  ?>
	</div>
</div>


<div class="form-group form-row"><label for="resource_tags" class="col-md-3">Resource Topics/Tags: </label>
<div class="col-md-9 padd0_l padd0_r">
<input type="text" name="resource_tags" id="resource_tags" class="form-control col-md-12 tags-field" style="width:100% !important" value="<?php echo @$fData['resource_tags']; ?>"  /></div>
</div>





<div class="form-group form-row">
<label for="resource_file" class="col-md-3">Resource File: </label>
<div class="col-md-9 padd0_l">
	
	<?php if($frmNoEdit == ''){ ?>
	<div class="col-md-2 padd0_l"><label for="fupload">Upload New</label></div>
	<div class="col-md-10 padd0_l"><input type="file" name="fupload" id="fupload"  class="form-control <?php echo $uploadRequire; ?>"  accept="<?php echo $uploadMime; ?>" /></div>
	<div class="col-md-12 note txtred padd0_5"><em><b>Accepted document types:</b> PDF, Excel, Word, PowerPoint, .mp4 Video</em></div>
	
	
	<?php } ?>
	
	<?php echo $resource_file; ?>
	
	
	<?php /* ?>
	<table align="left" width="100%" border="0" class="table nopadd nomargin noborder">
	<tr>
		<td style="width:;" class="col-md-3">
		<label style="display:inline-block;"><input name="change_image" id="upload_on" type="radio" value="Yes" <?php echo $upload_picy; ?>  class="radio"/>&nbsp; Upload New</label>&nbsp;
		<label style="display:inline-block;"><input name="change_image" id="upload_off" type="radio" value="No" <?php echo $upload_picn; ?>  class="radio"/> Resource Name</label> 
		</td>
		<td class="col-md-9">
	<div id="file_box_upload" class="col-md-12" <?php echo $file_box_upload; ?>>
	<input type="file" name="fupload" id="fupload"  class="form-control required"  accept="<?php echo $uploadMime; ?>" />
	</div>
	
	<div id="file_box_link" class="col-md-12" <?php echo $file_box_link; ?>>
	
	<input type="text" name="resource_file" id="resource_file" value="<?php echo @$fData['resource_file']; ?>" readonly class="form-control" placeholder="Enter File link:" />
	</div>
	</td>
	</tr>
	</table>
	<?php */ ?>
</div></div>




<div class="form-group form-row">
<label for="year_published" class="col-md-3 required">Publication Year: </label>
<select name="year_published" id="year_published" class="form-control col-md-3 required">
	 <option selected><?php echo @$fData['year_published']; ?></option>
	 <?php for($d=date("Y"); $d>=(date("Y")-20); $d--) { ?>   <option><?php echo $d; ?></option><?php } ?> 
</select>

<label for="date_created" class="col-md-3">Date Posted: </label>
<input type="text" name="date_created" id="date_created" class="form-control col-md-3 hasDatePicker" value="<?php echo @$fData['date_created']; ?>"  />
</div>






<div class="form-group form-row"><label for="access_id" class="col-md-3">Access Level: </label>
<select name="access_id" id="access_id" class="form-control col-md-3">
	 <option value='1' <?php echo $access[1]; ?>>Public Access</option> 
   <option value='2' <?php echo $access[2]; ?> >Private (Members Only) Access</option>
</select>


<label for="status" class="col-md-3 required">Status: </label>

<select name="status" id="status" class="form-control col-md-3 required">
  	<option><?php echo ucwords(@$fData['status']); ?></option>
  	<?php 
 		if($GLOBALS['LOWER_ACCOUNT'] == 1)
		{ 
			$optDecline = ($op=="edit" or $op=="view") ? '<option>Decline</option>' : '';
			echo '<option>Live</option>'.$optDecline; 
		} ?>
  	<option>Pending Approval</option><option>Draft</option><option>Archive</option>
</select>
</div>

<?php  if($op=="edit" or $op=="view"){ 
	$statusDisplay = ($fData['status'] == 'Decline') ? '' : ' style="display:none"';
?>
<div id="status_notes" class="form-group form-row" <?php echo $statusDisplay; ?> >
	<div class="col-md-6">&nbsp;</div>
	<label for="status_comments" class="col-md-3">Status Notes: </label>
	<textarea name="status_comments" id="status_comments" class="form-control col-md-3"><?php echo $status_comments; ?></textarea>
</div>
<?php  } ?>



<div class="form-group form-row">
<label for="resource_image" class="col-md-3">Resource Image: </label>
<input type="file" name="resource_image" id="resource_image" class="form-control col-md-9" style=""  />
<?php echo $resource_cover; ?>
</div>
<?php /*?>
<div class="form-group form-row"><label for="resource_date_update" class="col-md-3">Resource Date Update: </label>
<input type="text" name="resource_date_update" id="resource_date_update" class="form-control hasDatePicker" value=""  />
</div></div>


<div class="form-group form-row"><label for="owner_id" class="col-md-3">Owner Id: </label>
<input type="text" name="owner_id" id="owner_id" class="form-control " value=""  />
</div></div>

<div class="form-group form-row"><label for="owner_approve" class="col-md-3">Owner Approve: </label>
<input type="text" name="owner_approve" id="owner_approve" class="form-control " value=""  />
</div></div>

<div class="form-group form-row"><label for="published" class="col-md-3">Published: </label>
<label><input type="checkbox" name="published" id="published" class="form-control radio "    /> <small>(Yes / No)</small></label>
</div></div><?php */?>





<?php if($op=="edit" or $op=="view"){ ?>
<div class="form-group form-row">
	<label for="" class="col-md-3">Posted By: </label>
	<div class="col-md-3 form-control"><?php echo @$postByName; ?></div>
</div>
<?php } ?>

<div class="form-group form-row">
	<label class="col-md-3">&nbsp;</label>
	<button type="input" name="submit" id="submit" value="submit" class="btn btn-success btn-icon col-md-3">Submit </button>
</div>

	
</form>



<script type="text/javascript">
jQuery(document).ready(function($) 
{
	$("#upload_on").click(function () { $("#file_box_upload").show(); $("#file_box_link").hide(); });
	$("#upload_off").click(function () { $("#file_box_upload").hide(); $("#file_box_link").show(); });
	
	$("#adm_download_form").validate();
	
	<?php  if($op=="edit" or $op=="view"){ ?>
	$("select#status").change(function () {
	  var valStatus = $("select#status option:selected").val();
	  //alert(valStatus);
	 
		if(valStatus == 'Decline') { $("#status_notes").show(); $("#status_comments").addClass("required"); }
		else { $("#status_notes").hide(); $("#status_comments").removeClass("required"); }
		
	});	
	<?php  } ?>
	
});
</script>	
<?php
}
else
{ echo '<div class="warning">Nothing to display here!</div>';
}
 ?>
