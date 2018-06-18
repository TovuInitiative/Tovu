<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="A short description." />
<meta name="keywords" content="put, keywords, here" />
<title>CoP / Community Forums</title>
<link rel="stylesheet" href="../../assets/styles/style.css" type="text/css">
<link rel="stylesheet" href="../../assets/scripts/bootstrap/css/bootstrap-override.css" type="text/css">

<link rel="stylesheet" href="style.css" type="text/css">
<script type="text/javascript" src="../../assets/scripts/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="../../assets/scripts/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../../assets/scripts/misc/jquery.truncator.js"></script>
	
	
	<?php if($thisPage == 'manager.php'){ ?>
		<link rel="stylesheet" href="../../assets/scripts/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
		<script type="text/javascript" src="../../assets/scripts/jwysiwyg/jquery.wysiwyg.js"></script>
		<script type="text/javascript">
		jQuery(document).ready(function ($)  {
		  if( $('.wysiwyg').length ) { $('.wysiwyg').wysiwyg(); }
		});
		</script>
	<?php } ?>
	
	
</head>
<body>
<!--<h1>My forum</h1>-->
	<div id="wrapper">
	<div id="menu">
		<!--<a class="item" href="index.php">Forum Home</a> &nbsp; &nbsp;-->
		<?php if($member_is_admin == 1) { ?>
		<?php ?><a class="item" href="create_cat.php">Create Category</a> &nbsp; &nbsp;
		<a class="item" href="create_topic.php">Create Topic</a> &nbsp; &nbsp;<?php ?>
		
		<?php } ?>
		<div id="userbar">
		<a class="item" href="manager.php?fitm=cat&fopt=list">Categories</a> &nbsp; 	
		<a class="item" href="manager.php?fitm=topic&fopt=list">Topics</a> &nbsp; 
		<a class="item" href="manager.php?fitm=posts&fopt=list">Posts</a>
		<?php
		/*if($_SESSION['sess_mrfc_member']['signed_in'])
		{
			//echo 'Hello <b>' . htmlentities($_SESSION['sess_mrfc_member']['ac_uname']) . '</b>. Not you? <a class="item" href="signout.php">Sign out</a>';
		}
		else
		{
			//echo '<a class="item" href="signin.php">Sign in</a> or <a class="item" href="signup.php">create an account</a>';
		}*/
		?>
		</div>
	</div>
		<div id="content">