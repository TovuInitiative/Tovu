<?php

/******************************************************************
@begin :: SESSIONS
********************************************************************/	
$conf_token = time();

$contactLock = '';

$us_acc_current = '';
$us_id	   = '';
$us_name	 = '';
$us_fname	= '';
$us_lname	= '';
	
$us_email 	= '';
$us_type_id  = '';
$us_type  	 = '';
$us_level_id  = '';
$us_level  	 = '';
$us_org_id  = '';
$us_org     = '';
$us_post_id  = '';
$us_staff	= 0;
$us_photo    = 'no_avatar.png';
$us_login    = '';
$us_signed_in = false;
$us_access   = array();

$us_post     = '';
$us_dept     = '';

$us_first_name	= '';
$us_other_name	= '';
$us_type_label    = '';	

$member_is_admin = 0;

$sess_checker = time();
	


	
	//displayArray($_SESSION['sess_mrfc_member']);
if (!empty($_SESSION['sess_mrfc_member'])) 
{ 
	$sess_mbr	 	  = $_SESSION['sess_mrfc_member'];
	$sess_expire 	  = $sess_mbr['expires'];
	
	/*if($sess_checker >= $sess_expire)
	{
		if( $this_page <> "posts.php" ) {
		echo '<script type="text/javascript">location.href="'.SITE_DOMAIN_LIVE.'posts.php?signout=on";</script>'; exit;
		}
	}*/
		
	$us_id		 	= $sess_mbr['u_id'];	
	$us_name	   	= $sess_mbr['u_fname'] .' '. @$sess_mbr['u_lname'];	
	$us_email 	  	= $sess_mbr['u_email'];	
	$us_type_id  	= $sess_mbr['u_type_id'];	
	$us_type  	 	= $sess_mbr['u_type'];	
	$us_level_id   	= $sess_mbr['u_type_id'];	
	if($sess_mbr['u_avatar'] =='') { $sess_mbr['u_avatar'] = 'avatar_generic.png'; }
	$us_photo 	  	= @$sess_mbr['u_avatar'];
	$id_user 	   	= $us_id;
	
	
	$us_org_id 		= @$sess_mbr['u_organization_id'];
	$us_org  		= @$sess_mbr['u_organization'];
	//$us_name 	    = $us_fname; 
	
	$contactLock    = ' readonly="readonly" '; 
	
	$us_email_name  = explode(' ', $us_name); /*preg_split("/ /", $us_name);*/  
	//displayArray($us_email_name);
	
	$us_fname      = $sess_mbr['u_fname']; //$us_email_name[0];
	//if($us_name == '') { $us_name = $us_email_name[0]; }
	

	$us_lnk_home 	= 'client.php?op=list&order_lt=recent';	
	$us_tab 		= ($us_org_id > 0) ? 'dashboard' : 'resources';
	$us_acc_current = '<a href="profile.php?ptab='.$us_tab.'" title="'.$us_name.'"><i class="fa fa-user"></i> '.$us_fname.'</a>'; 
	
	$us_acc_logout = '<a href="posts.php?signout=on&tk='.time().'"><i class="fa fa-sign-out"></i>&nbsp; Log Out </a>';
	
} else { $sess_mbr	= ''; }



$sys_us_admin      = '';
$us_admin_type_id  = '';
$us_admin_id	   = '';
$us_admin_name	   = '';

if (!empty($_SESSION['sess_mrfc_admin'])) 
{ 
	$sys_us_admin      = $_SESSION['sess_mrfc_admin'];
    $us_admin_type_id  = $sys_us_admin['actype_id'];
    $us_admin_id       = $sys_us_admin['admin_id'];
    $us_admin_name     = $sys_us_admin['adminname'];
}

	
/******************************************************************
@end :: SESSIONS
********************************************************************/		

/*
<li><a data-url="accounts_settings.php?ptab=profile" data-id="profile"><i class="fa fa-gear"></i> Account Profile </a></li>
	<li><a data-url="accounts_settings.php?ptab=password" data-id="login"><i class="fa fa-key"></i> Change Password </a></li>
	<li><a data-url="accounts_resources.php?ptab=resources" data-id="resources"><i class="fa fa-download"></i> Resource Center </a></li>
*/

