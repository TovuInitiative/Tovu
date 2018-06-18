<?php
@ini_set('upload_max_filesize', '15M');
//require SITE_PATH .'apps/phpmailer/PHPMailerAutoload.php'; 
class mailer 
{
	var $sendto; 
	var $subject; 
	var $message; 
	var $sendfrom;
	
	function form_alerts($sendto, $subject, $message, $debug = 0) 
	{
		$content = '<html><head><title>'.$subject.'</title></head>'
			.'<body style="font-family: Tahoma, Verdana, Arial; font-size:12px;">'.$message.'</body></html>';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n"; 				// To send HTML mail, the Content-type header must be set
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$sendto. "\r\n";	// Additional headers
		$headers .= 'From: '.SITE_MAIL_SENDER.' <'.SITE_MAIL_FROM_BASIC.'>' . "\r\n"; 
     	
		if($debug == 1) { echo "<hr>".$sendto."<br>".$subject."<br>".$message."<hr><br>"; } 
		else { return 	@mail($sendto, $subject, $content, $headers); }
	}
	
	
	function messageLayout($mail_cont)
	{
		$emailpage = $GLOBALS['EMAIL_TEMPLATE']; //file_get_contents(SITE_DOMAIN_LIVE.'mailweb.php');
		$emailpage = str_replace("{_EPLATFORM_MAIL_CONTENT_GUTS_}", $mail_cont, $emailpage);
		
		return $emailpage;
	}	
	
	
	function messageTemplate($em_cat, $em_arr = array(), $cc_me = 1, $debug = 0, $em_cc = '') 
	{
		$msgSubject = ''; $msgCont = ''; $messageContent  = ''; $em_out = array(); $em_invalid = '';
		$em_out['sendto'] = $em_cc; //array();
		if($em_cat <> '') {
						
			if($cc_me == 1) { 
			$em_out['sendto'][] = "munene.murage@gmail.com"; }
			$em_out['cont'] 	 = $em_arr;
			$em_out['sendto'][] = SITE_MAIL_TO_BASIC;
			
			foreach($em_out['cont'] as $cKey=>$cval){
				$msgCont .= '<b>'.strtoupper($cKey).': </b> &nbsp; '.$cval.'<BR><BR>';
			}
			switch($em_cat)
			{ 
				
				
				case "feedback_post_notify":
				
					$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' '. $em_arr['message_subject'].'';
					
					$messageContent  = 'Hi,<br><br> You have recieved feedback from <b>'.SITE_TITLE_SHORT.'</b> website as detailed below:<br>'
					.'<blockquote><b>SENDER:</b> '.$em_arr['contact_name']
					.'<BR><BR><b>EMAIL:</b> '.$em_arr['contact_email']
					.'<BR><BR><b>TELEPHONE:</b> '.$em_arr['contact_phone']
					.'<BR><BR><b>DETAILS:</b> '.$em_arr['message_detail']
					.'</blockquote>'
					.'<br>Regards, <br> <b>Website Administrator</b><br>';
					
					$em_out['message']  = $this->messageLayout($messageContent);					
					//return $em_out;
					
				break;
				
				
				
				
				case "account_verify":
				
					$em_out['sendto'][] = "".$em_arr['message_to']."";
					/*array_push($em_out['sendto'],"".$em_arr['message_to']."");*/
					
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Thank you for signing up with '.SITE_TITLE_SHORT.'. <br><br>Verify your account by clicking on the link below: </p>'
						.'<p>' . $em_arr['message_link'] . '<br><br>'
						.'<em>(This message is intended for "' .  $em_arr['contact_email'] . '")<br />***<font size="2">This e-mail has been automatically generated. Do not reply to this address.</font></em></p>'
						.'<p><strong>Best Regards, <br> <u>'.SITE_TITLE_SHORT.' Accounts Coordinator</u></strong></p><br>';
						//.'<hr>'
						//.'Message sent from: '.$_SERVER['HTTP_HOST'].'<br> '. date("F j, Y, g:i a").'<hr />';
					
					$em_out['message']  = $this->messageLayout($messageContent);					
					//return $em_out;
					
				break;
				
				
				case "account_invite":
				
					$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' - '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Hi, <br><br>You have been invited to sign up to '.SITE_TITLE_SHORT.' by '.$em_arr['message_sender'].'. <br><br>Click on the link below to accept the invitation. You will be required to create your access password. <br><br>If you ignore this email the request will not be processed. </p>'
						.'<p>' . $em_arr['message_link'] . '<br><br>'
						.'<em>(This message is intended for "' . $em_arr['contact_email'] . '")<br />***<font size="2">This e-mail has been automatically generated. Do not reply to this address.</font></em></p>'
						.'<br><p><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
						.'<br>';
						//.'<hr>Message sent from: '.$_SERVER['HTTP_HOST'].'<br> '. date("F j, Y, g:i a").'<hr />';
					
					$em_out['message']  = $this->messageLayout($messageContent);
					
				break;
				
					
					
				case "account_passreset":
					
					$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' - '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Hello ' . $em_arr['contact_name'] . ' <br><br> Someone has requested a link to change your '.SITE_TITLE_SHORT.' password, and you can do this through the link below. </p>'
						.'<p>' . $em_arr['message_link'] . '<br><br>'
						.'If you did not request this, please ignore this email. Your password won\'t change until you access the link above and create a new one. <br><br>'
						.'<em>(This message is intended for "' . $em_arr['contact_email'] . '")<br />***<font size="2">This e-mail has been automatically generated. Do not reply to this address.</font></em></p>'
						.'<br><p><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
						.'<br>';					
					$em_out['message']  = $this->messageLayout($messageContent);
					//return $em_out;
					
				break;
				
				
				case "account_passchange":
				
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' - '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Hello ' . $em_arr['contact_name'] . ' <br><br> Your '.SITE_TITLE_SHORT.' account password has been updated. </p>'
						.'<p>If you did not take this action, contact the administrator on <a href="mailto:portal@'.SITE_DOMAIN_URI.'?subject=Unauthorized password change!">portal@'.SITE_DOMAIN_URI.'</a>. <br><br>'
						.'<em>(This message is intended for "' . $em_arr['contact_email'] . '")<br />***<font size="2">This e-mail has been automatically generated. Do not reply to this address.</font></em></p>'
						.'<br><p><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
						.'<br>';					
					$em_out['message']  = $this->messageLayout($messageContent);
					//return $em_out;
					
				break;	
				
					
					
				case "new_upload_notify":
				
					//$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Hi,<br><br> A new resource has been uploaded on <b>'.SITE_TITLE_SHORT.'</b>.</p>'
						.'<blockquote><b>UPLOAD TITLE:</b> '.$em_arr['entry_name']
						.'<BR><BR><b>CONTACT NAME:</b> '.$em_arr['contact_name']
						.'<BR><BR><b>CONTACT EMAIL:</b> '.$em_arr['contact_email']
						.'<BR><BR><b>CONTACT ORGANIZATION:</b> '.$em_arr['contact_org']
						.'<BR><BR><b>UPLOAD ID:</b> '.$em_arr['entry_id']			
						.'</blockquote>'
						.'<br><p>Regards, <br><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
						.'<br>';
			
					$em_out['message']  = $this->messageLayout($messageContent);
					//return $em_out;
					
				break;
					
					
				case "new_event_notify":
				
					//$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Hi,<br><br> A new event has been posted to <b>'.SITE_TITLE_SHORT.'</b>.</p>'
						.'<blockquote><b>ENTRY TITLE:</b> '.$em_arr['entry_name']
						.'<BR><BR><b>CONTACT NAME:</b> '.$em_arr['contact_name']
						.'<BR><BR><b>CONTACT EMAIL:</b> '.$em_arr['contact_email']
						.'<BR><BR><b>CONTACT ORGANIZATION:</b> '.$em_arr['contact_org']
						.'<BR><BR><b>ENTRY ID:</b> '.$em_arr['entry_id']			
						.'</blockquote>'
						.'<br><p>Regards, <br><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
						.'<br>';
			
					$em_out['message']  = $this->messageLayout($messageContent);
					
				break;	
				
				
				case "request_notify_admin":
				
					$em_out['sendto'][] = "".$em_arr['message_to']."";
					$em_out['subject']  = ''.SITE_TITLE_SHORT .' - '. $em_arr['message_subject'].'';
					
					$messageContent  = '<p>Request details below:</p>'
			.'<blockquote><b>REQUEST TYPE:</b> '.$em_arr['post_type']
			.'<BR><BR><b>NAME:</b> '.$em_arr['post_name']
			.'<BR><BR><b>CONTACT NAME:</b> '.$em_arr['contact_name']
			.'<BR><BR><b>CONTACT EMAIL:</b> '.$em_arr['contact_email']
			.'</blockquote>'
			.'<br><p><strong><u>'.SITE_TITLE_SHORT.' Webmaster</u></strong></p>'
			.'<br>';
			//.'<hr>Message sent from: '.$_SERVER['HTTP_HOST'].'<br> '. date("F j, Y, g:i a").'<hr />';
					$em_out['message']  = $this->messageLayout($messageContent);
					//return $em_out;
					
				break;
				
				
				default:
					//return 'invalid_request';	
					$em_invalid = 'invalid_request';
				break;
				
									
			}
			
		}
		else
		{
			$em_invalid = 'invalid_request'; //return 'invalid_request';	
		}
		
		if($em_invalid == '')
		{
			foreach($em_out['sendto'] as $em_to)  { 
				$em_res = ($em_to <> '')? $this->form_alerts($em_to, $em_out['subject'], $em_out['message'], $debug): ''; 
			}
		}
			
	}
	/* @end: messageTemplate*/
	
}

