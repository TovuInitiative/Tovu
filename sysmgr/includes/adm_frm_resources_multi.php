<div style="text-align:left">
<h2 style="font-size:22px; font-weight:normal; text-transform:none">Upload Multiple Files:</h2>
</div>

<!--multiple  accept="audio/*"-->

<div id="order_uploads" style="display:none;">
<textarea style="display:none" id="file_filler">
<tr class="tr_file_{0}">
	<td style="padding:5px 5px 0 0">{0}.</td>
	
	<td>
	<div class="uploader" id="upload_s_card_{0}">
	<input style="opacity: 0;" name="s_card[{0}]" id="s_card_{0}" type="file" class="required" onchange="javascript: setFilename('upload_s_card_{0}', 's_card_{0}', '{0}')" >
	<span style="-moz-user-select: none;" class="filename">No file selected</span>
	<span style="-moz-user-select: none;" class="action">Choose File</span>	
	</div>
	</td>
	
	<td>
	<input type="text" name="file_title[{0}]" id="file_title_{0}"  maxlength="300" class="required" placeholder="File title" style="width:400px;" title="Required"><br>
	<input type="text" name="file_desc[{0}]" id="file_desc_{0}"  maxlength="500" placeholder="File overview or description" style="width:400px;">
	</td>
	<td><select name="language[{0}]" id="language_{0}" class="required" style="width:130px;">
        <option>English</option>
		<option>French</option>
		<option>Swahili</option>
      </select></td>
	<td><input type="text" name="created[{0}]" id="created_{0}" class="date-pick required" style="width: 90px" value="<?php echo $date_posted; ?>" title="Required"></td>
	<td><select name="published[{0}]" id="published_{0}" style="width:50px;">
        <option value="1">Yes</option><option value="0">No</option>
      </select></td>
</tr>
</textarea>
</div>
		
	<?php $alb_id = 1; ?>	


<div style="width:90%; display:block; border:3px solid #e1e1e1; margin:10px auto;">
<form action="adm_posts.php" method="post" enctype="multipart/form-data" name="adm_med_uploader" id="adm_med_uploader" class="stdform">
<input type="hidden" name="formname" value="frm_download_multi" />
<input type="hidden" name="formact" value="_new" />
<input type="hidden" name="artistid" value="<?php echo $us_id; ?>" />
<input type="hidden" name="alb_id" value="<?php echo $alb_id; ?>" />
<input type="hidden" name="alb_box" value="<?php echo $us_ucode; ?>" />
<input type="hidden" name="redirect" value="artist_profile.php?op=list&tk=<?php echo time(); ?>" />
<input type="hidden" name="id_portal" value="1" />
<table width="" border="0" cellspacing="1" cellpadding="5"  style="margin:10px auto; width:99%;">
        <tr>
        	<td></td>
        	<td colspan="5"><?php echo $pgtitle; ?></td>
        	</tr>
       
        <tr>
          <td>&nbsp;</td>
          <td><label>Parent Link</label></td>
          <td colspan="4"><select name="id_parent[]" id="id_parent" multiple="multiple" class="multiple required" style="width:700px">
          <?php echo  $dispData->build_MenuSelectRage(0, $parent_menu);
		  //$dispData->build_MenuSelect($dispData->menuMain_portal, $id_menu, 0 , $parent_menu); ?>
          </select> </td>
          </tr>
		  <tr>
          <td></td>
          <td>Parent Content:</td>
          <td colspan="4">
          <select name="id_content[]" id="id_content" multiple="multiple" class="multiple" style="width:700px">
        <?php 
		if($adm_portal_id == 1) {
		echo $dispData->build_MenuArticles($dispData->contMain, $attachment, 0 , $attachment); 
		} else {
		echo $ddSelect->dropper_select("".$pdb_prefix."dt_content", "id", "title", $attachment); } ?>
      </select>
          </td>
          </tr>
		  </table>
		  <hr>
<table   border="0" cellspacing="0" cellpadding="0" id="file" style="margin:10px auto; width:99%;">
<thead>
<tr id="display_titles">
<td>&nbsp;</td>
<td><label>Resource File:</label></td>
<td><label>Resource Title and Overview: </label></td>
<td><label>Language: </label></td>
<td><label>Publish Date:</label></td>
<td><label>Publish:</label></td>
</tr>
</thead>
<tbody>

</tbody>

<tfoot>
  <tr>
	<td></td>
	<td><a id="del_file" class="nav_button">Cancel [-]</a> </td>
	<td colspan="4" style="text-align:right"><a id="add_file" class="nav_button">Add File [+]</a> </td>
  </tr>
  <tr>
	<td colspan="6">
	<div style="padding:15px; background:#e2e2e2; text-align:center;">
	<input type="submit" name="files_submit" value="UPLOAD RESOURCES" class="submit" style="padding:10px; width:200px;"   />	
	</div>
	</td>
  </tr>
</tfoot>

</table>
</form>
</div>