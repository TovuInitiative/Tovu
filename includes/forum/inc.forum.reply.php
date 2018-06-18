<div><!--<h1>Forums</h1>-->
<?php 
//require("classes/PHPMailerAutoload.php"); 
require("classes/cls.functions_misc.php");

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

$post		= array_map("filter_data", $_POST);

$redirect = $_POST['redirect']; 
//displayArray($post); //exit;
//displayArray($_SESSION['sess_mrfc_member']); 

if(trim($post['reply-content']) <> '') 
{


/* a real user posted a real reply */
$sql = "INSERT INTO 
		mrfc_forum_posts(post_content,
			  post_date,
			  post_topic,
			  post_by) 
	VALUES (" . quote_smart($post['reply-content']) . ",
			NOW(),
			" . quote_smart($post['forum_topic']) . ",
			" . quote_smart($us_id) . ")";
//echobr($sql); exit;
$result = $cndb->dbQuery($sql);
			
if(!$result)
{
echo 'Your reply has not been saved, please try again later.';
}
else
{
	
/******************************************************************
@begin :: Send Notification Email
------------------------------------------------------------------*/

	$from_name    	= $us_name;
	//$item_path		= SITE_DOMAIN_LIVE.'apps/forum/manager.php?fitm=posts&fopt=list&ftopic='.$post['forum_topic'];
	$item_path		= SITE_DOMAIN_LIVE.'#?fitm=posts&fopt=list&ftopic='.$post['forum_topic'];
	$newItemTitle 	= '<a href="'.$item_path.'">'.$post['topic_subject'].'</a>';
	
	$subject	= 'KSG Alert: New Forum Contribution';
	$message	= '<br>A new forum reply/contribution has been submitted to <b>'.SITE_TITLE_LONG.'</b>.<br>'
				 .'<blockquote><b>DISCUSSION TOPIC: </b> '.$newItemTitle
				 .'<br><br><b>ADDED BY:</b> '.$from_name .'</blockquote>'
				 .'<br>Regards, <br> <b>Website Administrator</b><br><hr>'. date("F j, Y, g:i a").'<hr>';
	
	//echo sendMailAlert($subject, $message);
	
	$sendto[]	= "murage@openinstitute.com";
	//$sendto[]	= "".SITE_MAIL_TO_BASIC."";
		
	foreach($sendto as $i => $val) {
		//echo "<hr>".$val."<br>".$sendfrom."<br>".$subject."<br>".$message; //exit;
		//$mailer->form_alerts($val, $subject, $message);
	}
//exit;
/*------------------------------------------------------------------
@end :: Send Notification Email
*****************************************************************  */

//$redirect = $post['redirect']; //'forum_topic.php?id='.htmlentities($_GET['id']).'';
echo '<br>Your reply has been saved. Kindly await the Moderator\'s  approval.<br><br> <a href="'.$redirect.'">Go back</a>.';
//exit;
}
}
else
{
//$redirect = $post['redirect']; //'forum_topic.php?id='.htmlentities($_GET['id']).'';
echo 'Your reply has NOT been saved. Reply field is empty.<br><br> <a href="'.$redirect.'">Go back</a>.';
}

?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 4000);
</script>			
<?php
}
}			

 ?>

</div>