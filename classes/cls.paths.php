<?php
/***********************************************************************
	* New Account Auto Validator
************************************************************************/
if(isset($_REQUEST['ac']))
{
	$reg_ac	= clean_request($_REQUEST['ac']);
	$reg_mod   = strtolower(substr($reg_ac,0,3));
	
	//MBR = Account Invite
	//SGN = Account Signup
	//RST = Password Reset
	//echobr($reg_mod);
	if($reg_mod == 'sgn')
	{
		$clsVerify = new clsVerify;
		$result 	= $clsVerify->verifySignupAccount($reg_ac);
		if($result['result'] == 1) { 
			$redirect ="profile.php?fc=signin&qst=106"; //&ureg=".$result['user']; 
		  	?><script>location.href = "<?php echo $redirect; ?>"; </script><?php exit;
		}
	}
	
	if($reg_mod == 'rst')
	{
		$dir = 'pass_reset';
	}
	
	if($reg_mod == 'mbr')
	{		
		
	}
}
/***********************************************************************
	* New Account Auto Validator
************************************************************************/


$pg_title = "";
$my_alias_h1 = ""; $my_alias_h2 = ""; $my_alias_h3 = ""; $my_alias_h4 = ""; $my_alias_h5 = ""; 
$menu_brief = "";
$my_intro   = "";
$my_breadcrumb = "";
$comMenuID 	  =  $comMenuSection =  $comMenuType    =  $comMenuAccess  = "";

$meta_image 	= META_LOGO;
$meta_desc  	 = META_DESC;
$meta_keywords = META_KEYS;

$com_active  = ''; //$com;
$cont_active = '';

$currMenu 	 = array();
$currCont    = array();

$seo_name    = '';

$cont_sector_id	    = '';
$cont_project_id    = '';

$cmt_id            = '';
$cmt_seo            = '';
$committee_detail   = array();


$cty_id            = '';
$cty_seo            = ''; //(isset($request['cty'])) ? $request['cty'] : 'nairobi';
$county_detail      = array();

$title_fcty         = '';
$title_fsec         = '';

$cont_sector        = array();


	
$my_rdr_path = '';
	
$my_request = str_replace(SITE_FOLDER, "", $_SERVER['REQUEST_URI']); 
$qpos = strripos($my_request,"?" ); 
$urlpathA = substr($my_request, 0, strripos($my_request,"/" ));  
$urlpathA = str_replace( "/", "", $urlpathA );
//echobr($my_request);
//echobr($urlpathA);
//echobr($qpos);

if($qpos) 
{ //echobr('rage');
	$urlQueryA = substr($my_request,0, strripos($my_request,"?" )); 
	$urlQueryB = substr($my_request, strripos($my_request,"?" )+1);
	parse_str(html_entity_decode($urlQueryB), $urlQueryArr);
	if (array_key_exists('tk', $urlQueryArr)) {
		unset($urlQueryArr['tk']);
	}
	if(substr($urlQueryA,strlen($urlQueryA)-1,1)=="/") {$urlQueryStr="?";} else { $urlQueryStr="/?"; }
	
	foreach($urlQueryArr as $qkey => $qval) 
	{ if(!is_array($qval)) { $urlQueryStr .= $qkey.'='.$qval.'&'; } } 
	
	$my_request = $urlQueryA.$urlQueryStr;
}
// @@ rage -Nginx
if($com=='') { $com = $urlpathA;}

// @@ **
if(substr($my_request,0, 1) == '/')	{
    $my_request = substr($my_request, 1);
}

//echobr($my_request); //exit;
//echobr($_SERVER['QUERY_STRING']);
define('REF_ACTIVE_URL', $my_request);

$_SESSION['sess_mrfc_active_url'] = $my_request;

