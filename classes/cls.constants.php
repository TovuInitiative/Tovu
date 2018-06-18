<?php
ini_set("display_errors", "on"); 
//ini_set('error_reporting', 'off');
date_default_timezone_set('Africa/Nairobi');

require_once('cls.formats.php');
require_once('cls.config.php');	
require_once('cls.sessions.php');	
require_once('cls.defines.php');
require_once('cls.data.site.php');
require_once('cls.data.resources.php');

require_once('cls.select.php');
require_once('cls.displays.php');
require_once('cls.post.php');


$msge_array  = array(
		199  => "You have been logged out. Login to proceed.",
		3 => "Your password was reset. Check your email for the new password.",
		1  => "Thank you. Feedback Posted Successfully",
		2 => "Your subscription for updates has been saved.",
        5  => "Thank you. Call Request Submitted. We will get in touch.",
		7  => "Update successfull.",
		8  => "Your Online Application was received. We will contact you through details provided.",
		
		/* account alerts */
		//101 => "Welcome. ",
		106 => "Account Verified. Login using your credentials. ",		
		100 => "Error. Please enter a valid email.",				
		114 => "Error. Please confirm your login details.",
		115 => "Error. Password NOT changed. Enter valid passwords or make a new request.",
		116 => "Error. Passwords Dont Match.",		
		117 => "Error. Account Registration NOT Successfull. Try again or contact the Administrator.",
		
		20 => "Error. Account with specified Email exists!",
		21 => "Error. Account does NOT exist or is not verified.",
		
		22 => "Account Sign Up: Check email for confirmation details.",
		23 => "Log in below to proceed.",
		24 => "Message sent.",
		25 => "Your contribution was posted successfull.",
		26 => "Reset Password: Check your email for a verification link. <b>If you dont see the email check in your SPAM folder</b>.",
		27 => "Success: New password saved. Login using your credentials below.",
		
		// APPLICATION FORMS	
		32 => "Partner Registration: Check your email for confirmation link.",
		33 => "Listing Request: <br>Check your email for confirmation link.",
		34 => "Advert Post: <br>Check your email for confirmation link.",
		35 => "Message Pending.",
		36 => "Message Pending.",
		
		// USER POSTS	
		201 => "Your comments have been submitted.<br>Posted comments will be published once approved.",
		202 => "Check your email for account verification link.",
		203 => "Account Verified.<br>Awaiting approval from the administrator.",
		205 => "Account Verified.",
		
		// ASSEMBLY FUNCTIONS
		221 => "Disabled Process.<br>You have pending Un-surrendered Imprest(s).",
		223 => "Invalid Request.<br>Applicable to Members of County Assembly Only.",
		
		251 => "Meeting for this date already exists for this Sector!",
		
		// ADMIN NOTIFICATIONS	
		241 => "Request Processed.",
		
		401 => "The requested URL was not found on this server.",
		
		);
		

$mimetypes = array(
			"application/pdf",
			"application/msword", 
			"application/vnd.openxmlformats-officedocument.wordprocessingml.document", 		
			"application/vnd.ms-powerpoint", 
			"application/vnd.openxmlformats-officedocument.presentationml.presentation",
			"application/vnd.ms-excel",
			"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
			"text/plain", "text/csv", "text/comma-separated-values",
			"image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png", "application/zip"
			);

$uploadMime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,video/mp4,image/png,image/jpg,image/jpeg,application/zip';

$imageMime = array("jpeg", "jpe", "jpg", "pjpeg", "gif", "png", "x-png" );



$m2_data=new displays;
$m2_data->addir = $dir; 

if(strpos($_SERVER['REQUEST_URI'],'sysadm/')) //($this_page == 'home.php')
{		
	echobr('admin');
	
}


$ddSelect = new drop_downs;






/*-----------------------------------------------------------------------------------*/
/*	ACCESS RIGHTS FOR LOGGED IN USER
/*-----------------------------------------------------------------------------------*/

function get_UserAccess($staff) {
	
	//$u_contacts = '';
	//$this->connect() or trigger_error('SQL', E_USER_ERROR);
	
	$departments = array();
	$groups	  = array();
	
	$sq_data ="SELECT `id_department`, `id_group` FROM `mrfc_relations_group_dept` WHERE
	 (`id_staff` = ".quote_smart($staff).")  and `id_group` <> '0' or 
	 (`id_staff` = ".quote_smart($staff).")  and `id_department` <> '0' ; ";
	 //echo $sq_data;
	 
	$rs_data = $this->dbQuery($sq_data);	//

	if($this->recordCount($rs_data) >0 )
	{
		while($cn_data = $this->fetchRow($rs_data))
		{
			if($cn_data[0] <> 0) { $departments[$cn_data[0]] = $cn_data[0]; }
			if($cn_data[1] <> 0) { $groups[$cn_data[1]] 	  = $cn_data[1]; }
			
		}
	}
	//displayArray()
	$userAccess = array('depts' => $departments, 'groups' => $groups);
	return $userAccess;
}





/******************************************************************
@begin :: CACHE DATA FUNCTIONS
********************************************************************/

function saveJsonMenu(){
	$result = file_get_contents(SITE_DOMAIN_LIVE.'classes/kbDataMenu.php');	
	return true;
}

function saveJsonGallery(){
	$json = file_get_contents(SITE_DOMAIN_LIVE.'classes/kbDataGallery.php');
	return true;
}

function saveJsonContent(){
	$json = file_get_contents(SITE_DOMAIN_LIVE.'classes/kbDataContent.php');
	return true;
}		

function saveJsonResources(){
	$json = file_get_contents(SITE_DOMAIN_LIVE.'classes/kbDataResource.php');
	return true;
}	




function closestDate($dates, $findate)
{
	$newDates = array();
	foreach($dates as $date) { $newDates[] = $date['ev_date']; }
	sort($newDates);
	foreach ($newDates as $a) { if ($a >= $findate) { return $a; } }
	return end($newDates);
}


function modHeader($title){
	return '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">'.$title.'</h4><a href="#close-modal" rel="modal:close" class="close-modal ">Close</a></div><div class="modal-body">';
}

function modFooter(){
	return '</div></div></div>';
}



$cms_bg_color = $GLOBALS['SYS_CONF']['ADM_STYLE_BG'];

$my_redirect = '';

$GLOBALS['TW_URL'] = '';
$GLOBALS['FB_URL'] = '';

$GLOBALS['RESOURCE_STATUS'] = array('Live', 'Pending Approval', 'Draft', 'Archive', 'Declined');



/* ============================================================================== 
/*	AUTHORIZATION LEVELS
/* ------------------------------------------------------------------------------ */
//displayArray($sys_us_admin);
$level_front_admin          = false;
$level_front_user           = false;
$level_cms_admin            = false;
$level_cms_user             = false;
//echobr($us_type_id);
if($us_type_id == 1) { $level_front_admin = true; }
if($us_type_id == 2) { $level_front_user  = true; }
if($us_admin_type_id == 1) { $level_cms_admin = true; }
if($us_admin_type_id == 2) { $level_cms_user = true; }

?>