function conf_usAccLinks($acc_link_pos, $acc_roles='')
{
	$acc_link_list = '';
	$conf_token = time();
	
	$sess_mbr	 = $_SESSION['sess_mrfc_member'];
	//$us_staff = @$_SESSION['sess_mrfc_member']['u_staff'];
	
	if($acc_link_pos === 1) 
	{
/* @ MEMBER DROP DOWN BAR */		
		/*<li><a><i class="fa fa-unlock-alt"></i> &nbsp; <b>'.strtoupper($sess_mbr['u_type']).'</b></a></li>*/
	$acc_link_list = '
					  <li><a href="profile.php?ptab=profile" data-id="profile"><i class="fa fa-user"></i>&nbsp; Profile </a></li>
					  <li><a href="posts.php?signout=on&tk='.time().'"><i class="fa fa-sign-out"></i> Log Out</a></li>
					  ';
		
	}
	elseif($acc_link_pos === 2) 
	{

/* @ MEMBER SIDE BAR */
	
/*
<li><a href="profile.php?ptab=dashboard" data-id="dashboard"><i class="fa fa-files-o"></i> Dashboard </a></li>
<li class="divider">&nbsp;</li>
<li><a href="profile.php?ptab=memos" data-id="memos"><i class="fa fa-files-o"></i> VDS Memos </a></li>
<li><a href="profile.php?ptab=events" data-id="events"><i class="fa fa-calendar-o"></i> VDS Events </a></li>
*/
	
		$acc_link_list = '';
		
		
if($sess_mbr['u_organization_id'] <> '' and $sess_mbr['u_organization_id'] > 0)
{	
	/*$acc_link_list .= '<li class="divider padd15_tX bold">'. strtoupper($sess_mbr['u_organization']) .'</li>
	<li class="divider bold"><a href="profile.php?ptab=dashboard" data-id="dashboard"><i class="fa fa-dashboard"></i>&nbsp;  Dashboard </a></li>
	<li><a href="profile.php?ptab=org_resources" data-id="org_resources"><i class="fa fa-download"></i>&nbsp; Organization Resources </a></li>
	<li><a href="profile.php?ptab=org_calendar" data-id="org_calendar"><i class="fa fa-calendar-o"></i>&nbsp; Organization Calendar </a></li>
	'; //*/

	if($sess_mbr['u_type_id'] == 1 or $sess_mbr['u_type_id'] == 3)
	{

		$acc_link_list .= '	
		<li><a href="profile.php?ptab=organization" data-id="organization"><i class="fa fa-building-o"></i>&nbsp; Organization Profile </a></li>
		<li><a href="profile.php?ptab=members" data-id="members"><i class="fa fa-users"></i>&nbsp; Organization Members </a></li>
		'; /*<li class="divider">&nbsp;</li>*/

	}
}		
	

		/*$acc_link_list .= '<li class="divider padd20_t">ACCOUNT LINKS</li>
<li><a href="profile.php?ptab=resources" data-id="resources"><i class="fa fa-download"></i>&nbsp; My Resources </a></li>
<li><a href="profile.php?ptab=calendar" data-id="calendar"><i class="fa fa-calendar-o"></i>&nbsp; My Calendar </a></li>';*/
		
/*href="profile.php?ptab=password" data-id="password"*/
/*$acc_link_list .= '<li><a href="profile.php?ptab=profile" data-id="profile"><i class="fa fa-gear"></i> My Profile </a></li>';*/
//$acc_link_list .= '<li class="divider">&nbsp;</li>';	
        
 
$acc_link_list .= '<li><a href="contribute.php?tk='.time().'"><i class="fa fa-edit"></i> &nbsp;  Contribute Story</a></li>';
$acc_link_list .= '<li><a href="profile.php?ptab=contributions"><i class="fa fa-paperclip"></i> &nbsp;  My Contributions</a></li>';
$acc_link_list .= '<li class="divider">&nbsp;</li>';       
$acc_link_list .= '<li><a href="profile.php?ptab=profile" data-id="profile"><i class="fa fa-gear"></i> &nbsp; Account Profile </a></li>';		
$acc_link_list .= '<li><a rel="modal:open" data-href="includes/accounts/php/profile_edit_password.php?rel=modal" ><i class="fa fa-key"></i> &nbsp;  Change Password </a></li>';
$acc_link_list .= '<li class="divider">&nbsp;</li>';
/*$acc_link_list .= '<li><a href="posts.php?signout=on&tk='.time().'"><i class="fa fa-sign-out"></i> &nbsp;  Log Out</a></li>';*/
$acc_link_list .= '<li class="divider"></li>';


	}
	return $acc_link_list;
}




/*-----------------------------------------------------------------------------------*/
/*	ORGANIZATION ADMINISTRATORS
/*-----------------------------------------------------------------------------------*/

function conf_OrgAdmins($org_id) {
	
	$cndb = new master();
	
	$orgAdmins = array();
	
	$sq_data ="SELECT `mrfc_reg_organizations`.`organization_id` , `mrfc_reg_account`.`namefirst` , `mrfc_reg_account`.`email` FROM `mrfc_reg_organizations` INNER JOIN `mrfc_reg_account` ON (`mrfc_reg_organizations`.`organization_id` = `mrfc_reg_account`.`organization_id`) WHERE (`mrfc_reg_organizations`.`organization_id` = ".q_si($org_id)." AND `mrfc_reg_account`.`role_id` =1 AND `mrfc_reg_account`.`uservalid` =1 AND `mrfc_reg_account`.`published` =1);";
	 //echo $sq_data;
	 
	$rs_data = $cndb->dbQuery($sq_data);	//

	if($cndb->recordCount($rs_data) > 0 )
	{
		while($cn_data = $cndb->fetchRow($rs_data, 'assoc'))
		{
			$orgAdmins[] = (trim($cn_data['email']) <> '') ? trim($cn_data['email']) : '';
		}
	}
	
	return $orgAdmins;
}





	
?>