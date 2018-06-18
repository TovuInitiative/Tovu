<?php
$topic_cat_head = '<th style="min-width:25%">Topic</th>';
$crit_list 	  = " WHERE `mrfc_forum_posts`.`post_id` > '0' ";


if($ftopic) 
{ 
	/* ====== #PARENT ======= */
	
	$sq_parent = "SELECT `topic_id`, `topic_subject` FROM `mrfc_forum_topics` WHERE `topic_id` = ".q_si($ftopic)." ;";
	$rs_parent = $cndb->dbQuery($sq_parent);
	$cn_parent = $cndb->fetchRow($rs_parent);
	echo '<div style="margin-bottom:15px;"><h3 class="inline">TOPIC:</h3> <span class="header_lists">"'.trim(html_entity_decode(stripslashes($cn_parent['topic_subject']))).'"</span></div> ';	
	
	/* ====== END #PARENT ======= */
				
	$crit_list .= " and (`mrfc_forum_topics`.`topic_id` = ".q_si($ftopic).") "; 
	$topic_cat_head = '';
}

if( $us_type_id == 3)
{ 
	$crit_list .= " and (`mrfc_forum_posts`.`post_by` = ".q_si($_SESSION['sess_mrfc_member']['ac_id']).") "; 
}
		
		
echo '<h3>Member Posts</h3>';


$sq_list = "SELECT
    `mrfc_forum_posts`.`post_id`
    , `mrfc_forum_posts`.`post_date`
    , `mrfc_forum_posts`.`post_content`
    , `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `post_by_name`
	, `mrfc_forum_posts`.`post_by`
    , `mrfc_forum_posts`.`post_published`
FROM
    `mrfc_forum_posts`
    INNER JOIN `mrfc_forum_topics` 
        ON (`mrfc_forum_posts`.`post_topic` = `mrfc_forum_topics`.`topic_id`)
    LEFT JOIN `".$pdb_prefix."reg_account` 
        ON (`mrfc_forum_posts`.`post_by` = `".$pdb_prefix."reg_account`.`account_id`) 
	 ". $crit_list ."
ORDER BY `mrfc_forum_posts`.`post_date` DESC, `mrfc_forum_posts`.`post_published` ASC;";
//echo $sq_list;
$rs_list = $cndb->dbQuery($sq_list);
			
if(!$rs_list)
{
	echo '<p>No posts to be displayed, please try again later.</p>';
}
else
{
	/*echo '<form action="#" method="post" id="adm_forum_posts">
		<div style="padding:10px;"><label><input type="checkbox" name="check_all" id="check_all" > Check All &nbsp; &nbsp; &nbsp;</label>
		<select name="fm_selection" id="fm_selection">
		<option value="" selected="selected">With Selected</option>
		<option value="posts_approve">Publish</option>		
		</select>
		<input type="submit" value="go" />
		</div>
	';*/
	
	echo '<table class="topic tims" border="1">
		<tr>
			<th style="min-width:10%">Post Date</th>
			<th>Post</th>
			<th style="min-width:15%">By</th>
			' .$topic_cat_head. '
			<th style="min-width:5%" title="Published">Published</th>
			<th></th>
		</tr>';
					
	while($cn_list = $cndb->fetchRow($rs_list))
	{
		$post_id		  = $cn_list['post_id'];
		$post_date		  = date('M d Y H:i', strtotime($cn_list['post_date']));
		$post_content  	 = strip_tags(trim(html_entity_decode(stripslashes($cn_list['post_content']))));
		$post_owner  	    = trim(html_entity_decode(stripslashes($cn_list['post_by_name'])));
		$post_pub		 = $cn_list['post_published'];
		$post_by	      = $cn_list['post_by'];
		$topic_id		  = $cn_list['topic_id'];
		
		$topic_subject   = substr(trim(html_entity_decode(stripslashes($cn_list['topic_subject']))),0,50);
		
			$post_topic	   = '';
		if($ftopic == '') {
		$post_topic  = '<td><div class="jtrunc">'.$topic_subject .'</div></td>';
		}
		
		
		if($post_pub == 0) { $post_pub = '<img src="image/off.png" />'; }
		if($post_pub == 1) { $post_pub = '<img src="image/on.png" />'; }
		
		
		$post_item = '<div class="jtrunc">' .$post_content. '<a href="topic.php?id=' .$topic_id. '"></a></div>'; 
		
		$post_edit = '';
		if( $member_is_admin == 1){ }
		$post_edit = '<a href="manager.php?fitm=posts&fopt=edit&fpost=' .$post_id. '">View</a>'; 
		
		
		echo '<tr>
				<td>' .$post_date. '</td>
				<td>' .$post_item. '</td>
				<td>' .$post_owner. '</td>
				' .$post_topic. '
				<td>' .$post_pub. '</td>
				<td>' .$post_edit. '</td>
			  </tr>';
	}
	
	echo '</table>';
}
//&radic; = √ 
?> 