if ($item)
{
	if(array_key_exists($item, master::$contMain['full']))
    {
        $currCont 	  =  master::$contMain['full'][$item]; 
        $com_active 	= $currCont['id_menu'];	
        $artSection 	 = $currCont['id_section'];
    } else {
        $com_active = 'not-found';
    }
	//$cont_sector_id	= $currCont['sector_id'];
	//$cont_project_id   = $currCont['project_id'];
}
elseif($com)
{
	//echobr($com);
	$menu_link = htmlspecialchars($com);
	if (array_key_exists($menu_link, master::$menusSeo)) {
		$com_active = master::$menusSeo[$menu_link]; 
	}
	else
	{
		$com_active = 'not-found';
	}
}
else
{
	$com = 1; $com_active = $com;
}

/*echobr('com:'.$com.' || com_active:'.$com_active.' || item:'.$item.' || file:'.$dc);*/

if($com_active == 'not-found') 
{
	$my_header   		= 'Page Not Found';
	$my_page_head	 = $my_header;
	$my_redirect 	  = '404.php';
	//$my_breadcrumb    = "<a href=\"./\">Home</a> &nbsp; / &nbsp; ";
}
else
{ 	
	if($com_active <> '') {
	$currMenu 		= master::$menuBundle['full'][$com_active]; } /*displayArray($currMenu);*/
	$my_header 		= @$currMenu['title'];
	$my_alias 		 = @$currMenu['title_alias'];
	$my_redirect 	  = @$currMenu['link_menu'];
	$seo_name		 = @$currMenu['menu_seo_name'];
	$meta_seolink	 = SITE_DOMAIN_LIVE.$seo_name.'/';
	
	$my_rdr_path 	  = $seo_name.'/';
	
		
	$comMenuID 	  = @$currMenu['id'];
	$comMenuSection = @$currMenu['id_section'];
	$comMenuType    = @$currMenu['id_menu_type'];
	$comMenuAccess  = @$currMenu['id_access'];
	
	if($my_alias <> '') { $my_header = $my_alias; }
	
	if($my_redirect == 'index.php') { $my_header = "Welcome"; }
	if($my_redirect == 'search.php' or $this_page == 'search.php') { $my_header = "Site Search"; $my_rdr_path = $this_page; }
	if($my_redirect == 'member.php' or $this_page == 'member.php') { $my_header = "Members"; }
	if($my_redirect == 'accounts.php' or $my_redirect == 'profile.php') { $my_header = "Member Area"; }
	if($my_redirect == 'action.php' or $this_page == 'action.php') { $my_header = "Notifications"; }
	if($my_redirect == 'mailing.php' or $this_page == 'mailing.php') { $my_header = "Mailing Subscription"; }
	if($my_redirect == 'events_register.php' or $this_page == 'events_register.php') { $my_header = $my_header ." Online Booking"; }
	if($my_header == 'order') { $my_header = "Place Order"; }
		
	
		
	$my_page_head	 = $my_header;
	
	
	
	if ($item)
	{
		
		if($com_active == 1) { }
		
		//$com_active 	= $currCont['id_menu'];	
		$my_page_head  = @$currMenu['title'];
		$my_redirect   = @$currMenu['link_menu'];
		
		if($currCont['link_menu'] <> $my_redirect) 
		{ $my_redirect = $currCont['link_menu']; }
		
		
		
		$meta_title 		  = ucfirst($currCont['title']);
		$meta_desc 	       = trim(smartTruncateNew(strip_tags_clean($currCont['article']), 100, '.'));
		
		$my_header = $meta_title;
		$pg_title  = $meta_title;
		$my_alias_h5 = $meta_title; // . " &rsaquo; ";		//strtolower()
		
		if(preg_match('/<img[^>]+\>/i',$currCont['article'],$regs)) 
		{
			if(preg_match('/src="([^"]*)"/i', $regs[0], $image_array ))
			{
				$meta_image 	   = SITE_DOMAIN_LIVE . urldecode($image_array[1]);  
			}
		}else {
			$meta_image  = $ddSelect->getContentImage($item);
		}
		
		$meta_seolink	   = SITE_DOMAIN_LIVE.$item.'/'.$currCont['link_seo'].'/';
	}
	
	
	if ($pj)
	{
		$fp = (object) array_map("clean_output",$ddSelect->getProjectDetails($pj)); 
		
		if (trim($fp->pname) <> '') 
		{
			$meta_title 	= ucfirst($fp->pname);
			$meta_desc 	 = trim(smartTruncateNew(strip_tags_clean(clean_output($fp->profile)), 100, '.','0','...'));
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?pj='.$fp->project_id;
		}
		else
		{
			$meta_title   	   = 'Page Not Found';
			$my_redirect 	  = '404.php';
			//$my_breadcrumb    = "<a href=\"./\">Home</a> &nbsp; / &nbsp; ";
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?pj='.$pj;
		}
	}
	
    
    if (isset($request['cty']))
	{
        $GLOBALS['COUNTY_SHOW_DETAIL'] 	= true;
        $cty_seo        = $request['cty'];
        
        $county_detail  = $dispDt->get_countyItems('detail', $cty_seo);
        //displayArray($county_detail);
        
        $my_page_head  = @$county_detail['title'];
        $cty_id        = @$county_detail['id'];  
		
		if (trim($county_detail['title']) <> '') 
		{
			$meta_title 	= ucfirst($county_detail['title']);
			$meta_desc 	    = trim(smartTruncateNew(strip_tags_clean(clean_output($county_detail['description'])), 100, '.','0','...'));
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?cty='.$cty_seo; 
		}
		else
		{
			$meta_title   	   = 'Page Not Found';
			$my_redirect 	  = '404.php';
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?cty=';
		}
	}
    
    
	
	
	if (isset($request['cmt']))
	{
        $my_rdr_path  = 'sectoral-committees/';
        $GLOBALS['COMMITTEE_SHOW_DETAIL'] 	= true;
        $cmt_seo = $request['cmt'];
        
        $committee_detail = $dispDt->get_commiteeItems('detail', $cmt_seo);
        //displayArray($committee_detail);
		/*$fp = (object) array_map("clean_output",$ddSelect->getProjectDetails($pj)); */
        
        $my_page_head  = @$committee_detail['title'];
        $cmt_id        = @$committee_detail['id'];  
		//$my_redirect   = @$currMenu['link_menu'];
		
		if (trim($committee_detail['title']) <> '') 
		{
			$meta_title 	= ucfirst($committee_detail['title']);
			$meta_desc 	    = trim(smartTruncateNew(strip_tags_clean(clean_output($committee_detail['description'])), 100, '.','0','...'));
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?cmt='.$cmt_seo; //$fp->project_id;
		}
		else
		{
			$meta_title   	   = 'Page Not Found';
			$my_redirect 	  = '404.php';
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?cmt=';
		}
	}
    
    
    
    if ($fcty <> '' and $fcty >= 1 and $fcty <= 48)
	{
        $com_active = '';
        $GLOBALS['COUNTY_SHOW_DETAIL'] 	= true;
        $cty_id        = $request['fcty'];
        
        $county_detail  = $dispDt->get_countyItems('single', $cty_id);
        /*displayArray($county_detail);*/
        
        $my_page_head  = @$county_detail['title'];
        $title_fcty    = @$county_detail['title'];
        $cty_seo       = @$county_detail['title_seo'];
        //$cty_id        = @$county_detail['id'];  
		
		if (trim($county_detail['title']) <> '') 
		{
			$meta_title 	= ucfirst($county_detail['title']);
			$meta_desc 	    = trim(smartTruncateNew(strip_tags_clean(clean_output($county_detail['description'])), 100, '.','0','...'));
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?fcty='.$cty_seo; 
		}
		else
		{
			$meta_title   	   = 'Page Not Found';
			$my_redirect 	  = '404.php';
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?fcty=';
		}
	}
    
    
    if ($fsec <> '')
	{
        $GLOBALS['COMMITTEE_SHOW_DETAIL'] 	= true;
        
        $cont_sector    = $dispDt->get_commiteeItems('multi', explode(',', $fsec)); 
        
        $title_fsec_arr = array();
        
        if(count($cont_sector) > 0){
            foreach($cont_sector as $sec_arr){
                $title_fsec_arr[] = $sec_arr['title'];
            }
        }
        
        $title_fsec = implode(', ', $title_fsec_arr);
        
        if($title_fcty <> '') { $title_fcty .= ' &rsaquo; '; }
        
        $my_page_head  = $title_fcty . $title_fsec;
        //echobr($my_page_head);
		
		if (trim($title_fsec) <> '') 
		{
			$meta_title 	= ucfirst($my_page_head);
			$meta_desc 	    = $my_page_head; //trim(smartTruncateNew(strip_tags_clean(clean_output($county_detail['description'])), 100, '.','0','...'));
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?fsec='.$cty_seo; 
		}
		else
		{
			$meta_title   	   = 'Page Not Found';
			$my_redirect 	  = '404.php';
			
			$my_header     = $meta_title;
			$pg_title      = $meta_title;
			$my_alias_h5   = $meta_title;			
			$meta_seolink  .= '?fsec=';
		}
	}
	
	
	//$my_header .= ' - ';	
	//echobr($my_breadcrumb);
	$thisSite =  $my_header .' - '. SITE_TITLE_LONG;		
	$pg_title1 = "<a href=\"./\">Home</a> &nbsp; / &nbsp; ";
	
	//$nav_Menu_Main = $dispData->buildMenu_Main($com_active, 1);
	$my_breadcrumb = $pg_title1 . $dispData->buildMenu_Crumbs($com_active) . $my_alias_h5 ;
	
	if($dc)
	{
		$dispData->siteDocuments();
		$file_id 	  	= master::$listResources['_seo'][$dc];
		$currCont 	  	= master::$listResources['full'][$file_id];
		
		
		$meta_title		= ucfirst($currCont['cont_title']);
		$meta_desc		= trim(smartTruncateNew(strip_tags_clean($currCont['cont_brief']), 100, '.'));
		$meta_seolink	= SITE_DOMAIN_LIVE.$dc.'/';
		
		$my_header 		= $meta_title;
		$pg_title  		= $meta_title;
		$my_alias_h5 	= $meta_title;
		
		$file_parent  	= master::$listResources['full'][$file_id]['cont_parent_id'];
		
		$my_breadcrumb = $pg_title1 . $dispData->buildMenu_Crumbs($file_parent) . $my_alias_h5 ;
	}
	
	
	
	
	

}


/*echobr($my_rdr_path);
echobr($this_page);
$GLOBALS['RDR_SEO'] = $my_rdr_path;*/

if($my_rdr_path == '' or $this_page == 'organization.php') { $my_rdr_path = $this_page; }

define('RDR_REF_PATH', $my_rdr_path); 


/* ============================================================================== 
/*	@FORUM MENU & PAGE
/* ------------------------------------------------------------------------------ */

$forum_page = '';
if(array_key_exists(14, master::$menuBundle['section']))
{ 
	$forum_menu = master::$menuBundle['full'][current(master::$menuBundle['section'][14])]; 
	$forum_page	= $forum_menu['menu_seo_name'];
}


//$nav_FootLinks = implode("", $dispData->linkToFoot);
/* displayArray(master::$menusSeo);
echobr($com);*/
//echobr($this_page);
//echobr($my_rdr_path);

$projectStatusClass = array(
	'Completed' => 'completed',
	'On Schedule/Ahead of Schedule' => 'on_schedule',
	'Commenced' => 'set_medium',
	'Not Started/Behind Schedule' => 'behind_schedule',
	'Ahead of Schedule' => 'on_schedule',
);

//echo $this_page.REF_QSTR;

include('cls.paginator.php');
				
?>