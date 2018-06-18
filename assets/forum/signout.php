<?php
//signout.php
include 'connect.php';
include 'header.php';

echo '<h2>Sign out</h2>';

//check if user if signed in
if($_SESSION['sess_mrfc_member']['signed_in'] == true)
{
	//unset all variables
	$_SESSION['sess_mrfc_member']['signed_in'] = NULL;
	$_SESSION['sess_mrfc_member']['ac_uname'] = NULL;
	$_SESSION['sess_mrfc_member']['ac_id']   = NULL;

	echo 'Succesfully signed out, thank you for visiting.';
}
else
{
	echo 'You are not signed in. Would you <a href="signin.php">like to</a>?';
}

include 'footer.php';
?>