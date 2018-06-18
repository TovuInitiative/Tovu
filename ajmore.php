<?php require("classes/cls.constants.php"); 
/*require('classes/cls.config.php');	
require('classes/cls.formats.php');
require('classes/cls.sessions.php');	
require('classes/cls.defines.php');
require_once('classes/cls.data.casoft.php');*/
//include("zscript_meta.php");

if (!empty($_GET['pg'])) { $pg = trim($_GET['pg']); } else { $pg = ''; }
if (!empty($_GET['pname'])) { $pname = trim($_GET['pname']); } else { $pname = ''; }
if (!empty($_GET['act'])) { $act = trim($_GET['act']); } else { $act = ''; }
if (!empty($_GET['filter'])) { $filter = trim($_GET['filter']); } else { $filter = ''; }
if (!empty($_GET['parent'])) { $parent = trim($_GET['parent']); } else { $parent = ''; }

$gstr = array_map("clean_request",$_REQUEST);
if(array_key_exists('fcall', $gstr)) { $fcall = $gstr['fcall']; $dir = $fcall; }
//displayArray($gstr);
$confDir = ucwords(clean_title($dir));
//displayArray($_REQUEST);
//echobr($dir);

if($pg == 'adm')
{
	switch($dir)
	{ 
		case "imprest_safari":
		case "committee_meeting":
			include("includes/cas_adm_form_approvals.php");
		break;
		
		case "committee_membership":		
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Committee Membership </h4></div><div class="modal-body">';
			include("includes/cas_form_comm_membership.php");
			echo '</div></div></div>';
		break;
		
	}
}
else
{
	
	$price = '1';
	
	if($op == 'edit') { $pg_op = 'Details'; } else { $pg_op = 'Add New'; }
	$navTabLinks  = '';
	
	switch($dir)
	{ 
		case "attendance_register":
			$meetArr = $dispCa->get_meeting_detail($gstr['id_sitting']); //displayArray($meetArr);
			$meet_date = date("M d Y",strtotime($meetArr['sitting_date'])); 
			$meet_time = date("h:i a",strtotime($meetArr['sitting_time']));
			
			//displayArray($meetArr);
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"> Attendance Register - '.$meetArr['sitting_type'].'</h4></div><div class="modal-body">';
			echo '<h4>'.$meetArr['title'].' - '.$meet_date.' '.$meet_time.'</h4>';
			echo $dispCa->get_attendance_register($gstr['id_sitting']);
			echo '</div></div></div>';
		break;
		
		case "committee_membership":		
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Committee Membership </h4></div><div class="modal-body">';
			include("includes/cas_form_comm_membership.php");
			echo '</div></div></div>';
		break;
		
		case "committee_budget":		
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Committee Budgets </h4></div><div class="modal-body">';
			include("includes/cas_form_comm_budget.php");
			echo '</div></div></div>';
		break;
			
			
		case "committee_meeting":		
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">New Committee Meeting </h4></div><div class="modal-body">';
			include("includes/cas_forms.php");
			echo '</div></div></div>';
		break;
		
		
		case "member_profile":	
		case "member_accounts":	
			$modalTitle = clean_title($gstr['op']).' '.$confDir;
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">'.$modalTitle.' </h4></div><div class="modal-body">';
			include("includes/cas_forms.php");			
			echo '</div></div></div>';
		break;
		
		
		case "member_password":		
			include("includes/cas_form_user_pword.php");
		break;
		
		
		case "member_avatar":		
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Your Profile Avatar </h4></div><div class="modal-body">';
			include("includes/cas_form_avatar.php");
			echo '</div></div></div>';
		break;
		
	
		case "sitting_allowances":
		case "member_allowance":		
		case "member_allowance_comm":
			echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Member Allowance Breakdown: </h4></div><div class="modal-body">';
			//displayArray($gstr);
			include("includes/cas_listings_allowance_breakdown.php");
			echo '</div></div></div>';
		break;	
		
		case "request_price":
			include("includes/form.request.price.php");
		break;	
		
		default:
			echo '<div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <h4 class="modal-title">'.SITE_TITLE_LONG.'</h4> </div> <div class="modal-body ">';
			echo '<h4>Invalid Request.</h4>';
			echo '</div> </div> </div>';
		break;	
	
	}

}
?>
		


