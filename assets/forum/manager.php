<?php
//category.php
include 'connect.php';
include 'header.php';

//displayArray($sys_us_admin);
/*if(!$_SESSION['sess_mrfc_member']) {  echo '<script>history.back(); </script>'; exit; }*/

/*if(isset($sys_us_admin) and $sys_us_admin['actype_id'] == 1 or 
   isset($sys_us_admin) and $sys_us_admin['actype_id'] == 2) 
{ $member_is_admin = 1; }
else
{ $member_is_admin = 0; }*/


if($fitm == 'cat')
{
	if($fopt == 'list')
	{
		include 'inc_list_category.php';
	}
	elseif($fopt == 'edit')
	{
		echo "<h3>Category Edit</h3>";
		include 'inc_edit_category.php';
	}	
}

if($fitm == 'topic')
{
	if($fopt == 'list')
	{
		include 'inc_list_topic.php';
	}
	elseif($fopt == 'edit')
	{
		echo "<h3>Topic Edit</h3>";
		include 'inc_edit_topic.php';
	}	
}


if($fitm == 'posts')
{
	if($fopt == 'list')
	{
		include 'inc_list_posts.php';
	}
	elseif($fopt == 'edit')
	{
		echo "<h3>Posts Edit</h3>";
		include 'inc_edit_post.php';
	}	
}

include 'footer.php';
?>
