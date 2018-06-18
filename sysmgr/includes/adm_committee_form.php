<style type="text/css">
	.rwdform-admin>.form-group>label { float: left; display: inline-block; width: 16.66666667%; position: relative; min-height: 1px;padding-right: .9375rem;padding-left: .9375rem;  }
	.rwdform-admin>.form-group>div { float: left; display: inline-block; width: 83.33333333%; position: relative; }
</style>

<?php

$dispData->buildMenu_Arr(); 
$dispData->siteGallery(); 

$formname		= "fm_courses_main";
$formact		= "_add";
$redirect 		= "home.php?d=". $dir; 
$fData 		   	= array();

$duration_type	= '<option selected>Days</option>';

$joining		= '<p>Joining this course is easy: just call us on +254 792 424 501 / +254 737 947 497 now or complete the form above.</p><p>All our venues provide excellent refreshments, a high quality hot and cold restaurant buffet lunch and a comfortable learning environment.</p><p>All venues except Nairobi have free parking and all are close to major routes so they’re easy to get to. They are also close to star rated hotels to provide you with a variety of accommodation options to choose from.</p>';

$fData['published']  	= 1;
$fData['id_section']  	= 7;
$fData['arr_images'] 	= 'no_image.png';
$article 				= "";
$image_disp 			= "";

if($op=="edit" and isset($id) or $op=="view" and isset($id))
{

$unit_function	= '';
/*`id`, `id_section`, `title`, `url_title_article`, `article`, `date_created`, `arr_extras`, `article_keywords`, `arr_images`, `published`*/
	
	$sqdata			= "SELECT * FROM `".$pdb_prefix."dt_content` WHERE (`id` = ".quote_smart($id)."); ";
	
	$rsdata			= $cndb->dbQuery($sqdata);// 
	$rsdata_count	= $cndb->recordCount($rsdata);
	
	$rs_fields 		= mysqli_num_fields($rsdata);
	
	
	if($rsdata_count == 1)
	{
		$cn_fields 	= $cndb->fetchRow($rsdata, "assoc");
		$fData  	= array_map("clean_output", $cn_fields);
		
		$cont_id	= $fData['id'];
		$fData['profile'] = unserialize($cn_fields['arr_extras']);
		
		
		//$fData['post_date'] = ($cn_fields['post_date'] > 0) ? date('m/d/Y', strtotime($cn_fields['post_date'])): '';
		
		$sq_item_parent = "SELECT `id_parent`, `id_content` FROM `".$pdb_prefix."dt_content_parent` WHERE (`id_content` = ".quote_smart($id)."); "; 
		$rs_item_parent = $cndb->dbQuery($sq_item_parent);
		if($cndb->recordCount($rs_item_parent)) {
			while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
			{ if($cn_item_parent[0] <> 0) { $fData['id_parent'][] = $cn_item_parent[0]; }}
		}
	
		 $image_disp  = getContGalleryPic($fData['id'], $fData['title']); 
	}
	
	/*$photo			= $fData['arr_images']; 
	if($photo == '') { $photo = 'no_avatar.png'; }*/
	
	//$image_disp			= "<img src=\"".DISP_GALLERY.$photo."\"  style=\"max-width:300px; max-height:300px;\" >";
		
	
	$formact		 = "_edit";
	//$redirect		= "dashone.php?d=" . $dir; //RDR_REF_PATH;
	
	
} 

if(@$fData['profile']['joining'] == '') {
	$fData['profile']['joining'] = $joining;
}
$published = yesNoChecked($fData['published']);
//displayArray($fData);
//displayArray(master::$listGallery);

?>

<div class="padd10">
<h3>Course Details</h3>
	
<form  class="rwdform rwdfull rwdstripes rwdform-admin" method="POST" name="frm_courses_main" id="frm_courses_main" action="adm_posts.php" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo @$fData['id']; ?>">
<input type="hidden" name="id_section" id="id_section" value="<?php echo @$fData['id_section']; ?>">
<input type="hidden" name="formname" value="<?php echo $formname; ?>" />
<input type="hidden" name="formact" value="<?php echo $formact; ?>" />
<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
<input type="hidden" name="approved" value="1" />


<div class="form-group">
<label for="id_parent">Parent Menu:</label>
<div>
<select name="id_parent[]" id="id_parent" multiple="multiple" class="multiple">
<?php echo $dispData->build_MenuSelectRage(0, @$fData['id_parent']); ?>
</select>
</div> 
</div>



<div class="form-group">
	<label for="title"> Title</label>
	<div><input type="text" name="title" id="title" maxlength="50" class="form-control" value="<?php echo @$fData['title']; ?>" /></div> 
</div>

<div class="form-group">
<label for="article">Introduction</label>
<div><textarea name="article" id="article" class="form-control  wysiwyg"><?php echo @$fData['article']; ?></textarea>
<?php //include("fck_rage/article.php"); ?>
</div> 
</div>

<div class="form-group">
	<label for="cost">Cost</label>
	<div><input type="text" name="profile[cost]" id="cost" maxlength="50" class="form-control" value="<?php echo @$fData['profile']['cost']; ?>" /></div> 
</div>

<div class="form-group">
	<label for="duration">Duration</label>
	<div>
		<input type="number" name="profile[duration]" id="duration" maxlength="2" class="form-control col-md-2 txtright required" value="<?php echo @$fData['profile']['duration']; ?>" />
		<select name="profile[duration_type]" id="duration_type" class="form-control col-md-2 required">
			<?php echo $duration_type; ?><option>Days</option><option>Weeks</option>
		</select>
	</div> 
</div>

<div class="form-group">
	<label for="target">Who is it for?</label>
	<div><input type="text" name="profile[target]" id="target" class="form-control" value="<?php echo @$fData['profile']['target']; ?>" /></div> 
</div>

<div class="form-group">
	<label for="coverage">What does it cover?</label>
	<div><textarea name="profile[coverage]" id="coverage" class="form-control wysiwyg"><?php echo @$fData['profile']['coverage']; ?></textarea></div> 
</div>

<div class="form-group">
	<label for="benefits">Benefits</label>
	<div><textarea name="profile[benefits]" id="benefits" class="form-control wysiwyg"><?php echo @$fData['profile']['benefits']; ?></textarea></div> 
</div>


<div class="form-group">
	<label for="training_overview">Training overview</label>
	<div><textarea name="profile[training_overview]" id="training_overview" class="form-control wysiwyg"><?php echo @$fData['profile']['training_overview']; ?></textarea></div> 
</div>


<div class="form-group">
	<label for="joining">Registering for this course</label>
	<div><textarea name="profile[joining]" id="joining" class="form-control wysiwyg"><?php echo @$fData['profile']['joining']; ?></textarea></div> 
</div>


<div class="form-group">
<label for="published">Published</label>

<div class="input-group padd5_t">
	<div class="col-md-4">
        <label class="radiolabel control-labelx" for="published">
            <input type="checkbox" name="published" id="published" <?php echo $published; ?> class="radio-inline"/>  
         Yes / No</label>
	 </div>
	 <!--<div class="col-md-4"><label for="approved">Published</label></div>
	 <div class="col-md-4"></div>-->
</div>
</div>




<!--<h3>Profile Photo</h3>-->

<div class="form-group">
<label class="textlabel control-label" for="upload_y">Upload Course Image:</label>
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