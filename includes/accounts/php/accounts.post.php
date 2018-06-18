<?php

require_once("../../../classes/cls.constants.php"); 
require_once("../../../classes/cls.functions_gallery.php");
require_once("../../../classes/cls.functions_misc.php");
require_once(__DIR__.'/accounts.class.php');
//echobr(__DIR__);


function getSalt()
{
	return substr(md5(uniqid(rand(), true)), 0, 6);
}	

/* ============================================================================== 
/*	SIGN OUT
/* ------------------------------------------------------------------------------ */
if(isset($_GET['signout']) and ($_GET['signout'] == "on")) 
{
	unset($_SESSION['sess_'.$pdb_prefix.'member']); 
	
		  
	$_SESSION['redirect_login'] = NULL; 
	$_SESSION['captcha_id'] = NULL;
	
	echo "<script language='javascript'>location.href=\"index.php?qst=199&token=".md5(rand())."\"; </script>"; 
	exit;
}



/* ============================================================================== 
/*	SPAM BLOCK! 
/* ------------------------------------------------------------------------------ */
if($_SERVER['REQUEST_METHOD'] !== 'POST') { 
echo "<script language='javascript'>location.href=\"index.php?qst=401&token=".$conf_token."\"; </script>"; exit; }

if (isset($_POST['nah_snd'])){$nah_snd=$_POST['nah_snd'];} else {$nah_snd='';}
if(strlen($nah_snd)>0) {echo "<script language='javascript'>location.href=\"index.php\"; </script>"; exit; }

/* ============================================================================== */





/* ********** FORM FUNCTIONS ****************************************************
********************************************************************************/
$formLog   = new hitsLog;
$debugmail = $GLOBALS['NOTIFY_DEBUG'];

//echobr($GLOBALS['EMAIL_TEMPLATE']);

$post	 = array_map("filter_data", $_POST); if(isset($post['fminfo'])) { $post = $post['fminfo']; }
$postb 	= array_map("quote_smart", $post);

$formname    = $post['formname'];	
$formact     = (isset($post['formact']))  ? $post['formact'] : '';
$formaction  = (isset($post['formaction']))  ? $post['formaction'] : $formact ;
$redirect    = (isset($post['redirect'])) ? $_POST['redirect'] : 'index.php';

$published = yesNoPost(@$post['published']);
$approved  = yesNoPost(@$post['approved']);
$mailing   = yesNoPost(@$post['mailing']);

if(strripos($redirect,"?")){ $redstr="&"; } else {$redstr="?";}

$field_names = array_keys($post); 
$mySql  	= "";	
$myCols 	= array();
$myDats 	= array();

$fields_ignore = array("formname","formaction","formtab","id","redirect","submit","publishval","password_r", "nah_snd", "resource_attr", "change_image");

$callfrom  = 	substr($_SERVER['HTTP_REFERER'],strripos($_SERVER['HTTP_REFERER'],"/" )+1);


//echobr($us_id);
//displayArray($_SESSION);
//displayArray($_FILES);

//displayArray($post);
//exit;








/******************************************************************
@begin :: USER PROFILE PASSWORD
********************************************************************/	

if($formname=="fm_profile_pass")
{
	
	if (!empty($_SESSION['sess_'.$pdb_prefix.'member'])) 
	{ 
		//$pass_old 	= md5($post['currentpass']);
		//$pass_new 	= md5($post['password']);
		
		$ac_salt 		= getSalt();
		$pass_new 	    = sha1($_POST['password'] . $ac_salt);
		
		$sq_check = "SELECT * FROM `".$pdb_prefix."reg_account` WHERE (`account_id` = ".q_si($us_id).")";  /* and (`userpass` = ".q_si($pass_old).")*/
		$rs_check = $cndb->dbQuery($sq_check);
	
		if(mysqli_num_rows($rs_check) <> 1)
		{ ?><script>location.href="<?php echo $redirect; ?>&qst=115";</script> <?php exit; }
		
		
		$sqpost = "update `".$pdb_prefix."reg_account` SET `usersalt`= ".q_si($ac_salt).", `userpass`= ".q_si($pass_new)." WHERE `account_id`=".q_si($us_id)."; ";
		$cndb->dbQuery($sqpost);
	
		//$redirect .= "&qst=7#profile";
	}
	
	?><script>location.href="<?php echo $redirect; ?>&qst=7";</script> <?php exit;

}





