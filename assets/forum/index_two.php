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
			mrfc_forum_topics.topic_id = mrfc_forum_categories.cat_id
		GROUP BY
			mrfc_forum_categories.cat_name, mrfc_forum_categories.cat_description, mrfc_forum_categories.cat_id";

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
				<th>Categories</th>
				<th>&nbsp;</th>
			  </tr>';	
			
		while($row = $cndb->fetchRow($result))
		{				
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>';
					// . $row['cat_description']
					
					
					//fetch last topic for each cat
					/*$topicsql = "SELECT
									topic_id,
									topic_subject,
									topic_date,
									topic_cat
								FROM
									mrfc_forum_topics
								WHERE
									topic_cat = " . $row['cat_id'] . "
								ORDER BY
									topic_date
								DESC
								LIMIT
									5";*/
					
					$topicsql = "SELECT
    `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , `mrfc_forum_topics`.`topic_date`
    , `mrfc_forum_topics`.`topic_cat`
    , `mrfc_forum_users`.`user_id`
    , `mrfc_forum_users`.`user_name`
FROM
    `mrfc_forum_topics`
    INNER JOIN `mrfc_forum_users` 
        ON (`mrfc_forum_topics`.`topic_by` = `mrfc_forum_users`.`user_id`)
WHERE (`mrfc_forum_topics`.`topic_cat` = " . $row['cat_id'] . ")
ORDER BY `mrfc_forum_topics`.`topic_date` DESC LIMIT 5";
												
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
							echo '<h4>LATEST TOPICS:</h4>';
							while($topicrow = $cndb->fetchRow($topicsresult)) {
							$user_name = substr($topicrow['user_name'],0,strpos($topicrow['user_name'],"@"));	//ucwords()
							echo '<div class="thread"><a href="topic.php?id=' . $topicrow['topic_id'] . '">' . $topicrow['topic_subject'] 
							. '</a> - <b>' . $user_name . '</b>, ' . date('M d Y,  H:i', strtotime($topicrow['topic_date'])) .'</div>';
							}
						}
					}
					
					
				echo '</td>';
				echo '<td class="rightpart">';				
				echo '</td>';
			echo '</tr>';
		}
		
		echo '</table>';
	}
}

include 'footer.php';
?>
