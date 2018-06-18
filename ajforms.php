<?php require_once("classes/cls.constants.php"); //include("classes/cls.paths.php");

$ajRequest = array_map("clean_request", $_REQUEST); 

if (!empty($_GET['filter'])) { $filter = trim($_GET['filter']); } else { $filter = ''; }

if (!empty($_GET['parent'])) { $parent = trim($_GET['parent']); } else { $parent = ''; }
if (!empty($_GET['page'])) { $page = trim($_GET['page']); } else { $page = 0; }
if (!empty($_GET['img'])) { $img = trim($_GET['img']); } else { $img = ''; }
if (!empty($_GET['cs'])) { $cs = trim($_GET['cs']); } else { $cs = 'event'; }
if (!empty($_GET['vid'])) { $vid = trim($_GET['vid']); } else { $vid = ''; }



//$form_redirect = (@$_SESSION['sess_nfrt_active_url'] <> '') ? $_SESSION['sess_nfrt_active_url'] : 'result/'; 


if($op == 'edit') { $pg_op = 'Details'; } else { $pg_op = 'Add New'; }
$navTabLinks  = '';
//displayArray($dir);


switch($dir)
{ 
	
	case "account":
		echo modHeader('Sign up / Sign In');
        //echo $GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.login.php?rel=modal";
		include("includes/form.account.one.php");
		echo modFooter();
	break;
        
    case "video":
		echo modHeader('Viewer');        
		echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/z4q1EXxnTI4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
		echo modFooter();
	break;
    

	case "signup_organization":		
		echo modHeader('Sign up as Organization');
		include("includes/form.account.register.org.php");
		echo modFooter();
	break;
	
	case "pass_reset":		
		echo modHeader('Forgot Password');
		include("includes/form.account.reset.php");
		echo modFooter();
	break;
		
	case "member_password":		
		echo modHeader('Change Password');
		include("includes/members/mem_profile_password.php");
		echo modFooter();
	break;
	
	case "member_avatar":		
		echo modHeader('Your Profile Avatar');
		include("includes/members/mem_profile_avatar.php");
		echo modFooter();
	break;
		
		
	case "cont_event":	
		//echo modHeader('&nbsp');
		//echo '<div class="modal-dialog"><div class="modal-content"><div class="modal-body">';
		$dispData->buildContent_Arr();	
		include("includes/inc.calendar.detail.modal.php");
		//echo '</div></div></div>';
		//echo modFooter();
	break;
		
		
		
		
	case "vprofile":			
		$dispData->buildContent_Arr();	
		include("includes/committee/inc.cont.profile.detail.php");
	break;	
		
		
	case "cmt_mem_profile":			
       // echo modHeader('Member Profile');
		include("includes/committee/inc.cont.profile.detail-governor.php");
        //echo modFooter();
	break;
	
        
        
	case "ipop":	
		echo '<div class="modal"><img src="'.$img.'" /></div>';
	break;
		
		
		
		
    case "org_backlink_img":		
        echo modHeader('Back Link URL and Image');
        include("includes/members/mem_org_images.php");
        echo modFooter();
    break;		
	
	
        
    /*-------------------------------------------------------------------------------------------------------
        @BASIC UNITS DROP DOWN
    -------------------------------------------------------------------------------------------------------*/
    case "dat_stats":    
        if (!empty($_GET['parent'])) 
        {
            $prop_units = $dispDt->build_dat_indicators($_GET['parent']);

            $out = '<select name="indicator_id" id="indicator_id" class="form-control required ">';
            $out .= '<option value="">Select </option>';	// '.$unit.'
            $out .= $prop_units;
            $out .= '</select>';
            
            echo $out;
        }    
	break;	
        
        
		
	default:
		echo '<div class="modal-dialog"> <div class="modal-content"><div class="modal-header"> <h4 class="modal-title">'.SITE_TITLE_LONG.'</h4> </div> <div class="modal-body ">';
		echo '<h4>Invalid Request.</h4>';
		echo '</div> </div> </div>';
	break;

}

//include("includes/wrap_form_tabs.php");
?>
		


