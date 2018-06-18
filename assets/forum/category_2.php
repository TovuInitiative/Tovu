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
		WHERE
			cat_id = " . q_si($_GET['id']);

$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This category does not exist.';
	}
	else
	{
		//display category data
		while($row = $cndb->fetchRow($result))
		{
			echo '<h2>Topics in &prime;' . $row['cat_name'] . '&prime; category</h2>';
		}
	
		//do a query for the topics
		$sql = "SELECT	
					topic_id,
					topic_subject,
					topic_date,
					topic_cat
				FROM
					mrfc_forum_topics
				WHERE
					topic_cat = " . q_si($_GET['id']);
		
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
					  <tr>
						<th>Topic</th>
						<th>Created at</th>
					  </tr>';	
					
				while($row = $cndb->fetchRow($result))
				{				
					echo '<tr>';
						echo '<td class="leftpart">';
							echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><br /><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y, H:i', strtotime($row['topic_date']));
						echo '</td>';
					echo '</tr>';
				}
				
				echo '</table>';
			}
		}
	}
}

include 'footer.php';
?>
