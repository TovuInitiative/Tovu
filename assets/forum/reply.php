<?php
//create_cat.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	//someone is calling the file directly, which we don't want
	echo 'This file cannot be called directly.';
}
else
{
	//check for sign in status
	if(!$_SESSION['sess_mrfc_member']['signed_in'])
	{
		echo 'You must be signed in to post a reply.';
	}
	else
	{
		//a real user posted a real reply
		$sql = "INSERT INTO 
					mrfc_forum_posts(post_content,
						  post_date,
						  post_topic,
						  post_by) 
				VALUES (" . q_si($_POST['reply-content']) . ",
						NOW(),
						" . q_si($_GET['id']) . ",
						" . q_si($_SESSION['sess_mrfc_member']['ac_id']) . ")";
						
		$result = $cndb->dbQuery($sql);
						
		if(!$result)
		{
			echo 'Your reply has not been saved, please try again later.';
		}
		else
		{
			
			$message	="\r\n".'<p><b>Post Content:</b> <br> '.$_POST['reply-content'].'</p>'
			.'<p><b>From:</b> '.$_SESSION['sess_mrfc_member']['ac_uname'].'</p>'
			.'<p><b>Topic:</b> '.$_POST['topic_subject'].'</p>'			
			.'<br><p><strong>Regards, <br> <u>Web Coordinator</u></strong></p>'
			//.'<img src="'.SITE_LOGO.'" alt="'.THIS_SITE_TITLE.'" />'
			.'<br><hr>'
			.'Message sent from: '.$_SERVER['HTTP_HOST'].'<br> '. date("F j, Y, g:i a").'<hr />';
			
			@mail(''.SITE_MAIL_TO_BASIC.'', ''.THIS_SITE_TITLE.' Online Forum - New Member Post', $message, 'From: '.THIS_SITE_TITLE_B.' <'.SITE_MAIL_FROM_BASIC.'>');
			@mail('munene.murage@gmail.com', ''.THIS_SITE_TITLE.' Online Forum - New Member Post', $message, 'From: '.THIS_SITE_TITLE_B.' <'.SITE_MAIL_FROM_BASIC.'>');
			
			$redirect = 'topic.php?id='.htmlentities($_GET['id']).'';
			echo 'Your reply has been saved. <a href="topic.php?id=' . htmlentities($_GET['id']) . '">Go back</a>.';
			
		}
		
		
			?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 2000);
</script>			
			<?php
	}
}

include 'footer.php';
?>