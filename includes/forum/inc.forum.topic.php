
<?php
$sql = "SELECT
    `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_topics`.`topic_subject`
    , `mrfc_forum_categories`.`cat_id`
    , `mrfc_forum_categories`.`cat_name`
	, `mrfc_forum_topics`.`topic_description`
FROM
    `mrfc_forum_topics`
    INNER JOIN `mrfc_forum_categories` 
        ON (`mrfc_forum_topics`.`topic_cat` = `mrfc_forum_categories`.`cat_id`)
	WHERE
			mrfc_forum_topics.topic_id = " . q_si($_GET['id']);
			
$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo '<h1>Forums</h1> The topic could not be displayed, please try again later.';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo '<h1>Forums</h1> This topic doesn&prime;t exist.';
	}
	else
	{
		while($row = $cndb->fetchRow($result))
		{
			//display post data
			echo '<div class="section-title"><h2 class="noborder"><span>Forum: "' . clean_output($row['cat_name']) . '"</span></h2></div>';
			echo '<h2 class="section-title padd5_t txt21">Topic: "' .clean_output( $row['topic_subject']) . '"</h2>
				<div class="padd15_t">' . clean_output($row['topic_description']) . '</div>
				<div class="padd15"></div>
				
				<table class="topic table" border="0">';
		
			//fetch the posts from the database
			$posts_sql = "SELECT
						mrfc_forum_posts.post_topic,
						mrfc_forum_posts.post_content,
						mrfc_forum_posts.post_date,
						mrfc_forum_posts.post_by,
						mrfc_reg_account.account_id,
						mrfc_reg_account.namefirst as `name`,
						mrfc_forum_posts.post_id
					FROM
						mrfc_forum_posts
					LEFT JOIN
						mrfc_reg_account
					ON
						mrfc_forum_posts.post_by = mrfc_reg_account.account_id
					WHERE
						mrfc_forum_posts.post_topic = " . q_si($_GET['id']) . " and mrfc_forum_posts.post_published = 1; ";
					
			$posts_result = $cndb->dbQuery($posts_sql);
			
			if(!$posts_result)
			{
				echo '<tr><td>The posts could not be displayed, please try again later.</tr></td></table>';
			}
			else
			{
			
				while($posts_row = $cndb->fetchRow($posts_result))
				{
					//$user_name = ucwords(substr($posts_row['user_name'],0,strpos($posts_row['user_name'],"@")));
					$user_name = $posts_row['name'];
					
					echo '<tr class="topic-post" style="border-bottom:1px solid #ddd;">
							<th class="txt17X"><span class="">' .$user_name. '</span></th>
							<th class="txtright  txt17X">' . date('M j, Y', strtotime($posts_row['post_date'])) . '</th>
						  </tr>';
					echo '<tr class="topic-post">
							<td colspan="2">
								<a id="'.$posts_row['post_id'].'"></a>' . clean_output($posts_row['post_content']) . '
                                
								<div class="padd5"></div>
                                <a href="#'.$posts_row['post_id'].'" class="txtgray txt11">[ Reply ]</a>
                                <div class="padd10"></div>
								</td>
						  </tr>';
						  //htmlentities(stripslashes(nl2br($posts_row['post_content'])))
				}
			}
			
			
			//finish the table
			echo '</table>';
			
			
			echo '<div class="padd15"></div>';
			//echo '<div class="categories"><div class="news-section">';
			echo '<table class="topic table"><tr><th>';
			
			if(!isset($_SESSION['sess_mrfc_member']['signed_in']))
			{
				//<tr><td colspan=2><hr>
				// You can also <a href="signup.php"><strong>Sign up</strong></a> for an account.
				echo '<a href="'.$GLOBALS['MODULAR_ACCOUNTS_ROOT'].'php/form.account.login.php?rel=modal"  title="Log in" rel="modal:open"><strong>Sign in</strong></a> to post a reply or comment.';
			}
			else
			{
				//show reply box
				//<tr><td colspan="2"></td></tr><br>
				
				/*&com=' . $com_active . '*/
				echo '<h2 class="txt17">Reply / Post Comment:</h2>
					<form method="post" id="frm_forum_reply" name="frm_forum_reply" action="'.$forum_page.'/?fc=reply&id=' . $row['topic_id'] . '">
						<textarea name="reply-content" id="reply-content" style="width:100%;" class="wysiwyg required"></textarea><br />
						<input type="hidden" name="forum_topic" value="'.$row['topic_id'].'" />
						<input type="hidden" name="id_user" value="'.$us_id.'" />
						<input name="redirect" type="hidden" value="'.$forum_page.'/'.REF_PAGE.'" />
						<input type="hidden" name="topic_subject" value="' . $row['topic_subject'] . '" />
						<input type="submit" value="Submit Reply" />
					</form>';
			}
			
			echo '</th></tr></table>';
			//echo '</div></div>';
		}
	}
}

?>