/******************************************************************
@begin :: USER PROFILE DETAILS
********************************************************************/	


if($formname=="fm_profile_add_invite")
{
	if (!empty($_SESSION['sess_'.$pdb_prefix.'member'])) 
	{ 
		
		if($formaction=="_edit")
		{
			//echobr($published); exit;
			foreach($field_names as $field)
			{
				$field = strtolower($field);

				if(!in_array($field, $fields_ignore))
				{
					$fieldNam	= $field;
					$fieldVal	= $post[''.$field.''];

					if( $field == "published") { $fieldVal = yesNoPost($post[''.$field.'']);  } 
					if( $field == "newsletter") { $fieldVal = yesNoPost($post[''.$field.'']);  } 
					if( $field == "pay_years") { $fieldVal = $post['pay_years'] * 12; $fieldNam = 'pay_months'; } 
					if( $field == "userpass")  { $fieldVal = md5($post[''.$field.'']);  } 


					$myCols[] = " `$fieldNam` = ".q_si($fieldVal).""; 
					/*if ($formaction == "_edit" ) { 
						//
					} elseif ($formaction == "_new" ) { $myCols[] = "`$fieldNam`";	$myDats[] = "".q_si($fieldVal)."";}*/

				}
			}

			$sqpost = "UPDATE `".$pdb_prefix."reg_account` set  ".implode($myCols, ', ').", `published`= ".q_si($published)." where (`account_id` = ".q_si($post['account_id'])." )" ;		
			//echo $sqpost; exit;
			$rspost = $cndb->dbQuery($sqpost);
			$redirect = "profile.php?ptab=members&qst=7";
		} 
		elseif($formaction=="_new")
		{
			$post['formtype'] = 'Individual';
			$sq_check = "SELECT `email` FROM `".$pdb_prefix."reg_account` WHERE (`email` = ".q_si($post['email']).")";
			$rs_check = $cndb->dbQuery($sq_check);
			if($cndb->recordCount($rs_check)>=1)
			{ /*echo $msge_array[20];*/ echo '<script>alert("'.$msge_array[20].'"); history.back();</script>'; exit; }
			else 
			{
				$ac_email 	= $post['email'];
				$auth_code	= 'MBR'.strtoupper(md5(uniqid(rand() . $ac_email)));
				
				/* =============================================== */	
				/* get Account, Category | Link Account to Category */
				$account_user_arr = array("organization_id" =>"".$post['organization_id']."",
										  "namefirst"       =>"".$post['namefirst']."",
										  "namelast"   	    =>"".$post['namelast']."",
										  "userauth"    	=>"".$auth_code."",
										  );	
				$account_id  	  = $ddSelect->getAddUserAccount($ac_email, $account_user_arr);
				$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
				$ddSelect->addUserToCategory($account_user_cat, $account_id);
				/* =============================================== */
				
				
				/* =============================================== */	
				/* @@ Send User Invite  */

					$confirm_link1 = SITE_DOMAIN_LIVE.'/index.php?ac='.$auth_code;
					$confirm_link2 = '<a href="'.$confirm_link1.'" target="_blank">'.$confirm_link1.'</a>';
					$messageDetail = array("message_link"   	=>"".$confirm_link2."",
										   "message_subject"  =>"Account Invite",
										   "contact_email"    =>"".$ac_email."",
										   "message_sender"   =>"".$us_org."",
										   "message_to"   	  =>"".$ac_email."" );

					$messageContent = $mailer->messageTemplate('account_invite', $messageDetail, 0, 0);
				//exit;
				/* --- end ---	*/								
				/* =============================================== */
			}
			
			$redirect = "profile.php?ptab=members&qst=24";
		}
		
	}
	
	echo "<script language='javascript'>location.href=\"$redirect\"; </script>";
	exit;

}






