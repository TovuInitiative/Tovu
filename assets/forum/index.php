<?php
//create_cat.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
			mrfc_forum_categories.cat_id,
			mrfc_forum_categories.cat_name,
			mrfc_forum_categories.cat_description,
			COUNT(mrfc_forum_topics.topic_id) AS topics
		FROM
			mrfc_forum_categories
		LEFT JOIN
			mrfc_forum_topics
		ON
			mrfc_forum_topics.topic_cat = mrfc_forum_categories.cat_id
		GROUP BY
			 mrfc_forum_categories.cat_id";
		//mrfc_forum_categories.cat_name, mrfc_forum_categories.cat_description,
$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo 'The categories could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'No categories defined yet.';
	}
	else
	{
		//prepare the table
		echo '<table border="1">
			  <tr>
				<th>Category</th>
				<th>Topics</th>
				<th>Posts</th>
				<th>Last Post</th>
			  </tr>';	
			
		while($row = $cndb->fetchRow($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
				echo '</td>';
				echo '<td>' . $row['topics'] . '</td>';	//Topics
				echo '<td>';
				
				//fetch posts
				$postssql = "SELECT `mrfc_forum_topics`.`topic_cat`, COUNT(`mrfc_forum_posts`.`post_id`) AS `posts` FROM `mrfc_forum_posts` INNER JOIN `mrfc_forum_topics` ON (`mrfc_forum_posts`.`post_topic` = `mrfc_forum_topics`.`topic_id`) WHERE (`mrfc_forum_topics`.`topic_cat` = " . $row['cat_id'] . ") GROUP BY `mrfc_forum_topics`.`topic_cat`;";
							
				$postsresult = $cndb->dbQuery($postssql);
				$postsrow = $cndb->fetchRow($postsresult);
				echo $postsrow['posts'];					
				echo '</td>';	//Posts
				echo '<td class="rightpart">';
				
				$topicsql = "SELECT
    `mrfc_forum_categories`.`cat_id`
    , `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_posts`.`post_id`
    , `mrfc_forum_posts`.`post_content`
    , `mrfc_forum_posts`.`post_date`
    , `mrfc_forum_posts`.`post_by`
    , concat_ws(' ',`".$pdb_prefix."reg_account`.`namefirst`, `".$pdb_prefix."reg_account`.`namelast`) as `name`
FROM
    `mrfc_forum_topics`
    LEFT JOIN `mrfc_forum_categories` 
        ON (`mrfc_forum_topics`.`topic_cat` = `mrfc_forum_categories`.`cat_id`)
    INNER JOIN `mrfc_forum_posts` 
        ON (`mrfc_forum_posts`.`post_topic` = `mrfc_forum_topics`.`topic_id`)
    LEFT JOIN `".$pdb_prefix."reg_account` 
        ON (`mrfc_forum_posts`.`post_by` = `".$pdb_prefix."reg_account`.`account_id`)
WHERE (`mrfc_forum_categories`.`cat_id` = " . $row['cat_id'] . " and `mrfc_forum_posts`.`post_published` = 1)
ORDER BY `mrfc_forum_topics`.`topic_date` DESC, `mrfc_forum_posts`.`post_date` DESC LIMIT 1;";
								
					$topicsresult = $cndb->dbQuery($topicsql);
				
					if(!$topicsresult)
					{
						echo 'Last topic could not be displayed.';
					}
					else
					{
						if(mysqli_num_rows($topicsresult) == 0)
						{
							echo 'no topics';
						}
						else
						{
							while($topicrow = $cndb->fetchRow($topicsresult)) 
							{
								
							//$post_content = smartTruncate(strip_tags($topicrow['post_content']),40);
							$post_content = substr($topicrow['post_content'],0,40);
							echo '<a href="topic.php?id=' . $topicrow['topic_id'] . '#' . $topicrow['post_id'] . '">' . $post_content . '</a> at ' . date('d-m-Y', strtotime($topicrow['post_date']));
							}
						}
					}
				echo '</td>';
			echo '</tr>';
		}
		
		echo '</table>';
	}
}

include 'footer.php';
?>
