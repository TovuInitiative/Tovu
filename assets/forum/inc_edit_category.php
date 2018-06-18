
  
<?php

$sq_edit = "SELECT `cat_id`, `cat_name`, `cat_description`, `cat_current`, `cat_published`, `cat_by`, `cat_date_start`, `cat_date_close` FROM `mrfc_forum_categories` WHERE `cat_id` = ".q_si($fcat)." ";

$rs_edit = $cndb->dbQuery($sq_edit);
			
if($rs_edit)
{
	$cn_edit = $cndb->fetchRow($rs_edit);

	$cat_id		  = $cn_edit['cat_id'];
	$cat_name  		= trim(html_entity_decode(stripslashes($cn_edit['cat_name'])));
	$cat_desc  		= trim(html_entity_decode(stripslashes($cn_edit['cat_description'])));
	$cat_current	 = $cn_edit['cat_current'];
	$cat_pub		 = $cn_edit['cat_published'];
	$cat_by	      = $cn_edit['cat_by'];
	
	$cat_published   = '';
	if($cat_pub == 1) { $cat_published = ' checked '; }
	
	$cat_featured   = '';
	if($cat_current == 1) { $cat_featured = ' checked '; }
}

?>
<form method="post" action="manager_posts.php" class="fm_base" name="edit_category" id="edit_category">
<input type="hidden" name="formname" value="forum_edit_cat" />
<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" />
<input type="hidden" name="cat_by" value="<?php echo $_SESSION['sess_mrfc_member']['ac_id']; ?>" /> <?php /*?>$cat_by<?php */?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Category name:</td>
		<td><input type="text" name="cat_name" id="cat_name" value="<?php echo $cat_name; ?>" /></td>
	</tr>
	<tr>
		<td>Category description:</td>
		<td><textarea name="cat_description" id="cat_description" class="wysiwyg" style="height:150px" /><?php echo $cat_desc; ?></textarea></td>
	</tr>
	<tr>
		<td>Is Featured:</td>
		<td><label><input type="checkbox" id="cat_current" name="cat_current" <?php echo $cat_featured; ?> class="radio"/> </label></td>
	</tr>
	<tr>
		<td>Is Published:</td>
		<td><label><input type="checkbox" id="published" name="published" <?php echo $cat_published; ?> class="radio"/> </label></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Save Category" /></td>
	</tr>
</table>
</form>