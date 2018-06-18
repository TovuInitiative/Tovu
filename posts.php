<?php
require("classes/cls.constants.php"); 
require("classes/cls.functions_gallery.php");
require("classes/cls.functions_misc.php");

function getSalt()
{
	return substr(md5(uniqid(rand(), true)), 0, 6);
}	
//exit;
/* ============================================================================== 
/*	SIGN OUT
/* ------------------------------------------------------------------------------ */
if(isset($_GET['signout']) and ($_GET['signout'] == "on")) 
{
	unset($_SESSION['sess_mrfc_member']); 
	unset($_SESSION['sess_mrfc_member']); 
	
	unset($_SESSION['sess_mrfc_shop_order']);
	unset($_SESSION['sess_mrfc_shop_cart']);
	
	unset($_SESSION['mrfc_cart_order']);
	unset($_SESSION['mrfc_cart_key']);
	  
	$_SESSION['redirect_login'] = NULL; 
	$_SESSION['captcha_id'] = NULL;
	
    //displayArray($_SESSION['sess_mrfc_member']); exit;
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
$redirect    = (isset($post['redirect'])) ? $post['redirect'] : 'index.php';

$published = yesNoPost(@$post['published']);
$approved  = yesNoPost(@$post['approved']);
$mailing   = yesNoPost(@$post['mailing']);

if(strripos($redirect,"?")){ $redstr="&"; } else {$redstr="?";}

$field_names = array_keys($post); 
$mySql  	= "";	
$myCols 	= array();
$myDats 	= array();

$fields_ignore = array("formname","formaction","formtab","id","redirect","submit","publishval","password_r", "nah_snd", "resource_attr", "change_image");

//echobr($us_id);
//displayArray($_SESSION);
//displayArray($_FILES);
//displayArray($post); 
//exit;


	

/* ============================================================================== 
/*	CONTRIBUTIONS
/* ------------------------------------------------------------------------------ */

if($formname=="fm_contribute")
{	
	$post_title  = $post['post']['title'];
	$post_desc   = $post['post']['description'];
	$post_dated  = $post['post']['dated'];
	$post_county = $post['post']['county'];
	$post_comments = $post['post']['comments'];
	$post_type   = serialize($post['post']['type']);
	$post_resources        = '';
	$post_resources_num    = '';
    
	$fdoc_title  = $post['fdoc_title'];
	$fdoc_error  = '';
    $file_arr	 = array();
    
    if(isset($_FILES['fdoc']) and is_array($_FILES['fdoc']['name'])) 
	{	
		foreach($_FILES['fdoc']['name'] as $doc_key => $doc_name)
        {
            $file_type 		= $_FILES['fdoc']['type'][$doc_key];
            
            if(strlen($doc_name) > 4) 
            {
                if(in_array($file_type, $mimetypes)) 
                {
                    $file_title     = ($fdoc_title[$doc_key] <> '') ? $fdoc_title[$doc_key] : $doc_key.'_'.$post_title;
                    $file_seo 	    = generate_seo_title($file_title, '_');	
                    $file_ext 		= ".".getFileExtension(strtolower($doc_name));
                    $file_key 	 	= hash("crc32", $post_title).$doc_key.'_';
                    $file_name_new	= $file_key . $file_seo . $file_ext;		

                    $file_temp 		= $_FILES['fdoc']['tmp_name'][$doc_key];					
                    $file_target  	= UPL_USERPOSTS . $file_name_new;                    


                    $isUploaded     = move_uploaded_file($file_temp, $file_target);
                    if($isUploaded)
                    {
                        $file_arr[$doc_key]     = array('title' => ''.$file_title.'', 'name' => ''.$file_name_new.'');
                    }
                    else
                    {
                        $fdoc_error .= 'File "'. $doc_name .'" was NOT uploaded. </br>';
                    }  
                } else 
                {
                    $fdoc_error .= 'File "'. $doc_name .'" was NOT valid.  </br>';
                }
                
            } 
        }
        
        //echobr($fdoc_error);	
	}	
    
    if( count($file_arr) > 0) {
            $post_resources_num = count($file_arr); 
            $post_resources     = serialize($file_arr);
        }
	
    
    if($fdoc_error <> '')
    {
        echo $fdoc_error;
        echo '<hr><a onclick="javascript:history.back();">Click here to go back.</a>';
        exit;
    } 
    else 
    {
        $sqpost="insert into `mrfc_dat_contributions`  "
        ."(`poster_id`, `poster_email`, `post_title`, `post_type`, `post_description`, `post_dated`, `post_county`, `post_resources`, `post_resources_num`, `post_comments`) "
        ." values "
        ."(".q_si($us_id).", ".q_si($us_email).", ".q_si($post_title).", ".q_si($post_type).", ".q_si($post_desc).", ".q_si($post_dated).", ".q_si($post_county).", ".q_si($post_resources).", ".q_si($post_resources_num).", ".q_si($post_comments).")";
        //echo $sqpost; exit;
        $cndb->dbQuery($sqpost);
        
        $poster_email = $us_email;
        
        $subject	= ' New Contribution from ' . $post['posted_by'];	
        $message	='<br>Hi,<br><br> New Contribution submitted at <b>'.SITE_TITLE_SHORT.'</b>:<br>'
                .'<blockquote><b>SENDER:</b> '.$us_fname
                .'<BR><BR><b>EMAIL:</b> '.$poster_email
                .'<BR><BR>&nbsp; '
                .'<BR><BR><b>POST TITLE:</b> '.$post_title
                .'<BR><BR><b>POST TYPE:</b> '.implode(',', $post_type)
                .'<BR><BR><b>POST UPLOADS:</b> '.$post_resources_num
                .'<BR><BR>&nbsp; '
                .'<BR><BR><b>COMMENTS:</b> '.$post_comments
                .'</blockquote>'
                .'<br>Regards, <br> <b>Website Administrator</b><br>'
                . date("F j, Y, g:i a").'<br><hr>'
                .'Message sent from: '.$_SERVER['HTTP_HOST'].'<hr />';

        $sendto[]	= "munene.murage@gmail.com";
        $sendto[]	= "".SITE_MAIL_TO_BASIC."";
		
		foreach($sendto as $i => $val) {
		  //echo "<hr>".$val."<br>".$sendfrom."<br>".$subject."<br>".$message; //exit;
		  $mailer->form_alerts($val, $subject, $message);
		}
        
        //exit;
        $redirect = cleanRedStr($redirect)."qst=25&tk=".time(); 	
        echo "<script language='javascript'>location.href=\"$redirect\"; </script>";/**/
        exit;
    }
}

	

/* ============================================================================== 
/*	EVENT REGISTER
/* ------------------------------------------------------------------------------ */

if($formname=="fm_conf_register")
{	
	$reg_type = $post['reg_type'];
	//$rmessage = html_entity_decode(stripslashes($post['rmessage']));
	
	$sqpost="insert into `mrfc_reg_events_booking`  "
	."(`id_content` , `regnum` , `contactname` , `contactemail` , `contactphone` , `orgname` , `contactjob`) "
	." values "
	."('0', ".$postb['reg_type'].", ".$postb['fullname'].", ".$postb['email'].", ".$postb['phone'].", ".$postb['organization'].", ".$postb['jobtitle'].")";
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
	
	
	$subject	= ' Conference Registration: ' . $reg_type;	
	$message	='<br>Hi,<br><br> You have recieved a Conference Registration from <b>'.SITE_TITLE_SHORT.'</b>:<br>'
			.'<blockquote><b>SENDER:</b> '.$post['fullname']
			.'<BR><BR><b>EMAIL:</b> '.$post['email']
			.'<BR><BR><b>TELEPHONE:</b> '.$post['phone']
			.'<BR><BR><b>ORGANIZATION:</b> '.$post['organization']
			.'<BR><BR><b>JOB TITLE:</b> '.$post['jobtitle']
			.'<BR><BR><b>REGISTRATION TYPE:</b> '.$reg_type
			.'</blockquote>'
			.'<br>Regards, <br> <b>Website Administrator</b><br>'
			. date("F j, Y, g:i a").'<br><hr>'
			.'Message sent from: '.$_SERVER['HTTP_HOST'].'<hr />';
	
	$sendto[]	= "munene.murage@gmail.com";
	$sendto[]	= "".SITE_MAIL_TO_BASIC."";
		
		foreach($sendto as $i => $val) {
		//echo "<hr>".$val."<br>".$sendfrom."<br>".$subject."<br>".$message; exit;
		$mailer->form_alerts($val, $subject, $message);
		}
	//exit;
	
	//echo 'Request sent.';
	$redirect = 'register/?qst=8'; //cleanRedStr($redirect)."qst=1"; 	
	echo "<script language='javascript'>location.href=\"$redirect\"; </script>";/**/
	exit;
}
	


/* ============================================================================== 
/*	MAILING SUBSCRIPTION DETAILED
/* ------------------------------------------------------------------------------ */

if($formname=="mailingdetail")
{
	//displayArray($post);//exit;
	$email = filter_var($post['email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$formReject = $ref_back."qst=100#fm-subscribe";
		echo "<script language='javascript'>location.href=\"$formReject\"; </script>";
	}
	
	
	
	$authcode 	= md5(uniqid(rand())); //round(microtime(true),0) + rand(101,999);
	$accemail	= $posts[2];

	
	
	if(empty($_SESSION['email_mailing']))
	{

	/*$sq_check = "SELECT `email` FROM `mrfc_reg_users` WHERE (`email` = ".$postb['email'].")";
	$rs_check = $cndb->dbQuery($sq_check);
	
		if($cndb->recordCount($rs_check)>=1)
		{ ?>
			<script>
			alert("An account already exists with the specified Email Address.")
			history.back(-1);
			</script>
			<?php exit;
		}*/
	
	/* =============================================== */
	/* get Account, Category | Link Account to Category */
	$county_staff   = checkIfStaff($email);
	$account_user_arr = array("ac_type"	    =>"mail",
							  "firstname"      =>"".$post['firstname']."",
							  "lastname"       =>"".$post['lastname']."",
							  "phone"   		  =>"".$post['phone']."",
							  "organization"   =>"".$post['ac_organization']."",
							  "country"        =>"".$post['ac_country']."",
							  "ipaddress"      =>"".$_SERVER['REMOTE_ADDR']."",
							  "newsletter"     =>"1",
							  "id_user_type"   =>"4",
							  "is_countystaff" =>"".$county_staff.""
							  );
		//displayArray($account_user_arr); exit;
	$account_user_id  = $ddSelect->getAddUserAccount($email, $account_user_arr, 1); //echo $account_user_id; exit;
	$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
	$ddSelect->addUserToCategory($account_user_cat, $account_user_id);
	/* =============================================== */
		
		
		
	/*$county_staff   = checkIfStaff($u_email);
	$sqpost = "insert into `mrfc_reg_users`  "
	."(`ac_type`,`firstname`, `lastname`, `email`, `phone`, `organization`, `country`, `ipaddress`, `newsletter`, `published`, `is_countystaff`)  values "
	."('mail', ".$postb['firstname'].", ".$postb['lastname'].", ".$postb['email'].", ".$postb['phone'].", ".$postb['ac_organization'].", ".$postb['ac_country'].", '".$_SERVER['REMOTE_ADDR']."', 1, 1, '".$county_staff."')"; 	
	$cndb->dbQuery($sqpost);
	$id_user = $cndb->insertId();*/
	
	
	}
	else
	{

	$email = $_SESSION['email_mailing'];
	
	$sqpost = "update `mrfc_reg_users` set `firstname` = ".$postb['firstname'].", `lastname` = ".$postb['lastname'].", `phone` = ".$postb['phone'].", `organization` = ".$postb['ac_organization'].", `country` = ".$postb['ac_country']." WHERE (`email` = '".$email."' and `ac_type` = 'mail' )";
	$cndb->dbQuery($sqpost);
	
	}
	//echo $sqpost; exit;
	
	
		
	if($redirect == "") { $redirect = "home/";}
	$redirect = "home/?qst=2"; //cleanRedStr($redirect)."qst=2";
		
		//$redirect .= $redstr."";
	
	?> <script language='javascript'> location.href="<?php echo $redirect; ?>"; </script> <?php
	exit;
}
	
	
	
/* ============================================================================== 
/*	MAILING SUBSCRIPTION
/* ------------------------------------------------------------------------------ */	

if($formname=="mailingtiny")
{
	//exit;
	$email = filter_var($post['email_nl'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$formReject = $ref_back."qst=100#fm-subscribe";
		echo "<script language='javascript'>location.href=\"$formReject\"; </script>";
	}
	
	
	$email = $post['email_nl'];
	
	
	/* =============================================== */
	/* get Account, Category | Link Account to Category */
	$post['formtype'] = 'Mailing List';
	$county_staff   	= checkIfStaff($email);
	$account_pref 		= array("pref_dataset" 	=> "".@$post['datasets'].""
							  );
	$account_user_arr 	= array("newsletter"    => "1",
							    "staff" 		=> "".$county_staff.""
							  );
	$account_user_id  = $ddSelect->getAddUserAccount($email, $account_user_arr, 1); //echo $account_user_id; exit;
	$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
	$ddSelect->addUserToCategory($account_user_cat, $account_user_id, $account_pref);
	/* =============================================== */
	
	//echobr($GLOBALS['EXISTS_MAILING_ACCOUNT']); exit;
	if($GLOBALS['EXISTS_MAILING_ACCOUNT'] == false) 
	{ 
		$redirect = "mailing.php?com=1&opt=mail";
		$_SESSION['email_mailing'] = $post['email_nl'];
	/* ==================================================
	@start - inform admin
	**************************************************** */
	
		$subject	= 'New mailing list subscription '; 
		$message	='<br><br> New Mailing list subscription was received from:<br>'
			.'<blockquote><b>EMAIL:</b> '.$email
			.'</blockquote>'
			.'<em>***<font size="2">Please do not reply to this email as we are not able to respond to messages sent to this address.</font></em><br/>'
			.'<br>Regards, <br> <b>Website Administrator</b><br>'
			. date("F j, Y, g:i a").'<br><hr>'
			.'Message sent from: '.$_SERVER['HTTP_HOST'].'<hr />';
		
		$sendto[0]	= "munene.murage@gmail.com";
		$sendto[1]	= "".SITE_MAIL_TO_BASIC."";
	
		$i=0;
		for($i==0; $i<=(count($sendto)-1); $i++ )
		{	//echo "<hr>".$sendto[$i]."<br>".$sendfrom."<br>".$subject."<br>".$message; exit;
			$mailer->form_alerts($sendto[$i], $subject, $message);	
		}
	/* ****************************************************
	@end - inform admin
	====================================================== */
		$redirect = "index.php?qst=2"; 
	}
	else { $redirect = "index.php?qst=4"; }
	
	//exit;
	?> <script language='javascript'>location.href="<?php echo $redirect; ?>"; </script> 
	<?php exit;
	
}
	
	
	
/* ============================================================================== 
/*	FEEDBACK FORM
/* ------------------------------------------------------------------------------ */	

if($formname=="feedback")
{	
	//displayArray($post);
	$email = filter_var($post['email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$formReject = $ref_back."qst=100#fm-feedback";
		echo "<script language='javascript'>location.href=\"$formReject\"; </script>";
	}
	
	//`subject`,,".$postb['subject']."
	$sendfrom = $email;
	$sqpost="insert into `mrfc_dt_feedback`  "
	."(`name`, `email`, `phone`,  `subject`,  `details`, `ipaddress`) "
	." values "
	."(".$postb['fullname'].", ".$postb['email'].", ".$postb['phone'].", ".$postb['subject'].", ".$postb['details'].", '".$_SERVER['REMOTE_ADDR']."')";
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
	
	
	$u_name 		 = preg_split("/ /", $post['fullname']);	
	$u_name_first   = @$u_name[0];
	$u_name_last    = @$u_name[1];
	//if(strlen($u_name[0]) > 3) {	$u_name_first  = $u_name[0]; }
	//if(strlen($u_name[1]) > 3) {	$u_name_last   = $u_name[1]; }
	
	/* get Account, Category | Link Account to Category */
	$account_staff   = 0; /*checkIfStaff($post['email']);*/
	$account_user_arr = array("namefirst"=>"".$u_name_first."",
							  "namelast"=>"".$u_name_last."",
							  "staff"=>"".$account_staff."",
							  "phone"=>"".$post['phone'].""
							  );
	//exit;
	$account_user_id  = $ddSelect->getAddUserAccount($post['email'], $account_user_arr);
	$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
	$ddSelect->addUserToCategory($account_user_cat, $account_user_id);
	/* =============================================== */
	
	
	/* =============================================== */	
	/* @@ FEEDBACK POST - Admin Notification   */
	
		$message_notify_admin = array("post_name" =>"feedback_post_notify", 
						        "contact_name"  =>"".$post['fullname']."",
								"contact_email"  =>"".$post['email']."",
								"contact_phone"  =>"".$post['phone']."",
								"message_detail"  =>"".html_entity_decode(stripslashes($post['details']))."",
								"message_subject" =>"- New Online Feedback",
							    "message_to"   	=>"".SITE_MAIL_TO_BASIC."" );
		
		$mailer->messageTemplate('feedback_post_notify', $message_notify_admin, 1);	
		
	/* --- end ---	*/								
	/* =============================================== */	
	
	
	$redirect = cleanRedStr($redirect, "qst=1"); 
	//exit;
	echo "<script language='javascript'>location.href=\"$redirect\"; </script>";
	exit;
}
	


	
/* ============================================================================== 
/*	COURSE ENQUIRY FORM
/* ------------------------------------------------------------------------------ */	

if($formname=="frm_course_enquiry")
{	
	//displayArray($post); //exit;
	/*$email = filter_var($post['email'], FILTER_SANITIZE_EMAIL);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$formReject = $ref_back."qst=100#fm-feedback";
		echo "<script language='javascript'>location.href=\"$formReject\"; </script>";
	}*/
	
    $subject    = 'Course Enquiry';
    $details    = 'Interested in: ' . $post['details'] .'<br> From page: '. $post['redirect'];
	
	$sqpost="insert into `mrfc_dt_feedback`  "
	."(`name`, `email`, `phone`,  `subject`,  `details`, `ipaddress`) "
	." values "
	."(".$postb['fullname'].", '', ".$postb['phone'].", ".q_si($subject).", ".q_si($details).", '".$_SERVER['REMOTE_ADDR']."')";
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
	
	
	$u_name 		 = preg_split("/ /", $post['fullname']);	
	$u_name_first   = @$u_name[0];
	$u_name_last    = @$u_name[1];
	
	/* get Account, Category | Link Account to Category */
	$account_staff   = 0; /*checkIfStaff($post['email']);*/
	$account_user_arr = array("namefirst"=>"".$u_name_first."",
							  "namelast"=>"".$u_name_last."",
							  "staff"=>"".$account_staff."",
							  "phone"=>"".$post['phone'].""
							  );
	//exit;
	/*$account_user_id  = $ddSelect->getAddUserAccount($post['email'], $account_user_arr);
	$account_user_cat = $ddSelect->getAddUserCat($post['formtype']);
	$ddSelect->addUserToCategory($account_user_cat, $account_user_id);*/
	/* =============================================== */
	
	
	/* =============================================== */	
	/* @@ FEEDBACK POST - Admin Notification   */
	
		$message_notify_admin = array("post_name" =>"feedback_post_notify", 
						        "contact_name"  =>"".$post['fullname']."",
								/*"contact_email"  =>"".$post['email']."",*/
								"contact_phone"  =>"".$post['phone']."",
								"message_detail"  =>"".html_entity_decode(stripslashes($details))."",
								"message_subject" =>"- New Course Enquiry",
							    "message_to"   	=>"".SITE_MAIL_TO_BASIC."" );
		
		$mailer->messageTemplate('feedback_post_notify', $message_notify_admin, 1);	
		
	/* --- end ---	*/								
	/* =============================================== */	
	
	
	$redirect = cleanRedStr($redirect, "qst=5"); 
	//exit;
	echo "<script language='javascript'>location.href=\"$redirect\"; </script>";
	exit;
}
	

			
?>