$mailer = new mailer;








function getChecksum($input) 
{
	$checkval = crc32($input);
	if($checkval < 0) {
		$checkval = $checkval *-1;
	}
	return $checkval;
}

/******************************************************************
@begin :: IMAGE UPLOAD FUNCTION
********************************************************************/	

function imageUploadArr ($pic, $uploadname, $uploadtarget, $getthumbnail, $loopNum)
{
	//$img_mimetypes = array("image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png");
	$image_details 	= getimagesize($pic['tmp_name'][$loopNum]);
	
	$mimetype 		= $image_details['mime'];
	$image_size 	= $pic['size'][$loopNum];
	$max_size 		= "500000";
	$img_ext 		= ".".getFileExtension(strtolower($pic['name'][$loopNum]));
	
	$img_new_name 	=  $uploadname.$img_ext;  
	$img_thmb_name 	=  $uploadname."_t".$img_ext;
	
				
	if(substr($mimetype,0,6) == "image/")
	{
		$filename 		= $img_new_name; 					
		$filename_thmb 	= $img_thmb_name;
		
		$source = $pic['tmp_name'][$loopNum];	
		$target = $uploadtarget . $filename;
		
		$isUploaded = move_uploaded_file($pic['tmp_name'][$loopNum], $target);
		
		if($isUploaded)
		{
			if($getthumbnail==1) {
			createThumbnail($filename, $image_details, $filename_thmb, $uploadtarget, 1);	
			}	
		
			echo "<script>alert(\"Image was successfully uploaded.\"); </script>";
			$the_image 	= $filename; 
			
		}
		else
		{
			echo "<script>
				alert(\"Image was NOT uploaded.\nPlease ensure destination folder exists and you are allowed access.\");
				history.back(-1);
			  </script>";  
				exit;  							
		}
		 

	}	
	else
		{
			echo "<script>
				alert(\"File selected for upload is not an Image.\");
				history.back(-1);
			  </script>";  
			exit;  
		}
	return $the_image;
}

	
function imageUpload ($pic, $uploadname, $uploadtarget, $getthumbnail = 0)
{
	$the_image = array();
		
	/* ===================================================
	$img_mimetypes = array("image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png");
	====================================================== */
	$image_details 		= getimagesize($pic['tmp_name']); displayArray($pic);
	$mimetype 		 	= $image_details['mime'];
	$image_size 	   	= $pic['size'];
	$max_size 		 	= "1000000";
	$img_ext 		  	= "." . getFileExtension(strtolower($pic['name']));
	
	$img_new_name 	 	=  $uploadname.$img_ext;  
	$img_thmb_name 		=  $uploadname."_t".$img_ext;
				
	if(substr($mimetype,0,6) == "image/")
	{
		$filename 		 	= $img_new_name; 					
		$filename_thmb 		= $img_thmb_name;
		
		$source = $pic['tmp_name'];	
		$target = $uploadtarget . $filename;
		
		if (intval($image_size) > intval($max_size)) 
		{  
			$the_image 	= array('name' => ''.$filename.'', 'thumb' => ''.$filename_thmb.'', 'result' => 0);	
		}
		else
		{
					//echobr($pic['tmp_name']); exit;
			$isUploaded = move_uploaded_file($pic['tmp_name'], $target);
			
			if($isUploaded)
			{
				$img_result   = createThumbnail($filename, $image_details, $filename_thmb, $uploadtarget, $getthumbnail);	
				$img_size_new = filesize($uploadtarget . $filename);
				//echo $img_size_new; exit;
				
				$the_image 	= array('name' => ''.$filename.'', 'thumb' => ''.$filename_thmb.'', 'size' => ''.$img_size_new.'', 'result' => 1);
			}
			else
			{
				$the_image 	= array('name' => ''.$filename.'', 'thumb' => ''.$filename_thmb.'', 'result' => 0);					
			}
		 }

	}	
	else
	{
		$the_image 	= array('name' => ''.$img_new_name.'', 'thumb' => ''.$img_thmb_name.'', 'result' => 0);	
	}
	return $the_image;
}
/******************************************************************
@end :: IMAGE UPLOAD FUNCTION
********************************************************************/	




function fileUpload ($file, $loop=0, $uploadname, $uploadtarget, $mimeoptions = 1, $getthumbnail = 0)
{
	$max_size 		= "5000000";
	
	$mimetypes = array(
		"application/pdf",
		"application/msword", 
		"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 		
		"application/vnd.ms-powerpoint", 
		"application/vnd.openxmlformats-officedocument.presentationml.presentation",
		"application/vnd.ms-excel",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
		"text/plain", "text/csv", "text/comma-separated-values",
		"image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png"
		);
		
	if($mimeoptions == 2) {
		$image_details 	= getimagesize($file['tmp_name'][$loop]);
		$item_type 		= $image_details['mime'];		
		
		$mimetypes = array(
		"image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png"
		);
	} 
	elseif($mimeoptions == 1) 
	{
		$item_type 		= $file['type'][$loop];
	}
	
	$item_arr 	    = array();
	$item_source 	 = $file['tmp_name'][$loop];
	$item_size 	   = $file['size'][$loop];
	
	$item_ext_a	   = getFileExtension(strtolower($file['name'][$loop]));
	
	$item_ext 		= "." . $item_ext_a;
	$item_new 		=  $uploadname . $item_ext;  
	$item_target 	 =  $uploadtarget . $item_new;
	
	
	if(in_array($item_type, $mimetypes))
	{
		if (intval($item_size) > intval($max_size)) 
		{  
			$item_arr 	= array('name' => ''.$item_new.'', 'result' => 0, 'error' => 'File exceeds size limit.');	
		}
		else
		{
					
			$isUploaded = @move_uploaded_file($item_source , $item_target);
			
			if($isUploaded)
			{
				$item_arr 	= array('name' => ''.$item_new.'', 'result' => 1);
			}
			else
			{
				$item_arr 	= array('name' => ''.$item_new.'', 'result' => 0, 'error' => 'File not uploaded. Contact Admin.');					
			}
		}		
	}
	else
	{
		$item_arr 	= array('name' => ''.$item_new.'', 'result' => 0, 'error' => 'Invalid file type.');	
	}
		
			
	return $item_arr;
}





	

function copy_file($source, $destination) 
{
        $sp = fopen($source, 'r');
        $op = fopen($destination, 'w');

        while (!feof($sp)) {
            $buffer = fread($sp, 512);  // use a buffer of 512 bytes
            fwrite($op, $buffer);
        }
        // close handles
        fclose($op);
        fclose($sp);
    }

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 



/******************************************************************
@begin :: USER RIGHTS
********************************************************************/	

function accountRights($roleID) 
{
	$privList   = array();
	$roleValues = array();
	
	if($roleID <> '')
	{
	
		$sq_priv_roles = "SELECT `priv_id`, `priv_value` FROM `afp_conf_privilege_to_roles` WHERE (`role_id` = ".quote_smart($roleID)." AND `priv_value` ='1');";
		$rs_priv_roles = $this->dbQuery($sq_priv_roles);
		
		if($this->recordCount($rs_priv_roles)>=1)
		{   while($cn_priv_roles = $this->fetchRow($rs_priv_roles))
			{ $roleValues[$cn_priv_roles['priv_id']] = $cn_priv_roles['priv_value']; }
		}
	
		$sq_priv = "SELECT `priv_id` , `priv_type` , `priv_code` FROM `afp_conf_privilege_list` WHERE (`priv_type` ='fmod');"; 	
		$rs_priv = $this->dbQuery($sq_priv); 
		if($this->recordCount($rs_priv))
		{
			while($cn_privileges = $this->fetchRow($rs_priv))
			{
				$priv_id 	 = $cn_privileges['priv_id'];
				$priv_code   = $cn_privileges['priv_code'];
				//$priv_value  = $cn_privileges['priv_value'];
				//if($priv_value <> 1) { $priv_value = 0; }	
				
				$priv_value = 0;
				
				if(array_key_exists($priv_id, $roleValues)) { $priv_value = 1; }
				
				$privList[$priv_code] = $priv_value;
			}
			
		}
	}

	return $privList;		
}

$colBgGuts = '#f9f9f9';
$colBgHead = '#A39482';
$logo = 'http://sand-box.online/maarifacentre/assets/image/maarifa_logo_single.png';

$emailTemplate = '<table width="100%" bgcolor="#FFF" border="0" cellspacing="0" align="center" cellpadding="2" style="margin:0;font-family:calibri,tahoma,arial,sans-serif; color: #666666; font-size: 13px;">
<tr><td style="padding:15px 10px 40px;">
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" style="max-width:720px; margin:auto; border-collapse:collapse; box-shadow: 0px 0px 4px 1px #333;"  bgcolor="#FFFFFF">
<tr bgcolor="'.$colBgHead.'"><td colspan="3" valign="middle" height="90"><table border="0" width="100%"><tr>
<td width="220" height="90" rowspan="2" align="center">
<a href="'. SITE_DOMAIN_LIVE.'" target="_blank" style="text-decoration:none;">
<img src="'.$logo.'" width="200" alt="'. SITE_TITLE_SHORT.'"></a></td>
<td valign="bottom" align="left" style="font-family:calibri,tahoma,arial,sans-serif;font-size:17px;color:#000;font-weight:bold;color:#666;">'. SITE_TITLE_LONG.'</td>
<td valign="bottom" align="left" style="font-family:calibri,tahoma,arial,sans-serif;font-size:21px;color:#666;font-weight:bold;">&nbsp;</td></tr><tr>
<td valign="top" align="left" style="font-family:calibri,tahoma,arial,sans-serif;color:#666;font-size:12px;">Email Notification</td>
<td valign="top" align="right" nowrap style="font-family:calibri,tahoma,arial,sans-serif;color:#666666;font-size:12px;">'. date("F j, Y").'</td></tr></table>	
</td></tr>
<tr><td width="10" bgcolor="'.$colBgGuts.'" style="height:15px;"></td>
<td align="right" bgcolor="'.$colBgGuts.'" style="font-family:calibri,tahoma,arial,sans-serif;color:#666666;font-size:12px;"></td>
<td width="10" bgcolor="'.$colBgGuts.'"></td></tr>
<tr><td bgcolor="'.$colBgGuts.'">&nbsp;</td>
<td style="font-family:calibri,tahoma,arial,sans-serif;color:#666666;font-size:14px; padding:20px;padding-bottom:40px;">
{_EPLATFORM_MAIL_CONTENT_GUTS_} </td>
<td bgcolor="'.$colBgGuts.'">&nbsp;</td></tr>
<tr><td bgcolor="'.$colBgGuts.'">&nbsp;</td>
<td bgcolor="'.$colBgGuts.'" align="center" style="font-family:calibri,tahoma,arial,sans-serif;color:#666666;font-size:12px;padding:3px 0px 15px;"><!--contacts-->
</td><td bgcolor="'.$colBgGuts.'">&nbsp;</td>
</tr><tr bgcolor="'.$colBgHead.'" style="border-left:1px solid #92D050;border-right:2px solid #92D050;">
<td></td><td align="center" style="font-family:calibri,tahoma,arial,sans-serif;color:#666666;font-size:12px;padding:15px 0px 20px;">This e-mail has been automatically generated from '. $_SERVER['HTTP_HOST'].'.</td>
<td>&nbsp;</td></tr></table>
</td></tr></table>';


$GLOBALS['EMAIL_TEMPLATE'] = $emailTemplate;		
		
?>