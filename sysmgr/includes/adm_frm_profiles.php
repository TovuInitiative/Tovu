<?php

$dispData->buildMenu_Arr(); 

$formname		= "vds_profiles";
$formact		 = "_add";
$redirect 		= "home.php?d=" . $dir; //$ref_back;
$fData 		   = array();


$fData['published']  = 1;
$fData['id_section']  = 18;
$fData['arr_images'] = 'no_image.png';
$article = "";
$image_disp = "";

if($op=="edit" and isset($id) or $op=="view" and isset($id))
{

$unit_function	= '';

	$sqdata="SELECT
    `id`
    , `id_section`
    , `title`
    , `url_title_article`
    , `article`
    , `date_created`
    , `arr_extras`
    , `article_keywords`
	, `arr_images`
    , `published`
FROM
    `".$pdb_prefix."dt_content`
WHERE (`id` = ".quote_smart($id)."); ";
	
	//echo $sqdata;
	
	$rsdata=$cndb->dbQuery($sqdata);// 
	$rsdata_count=$cndb->recordCount($rsdata);
	
	$rs_fields = mysql_num_fields($rsdata);
	
	
	if($rsdata_count==1)
	{
		$cn_fields = $cndb->fetchRow($rsdata);
		
		
		for ($i = 0; $i<$rs_fields; $i++)
		{
			$field_names[$i] = mysql_fetch_field($rsdata, $i);			
			$fData[$field_names[$i]->name] = $cn_fields[$field_names[$i]->name];
		}
		
		//$fData['post_date'] = ($cn_fields['post_date'] > 0) ? date('m/d/Y', strtotime($cn_fields['post_date'])): '';
		
		$fData['profile'] = unserialize($cn_fields['arr_extras']);
		$article 		 = clean_output($cn_fields['article']);
		
		
		$sq_item_parent = "SELECT `id_parent`, `id_content` FROM `".$pdb_prefix."dt_content_parent` WHERE (`id_content` = ".quote_smart($id)."); "; 
		$rs_item_parent = $cndb->dbQuery($sq_item_parent);
		if($cndb->recordCount($rs_item_parent)) {
			while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
			{ if($cn_item_parent[0] <> 0) { $fData['id_parent'][] = $cn_item_parent[0]; }}
		}
	
	}
	
	$photo			= $fData['arr_images']; 
	if($photo == '') { $photo = 'no_avatar.png'; }
	
	$image_disp			= "<img src=\"".DISP_AVATARS.$photo."\"  style=\"max-width:300px; max-height:300px;\" >";
		
	
	$formact		 = "_edit";
	//$redirect		= "dashone.php?d=" . $dir; //RDR_REF_PATH;
	
	
} 

$published = yesNoChecked($fData['published']);


?>

<div style="width:100%; max-width:900px; margin:0 auto; border:0px solid">
	
	<div style="padding:10px;">
	
<form  class="rwdform rwdfull  rwdstripes" method="POST" name="frm_profile" id="frm_profile" action="adm_posts.php" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo @$fData['id']; ?>">
<input type="hidden" name="id_section" id="id_section" value="<?php echo @$fData['id_section']; ?>">
<input type="hidden" name="formname" value="<?php echo $formname; ?>" />
<input type="hidden" name="formact" value="<?php echo $formact; ?>" />
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
<input type="hidden" name="image_old" id="image_old" value="<?php echo @$fData['arr_images']; ?>">





<div class="form-group">
<label for="id_parent">Parent Menu:</label>
<div>
<select name="id_parent[]" id="id_parent" multiple="multiple" class="multiple">
<?php echo $dispData->build_MenuSelectRage(0, @$fData['id_parent']); ?>
</select>
</div> 
</div>



<div class="form-group">
<label  for="title"> Name</label>
<div>
<input type="text" name="title" id="title" maxlength="50" class="form-control" value="<?php echo @$fData['title']; ?>" />
</div> 
</div>


