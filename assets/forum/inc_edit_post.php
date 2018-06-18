
  
<?php

$sq_edit = "SELECT
    `mrfc_forum_posts`.`post_id`
    , `mrfc_forum_posts`.`post_date`
    , `mrfc_forum_posts`.`post_content`
    , `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `post_owner`
    , `mrfc_forum_posts`.`post_published`
FROM
    `mrfc_forum_posts`
    INNER JOIN `mrfc_forum_topics` 
        ON (`mrfc_forum_posts`.`post_topic` = `mrfc_forum_topics`.`topic_id`)
    LEFT JOIN `".$pdb_prefix."reg_account` 
        ON (`mrfc_forum_posts`.`post_by` = `".$pdb_prefix."reg_account`.`account_id`)
WHERE (`mrfc_forum_posts`. `post_id` = ".q_si($fpost).") ; ";

$rs_edit = $cndb->dbQuery($sq_edit);
			
if($rs_edit)
{
	$cn_edit 		   = $cndb->fetchRow($rs_edit);

	$post_id		  = $cn_edit['post_id'];
	$post_date		  = date('d-m-Y', strtotime($cn_edit['post_date']));
	$post_content  		= trim(html_entity_decode(stripslashes($cn_edit['post_content'])));
	$topic_subject  		= trim(html_entity_decode(stripslashes($cn_edit['topic_subject'])));
	$post_pub		  = $cn_edit['post_published'];
	$post_owner	      = trim(html_entity_decode(stripslashes($cn_edit['post_owner'])));
	
	$post_published_y   = '';
	$post_published_n   = '';
	if($post_pub == 1) { $post_published_y = ' checked '; $post_published = '<strong>Yes</strong>'; }
	if($post_pub == 0) { $post_published_n = ' checked '; $post_published = '<strong>No</strong>'; }	//value="0"
		
}

		
?>
<form method="post" action="manager_posts.php" class="fm_base" name="edit_posts" id="edit_posts">
<input type="hidden" name="formname" value="forum_edit_posts" />
<input type="hidden" name="post_id" value="<?php echo $post_id; ?>" /> 

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tims">
	<tr>
		<td style="width:150px;">Post Brief</td>
		<td>by <strong><?php echo $post_owner; ?></strong> - <?php echo $post_date; ?></td>
	</tr>
	<tr>
		<td>Post Contents</td>
		<td>
		<?php
		if( $member_is_admin == 1){ 		
		?>
		<textarea name="post_content" id="post_content" class="wysiwyg" style="height:300px" /><?php echo $post_content; ?></textarea>
		<?php
		} else { echo $post_content; }
		?>
		
		</td>
	</tr>
	
	
	<tr>
		<td>Parent Topic</td>
		<td><?php echo $topic_subject; ?></td>
	</tr>
	
	
	<?php
		if( $member_is_admin == 1){ 		
	?>
	<tr>
		<td nowrap="nowrap">Publish Post:</td>
		<td>
		<label><input type="radio" id="published_y" name="published" <?php echo $post_published_y; ?> value="on" class="radio"/> Yes</label>
		<label><input type="radio" id="published_n" name="published" <?php echo $post_published_n; ?> value="off" class="radio"/> No</label>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="Submit" /></td>
	</tr>
	
	<?php
		} else { 		
	?>
	<tr>
		<td>Post Approved:</td>
		<td><?php echo $post_published; ?></td>
	</tr>
	
	<?php
		}  		
	?>
</table>
</form>