
<?php
$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			mrfc_forum_categories
		WHERE
			cat_id = " . q_si($_GET['id']) . " and `cat_published` = 1";

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
			$cat_name = 'Topics under: ' . $row['cat_name'] . '';
			echo display_PageTitle($cat_name, 'h2', 'noborder');
			//echo '<h2>Topics in &prime;' . trim(html_entity_decode(stripslashes($row['cat_name']))) . '&prime; category</h2>';
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
					topic_cat = " . q_si($_GET['id']) . " AND `topic_published` =1; ";
		
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
					$topic_subject = trim(html_entity_decode(stripslashes($row['topic_subject'])));		
					echo '<tr>';
						echo '<td class="leftpart txt14">';
							echo '<div class=""><a href="'.REF_ACTIVE_URL.'fc=topic&id=' . $row['topic_id'] . '">' . $topic_subject . '</a><br /><div>';
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
?>