if($formname=="fm_profile_edit")
{
	if (!empty($_SESSION['sess_'.$pdb_prefix.'member'])) 
	{ 
		//$us_id = $_SESSION['sess_'.$pdb_prefix.'member']['ac_id'];
	
		$fields_ignore[]	= 'organization';
		foreach($field_names as $field)
		{
			$field = strtolower($field);

			if(!in_array($field, $fields_ignore))
			{
				$fieldNam	= $field;
				$fieldVal	= $post[''.$field.''];

				if( $field == "published") { $fieldVal = yesNoPost($post[''.$field.'']);  } 
				if( $field == "newsletter") { $fieldVal = yesNoPost($post[''.$field.'']);  } 
				if( $field == "pay_years") { $fieldVal = $post['pay_years'] * 12; $fieldNam = 'pay_months'; } 
				if( $field == "userpass")  { $fieldVal = md5($post[''.$field.'']);  } 

				
				$myCols[] = " `$fieldNam` = ".q_si($fieldVal).""; 
				/*if ($formaction == "_edit" ) { 
					//
				} elseif ($formaction == "_new" ) { $myCols[] = "`$fieldNam`";	$myDats[] = "".q_si($fieldVal)."";}*/

			}
		}
		
		if($post['organization'] <> ''){
			$organization_id  	= $ddSelect->getAddUserOrganization($post['organization'], $us_id);
			$myCols[] 			= " `organization_id` = ".q_si($organization_id).""; 
			/*$sq_upd = "update `".$pdb_prefix."reg_account` set `organization_id` = ".q_si($organization_id)." WHERE `account_id` = ".q_si($account_id)."; ";
			$cndb->dbQuery($sq_upd);*/
		}
		
		$sqpost = "UPDATE `".$pdb_prefix."reg_account` set  ".implode($myCols, ', ')." where (`account_id` = ".q_si($us_id)." )" ;		
		//echo $sqpost; exit;
		$rspost = $cndb->dbQuery($sqpost);
	
		
		/*$log_session = array(
			'u_fname' 		 => ''.$post['namefirst'].'',
			'u_lname' 		 => ''.$post['namelast'].'',
			'u_phone' 		 => ''.$post['phone'].'',
			'u_country' 	 => ''.$post['country'].'',
			'expires'		 => time()+(45*60)
		);*/
		$_SESSION['sess_'.$pdb_prefix.'member']['u_fname'] = ''.$post['namefirst'].'';
		$_SESSION['sess_'.$pdb_prefix.'member']['u_lname'] = ''.$post['namelast'].'';
		$_SESSION['sess_'.$pdb_prefix.'member']['u_phone'] = ''.$post['phone'].'';
		//$_SESSION['sess_'.$pdb_prefix.'member']['u_country'] = ''.$post['country'].'';
		
		//$redirect = "profile.php?ptab=profile&qst=7";
	}
	
	echo "<script language='javascript'>location.href=\"$redirect\"; </script>";
	exit;

}




/* ============================================================================== 
/*	@UPLOAD MEMBER AVATAR
/* ------------------------------------------------------------------------------ */

if($formname=="fm_profile_avatar")
{		
	$email_name  = explode('@', $_SESSION['sess_'.$pdb_prefix.'member']['u_email']); 
	$doc_newname = cleanFileName(crc32($us_id).'_'.$email_name[0]); 
	
	$resp = '';
	if(isset($_FILES['idoc']) and is_array($_FILES['idoc']['name'])) 
	{		
		//displayArray($_FILES['idoc']); exit;
		
		$dfile = $_FILES['idoc']['name'][0];
		if(strlen($dfile) > 4) 
		{
			$doc_result   = fileUpload($_FILES['idoc'], 0, $doc_newname, UPL_AVATARS);
			//displayArray($doc_result); exit;
			
			if($doc_result['result'] == 1) {
				$sq_files  = "UPDATE `".$pdb_prefix."reg_account` SET `avatar`= ".q_si($doc_result['name'])." WHERE `account_id` = ".q_si($us_id)."; ";
				$cndb->dbQuery($sq_files);
				$_SESSION['sess_'.$pdb_prefix.'member']['u_avatar'] = ''.$doc_result['name'].'';
				$resp = 'Uploaded';
			}
		}		
	}	
	echo $resp;
	/*?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php*/
exit;	

	
}








/* ============================================================================== 
/*	ACCOUNT SIGNUP || Organization
/* ------------------------------------------------------------------------------ */
	
