<?php require_once("../classes/cls.constants.php"); 

//displayArray($request);


switch($dir)
{ 
	
	case "committee_member":
		echo modHeader('Edit Committee Member');
		include("includes/adm_committee_member_form.php");
		echo modFooter();
	break;
	
	case "course_date":
		echo modHeader('Edit Course Date');
		include("includes/adm_courses_dates_add.php");
		echo modFooter();
	break;

	case "signup_organization":		
		echo modHeader('Sign up as Organization');
		echo modFooter();
	break;
	
	case "pass_reset":		
		echo modHeader('Forgot Password');
		echo modFooter();
	break;
		
	case "member_password":		
		echo modHeader('Change Password');
		echo modFooter();
	break;
	
	case "member_avatar":		
		echo modHeader('Your Profile Avatar');
		echo modFooter();
	break;
		
		
	default:
		echo '<div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <h4 class="modal-title">'.SITE_TITLE_LONG.'</h4> </div> <div class="modal-body ">';
		echo '<h4>Invalid Request.</h4>';
		echo '</div> </div> </div>';
	break;

}

//include("includes/wrap_form_tabs.php");
?>
		


