<?php

 
echo '<h3>Category List'; 

if($level_front_admin == true) 
{ 
?>
		<div class="menu inline float_right width_auto txt75 notransform">
		<a class="item" href="create_cat.php">Create Category</a></div>
<?php
}

echo '</h3>';
		
		
		
		
$sq_list = "SELECT
    `mrfc_forum_categories`.`cat_id`
    , `mrfc_forum_categories`.`cat_name`
    , `mrfc_forum_categories`.`cat_current`
    , `mrfc_forum_categories`.`cat_published`
    , COUNT(`mrfc_forum_topics`.`topic_id`) AS `cat_topics`
    , `mrfc_forum_categories`.`cat_by`
    , `mrfc_forum_categories`.`cat_date_close`
FROM
    `mrfc_forum_categories`
    LEFT JOIN `mrfc_forum_topics` 
        ON (`mrfc_forum_categories`.`cat_id` = `mrfc_forum_topics`.`topic_cat`)
GROUP BY `mrfc_forum_categories`.`cat_id`
ORDER BY `mrfc_forum_categories`.`cat_current` DESC;";

$rs_list = $cndb->dbQuery($sq_list);
			
if(!$rs_list)
{
	echo '<p>Category list could not be displayed, please try again later.</p>';
}
else
{
	echo '<table class="topic" border="1">
		<tr>
			<th>Category</th>
			<th>Topics</th>
			<th>Pub</th>
			<th>&nbsp;</th>
		</tr>';
					
	while($cn_list = $cndb->fetchRow($rs_list))
	{
		$cat_id		  = $cn_list['cat_id'];
		$cat_name  		= trim(html_entity_decode(stripslashes($cn_list['cat_name'])));
		$cat_current	 = $cn_list['cat_current'];
		$cat_pub		 = $cn_list['cat_published'];
		$cat_topics	  = $cn_list['cat_topics'];
		
		$cat_feature	 = '';
		$list_topics	 = '';
		
		if($cat_pub == 0) { $cat_pub = '<img src="image/off.png" />'; }
		if($cat_pub == 1) { $cat_pub = '<img src="image/on.png" />'; }
		if($cat_current == 1) { $cat_feature = ' <span class="cat_current">FEATURED</span> &nbsp;'; }
		
		
		if($cat_topics > 0) { 
			$list_topics = '&nbsp; - <a href="manager.php?fitm=topic&fopt=list&fcat=' .$cat_id. '">view</a>'; 
		}
		
		//category.php?id=' .$cat_id. '
		$cat_link = '<a href="#">' .$cat_name. '</a>'; 
		
		$cat_edit = '';
		if( $member_is_admin == 1)
		{ $cat_edit = '<a href="manager.php?fitm=cat&fopt=edit&fcat=' .$cat_id. '">Edit</a>'; }
		
		
		echo '<tr>
				<td>' .$cat_feature . $cat_link. '</td>
				<td>' .$cat_topics . $list_topics .'</td>
				<td>' .$cat_pub. '</td>
				<td>' .$cat_edit. '</td>
			  </tr>';
	}
	
	echo '</table>';
}

?>