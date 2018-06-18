<?php
//create_topic.php
include 'connect.php';
include 'header.php';

echo '<h2>Create a topic</h2>';

if(!isset($sys_us_admin) or $member_is_admin == 0)
{
	//the user is not signed in
	echo 'Sorry, you have to be <a href="#">signed in</a> to create a topic.';
}
else
{
	//the user is signed in
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{	
		//the form hasn't been posted yet, display it
		//retrieve the categories from the database for use in the dropdown
		$sql = "SELECT
					cat_id,
					cat_name,
					cat_description
				FROM
					mrfc_forum_categories where cat_published = 1";
		
		$result = $cndb->dbQuery($sql);
		
		if(!$result)
		{
			//the query failed, uh-oh :-(
			echo 'Error while selecting from database. Please try again later.';
		}
		else
		{
			if(mysqli_num_rows($result) == 0)
			{
				//there are no categories, so a topic can't be posted
				if($member_is_admin == 1)
				{
					echo 'You have not created categories yet.';
				}
				else
				{
					echo 'Before you can post a topic, you must wait for an admin to create some categories.';
				}
			}
			else
			{
		
				echo '<form method="post" action="">
					Subject: <input type="text" name="topic_subject" /><br />
					Category:'; 
				
				echo '<select name="topic_cat">';
					while($row = $cndb->fetchRow($result))
					{
						echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
					}
				echo '</select><br />';	
					
				echo 'Description: <br /><textarea name="post_content" /></textarea><br /><br />
					<input type="submit" value="Create topic" />
				 </form>';
			}
		}
	}
	else
	{
		//start the transaction
		$query  = "BEGIN WORK;";
		$result = $cndb->dbQuery($query);
		
		if(!$result)
		{
			//Damn! the query failed, quit
			echo 'An error occured while creating your topic. Please try again later.';
		}
		else
		{
	
			//the form has been posted, so save it
			//insert the topic into the topics table first, then we'll save the post into the posts table
			$sql = "INSERT INTO 
						mrfc_forum_topics(topic_subject,
							   topic_description,
							   topic_date,
							   topic_cat,
							   topic_by)
				   VALUES(" . q_si($_POST['topic_subject']) . ",
				   	      " . q_si($_POST['post_content']) . ",
							   NOW(),
							   " . q_si($_POST['topic_cat']) . ",
							   " . q_si($sys_us_admin['admin_id']) . "
							   )";
					 
			$result = $cndb->dbQuery($sql);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'An error occured while inserting your data. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = $cndb->dbQuery($sql);
			}
			else
			{
				//the first query worked, now start the second, posts query
				//retrieve the id of the freshly created topic for usage in the posts query
				$topicid = mysql_insert_id();
				
				$sql = "COMMIT;";
				$result = $cndb->dbQuery($sql);
					
				echo 'You have succesfully created your new topic. <a href="manager.php?fitm=topic&fopt=list"> View Topics</a>.';
				
				/*
				$sql = "INSERT INTO
							mrfc_forum_posts(post_content,
								  post_date,
								  post_topic,
								  post_by)
						VALUES
							('" . mysql_real_escape_string($_POST['post_content']) . "',
								  NOW(),
								  " . $topicid . ",
								  " . $sys_us_admin['admin_id'] . "
							)";
				$result = $cndb->dbQuery($sql);
				
				if(!$result)
				{
					//something went wrong, display the error
					echo 'An error occured while inserting your post. Please try again later.<br /><br />' . mysql_error();
					$sql = "ROLLBACK;";
					$result = $cndb->dbQuery($sql);
				}
				else
				{
					$sql = "COMMIT;";
					$result = $cndb->dbQuery($sql);
					
					//after a lot of work, the query succeeded!
					echo 'You have succesfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
				}*/
			}
		}
	}
}

include 'footer.php';
?>
