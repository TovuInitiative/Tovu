
  
<?php

$sq_edit = "SELECT `topic_id`, `topic_subject`, `topic_date`, `topic_cat`, `topic_by`, `topic_published`, `topic_description` FROM `mrfc_forum_topics` WHERE `topic_id` = ".q_si($ftopic)." ";

$rs_edit = $cndb->dbQuery($sq_edit);
			
if($rs_edit)
{
	$cn_edit = $cndb->fetchRow($rs_edit);

	$topic_id		  = $cn_edit['topic_id'];
	$topic_subject  		= trim(html_entity_decode(stripslashes($cn_edit['topic_subject'])));
	$topic_description  		= trim(html_entity_decode(stripslashes($cn_edit['topic_description'])));
	$topic_pub		 = $cn_edit['topic_published'];
	$topic_by	      = $cn_edit['topic_by'];
	$topic_cat	      = $cn_edit['topic_cat'];
	
	$topic_published   = '';
	if($topic_pub == 1) { $topic_published = ' checked '; }
	
	
}

$sql = "SELECT cat_id, cat_name FROM mrfc_forum_categories where cat_published = 1";
$result = $cndb->dbQuery($sql);
		
?>
<form method="post" action="manager_posts.php" class="fm_base" name="edit_topic" id="edit_topic">
<input type="hidden" name="formname" value="forum_edit_topic" />
<input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>" />
<input type="hidden" name="topic_by" value="<?php echo $_SESSION['sess_mrfc_member']['ac_id']; ?>" /> <?php /*?>$cat_by<?php */?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Topic Subject:</td>
		<td>
		<input type="text" name="topic_subject" id="topic_subject" value="<?php echo $topic_subject; ?>" />
		<?php /*?><textarea name="topic_subject" id="topic_subject" /><?php echo $topic_subject; ?></textarea><?php */?>
		</td>
	</tr>
	
	<tr>
		<td>Topic description:</td>
		<td><textarea name="topic_description" id="topic_description" class="wysiwyg" style="height:150px" /><?php echo $topic_description; ?></textarea></td>
	</tr>
	<tr>
		<td>Category:</td>
		<td><select name="topic_cat">
		<option value=""></option>
		<?php  while($row = $cndb->fetchRow($result))
			   { if($topic_cat == $row['cat_id']) {$opsel = " selected";} else { $opsel = ""; }
			   echo '<option value="' . $row['cat_id'] . '" ' . $opsel . '>' . $row['cat_name'] . '</option>'; } ?>
		</select></td>
	</tr>
	<tr>
		<td>Is Published:</td>
		<td><label><input type="checkbox" id="published" name="published" <?php echo $topic_published; ?> class="radio"/> </label></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Save Topic" /></td>
	</tr>
</table>
</form>