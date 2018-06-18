<?php
//create_cat.php
include 'connect.php';
include 'header.php';


include("inc.forum.topic.php");

$sql = "SELECT
			topic_id,
			topic_subject
		FROM
			mrfc_forum_topics
		WHERE
			mrfc_forum_topics.topic_id = " . q_si($_GET['id']);
			
$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo 'The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = $cndb->fetchRow($result))
		{
			//display post data
			echo '<table class="topic" border="1">
					<tr>
						<th colspan="2">' . $row['topic_subject'] . '</th>
					</tr>';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						mrfc_forum_posts.post_topic,
						mrfc_forum_posts.post_content,
						mrfc_forum_posts.post_date,
						mrfc_forum_posts.post_by,
						mrfc_forum_users.user_id,
						mrfc_forum_users.user_name,
						mrfc_forum_posts.post_id
					FROM
						mrfc_forum_posts
					LEFT JOIN
						mrfc_forum_users
					ON
						mrfc_forum_posts.post_by = mrfc_forum_users.user_id
					WHERE
						mrfc_forum_posts.post_topic = " . q_si($_GET['id']);
				//echobr($posts_sql);		
			$posts_result = $cndb->dbQuery($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = $cndb->fetchRow($posts_result))
				{
					$user_name = substr($posts_row['user_name'],0,strpos($posts_row['user_name'],"@"));
					
					echo '<tr class="topic-post">
							<td class="post-user">by <strong>' .$user_name. '</strong><br/>' . date('F j, Y, H:i', strtotime($posts_row['post_date'])) . '</td>
							<td class="post-content"><a id="'.$posts_row['post_id'].'"></a>' . html_entity_decode(stripslashes(nl2br($posts_row['post_content']))) . '</td>
						  </tr>';
						  //htmlentities(stripslashes(nl2br($posts_row['post_content'])))
				}
			}
			
			if(!$_SESSION['sess_mrfc_member']['signed_in'])
			{
				echo '<tr><td colspan=2>You must be <a href="signin.php">signed in</a> to reply. You can also <a href="signup.php">sign up</a> for an account.';
			}
			else
			{
				//show reply box
				echo '<tr><td colspan="2"><h2>Reply / Post Comment:</h2>
					<form method="post" action="reply.php?id=' . $row['topic_id'] . '">
						<textarea name="reply-content"></textarea><br />
						<input type="hidden" name="topic_subject" value="' . $row['topic_subject'] . '" />
						<input type="submit" value="Submit Reply" />
					</form></td></tr>';
			}
			
			//finish the table
			echo '</table>';
		}
	}
}

include 'footer.php';
?>