<div class="form-group">
<label  for="email">Email</label>
<div>
<input type="text" name="profile[email]" id="email"  maxlength="50" class="form-control" value="<?php echo @$fData['profile']['email']; ?>" />
</div> 
</div>

<div class="form-group">
<label for="phone">Direct Line</label>
<div>
<input type="text" name="profile[phone]" id="phone"  maxlength="20" class="form-control" value="<?php echo @$fData['profile']['phone']; ?>" />
</div> 
</div>

<div class="form-group">
<label for="mobile">Mobile</label>
<div>
<input type="text" name="profile[mobile]" id="mobile"  maxlength="20" class="form-control" value="<?php echo @$fData['profile']['mobile']; ?>" />
</div> 
</div>


<div class="form-group">
<label  for="role">Position</label>
<div>
<input type="text" name="profile[role]" id="role"  maxlength="100" class="form-control" value="<?php echo @$fData['profile']['role']; ?>" />
</div> 
</div>


<div class="form-groupX">
<label for="article">Profile Text</label>
<div>
<?php include("fck_rage/article.php"); ?>
</div> 
</div>

<div class="form-group">
<label for="published">Published</label>

<div class="input-group padd5_t">	
	<label class="radiolabel control-labelx" for="published">
		<input type="checkbox" name="published" id="published" <?php echo $published; ?> class="radio-inline"/>  
	 Yes / No</label>
</div>
</div>




<h3>Profile Photo</h3>

<div class="form-group">
<label class="textlabel control-label" for="upload_y">Upload Photo:</label>
<div>
	<div class="radio_group">
	<label><input name="change_image" id="upload_y" type="radio" value="Yes"  class="" /> Yes </label>
	<label><input name="change_image" id="upload_n" type="radio" value="No" checked="checked" class="" /> No</label>
	</div>
</div>
</div>
				
<div class="form-group" id="upload_avatar" style="display:none">
<label class="textlabel control-label" for="reg_photo">&nbsp;</label>
<div>
	<div class="uploader" id="upload_reg_photo">
		<input style="opacity: 0;" name="reg_photo" id="reg_photo" type="file" accept="image/*" onchange="javascript: setFilename('upload_reg_photo', 'reg_photo', '1')" >
		<span style="-moz-user-select: none;" class="filename">No file selected</span>
		<span style="-moz-user-select: none;" class="action">Choose File</span>	
	</div> 
		<input type="hidden" name="command" value="1" />
</div> 
</div>


<div class="form-group">
<label class="control-label" for="">&nbsp;</label>
<div>
<?php echo $image_disp; ?>	
</div> 
</div>		





<div class="form-group">
<label class="control-label" for="">&nbsp;</label>
<div>
<button type="submit" class="btn btn-success" id="f_submit" name="submit" value="1"><i class="glyphicon glyphicon-plus"></i>Submit</button>
</div>

</div>



</form>

</div>
</div>


<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	$("#upload_y").click(function () { 
		$("#upload_avatar").show();  $("#reg_photo").click();   
	});
	$("#upload_n").click(function () { 
		$("#upload_avatar").hide();   
	});
});

function setFilename(upBox, upField, upKey)
{
 jQuery(document).ready(function($){
  	var fileDefaultText = 'No file selected';
	
  	var filenameTag = $('div#'+upBox+' span.filename');
	var filenameBtn = $('div#'+upBox+' span.action');
	
	var fileLabel = $('input#file_title_'+upKey+'');
	
	
	var $el = $('#'+upField+''); 
	var filename = $el.val();
	var filenameC = $el.val();
	
	filenameC = filenameC.split(".");
	filenameC = filenameC[(filenameC.length-1)].toUpperCase();
	
		if (filename === '') {	filename = fileDefaultText;	}
		else { 	
			filename = filename.split(/[\/\\]+/); filename = filename[(filename.length-1)];		
			filenameTag.html(filename);
			fileLabel.attr("value", filename.substr(0,filename.length-4)).focus();
	
		}
	});
};
</script>