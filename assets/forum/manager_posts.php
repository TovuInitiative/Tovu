<?php
include 'connect.php';


if($_SERVER['REQUEST_METHOD'] !== 'POST') { echo '<script>history.back(); </script>'; exit; }


	if (isset($_POST['formname'])){$formname=$_POST['formname'];} else {$formname=NULL;}
	if (isset($_POST['published']))	{$published=$_POST['published'];}   else {$published='off';}
	if (isset($_POST['cat_current']))	{$cat_current=$_POST['cat_current'];}   else {$cat_current='off';}
	
	if($published=='on' or $published=='1') { $published=1;	} else { $published=0; }
	if($cat_current=='on') { $cat_current=1;	} else { $cat_current=0; }
	
	//echo '<pre>'; print_r($_POST); echo '</pre>';
	//exit;

//print_r($_POST);


/* @@MEMBER POSTS 
********************************* */	

if($_POST['formname'] == 'forum_edit_posts')
{
		
		$post_id = $_POST['post_id'];
		
		$sq_post = "UPDATE `mrfc_forum_posts` SET `post_content` = " . sanitizor($_POST['post_content']) . ", `post_published` = '".$published."'  WHERE `post_id` = " . sanitizor($_POST['post_id']) . " "; 
		 //echo $sq_post; exit;
		$rs_post = $cndb->dbQuery($sq_post);
	
	
		if(!$rs_post)
		{
			echo 'An error occured while updating your post. Please try again later.<br /><br />' . mysql_error();
			$sql = "ROLLBACK;";
			$result = $cndb->dbQuery($sql);
		}
		else
		{
			$sql = "COMMIT;";
			$result = $cndb->dbQuery($sql);	
			$redirect = 'manager.php?fitm=posts&fopt=list&fpost='. $post_id . '';		
			echo 'You have succesfully updated the member post. <a href="'. $redirect . '">Back to list</a>.';
			
			
			?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 3000);
</script>			
			<?php
		}
	
}	




/* @@TOPICS 
********************************* */	

if($_POST['formname'] == 'forum_edit_topic')
{
		
		$topic_id = $_POST['topic_id'];
		
		$sq_post = "UPDATE mrfc_forum_topics SET topic_subject = " . sanitizor($_POST['topic_subject']) . ",topic_description = " . sanitizor($_POST['topic_description']) . ", `topic_published` = '".$published."', `topic_cat` = " . sanitizor($_POST['topic_cat']) . "   WHERE topic_id = '" . sanitizor($_POST['topic_id']) . "' "; //, topic_by = '" . sanitizor($_POST['topic_by']) . "
		// echo $sq_post; exit;
		$rs_post = $cndb->dbQuery($sq_post);
	
	
		if(!$rs_post)
		{
			//something went wrong, display the error
			echo 'An error occured while updating your post. Please try again later.<br /><br />' . mysql_error();
			$sql = "ROLLBACK;";
			$result = $cndb->dbQuery($sql);
		}
		else
		{
			
			$sql = "COMMIT;";
			$result = $cndb->dbQuery($sql);
			$redirect = 'manager.php?fitm=topic&fopt=list&ftopic='. $topic_id . '';
			echo 'You have succesfully updated the topic. <a href="'. $redirect . '">Back to list</a>.';
			
			?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 3000);
</script>			
			<?php
		}
	
}	
	
	
	
	
/* @@CATEGORY 
********************************* */	

if($_POST['formname'] == 'forum_edit_cat')
{
		
	$query  = "BEGIN WORK;";
	$result = $cndb->dbQuery($query);
	
	if(!$result)
	{
		echo 'An error occured while updating. Please try again later.';
	}
	else
	{
		$cat_id = $_POST['cat_id'];
		
		$sq_post = "UPDATE mrfc_forum_categories SET cat_name = " . sanitizor($_POST['cat_name']) . ", cat_description = " . sanitizor($_POST['cat_description']) . ", `cat_published` = '".$published."' ,  cat_current = '".$cat_current."', cat_by = " . sanitizor($_POST['cat_by']) . " 
		   WHERE cat_id = " . sanitizor($_POST['cat_id']) . " ";
		 //echo $sq_post; exit;
		$rs_post = $cndb->dbQuery($sq_post);
	
	
			if(!$rs_post)
			{
				//something went wrong, display the error
				echo 'An error occured while updating your post. Please try again later.<br /><br />' . mysql_error();
				$sql = "ROLLBACK;";
				$result = $cndb->dbQuery($sql);
			}
			else
			{
				
				if($cat_current == 1) 
				{
				$sq_current = "UPDATE mrfc_forum_categories SET cat_current = '0' WHERE cat_id <> " . sanitizor($cat_id) . " "; //echo $cat_current . $sq_current; exit;
				$rs_current = $cndb->dbQuery($sq_current);
				}
		
				$sql = "COMMIT;";
				$result = $cndb->dbQuery($sql);
				
				//after a lot of work, the query succeeded!
				
				$redirect = 'manager.php?fitm=cat&fopt=list&fcat='. $cat_id . '';
	echo 'You have succesfully updated the category. <a href="'. $redirect . '">Back to list</a>.';
				?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 3000);
</script>			
			<?php
			}
	
	}
	
}
		

?>