if($formname=="ac_signup")	// _organization
{
	$formResponse = $msge_array[22];
	
	$email = filter_var($post['ac_email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo $msge_array[100]; exit;
	}
	if($post['ac_pass'] <> $post['ac_passconfirm']) {
		echo $msge_array[116]; exit;
	}
	//$post['formtype'] = 'Individual'; 
	
	$ac_formtype 	 = $post['formtype'];	
	$ac_organization  = @$post['ac_organization'];
	$ac_email 		= $post['ac_email'];
	$ac_phone 		= @$post['ac_phone']; 
	$ac_namefirst	= $post['ac_namefirst'];
	$ac_namelast	 = $post['ac_namelast'];
	
	$ac_salt 		= getSalt();
	$ac_password 	= sha1($_POST['ac_pass'] . $ac_salt);	
	$auth_code	    = 'SGN'.strtoupper(md5(uniqid(rand() . $ac_email)));
	
	$seqpost		 = array();
	
	
	//$organization_id  = ($ac_formtype == 'Corporate') ? $ddSelect->getAddUserOrganization($ac_organization) : '';
	
	$sq_check = "SELECT `email` FROM `".$pdb_prefix."reg_account` WHERE (`email` = ".q_si($ac_email).")";
	$rs_check = $cndb->dbQuery($sq_check);
	if($cndb->recordCount($rs_check)>=1)
	{ echo $msge_array[20]; exit; }

	
	/* =============================================== */	
	/* get Account, Category | Link Account to Category */
	$account_staff   = checkIfStaff($ac_email);
	$account_user_arr = array(/*"organization_id"  =>"".$organization_id."",*/
							  "namefirst"      =>"".$ac_namefirst."",
							  "namelast"   	   =>"".$ac_namelast."",
							  "phone"    	  =>"".$ac_phone."",
							  "staff"    	  =>"".$account_staff."",							  
							  "usersalt"   	   =>"".$ac_salt."",
							  "userpass"      =>"".$ac_password."",
							  "userauth"    	  =>"".$auth_code."",
							  );	//displayArray($account_user_arr); exit;
	$account_id  	  = $dbAcc->getAddUserAccount($ac_email, $account_user_arr);
	//$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
	//$ddSelect->addUserToCategory($account_user_cat, $account_id);
	
	/*if($ac_formtype == 'Corporate'){
		$organization_id  = $ddSelect->getAddUserOrganization($ac_organization, $account_id);
		$sq_upd = "update `".$pdb_prefix."reg_account` set `organization_id` = ".q_si($organization_id)." WHERE `account_id` = ".q_si($account_id)."; ";
		$cndb->dbQuery($sq_upd);
	}*/
	
	/* =============================================== */
	//echobr($account_id); //exit;
	
	if($account_id >= 1)
	{
		
	
		/* =============================================== */	
		/* @@ Activity Log   */
		/*$formLog_arr = array("id_account" => "".$ac_email."", "log_desc"=>"New ".$ac_formtype."", "log_cat_name"=>"".$ac_formtype."", "log_cat_id"=>"".$account_id."");
		$formLog->formsUserLogs('account_signup','account_signup',$account_id, $ac_email);*/	
		/* =============================================== */	


		$redirect = "index.php?qst=22";	//signin
		echo $msge_array[22];


		/* =============================================== */	
		/* @@ Request Verification User Message   */

			$confirm_link1 = SITE_DOMAIN_LIVE.'?ac='.$auth_code;
			$confirm_link2 = '<a href="'.$confirm_link1.'" target="_blank">'.$confirm_link1.'</a>';
			$messageDetail = array("message_link"   	=>"".$confirm_link2."",
								   "message_subject" =>"Account Sign Up",
								   "contact_email"   =>"".$ac_email."",
								   "message_to"   	  =>"".$ac_email."" );
			//displayArray($messageDetail); exit;
			$messageContent = $mailer->messageTemplate('account_verify', $messageDetail, 1, 0);

		/* --- end ---	*/								
		/* =============================================== */
	
	}
	else
	{
		echo $msge_array[117];
	}
	
	exit;

}




/* ============================================================================== 
/*	LOGIN FORM
/* ------------------------------------------------------------------------------ */

if ($formname=="ac_login") 
{	
	$result_msg = '';
	$password = trim($_POST['log_passw']); 	
	
	$sq_salt = "SELECT `".$pdb_prefix."reg_account`.* , `".$pdb_prefix."reg_organizations`.`organization`, `".$pdb_prefix."reg_roles`.`role_title` FROM `".$pdb_prefix."reg_account` LEFT JOIN `".$pdb_prefix."reg_organizations` ON (`".$pdb_prefix."reg_account`.`organization_id` = `".$pdb_prefix."reg_organizations`.`organization_id`) LEFT JOIN `".$pdb_prefix."reg_roles` ON (`".$pdb_prefix."reg_account`.`role_id` = `".$pdb_prefix."reg_roles`.`role_id`) WHERE (`".$pdb_prefix."reg_account`.`email` = ".$postb['log_email']."  AND `".$pdb_prefix."reg_account`.`uservalid` ='1' AND `".$pdb_prefix."reg_account`.`published` ='1')"; //echobr($sq_salt); exit;
	$rs_salt = $cndb->dbQueryFetch($sq_salt);
	
	if(count($rs_salt)==1)
	{
		$user_acc   = current($rs_salt); 
		
		$u_id 	    = $user_acc['account_id'];
		$u_email    = $user_acc['email'];
		$u_email_arr= explode('@', $u_email);
		$u_fname    = ($user_acc['namefirst'] <> '') ? $user_acc['namefirst'] : $u_email_arr[0];
		
		$u_type_id 	= $user_acc['role_id'];		
		$u_type 	= $user_acc['role_title'];
		$u_org_id 	= $user_acc['organization_id'];		
		$u_org		= $user_acc['organization'];
		
		$usersalt 	= $user_acc['usersalt'];
		$userpass 	= $user_acc['userpass'];		
		$log_pass	= sha1($password . $usersalt);
		
		if($log_pass == $userpass)
		{			
			$log_session = array(
				'u_id' 			 => ''.$u_id.'',
				'u_fname' 		 => ''.$u_fname.'',
				'u_lname' 		 => ''.$user_acc['namelast'].'',
				'u_type_id' 	 => ''.$user_acc['role_id'].'',
				'u_type' 		 => ''.$user_acc['role_title'].'',
				'u_email' 		 => ''.$user_acc['email'].'',
				'u_phone' 		 => ''.$user_acc['phone'].'',
				'u_country' 	 => ''.$user_acc['country'].'',
				'u_avatar' 		 => ''.$user_acc['avatar'].'',
				'u_organization_id'  => ''.$user_acc['organization_id'].'',
				'u_organization' 	 => ''.$user_acc['organization'].'',
				'u_staff' 		 => ''.$user_acc['staff'].'',
				'expires'		 => time()+(45*60)
			);
			
			$_SESSION['sess_'.$pdb_prefix.'member'] = $log_session;		
			$_SESSION['sess_'.$pdb_prefix.'member']['signed_in']    = true;	

			//displayArray($_SESSION['sess_'.$pdb_prefix.'member']); exit;
			
			$sq_datelog	= "update `".$pdb_prefix."reg_account`  set `date_lastlog` = '".time()."' where `account_id` = ".quote_smart($u_id)." ";
			$cndb->dbQuery($sq_datelog);

			/* =============================================== */	
			/* @@ Activity Log   */
			$log_detail = $u_email . ' [Name: '.$u_fname.' '.$user_acc['namelast'].']';
			$formLog->formsUserLogs('accounts', 'log_in', $u_id, $log_detail);
			/* =============================================== */
			/*$ptab = ($user_acc['organization_id'] <> '') ? 'ptab=dashboard&' : '';
			$redirect = 'profile.php?'.$ptab.time();*/

			$result_msg = 'log_1';
		}
		else
		{ $result_msg = $msge_array[21]; }
	}
	else
	{ $result_msg = $msge_array[21]; }
	
	echo $result_msg;
	
	exit;
}		




/* ============================================================================== 
/*	ACCOUNT CHANGE PASSWORD FORM
/* ------------------------------------------------------------------------------ */	

if ($formname=="ac_pwchange")  
{
	$passnew 	= $post['passnew'];
	$passconf 	= $post['passconf'];
	//$passcurr 	= $post['passcurr'];
	$passauth 	= $post['passauth'];
	
	if($passnew <> $passconf) { 
	?> <script language='javascript'> location.href="profile.php?ptab=profile&ac=<?=$passauth?>&qst=116"; </script>  <?php exit; }
	/*action.php?*/
	
	$pass_salt 	= getSalt();
	$pass_new 	= sha1($passconf . $pass_salt);	
	
	//$pass_old 	= md5($post['passcurr']);
	//$pass_new 	= md5($post['passnew']);
	
	$sq_check = "SELECT * FROM `".$pdb_prefix."reg_account` WHERE (`userauth`=".q_si($passauth)." )";
	$rs_check = $cndb->dbQuery($sq_check);
	
	if($cndb->recordCount($rs_check)==1)
	{ 	
		$cn_check      	= $cndb->fetchRow($rs_check);	
		$account_id   	= $cn_check['account_id'];	
		$account_name  	= clean_output($cn_check['namefirst']);
		$account_email  = clean_output($cn_check['email']);
		
		
		$sq_rst	="update `".$pdb_prefix."reg_account` set `usersalt`= ".q_si($pass_salt).", `userpass`= ".q_si($pass_new).", `userauth` = ".q_si($passauth."__")." where `account_id` = ".quote_smart($account_id)."; ";
		$rs_rst = $cndb->dbQuery($sq_rst);
	
	
		/* =============================================== */	
		/* @@ Activity Log   */
		$formLog->formsUserLogs('accounts','Password changed',$account_id, $account_email);	
		/* =============================================== */
	
	
		/* =============================================== */	
		/* @@ User Email Notification   */
		$messageDetail = array("message_subject" =>"Password Changed",
							   "contact_email"   =>"".$account_email."",
							   "contact_name"    =>"".$account_name."",
							   "message_to"   	 =>"".$account_email."" );		
		$messageContent = $mailer->messageTemplate('account_passchange', $messageDetail, '',0); //, $debugmail
		/* =============================================== */
	
		?><script>location.href="profile.php?ptab=profile&fcall=signin&tk=<?php echo time(); ?>&qst=27";</script> <?php exit;
		/*action.php?*/
		
	}
	else
	{ ?><script>location.href="index.php?ac=<?=$passauth?>&qst=115";</script> <?php exit; }
	
	
}	


/* ============================================================================== 
/*	ACCOUNT RESET PASSWORD REQUEST
/* ------------------------------------------------------------------------------ */	

if ($formname=="ac_pwreset")  
{
	$ac_email = filter_var($post['rf_email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($ac_email, FILTER_VALIDATE_EMAIL)) {
		echo $msge_array[100]; exit;
	}
	
	
	$auth_code	   = 'RST'.strtoupper(md5(uniqid(rand() . $ac_email)));
	
	$sq_check ="SELECT `account_id`,`email` FROM `".$pdb_prefix."reg_account` WHERE (`email`=".quote_smart($ac_email).")"; //echo $sq_check; exit;
	$rs_check = $cndb->dbQuery($sq_check);
	
	if($cndb->recordCount($rs_check)==1)
	{ 	
		$cn_check      = $cndb->fetchRow($rs_check);	
		$account_id    = $cn_check['account_id'];	
		$account_name  = clean_output($cn_check['email']);; //clean_output($cn_check['account_name']);
		
		echo $msge_array[26];
		
		$sq_rst	="update `".$pdb_prefix."reg_account` set `userauth` = '".$auth_code."' where `account_id` = ".quote_smart($account_id)."; ";
		//echo $sq_rst; exit;
		$rs_rst = $cndb->dbQuery($sq_rst);
	
		/* ========= @@ Activity Logger ================== */	
		$log_detail = 'Reset Password request: '. $ac_email . '';
		$formLog->formsUserLogs('accounts', $account_id, $log_detail, 7);
		/* =============================================== */	
	
	
		/* =============================================== */	
		/* @@ User Email Notification  */		
		//$confirm_link1 = SITE_DOMAIN_LIVE.'?ac='.$auth_code;
		$confirm_link1 = SITE_DOMAIN_LIVE.'/action.php?ac='.$auth_code;
		$confirm_link2 = '<a href="'.$confirm_link1.'" target="_blank">'.$confirm_link1.'</a>'; //echo $confirm_link2;
		$messageDetail = array("message_link"   	=>"".$confirm_link2."",
							   "message_subject" =>"Reset Password",
							   "contact_email"   =>"".$ac_email."",
							   "contact_name"    =>"".$account_name."",
							   "message_to"   	  =>"".$ac_email."" );		
		$messageContent = $mailer->messageTemplate('account_passreset', $messageDetail, 1, 0); //, $debugmail
		/* =============================================== */
	
		//exit;
	}
	else
	{
		echo $msge_array[21];
	}
	
	exit;
}	














?>