<?php
$topic_cat_head = '<th>Category</th>';
$crit_list 	  = "";
if($fcat) 
{
	/* ====== #PARENT ======= */
	$sq_parent = "SELECT `cat_id`, `cat_name` FROM `mrfc_forum_categories` WHERE `cat_id` = ".q_si($fcat)." ;";
	$rs_parent = $cndb->dbQuery($sq_parent);
	$cn_parent = $cndb->fetchRow($rs_parent);
	//<h3 class="inline">CATEGORY:</h3>
	echo '<div> <span class="header_lists">"'.trim(html_entity_decode(stripslashes($cn_parent['cat_name']))).'"</span></div> ';	
	/* ====== END #PARENT ======= */
	 
	$crit_list = " WHERE (`mrfc_forum_topics`.`topic_cat` = ".q_si($fcat).") "; 
	$topic_cat_head = '';
}

echo '<h3>Topic List'; 

if($level_front_admin == true) 
{ 
?>
		<div class="menu inline float_right width_auto txt75 notransform">
		<a class="item" href="create_topic.php">Create Topic</a></div>
<?php
}
echo '</h3>';


$sq_list = "SELECT
    `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , COUNT(`mrfc_forum_posts`.`post_id`) AS `topic_posts`
    , `mrfc_forum_topics`.`topic_date`
    , `mrfc_forum_topics`.`topic_cat`
    , `mrfc_forum_topics`.`topic_published`
	, `mrfc_forum_categories`.`cat_name`
FROM
    `mrfc_forum_topics`
    LEFT JOIN `mrfc_forum_posts` 
        ON (`mrfc_forum_topics`.`topic_id` = `mrfc_forum_posts`.`post_topic`)
	INNER JOIN `mrfc_forum_categories` 
        ON (`mrfc_forum_topics`.`topic_cat` = `mrfc_forum_categories`.`cat_id`)
	 ". $crit_list ."
GROUP BY `mrfc_forum_topics`.`topic_id`, `mrfc_forum_topics`.`topic_subject`
ORDER BY `mrfc_forum_topics`.`topic_cat` ASC, `mrfc_forum_topics`.`topic_id` ASC;";

$rs_list = $cndb->dbQuery($sq_list);
			
if(!$rs_list)
{
	echo '<p>Topic list could not be displayed, please try again later.</p>';
}
else
{
	echo '<table class="topic" border="1">
		<tr>
			<th style="width:60%">Topic</th>
			<th style="min-width:10%">Posts</th>
			' .$topic_cat_head. '
			<th style="min-width:5%">Pub</th>
			<th style="min-width:5%">&nbsp;</th>
		</tr>';
					
	while($cn_list = $cndb->fetchRow($rs_list))
	{
		$topic_id		  = $cn_list['topic_id'];
		$topic_name  		= trim(html_entity_decode(stripslashes($cn_list['topic_subject'])));
		$topic_pub		 = $cn_list['topic_published'];
		$topic_posts	   = $cn_list['topic_posts'];
		$topic_cat		 = '';
		
		if($fcat == '') {
		$topic_cat  		 = '<td>'.trim(html_entity_decode(stripslashes($cn_list['cat_name']))) . '</td>';
		}
		
		
		if($topic_pub == 0) { $topic_pub = '<img src="image/off.png" />'; }
		if($topic_pub == 1) { $topic_pub = '<img src="image/on.png" />'; }
		
		$list_posts		= '';
		if($topic_posts > 0) { 
			$list_posts = '&nbsp; - <a href="manager.php?fitm=posts&fopt=list&ftopic=' .$topic_id. '">view</a>'; 
		}
		//topic.php?id=' .$topic_id. '
		$topic_link = '<div class="jtrunc"><a href="#">' .$topic_name. '</a></div>'; 
		
		$topic_edit = '';
		if( $member_is_admin == 1){ 
		$topic_edit = '<a href="manager.php?fitm=topic&fopt=edit&ftopic=' .$topic_id. '">Edit</a>'; }
		
		echo '<tr>
				<td>' .$topic_link. '</td>
				<td nowrap>' .$topic_posts . $list_posts. '</td>
				' .$topic_cat. '
				<td>' .$topic_pub. '</td>
				<td>' .$topic_edit. '</td>
			  </tr>';
	}
	
	echo '</table>';
}
//&radic; = √ 
?> 