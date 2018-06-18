<div style="width:100%; max-width:950px; margin:0 auto; border:0px solid">

<div style="padding:5px;">
<h2>Add Gallery Image / Video &raquo;</h2>


<form action="adm_gallery_upload.php" name="adm_gallery_form" id="adm_gallery_form" class="rwdform rwdfull"  method="post"  enctype="multipart/form-data" >
<fieldset style="background:#f7f7f7;">
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="100%" class="tims" >
	<tr>
		<td class="col-md-3 padd0_l"><label>Parent Menu</label></td>
		<td><select name="id_parent[]" id="id_parent" multiple="multiple" class="form-control multiple" style="width:600px">
          <?php echo  $dispData->build_MenuSelectRage(0, $parent);  ?>
          </select></td>
	</tr>
	<tr>
		<td><label>Parent Content</label></td>
		<td><select name="id_content[]" id="id_content" class="multiple width_full"   style="width:100% !important">
       <?php echo $dispData->build_MenuArticles(master::$contMain['full'], $id_content); ?>
      </select></td>
	</tr>
<?php 
/*	===========================================================
	// BEGIN - SECTOR AND PROJECT LINKAGE 
/*  -----------------------------------------------------------  
?>	
<tr><td nowrap="nowrap"><label>Link To Sector, Project:</label></td> <td>
<table style="margin:0 "> <tr> <td style="width:40%;padding-left:0;"> <select id="sector_id" name="sector_id" onchange="javascript: show_projects(); "> <?php echo $ddSelect->dropper_select("mrfc_app_sector", "sector_id", "title", $sector_id, "Select Sector") ?> </select> </td> <td> <span id="box_project"><input name="project_id" id="project_id" type="text" readonly placeholder="Select Project" ></span></td> </tr> </table>
</td></tr>
<?php 
/*	-----------------------------------------------------------
	// END - SECTOR AND PROJECT LINKAGE 
/*  ===========================================================  */
?>	
	
	<?php /*?><tr>
		<td style="width:100px;">Parent Resource</td>
		<td>
		<select name="id_resource[]" id="id_resource" class="multiple" multiple style="width:600px">
       <?php echo $ddSelect->dropper_select("mrfc_dt_downloads", "id", "title"); ?>
      </select>
		</td>
	</tr>
	<tr>
		<td style="width:100px;">Parent Crop / Equipment</td>
		<td>
		<select name="id_equipment[]" id="id_equipment" class="multiple" multiple   style="width:600px">
       <?php //echo $caData->get_equipment_select(); ?>
      </select>
		</td>
	</tr>
	<tr>
		<td style="width:100px;">&nbsp;</td>
		<td>&nbsp;</td>
	</tr><?php */?>
	
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td>&nbsp;</td><td>
	<div class="radio_group">
	<label><input type="radio" name="file_type" id="add_photo" value="p" class="radio"  <?php echo $checked_pic; ?> /> 
	Add Gallery Image </label>
	&nbsp;
	<label><input type="radio" name="file_type" id="add_video" value="v" class="radio" <?php echo $checked_vid; ?> /> Add Gallery Video </label>  
	
	</div>
	</td></tr>
	<tr>
		<td colspan="2">
		
		
		<div id="file_box_video" <?php echo $checked_vid_box; ?>>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td class="col-md-3 padd0_l"><label for="video_title">Video Title:</label> </td>
		  <td><input name="video_title" id="video_title" type="text" style="width:99%" class="<?php echo $require_vid_title; ?>" value="<?php echo $article_title; ?>" /></td>
		  </tr>
		<tr>
		<tr>
		<td> <label for="video_name">Youtube Video URL:</label> </td>
		<td><input type="text" name="video_name" id="video_name" value="<?php echo @$file_name_v; ?>" class="text_full" style="width:99%"><!--<span class="hint">e.g. http://www.youtube.com/embed/xxxxxxxxxx</span>--></td>
		</tr>
		<tr>
		<td nowrap="nowrap"><label for="video_caption">Video Summary:</label> </td>
		<td><textarea name="video_caption" id="video_caption" class="text_full" rows="1"><?php echo $file_caption; ?></textarea> </td>
		</tr>		
		</table>
		</div>
		
		
		<div id="file_box_photo" <?php echo $checked_pic_box; ?>>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="width:">
		
            <tr>
              <td class="col-md-3 padd0_l"><label for="photo_title">Image Title:</label> </td>
              <td colspan="3"><input name="photo_title" id="photo_title" type="text" style="width:99%" class="form-control <?php echo $require_pic_title; ?>" value="<?php echo $article_title; ?>" /></td>
              </tr>
            <tr>
            <td> <label for="photo_name">Upload Image: </label> </td>
            <td><input type="file" name="myfile" id="photo_name"  class="form-control" style="width:100%;"   /></td>
            </tr>
            <tr>
            <td nowrap="nowrap"><label><strong>OR</strong> Enter URL/Name:</label></td>
            <td><input type="text" name="image_link" id="image_link" style="width:;" class="width-full" /></td>
            </tr>
            <tr>
            <td nowrap="nowrap"><label for="photo_caption"> Image Summary: </label></td>
            <td colspan="3"><textarea name="photo_caption" id="photo_caption" class="form-control " rows="1"><?php echo $file_caption; ?></textarea> </td>
            </tr>
		</table>
		</div>		
		
		
		
		</td>
	</tr>
	<tr>
		<td nowrap><label for="id_gallery_cat">Gallery Category:</label></td>
			<td>
			<table class="nopadd nomargin" width="100%" border="0">
				<td style="width:270px;">
				<select name="id_gallery_cat" id="id_gallery_cat" class="required" style="width:270px;">
	            <?php echo $ddSelect->dropper_select("mrfc_dt_gallery_category", "id", "title") ?>
	            </select>
				</td>
				<td style="width:150px;text-align:right;"><label>Date: &nbsp;</label></td>
		<td><input type="text" name="date_posted" id="date_posted" value="<?php echo date("Y-m-d"); ?>" class="hasDatePicker half_width required" style="width: ">
				</td>
			</table>	
				
		</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
	<td>&nbsp;</td>
	  <td><input type="submit" name="submitBtn" id="upload"  value="Submit" style="width:270px;" />
			<input type="hidden" name="tags[]" value="" />
			<input type="hidden" name="formname" value="gall_content" />
			<input type="hidden" name="redirect" value="<?php echo "home.php?d=".$dir.""; ?>" />
	</td>	
  </tr>
	</table>
</fieldset>
</form>

</div>
</div>