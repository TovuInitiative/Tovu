<?php
//category.php
include 'connect.php';
include 'header.php';

//first select the category based on $_GET['cat_id']
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			mrfc_forum_categories
		WHERE `cat_current` = 1 and `cat_published` = 1 limit 0, 1; ";
			/*cat_id = " . mysql_real_escape_string($_GET['id']);*/

$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo 'No discussion to display'; 
	//echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'No discussion to display'; //'This category does not exist.';
	}
	else
	{
		
		//display category data
		while($row = $cndb->fetchRow($result))
		{
			$cat_id = $row['cat_id'];
			echo '<h2>Discussion: ' . trim(html_entity_decode(stripslashes($row['cat_name']))) . '</h2>';
			echo '<div><h4>Description:</h4>' . trim(html_entity_decode(stripslashes($row['cat_description']))) . '</div>';
			echo '<br><br><h3>Questions / Topics in &prime;' . trim(html_entity_decode(stripslashes($row['cat_name']))) . '&prime; </h3>';
		}
	
		//do a query for the topics
		$sqlXX = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					mrfc_forum_topics
				WHERE
					topic_cat = " . q_si($cat_id);
		
		$sql = "SELECT
    `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , `mrfc_forum_topics`.`topic_cat`
    , COUNT(`mrfc_forum_posts`.`post_id`) AS `topic_posts`
FROM
    `mrfc_forum_topics`
    LEFT JOIN `mrfc_forum_posts` 
        ON (`mrfc_forum_topics`.`topic_id` = `mrfc_forum_posts`.`post_topic`)
WHERE (`mrfc_forum_topics`.`topic_cat` = ".q_si($cat_id).")
GROUP BY `mrfc_forum_topics`.`topic_id`, `mrfc_forum_topics`.`topic_subject`;";
		
		$result = $cndb->dbQuery($sql);
		
		if(!$result)
		{
			echo 'The topics could not be displayed, please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				echo 'There are no topics in this category yet.';
			}
			else
			{
				//prepare the table
				echo '<table border="1">
					  <!--<tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>-->';	
					
				while($row = $cndb->fetchRow($result))
				{				
					echo '<tr>';
						echo '<td class="leftpartX">';
							echo '<h3 class="notransform"><a href="topic.php?id=' . $row['topic_id'] . '">' . trim(html_entity_decode(stripslashes($row['topic_subject']))) . '</a><h3>' . $row['topic_posts'] . ' contributions ';
						echo '</td>';
						//echo '<td class="rightpart">';
						//	echo ''; //date('d-m-Y, H:i', strtotime($row['topic_date']));
						//echo '</td>';
					echo '</tr>';
				}
				
				echo '</table>';
			}
		}
	}
}

include 'footer.php';
?>
