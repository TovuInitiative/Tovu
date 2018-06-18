<?php

class data_arrays extends master
{
	
	public $menuMain = array();
	public $menuLong = array();
	public $menuSubs = array();
	
	public $menuMainSelect;
	
	public $menuGroups = array();
	public $menuSelect = array();
	
	//public $menuDepts = array();
	
	public $menuMain_portal = array();
	public $menuLong_portal = array();
	
	public $comArr = array();
	
	//public $contMain = array();
	public $contLong = array();
	public $contMainExtras = array();
	
	public $contFacts = array();
	public $contTabsDept = array();
	public $contActivities = array();
	public $contPlaces = array();
	public $contEvents = array();
	public $contNews = array();
	
	
	public $contPrograms = array();
	
	public $linkToHead = array();
	public $linkToQuick = array();
	public $linkToFoot = array();
	public $linkTabsDept = array();
	public $linkTabsCircuit = array();
	public $linkTabsHome = array();
	public $linkTabsCustom = array();
	
	private $link_temp = array();
	
	public $bannMain = array();
	
	public $navMainCurrent;
	
	var $menu;
	var $key;
	
	public $coom;
	public $coom_b;
	
	var $out;
	var $parent;
	var $h_lnk;
	var $h_cnt;
	var $sel_crit;
	var $com_active;
	
	
	/*
	@START -- BUILD: Menu Array
	***********************************************************/
	
	
	function buildMenu_Arr()
	{
		
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */			
		$cache_data = array();
		
		$menus_modstamp = @$_SESSION['sess_mrfc_menus']['_modstamp'];
		
		$rs_check = $this->dbQuery("SELECT `cache_id`, `cache_date`, `cache_data` FROM `mrfc_cache_vars` where `cache_id` = 'menuChest'"); 
			
		if($this->recordCount($rs_check) == 1 )
		{ 
			$cn_check    = $this->fetchRow($rs_check);
			$cache_date  = $cn_check['cache_date'];
			if($cache_date > $menus_modstamp)
			{
				$cache_data  = unserialize($cn_check['cache_data']);	
				$_SESSION['sess_mrfc_menus'] = 	$cache_data;
			}
			else
			{
				$cache_data = $_SESSION['sess_mrfc_menus'];
			}
		}
			
		//displayArray($cache_data); exit;
		if(is_array($cache_data))
		{
			master::$menuBundle	   = $cache_data;
			master::$menusFull		= $cache_data['full'];
			master::$menusType		= $cache_data['type'];
			master::$menusSection	 = $cache_data['section'];
			master::$menusChild	   = @$cache_data['child'];
			master::$menusSeo		 = @$cache_data['seo'];
			master::$menusMom		 = @$cache_data['mom'];
			master::$menusTabs		= @$cache_data['tabs'];
			master::$directoryCatsMenu= @$cache_data['dircat'];
		}
		
	}
	
	
	
	
	function buildMenu_Main ($com_active, $id_menu_type = 1, $id_parent = 0 , $nav_type="mainNav", $seo_refs = 1, $public_access = 1)
	{   
		$out 		  	   = "";
		$nav_class_main    = "";
		$nav_class_sub     = "";
		$nav_id	   	    = $nav_type;
		$linkClass	     = "";
		
		if($nav_type=="mainNav") 
		{ 
			if($id_parent == 0) { $nav_id = $nav_type; $nav_class_main = "  sf-menu "; }
			$nav_class_sub = ""; 
			$linkClass = "";  
		}
		
		if($nav_type=="treeview") 
		{ 
			if($id_parent == 0) { $nav_id = "tree"; $nav_class_main = "treeview "; }
			$nav_class_sub = ""; 
			$linkClass = "";  
		}
		
		if($nav_type=="nav_top") 
		{ 
			if($id_parent == 0) { $nav_id = $nav_type; $nav_class_main = "  nav_wireX sf-menu "; }
			$nav_class_sub = ""; 
			$linkClass = "";  
			$nav_type = "";
		}
		
		
		if($nav_type=="nav_dloads") 
		{ 
			if($id_parent == 0) {} $nav_id = $nav_type; $nav_class_main = "  bul-gry dark "; //$nav_type; //
			$nav_class_sub = ""; 
			$linkClass = "";  
		}
		
		if($nav_type=="nav_cols") 
		{ 
			if($id_parent == 0) {} $nav_id = ""; $nav_class_main = " nav_sidex bul-gryx darkx "; //$nav_type; //
			$nav_class_sub = ""; 
			$linkClass = "";  
		}
		
		if($nav_id <> "nav_top" and $nav_id <> "nav_foot")  
		{
			$out .=  "<ul id=\"".$nav_id."\" class=\"". $nav_class_main . $nav_class_sub."\">"; //."\n"; 
		}
		
		if($nav_type == "treeview") 
		{
			if($id_menu_type == 0)
			{ $menu = master::$menusChild[$id_parent]; }
			else
			{ $menu = master::$menusType['_tree']; asort($menu); }
		}
		else
		{
			if($id_menu_type <> 0 and array_key_exists($id_menu_type, master::$menusType))
			{ $menu = master::$menusType[$id_menu_type]; }
			else
			{ $menu = master::$menusChild[$id_parent]; }
		}
		
		
		if($nav_type == "nav_tabs") 
		{
			$menu = master::$menusTabs[$id_parent]; 
		}
		
		if(is_array($menu))
		{
			foreach($menu as $key => $val )	//=> $ml
			{
				$ml 	      		= master::$menusFull[$val];
				$ml_has_subs 		= '';
				$ml_link_has_subs 	= '';
				$ml_subs 			= 0;
				if (is_array(master::$menusChild) and array_key_exists($val, master::$menusChild)) 
				{ $ml_subs = count(master::$menusChild[$val]); $ml_has_subs = ' sf-with-ul';  $ml_link_has_subs = 'dropdown'; }
				
				
				if( is_array($ml) and $ml['id_access'] == $public_access) 
				{
		
						$link 		  = $ml['link_menu'];				//'_page.php'; //
						$link_seo     = $ml['menu_seo_name'].'/';	//.'.htm';
						
						
						$lbit = substr($link,0,3);	//EXTERNAL
						if($lbit == 'htt' or $lbit == 'www' or $lbit == 'ftp' or $lbit == 'ww2') 
						{ 
							$redirect = $link;
							if(substr($lbit,0,2)  == 'ww') { $redirect = 'http://'. $link; }
							$sURL = urlencode($redirect); 
							$link = $redirect; //'out.php?url='.$sURL;  
						} 
						elseif( $link <> "#") 
						{ 	
							$link = $link_seo;
							/*if($seo_refs == 0){
								$link = $ml['link_menu'] . '?com='.$key; 
							}*/
						  	
						}
						
						//if( $link == "index.php" or $ml['id'] == 1) { $link = ''; }
								
								
						if( $link == "#") { $linkb = ""; } 
						else { $linkb = " href=\"$link\" ";	} 
						
						
						if ( $ml['id'] == $com_active ) { $isActive = " current";} else { $isActive = "";}
						
						
					if($ml['id_access'] == 2) 
					{   $folderlock = "nav-locked"; 
						if ( $ml['id'] == $com_active ) { $folderlock = "nav-locked-open"; }				
					} else { $folderlock = ""; }
					
					
					
					if($ml['to_footer'] == 1 or $ml['id_menu_type'] == 5) { 
						if (!array_key_exists($key, $this->linkToFoot)) {
							$this->linkToFoot[$key] = "<li><a $linkb  class=\"". $isActive ."\">".$ml['title']."</a></li>"; 
						}
					}
					
					
					//@@ Tab Links
					if($ml['id_menu_type'] == 3)  
					{	
						//$linktab = " href=\"#\" data-id=\"".$key."\" data-url=\"contabs.php?com=".$key."&isec=".$ml['id_section']."\" ";
						$linktab = " href=\"".$link."\" data-id=\"".$key."\" data-url=\"contabs.php?com=".$key."&isec=".$ml['id_section']."\" ";
						
						if (!array_key_exists($key, $this->linkTabsDept)) {
							$this->linkTabsDept[$id_parent][$key] = "<li><a $linktab  class=\"". $isActive ."\">".$ml['title']."</a></li>"; 
						}
					}
					
					$out_extra = '';

					if($id_menu_type == 1 and $ml_subs == 0 and $ml['id_section'] == 7)
					{						
						$out_extra = $this->build_coursesMenu($ml['id']);
					}
					
					
                    /* =======================
                    @@ COUNTIES
                    -------------------------- */
                    if($id_menu_type == 1 and $ml_subs == 0 and $ml['id_section'] == 20)
					{		
                        $linkb = "";
                        $ml_has_subs = ' sf-with-ul';  $ml_link_has_subs = 'dropdown';
						$out_extra = $this->build_countiesMenu($ml['id']);
					}
					
                    
                    /* =======================
                    @@ SECTORS
                    -------------------------- */
                    if($id_menu_type == 1 and $ml['id_section'] == 15) // and $ml_subs == 0
					{		
                        $linkb = "";  
                        $ml_has_subs = ' sf-with-ul';  $ml_link_has_subs = 'dropdown';
						$out_extra = $this->build_sectorsMenu($ml['id']);
					}
                    
					/*if($ml['to_quick'] == 1) { 
						if (!array_key_exists($key, $this->linkToQuick)) {
							$this->linkToQuick[$key] = "<li><a $linkb  class=\"". $isActive ."\">".$ml['title']."</a></li>"; 
						}
					}*/
					
					
					
						
						
					/*if ( $ml [ 'id_menu_type' ] == 6) 
					{
						if (!array_key_exists($key, $this->linkToHead)) {
							$this->coom = 3; if($this->coom > 3) $this->coom = 2;
											
							$outhead  =  "<li><a $linkb  class=\"".$isActive."\">".$ml['title']."</a>"; 
							$outhead .=  $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active , $mainNavClass, 3, $com);
							
							$this->coom = 2;
							
							$outhead .=  "</li>"; //."\n";
							
							$this->linkToHead[$key] = $outhead;
						}
					}	
					
					
					
					
					if($ml['id_menu_type'] == 7)  //circuit tabs
					{
						//href=\"#\" 
						$linktab = " data-id=\"".$key."\" data-url=\"circuit_tabs.php".RDR_REF_BASE."tk=".time()."&tab=".$key."\" ";
						if (!array_key_exists($key, $this->linkTabsCircuit)) {
							$this->linkTabsCircuit[$key] = "<li><a $linktab  class=\"". $isActive ."\">".$ml['title']."</a></li>"; 
						}
					}
					
					*/
						
					//if ( $ml [ 'id_menu_type' ] == $id_menu_type) 
					//{
						$this->coom = 3; if($this->coom > 3) $this->coom = 2;
						$this->navMainCurrent = $key;
						
						$countConts = '';
						
						
						/*if(array_key_exists($key, master::$menuToContents))
						{ $countConts = ' ('.count(master::$menuToContents[$key]).')';  }*/
						
						//<span class=\"".$linkClass.$folderlock."\">	</span>	
						
						$menu_title = $ml['title'];
						
						/*if($nav_id == 'nav_top' or $nav_id == 'mainNav') {
							if($ml['id'] == '1') { $menu_title = '<i class="fa fa-home" id="nav_link_home_fa"></i><span id="nav_link_home">&nbsp; '.$ml['title'].'</span>'; }
						}*/
						
                    
                        $unique_style = '';
                       if($ml['id'] == 31 or $ml['id'] == '26') {
                           $unique_style = ' txt21 txtpurple bg-unique marg0_1 '; 
                       }
                        
						//. $ml_has_subs
						$out .=  "<li id=\"m".$key."\" class=\"".$isActive . $ml_link_has_subs  ."\"><a $linkb  class=\"".$isActive." linkMenu ".$ml_has_subs  .$unique_style ."\" data-id=\"".$ml['id']."\">".$menu_title . $countConts ."</a>";
						
						if($ml_subs > 0){
							$out .=  $this->buildMenu_Main ($com_active, 0, $ml['id'] , $nav_type, $seo_refs, $public_access);
						} else {
							
							$out .= $out_extra;
						}
						
						$this->coom = 2;
						
						$out .=  "</li>"; //."\n";//;
					//}
				}
			}
		}
		
		if($nav_id <> "nav_top" and $nav_id <> "nav_foot")  {  
			$out .=  "</ul>"; //."\n";
		}
		return $out;
	}
	
	
	function buildMenu_Crumbs ($com, $result = '')
	{	//echo $com; exit;
		$sep = CRUMBS_SEP; 
		$crumb = '';
		
		if(is_array(master::$menusFull) and array_key_exists($com, master::$menusFull))
		{
			$title_menu		   = master::$menusFull[$com];
			$title_url 	  	    = display_linkMenu($title_menu['link_menu'], $title_menu['menu_seo_name']);	
			//$title_url			= master::$menusFull[$com]['link_menu'].'?com='.$com;
			$title_active_plain   = master::$menusFull[$com]['title'];
			$title_active 	     = '<a '.$title_url.'>'.$title_active_plain.'</a>';			
			$title_type   	       = master::$menusFull[$com]['id_menu_type']; //echobr($title_type);
			
			if($title_type == 1) { $this->menuMainSelect = $com; }
			
			if(is_array(master::$menusMom) and array_key_exists($com, master::$menusMom['_link']))
			{
				
				$pero  		 = master::$menusMom['_link'][$com];
				$pero_title	 = '';
				$result	 	 = '';
				
				if(array_key_exists($pero, master::$menusFull)) {
				
					$pero_arr	 = master::$menusFull[$pero];
					//$pero_url	 = master::$menusFull[$pero]['link_menu'].'?com='.$pero;
					$pero_url 	 = display_linkMenu($pero_arr['link_menu'], $pero_arr['menu_seo_name']);	
					$pero_title   = '<a '.$pero_url.'>'.$pero_arr['title'].'</a>' . $sep;

					if(array_key_exists($pero, master::$menusMom['_link'])){
						$result = $this->buildMenu_Crumbs($pero);
					}
				}		
					if($result == '')
					{
						$crumb = $result . $pero_title . $title_active . $sep;
					}
					else
					{
						$crumb = $result . $title_active . $sep;	//. $sep
					}	
				
			}
			else
			{
				$crumb =  $title_active . $sep;
			}
		}
		return $crumb;
	}
	
	
	
	function siteMenu_portal($id_portal = 1)
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */
		
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		
		$sq_mainlinks = QRY_MENULISTB_PORTAL . "  WHERE (`".$pdb_prefix."dt_menu`.`published` =1) "
		."  AND (`".$pdb_prefix."dt_menu`.`id_type_menu` <> 2) ORDER BY `".$pdb_prefix."dt_menu`.`seq` ASC, "
		." `".$pdb_prefix."dt_menu`.`id_type_menu` ASC, `mrfc_dt_menu_parent`.`id_parent` ASC,  `".$pdb_prefix."dt_menu`.`title` ASC "; 
		// AND (`".$pdb_prefix."dt_menu`.`id_portal` = $id_portal)
		//AND (`".$pdb_prefix."dt_menu`.`id_access` =1)
		//echo $sq_mainlinks; exit;
		
		$rs_mainlinks=$this->dbQuery($sq_mainlinks);
		$rs_mainlinks_count=$this->recordCount($rs_mainlinks);
		
		if($rs_mainlinks_count>=1)
		{
			$menu_loop=1;
			while($cn_mainlinks=$this->fetchRow($rs_mainlinks))
			{
				if(strlen($cn_mainlinks[7]) >= 2 or $cn_mainlinks[7] == "#" ) 
				{ $link = $cn_mainlinks[7]; } else { $link = $cn_mainlinks[8]; }
				
				$id_link = $cn_mainlinks[0];
				
				$pagebanner = '';
				$image 	  = $cn_mainlinks[19];
				$image_show = $cn_mainlinks[20];
				if($image_show == 1) { $pagebanner = $image; }
				
				$menuItem = array 
				(						
					'id'			=> 	''.$id_link.'',
					'title'			=> 	''.trim(html_entity_decode(stripslashes($cn_mainlinks[1]))).'',
					'title_alias'	=> 	''.trim(html_entity_decode(stripslashes($cn_mainlinks[2]))).'',
					'menu_brief'	=> 	''.trim(html_entity_decode(stripslashes($cn_mainlinks[3]))).'',
					'id_section'	=> 	''.$cn_mainlinks[4].'',
					'id_menu_type'	=> 	''.$cn_mainlinks[5].'',
					'link_menu'		=> 	''.$link.'',
					'menu_intro'	=> 	''.trim(html_entity_decode(stripslashes($cn_mainlinks[6]))).'',
					'metawords'		=> 	''.trim(html_entity_decode(stripslashes($cn_mainlinks[9]))).'',
					'to_footer'		=> 	''.$cn_mainlinks[17].'',
					'to_quick'		=> 	''.$cn_mainlinks[18].'',
					'pagebanner'	  => 	''.$pagebanner.'',
					'id_access'		=> 	''.$cn_mainlinks["id_access"].''
													
				);
				//,'id_portal'	  => 	''.$cn_mainlinks["id_portal"].''
				$this->menuMain_portal[$cn_mainlinks[0]] = $menuItem;
				$this->menuLong_portal[$cn_mainlinks[0]] = $menuItem;
				
				$sq_chld = "SELECT `mrfc_dt_menu_parent`.`id_menu` FROM `mrfc_dt_menu_parent` inner join `".$pdb_prefix."dt_menu` on `mrfc_dt_menu_parent`.`id_menu` = `".$pdb_prefix."dt_menu`.`id` where `mrfc_dt_menu_parent`.`id_parent`= '".$id_link."' and `".$pdb_prefix."dt_menu`.`published` =1 ";
				//`mrfc_dt_menu_parent`.`id_portal` = `".$pdb_prefix."dt_menu`.`id_portal` and 
				$rs_chld = $this->dbQuery($sq_chld);
			
				if($this->recordCount($rs_chld) >=1) {	
					
					$this->menuLong_portal[$cn_mainlinks[0]]['children'] = $this->siteMenuSub_portal($id_link); //$this->recordCount($rs_chld);
					
					$this->menuMain_portal[$cn_mainlinks[0]]['children'] = $this->siteMenuSub_portal($id_link);
				}
			}
		}
		//print_r($this->menuMain); exit;
		return $this->menuMain_portal;
	}
	
	
	
	function siteMenuSub_portal($id_parent = NULL)
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */
		
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		
		if($id_parent)
		{
			$crit = " AND (`mrfc_dt_menu_parent`.`id_parent` = '".$id_parent."')  "; 
			//AND (`".$pdb_prefix."dt_menu`.`id_access` =1)
			$sq_sublinks = QRY_MENULISTB_PORTAL . "  WHERE (`".$pdb_prefix."dt_menu`.`published` =1) "
			."  ".$crit." ORDER BY `".$pdb_prefix."dt_menu`.`seq` ASC,  `".$pdb_prefix."dt_menu`.`id_type_menu` ASC,  "
			." `mrfc_dt_menu_parent`.`id_parent` ASC, `".$pdb_prefix."dt_menu`.`title` ASC ";
			//echo $sq_sublinks;
			
			$rs_sublinks=$this->dbQuery($sq_sublinks);
			$rs_sublinks_count=$this->recordCount($rs_sublinks);
			
			if($rs_sublinks_count >=1)
			{
				$subMain = array();
				
				while($cn_sublinks=$this->fetchRow($rs_sublinks))
				{
					if(strlen(trim($cn_sublinks[7])) >= 2 or trim($cn_sublinks[7]) == "#" ) 
					{ $link = $cn_sublinks[7]; } else { $link = $cn_sublinks[8]; }
					
					$id_link = $cn_sublinks[0];
					
					//$menuItem = array 	
					$subMain[$id_link] = array 					
					(
						'id'			=> 	''.$id_link.'',
						'title'			=> 	''.trim(html_entity_decode(stripslashes($cn_sublinks[1]))).'',
						'title_alias'	=> 	''.trim(html_entity_decode(stripslashes($cn_sublinks[2]))).'',
						'menu_brief'	=> 	''.trim(html_entity_decode(stripslashes($cn_sublinks[3]))).'',
						'id_section'	=> 	''.$cn_sublinks[4].'',
						'id_menu_type'	=> 	''.$cn_sublinks[5].'',
						'link_menu'		=> 	''.$link.'',
						'menu_intro'	=> 	''.trim(html_entity_decode(stripslashes($cn_sublinks[6]))).'',
						'metawords'		=> 	''.trim(html_entity_decode(stripslashes($cn_sublinks[9]))).'',
						'to_footer'		=> 	''.$cn_sublinks[17].'',
						'to_quick'		=> 	''.$cn_sublinks[18].'',
						'id_access'		=> 	''.$cn_sublinks["id_access"].''
						
					);
					//,'id_portal'	  => 	''.$cn_sublinks["id_portal"].''	
					//$subMain[$id_link] = $menuItem;
					$this->menuLong_portal[$id_link] = $subMain[$id_link];
					
					$sq_chld = "SELECT `mrfc_dt_menu_parent`.`id_menu` FROM `mrfc_dt_menu_parent` inner join `".$pdb_prefix."dt_menu` on `mrfc_dt_menu_parent`.`id_menu` = `".$pdb_prefix."dt_menu`.`id`  where `mrfc_dt_menu_parent`.`id_parent`= '".$id_link."' and `".$pdb_prefix."dt_menu`.`published` =1 ";
					// and `mrfc_dt_menu_parent`.`id_portal` = `".$pdb_prefix."dt_menu`.`id_portal`
					$rs_chld = $this->dbQuery($sq_chld);
				
					if($this->recordCount($rs_chld) >=1) {	
						$this->menuLong_portal[$id_link]['children'] = $this->siteMenuSub_portal($id_link);; //$this->recordCount($rs_chld);
						$subMain[$id_link]['children'] = $this->siteMenuSub_portal($id_link);
					}
							
				}
			}
			//print_r($this->menuMain); exit;
			return $subMain;
		
		}
	}
	
	
	
	
	
	/*
	@BUILD: other site menus - Courses
	***********************************************************/
	
	function build_coursesMenu ($com, $item_active = '')
	{
		$menu 		= master::$contMain['parent'][$com];
		
		$out 		=  '<ul>'; 
		
		foreach($menu as $key => $contKey)
		{
			$contArray 		  = master::$contMainNew[$contKey];
		
			$cont_id			= $contArray['id'];
			$cont_parent_id	 = $contArray['id_menu'];
			$cont_title		 = $contArray['title'];
			$cont_title_sub	 = $contArray['title_sub'];
			$cont_page		  = $contArray['link_menu'];
			$cont_date		  = $contArray['modified']; 
			$cont_page_seo		  = $contArray['link_seo']; 

			$cont_location	   = $contArray['location'];		
			$cont_article	   = $contArray['article'];
			
			$link 			= $cont_page;	
			
			//if ( $link == "#")	{ 	$linkb = ""; } else {	$linkb = " href=\"$link?com=".$key." \" ";	} 
			if ( $cont_id == $item_active ) { $isActive = " selected ";} else { $isActive = "";}

			
			$item_link		  = display_linkArticle($cont_id, $cont_page_seo);
			
			$out .=	'<li class=""><a '. $item_link .' class="'. $isActive .'">'. $cont_title .'</a></li>';
		}
		
		$out .=  '</ul>';
		
		
		return $out;
	}
	
    
    /*
	@BUILD: other site menus - Sectors
	***********************************************************/
	
	function build_sectorsMenu ($com, $item_active = '', $county_id = '')
	{
        //$this->get_resCounties
        $cty = (isset($_REQUEST['cty'])) ? $_REQUEST['cty'] : '';
        
        $sq_qry = "SELECT `committee_id`, `title`, `title_seo` FROM `mrfc_app_committee` WHERE `published` = '1' and `is_widget` = '1' ORDER BY `title` ASC;"; /* and  `is_widget` = '1'*/
        $rs_qry = $this->dbQuery($sq_qry);        
            
        $county_id = $GLOBALS['FCTY'];
        $fsector_id = ($GLOBALS['FSEC'] <> '') ? explode(',', $GLOBALS['FSEC']) : '';
        
        $out 		=  '<ul class="mega-menu mega-sector">'; 
        
        while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
        {
            $cn_qry  	   = array_map("clean_output", $cn_qry_a);
            $committee_id	   = $cn_qry['committee_id'];
            $title		   = $cn_qry['title'];
            $title_seo	   = $cn_qry['title_seo'];
            
            //if($county_id <> '48') {
                if ( $title_seo == $cty ) { $isActive = ' current'; } else { $isActive = '';}
            
                $isSelected = '';
            
                if(is_array($fsector_id)){
						if(in_array($committee_id, $fsector_id)) { $isSelected = ' checked ';} 						
					}
                
                //$item_link	   = 'href = "sectoral-committees/?cmt='.$title_seo.'" ';
                $item_link	   = 'href = "index.php?fcty='.$county_id.'&fsec='.$committee_id.'" ';

                /*$out .=	'<li class="">
                <a '. $item_link .' class="linkCty'. $isActive .'" data-id="'.$committee_id.'">'.$title .'</a></li>';*/
            
                 $out .=	'<li><label><input type="checkbox" title="'.$title.'" value="'.$committee_id.'" name="chk_fsec" class="chk_fsec"  '.$isSelected.' id="fsec_'.$committee_id.'"  /> '.$title .' &nbsp; </label></li>';
            //}

        }
        
		$out .=  '<li style="float:none; display:block;"><button class="btn col-md-12 filter_fsec_go" id="filter_fsec_go"> <i class="fa fa-arrow-right"></i> Go</button></li>';
		$out .=  '</ul>';
		
		
		return $out;
	}
	
    
    /*
	@BUILD: other site menus - Counties
	***********************************************************/
	
	function build_countiesMenu ($com, $item_active = '')
	{
        //$this->get_resCounties
        $cty = (isset($_REQUEST['cty'])) ? $_REQUEST['cty'] : '';
        
        $sq_qry = "SELECT `county_id` , `county`, `county_seo` FROM `mrfc_reg_county` WHERE `published` = '1' ORDER BY `county` ASC;";
        $rs_qry = $this->dbQuery($sq_qry);       
        
        //$fcounty_id = ($GLOBALS['FSEC'] <> '') ? explode(',', $GLOBALS['FSEC']) : '';
        $fsector_id = ($GLOBALS['FSEC'] <> '') ? explode(',', $GLOBALS['FSEC']) : '';
            
        $out 		=  '<ul class="mega-menu">'; 
        $all        = '';
        while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
        {
            $cn_qry  	   = array_map("clean_output", $cn_qry_a);
            $county_id	   = $cn_qry['county_id'];
            $county		   = $cn_qry['county'];
            $county_seo	   = $cn_qry['county_seo'];
            
            
                if ( $county_seo == $cty ) { $isActive = ' current'; } else { $isActive = '';}

                //$item_link	   = 'href = "counties/?cty='.$county_seo.'" ';
                $item_link	   = 'href = "index.php?fcty='.$county_id.'&fsec='. $GLOBALS['FSEC'] .'" ';
            if($county_id <> '48')
            { $out .=	'<li class=""><a '. $item_link .' class="linkCty'. $isActive .'" data-id="'.$county_id.'">'.$county .'</a></li>'; }
            else
            { $all  =	'<li class=""><a '. $item_link .' class="linkCty'. $isActive .'" data-id="'.$county_id.'">'.$county .'</a></li>'; }    

        }
        
		$out .=  $all;
		$out .=   '</ul>';
		
		
		return $out;
	}
    
    
    
    
	/*
	@START -- BUILD: Content Array
	***********************************************************/
	
	function buildContent_Arr()
	{
		
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */			
		$cache_data = array();
		
		$content_modstamp = @$_SESSION['sess_mrfc_content']['_modstamp'];
		
		$rs_check = $this->dbQuery("SELECT `cache_id`, `cache_date`, `cache_data` FROM `mrfc_cache_vars` where `cache_id` = 'contentChest'"); 
			
		if($this->recordCount($rs_check) == 1 )
		{ 
			$cn_check    = $this->fetchRow($rs_check);
			$cache_date  = $cn_check['cache_date'];
			
			if($cache_date > $content_modstamp)
			{
				$cache_data  = unserialize($cn_check['cache_data']);	
				$_SESSION['sess_mrfc_content'] = 	$cache_data;
			}
			else
			{
				$cache_data = $_SESSION['sess_mrfc_content'];
			}
		
		master::$contMain		   = $cache_data; //displayArray($cache_data);
		master::$contMainNew		= $cache_data['full'];
		master::$contSection		= @$cache_data['section'];
		master::$menuToContents	 = @$cache_data['parent'];	//menuToContents
		master::$menuIntros	    = @$cache_data['intros'];
		master::$contFront		 = @$cache_data['front'];
		}
				
		
	}
	
	
	
	function siteContentDates($cont_id)
	{
		
		$sq_eventlinks = "SELECT DATE_FORMAT(`date`, '%Y%m%d') AS `ev_date`, DATE_FORMAT(`date`,'%l:%i %p') AS `ev_time_start`,  DATE_FORMAT(`end_date`, '%l:%i %p') AS `ev_time_end`, UNIX_TIMESTAMP(DATE_FORMAT(`date`, '%Y%m%e')) AS `ev_date_unix` FROM mrfc_dt_content_dates WHERE (`id_content` =".quote_smart($cont_id).") ORDER BY `ev_date_unix` ;";
		// `mrfc_dt_content_dates`.`date` >=CURRENT_DATE() and 
		
		$rs_eventlinks = $this->dbQuery($sq_eventlinks);	
		$rs_eventlinks_count = $this->recordCount($rs_eventlinks);
		
		$eventDates    = array();
		
		if($rs_eventlinks_count>=1)
		{
			while($cn_eventlinks = $this->fetchRow($rs_eventlinks))
			{
				$eventDates[] = array 
				(
					'ev_date'	     => 	''.strtotime($cn_eventlinks['ev_date']).'',
					'ev_time_start'  => 	''.$cn_eventlinks['ev_time_start'].'',
					'ev_time_end'    => 	''.$cn_eventlinks['ev_time_end'].''
				);				
			}
		}
		return $eventDates;
	}
	
	
	
	/*
	@@@ GALLERY ITEMS
	***********************************************************/
	
	function siteGallery()
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */			
		$dataGallery = array();
		
		$cat_modstamp = @$_SESSION['sess_mrfc_gallery']['_modstamp'];		
		$rs_check = $this->dbQuery("SELECT `cache_id`, `cache_date`, `cache_data` FROM `mrfc_cache_vars` where `cache_id` = 'galleryChest'"); 
			
		if($this->recordCount($rs_check) == 1 )
		{ 
			$cn_check    = $this->fetchRow($rs_check);
			$cache_date  = $cn_check['cache_date'];
			
			if($cache_date > $cat_modstamp)
			{ 
				$dataGallery  = @unserialize($cn_check['cache_data']);	
				$_SESSION['sess_mrfc_gallery'] = 	$dataGallery;
			}
			else
			{  
				$dataGallery = $_SESSION['sess_mrfc_gallery'];
			}
		}
		
		if(count($dataGallery) > 1)
		{
		 //master::$listGallery_long = $dataGallery['full']; 
		 master::$listGallery = $dataGallery;
		 		
			/*foreach($dataGallery as $gkey => $gval)
			{ if($gkey <> 'full') { master::$listGallery[$gkey] = $gval; } }*/
		}
		
		
	}
	
	
	function siteGalleryTop($galCat = '')
	{
		//echobr(count(master::$contMainNew));
		
		if($galCat == '') 
		{
			if (array_key_exists('galleryX', master::$listGallery['cat'])){				
			
				$arr = master::$listGallery['cat']['gallery'];

				foreach ($arr as $k => $v) { 

					$pic_arr = master::$listGallery['full'][$v];

					$pic_parent_id = $pic_arr['pic_parent_id'];
					$parent_title  = $pic_arr['title'];

					/*if($pic_arr['pic_parent'] == '_cont')
					{ $parent_title = @master::$contMainNew[$pic_parent_id]['title']; }
					else
					{ $parent_title = @master::$menusFull[$pic_parent_id]['title']; }*/

					$pic_arr['pic_parent_title'] = $parent_title;

					master::$listGallery_top[] = $pic_arr; 

				}
			}
			else
			{
				$arr = master::$listGallery['parent'];

				foreach ($arr as $k => $v) { 
					if($k <> '_resource')	//  and $k <> '_link' 
					{
						foreach ($v as $pk => $pp) 
						{
							$pic_arr = master::$listGallery['full'][current($pp)];
							$pic_arr['pic_total'] = count($pp);

							$pic_parent_id = $pic_arr['pic_parent_id'];
							$parent_title  = '';

							if($pic_arr['pic_parent'] == '_cont')
							{ $parent_title = @master::$contMainNew[$pic_parent_id]['title']; }
							else
							{ $parent_title = @master::$menusFull[$pic_parent_id]['title']; }

							$pic_arr['pic_parent_title'] = $parent_title;

							master::$listGallery_top[] = $pic_arr; 
						}
					}
				}
			}
		}
		else
		{
			$arr = master::$listGallery[$galCat];
			foreach ($arr as $pk=>$pp) {
				$pic_arr = master::$listGallery['full'][current($pp)];
				$pic_arr['pic_total'] = count($pp);
				master::$listGallery_top[] = $pic_arr; 
			}
		}
	}
	
	
	
	
	
	
	/*
	@@@ RESOURCE CENTER ITEMS
	***********************************************************/
	
	function siteDocuments()
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */			
		$dataResources = array();
		
		$cat_modstamp = @$_SESSION['sess_mrfc_resources']['_modstamp'];		
		$rs_check = $this->dbQuery("SELECT `cache_id`, `cache_date`, `cache_data` FROM `mrfc_cache_vars` where `cache_id` = 'resourceChest'"); 
			
		if($this->recordCount($rs_check) == 1 )
		{ 
			$cn_check    = $this->fetchRow($rs_check);
			$cache_date  = $cn_check['cache_date'];
			
			if($cache_date > $cat_modstamp)
			{ 
				$dataResources  = unserialize($cn_check['cache_data']);	
				$_SESSION['sess_mrfc_resources'] = 	$dataResources;
			}
			else
			{  
				$dataResources = $_SESSION['sess_mrfc_resources'];
			}
		}
		
		master::$listResources = $dataResources; 
		
			
	}
	
	
	
	
	/*
	@START -- BUILD: Events Array
	***********************************************************/
	
	function siteEventsList($organization_id = '')
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */
		$response = array(); /* $response["events"] */
		
		$sq_crit = "";
		if($organization_id <> ''){
			$sq_crit = " AND `mrfc_dt_content`.`organization_id` = ".q_si($organization_id)." ";
		}
		//

		$sq_eventlinks = "SELECT `mrfc_dt_content_dates`.`id_content`
			,    UNIX_TIMESTAMP(`mrfc_dt_content_dates`.`date`) AS `date`
			,  `mrfc_dt_content`.`arr_extras` AS `location`
			 ,  `mrfc_dt_content`.`url_title_article`
			 ,  `mrfc_dt_content`.`article`
			, `mrfc_dt_content`.`title`
			, DATE_FORMAT(`mrfc_dt_content_dates`.`date`, '%Y%m%d') as `ev_date`
			, DATE_FORMAT(`mrfc_dt_content_dates`.`date`,'%l:%i %p') AS `ev_time_start`
		FROM
			`mrfc_dt_content_dates`
			INNER JOIN `mrfc_dt_content` 
				ON (`mrfc_dt_content_dates`.`id_content` = `mrfc_dt_content`.`id`)
		   WHERE `mrfc_dt_content`.`published` = '1'  AND `mrfc_dt_content`.`approved` = '1' ".$sq_crit."
		ORDER BY `mrfc_dt_content_dates`.`date` DESC ;"; 
		
		
		/*$sq_eventlinks = " SELECT `mrfc_dt_content_dates`.`id_content`,    DATE_FORMAT(`mrfc_dt_content_dates`.`date`,'%b %e %Y') AS `date`, `mrfc_dt_content`.`title`,  `mrfc_dt_content`.`arr_extras` AS `location`, `mrfc_dt_content`.`organization_id` FROM `mrfc_dt_content_dates` INNER JOIN `mrfc_dt_content`  ON (`mrfc_dt_content_dates`.`id_content` = `mrfc_dt_content`.`id`) WHERE (`mrfc_dt_content`.`published` =1) GROUP BY `mrfc_dt_content`.`title`, `mrfc_dt_content_dates`.`id_content` ORDER BY `mrfc_dt_content_dates`.`date` DESC ";*/
		// `mrfc_dt_content_dates`.`date` >=CURRENT_DATE() and 
		
		$rs_eventlinks 			= $this->dbQuery($sq_eventlinks);
		$rs_eventlinks_count 	= $this->recordCount($rs_eventlinks);
		$truncFilter 	= "<img>";
		
		if($rs_eventlinks_count>=1)
		{
			$ev_loop=1;
			while($cn_eventlinks = $this->fetchRow($rs_eventlinks))
			{
				$response[$cn_eventlinks['id_content']]	 = $cn_eventlinks['id_content'];
				
				/*$cont_id			= $cn_eventlinks[0];
				$cont_date		  = $cn_eventlinks[1];
				$cont_dateb 		 = strtotime($cont_date);
				$cont_title		 = master::$contMainNew[$cont_id]['title'];		
				$cont_article	   = master::$contMainNew[$cont_id]['article'];
				$cont_brief 		 = smartTruncateNew(strip_tags($cont_article, $truncFilter),250);
				$cont_location	  = master::$contMainNew[$cont_id]['location'];
				$cont_section	  = master::$contMainNew[$cont_id]['id_section'];
				$booking	       = master::$contMainNew[$cont_id]['booking'];
				$booking_amount    = master::$contMainNew[$cont_id]['booking_amount'];
				$cont_seo		   = $cont_id.'/'.master::$contMainNew[$cont_id]['link_seo'];*/
				//$item_link	      = display_linkArticle($cont_id, $cont_seo);
				
				/*$eventItem 	= array(
					'evid' 	 => ''.$cont_id.'',
					'date'     => ''.$cont_dateb.'',
					'title'    => ''.$cont_title.'',
					'location' => ''.$cont_location.'',
					'description' => ''.$cont_brief.'',
					'id_section' => ''.$cont_section.'',
					'booking' => ''.$booking.'',
					'booking_amount' => ''.$booking_amount.'',
					'link' => ''.$cont_seo.''
				);*/
				
				//array_push($response["events"], $eventItem);		
				//$this->contEvents[] = $eventItem;				
				$ev_loop += 1;				
			}
		}
		return $response; //$this->contEvents;
	}
	
	
	
	function siteEventsFuture()
	{
		/* $this->connect() or trigger_error('SQL', E_USER_ERROR); */
		$response["events"] = array();
		//echobr(count(master::$contMainNew)); exit;
		//$dispData->buildContent_Arr();
		/*`mrfc_dt_content`.`title`,  `mrfc_dt_content`.`arr_extras` AS `location`, `mrfc_dt_content`.`organization_id`*/
		$sq_eventlinks = " SELECT `mrfc_dt_content_dates`.`id_content`,    DATE_FORMAT(`mrfc_dt_content_dates`.`date`,'%b %e %Y') AS `date`, `mrfc_dt_content`.`*`,  `mrfc_dt_content`.`arr_extras` AS `location` FROM `mrfc_dt_content_dates` INNER JOIN `mrfc_dt_content`  ON (`mrfc_dt_content_dates`.`id_content` = `mrfc_dt_content`.`id`) WHERE (`mrfc_dt_content`.`published` =1) GROUP BY `mrfc_dt_content`.`title`, `mrfc_dt_content_dates`.`id_content` ORDER BY `mrfc_dt_content_dates`.`date` DESC ";
		// `mrfc_dt_content_dates`.`date` >=CURRENT_DATE() and 
		$rs_eventlinks = $this->dbQuery($sq_eventlinks);
		$rs_eventlinks_count = $this->recordCount($rs_eventlinks);
		$truncFilter 	= "<img>";
		if($rs_eventlinks_count>=1)
		{
			$ev_loop=1;
			while($cn_eventlinks = $this->fetchRow($rs_eventlinks))
			{
				$cont_id			= $cn_eventlinks['id_content']; 
				$cont_date		  = $cn_eventlinks['date'];
				$cont_dateb 		 = strtotime($cont_date);
				
				$cont_array		 = master::$contMainNew[$cont_id]; 
				$cont_title		 = $cont_array['title'];		
				$cont_article	   = $cont_array['article'];
				$cont_brief 	  = smartTruncateNew(strip_tags($cont_article, $truncFilter),250);
				$cont_location	  = $cont_array['location'];
				$cont_section	  = $cont_array['id_section'];
				$booking	       = $cont_array['booking'];
				$booking_amount    = $cont_array['booking_amount'];
				$cont_seo		   = $cont_id.'/'.$cont_array['link_seo'];
				//$item_link	      = display_linkArticle($cont_id, $cont_seo);
				
				$eventItem 	= array(
					'evid' 	 => ''.$cont_id.'',
					'date'     => ''.$cont_dateb.'',
					'title'    => ''.$cont_title.'',
					'location' => ''.$cont_location.'',
					'description' => ''.$cont_brief.'',
					'id_section' => ''.$cont_section.'',
					'booking' => ''.$booking.'',
					'booking_amount' => ''.$booking_amount.'',
					'link' => ''.$cont_seo.''
				);
				
				array_push($response["events"], $eventItem);		
				//$this->contEvents[] = $eventItem;				
				$ev_loop += 1;				
			}
		}
		return $response; //$this->contEvents;
	}
	
	
	
	/*
	@BUILD: sub menu
	***********************************************************/
	
	function build_SubMenu ( $menu, $el_id, $path, $com_active, $nav_cat="", $nav_level="", $com="", $nlimit="", $nexpand="Y" )
	{
		$has_subcats = FALSE;
		
		
		if (array_key_exists($el_id, $this->menuSubs) and is_array($this->menuSubs[$el_id])) 
		{
		
			$submenu_class = "";	
			$submenu_icons = "";			
			$out  		  = ""; 
			$out_close 	= ""; 
			
			if(trim($nav_cat) == "sf-menu") { $submenu_class = " filetree "; $submenu_icons = " folder ";	 }
			
			//if($nav_cat <> "" and trim($nav_cat) <> "sf-menu") { $submenu_class = " $nav_cat "; }
			//if($nav_cat=="treeview") { $submenu_class = " style=\"display: none\" "; }
			//echoBr($nav_cat);
			//echoBr($nlimit);
			if($nlimit == "") 
			{   $menuChildren = $this->menuSubs[$el_id]; }
			else
			{   $submenuArray = array_chunk($this->menuSubs[$el_id], $nlimit, true); 
				$menuChildren = $submenuArray[0];
				$nexpand = "";
			}
			//$menuChildren = $this->menuSubs[$el_id]; 
			
			
			
			$out .= "<ul class=\" $submenu_class\">"; 
			
			$linkLoop = 1;
			
			foreach($menuChildren as $key => $childID)
			{
				$sl = $this->menuLong[$childID];
				
				//displayArray($sl); exit;
				
				if( is_array($sl)) 
				{
					$isActive = "  ";
					if ( $sl['id'] == $com_active ) { $isActive = " current ";} 
					
					$has_subcats = TRUE;
					
					$npath = $path.$key."&com".$nav_level."=";
										
					if($sl['link_menu']<>"#") { 
						$lbit = substr($sl['link_menu'],0,3);	//EXTERNAL
						if($lbit == 'htt' or $lbit == 'www' or $lbit == 'ftp' or $lbit == 'ww2') 
						{ 
							$redirect = $sl['link_menu'];
							if(substr($lbit,0,2)  == 'ww') { $redirect = 'http://'. $sl['link_menu']; }
							$sURL = urlencode($redirect); 
							$link = 'out.php?url='.$sURL;  
						} else 
						{ $link = $sl['link_menu'] . $npath; }
					} else { $link = '#'; }
					
					
					if($sl['id_access'] == 2) { 
						$folderlock = "nav-locked"; /*$link = "#";*/
						if ( $sl['id'] == $com_active ) { $folderlock = "nav-locked-open"; }
						
				
					
					 } else { $folderlock = ""; }
					
					
					if($link <> '#'){  } $linkd = " href=\"$link\" ";
					
					if($sl['to_footer'] == 1 ) { 
						if (!array_key_exists($key, $this->linkToFoot)) {
							$this->linkToFoot[$key] ="<li><a".$linkd.">".$sl['title']."</a></li>"; 
						}
					}
					
					if($sl['to_quick'] == 1) { 
						if (!array_key_exists($key, $this->linkToQuick)) {
							$this->linkToQuick[$key] ="<li><a".$linkd.">".$sl['title']."</a></li>";  
						}
					}
					
					
				$countSubs = '';
				
				/*if(array_key_exists($key, $this->menuSubs) and is_array($this->menuSubs[$key]))
				{
					//$countSubs = ' ('.count($this->menuSubs[$key]).')';
				}*/
				
				if(array_key_exists($key, master::$menuToContents)) //and is_array($this->menuSubs[$key])
				{
					$countSubs = ' ('.count(master::$menuToContents[$key]).')'; 
				}
					
					//<div class=\"hitarea expandable-hitarea\"></div>
					$out .= "<li class=\"expandable ".$isActive."\" >"; 
					$out .= "<span class=\"".$submenu_icons." ".$folderlock." ".$isActive."\"><a".$linkd." class=\"".$isActive." linkMenu\" data-id=\"".$sl['id']."\">".$sl['title'] .$countSubs."</a></span>"; 
					
					$mpath = $npath."&com2=".$key;
					
					if($nexpand == "Y")
					{
						//if(array_key_exists('children', $sl) and is_array($sl['children'])) {
						if(array_key_exists($childID, $this->menuSubs) and is_array($this->menuSubs[$childID])) {
							//another level sub menu
							$out .=  $this->build_SubMenu ( $menu, $childID, $npath, $com_active, $nav_cat, ($nav_level+1), $com ); 
						}
					}
						
					$out .= "</li>"; //."\n"; 
					$linkLoop += 1;
					
				}
			}
			
			$out .= "</ul>";
			$out .= $out_close; //"</td></tr></table></div></div>";
			return ( $has_subcats ) ? $out : FALSE;
			//return ( $out ) ? $has_subcats : FALSE;
		}
	}
	
	
	
	
	
	
	
	/*
	@BUILD: NAV TABS ARTICLE TITLES
	***********************************************************/
	
	function build_navTabArticles ( $parent, $limit = 100, $optionalTitle = '' )
	{
		$output = ''; $parentTitle = '';
		
		if($optionalTitle == '')
		{
			if($this->menuLong[$parent]['title_alias'] <> '') 
			{	$parentTitle = $this->menuLong[$parent]['title_alias']; } else 
			{	$parentTitle = $this->menuLong[$parent]['title']; }	
			$output = '<h3 class="txtupper">'.$parentTitle.'</h3>';
			$output .= '<div class="info-b"><ul class="bul-gry" >';
			$pageurl = 'department.php';
			$pagehash = ' #'.$parent.'';
		} 
		else {
			$parentTitle = $optionalTitle;
			$output = '<h4 class="txtupper txtred">'.$parentTitle.'</h4>';
			$output .= '<div class="wside_nav"><ul class="nav_context" >';
			$pageurl = 'dept.php';
			$pagehash = '';
		}
		
		
		$tabContFull   	 = $this->contTabsDept[$parent];
		$tabContPaged 	= array_chunk($tabContFull, $limit, true);		
		$tabContTitles   = $tabContPaged[0];

		
		foreach ($tabContTitles as $menu => $cont) 
		{ 
			if($this->menuLong[$menu]['id_section'] == 7)
			{
				$linka   = ''.$pageurl.'?com='.$menu.'&tab='.$parent.''.$pagehash.'';
				$conta   = $this->menuLong[$menu]['title'];			
				$output .= '<li><a href="'.$linka.'">'.$conta.'</a></li>';
			}
		}
		$output .=  '</ul></div>';
		
		
		if(count($tabContFull) > $limit) {
		$output .=  '<div class="padd5_t"><a href="context.php?com='.$parent.'" class="postDate read_more_right" style="border:1px solid #f00">VIEW ALL</a></div>';
		}
		
		return $output;
	}
	
	
	
	
	/*
	@BUILD: NAV SINGLE COLUMNS
	***********************************************************/
		
	function build_navCategorySingle ( $id_category, $com_active = '', $linkLimit = 4, $cat_class='nav_cols' )
	{
		$out = '';
		if(array_key_exists($id_category, master::$menusFull))  
		{
			
			$swl 		= master::$menusFull[$id_category];			
			$parent 	 = $swl['id'];
			
			$box_title  = $swl[ 'title' ];
			$box_links  = $this->buildMenu_Main ($com_active, 0, $parent, $cat_class);
			
			$box_title = 'Sectors';
			
			$out .= '<div class="box-cont">';
			$out .= '<div class="box-cont-title">'.$box_title.'</div>';
			
			$out .= $box_links;
			$out .= '<div class="padd10"></div></div>';
		}
		return $out;
	}
	
	
	
	/*
	@BUILD: NAV FOOTER COLUMNS
	***********************************************************/
		
	function build_navColumnsFoot ( $com_active, $linkLimit = 4, $cat_section = 'navSide' )
	{
		$menu = master::$menuBundle['group']; 
		
		$out = '';
		
		$tagsOpen 	 = '';
		$tagsClose 	= '';
		$cat_class	= '';
		
		if($cat_section == 'navSide')
		{
			$tagsOpen 	 = '<div class="padd10"></div><div class="phpkb-tree"><div class="padd5">';
			$tagsClose 	= '</div></div>';
			$cat_class	= 'nav_dloads';
		}
		
		if($cat_section == 'nav_cols')
		{
			$cat_class	= 'nav_cols';
		}
		
		
		$out .= '<div class="pagerX">';
		
		foreach($menu as $key)	// => $swl
		{
			$swl = master::$menusFull[$key];
			
			$parent = $swl['id'];
			
			$box_title = $swl[ 'title' ];
			
			$box_links = $this->buildMenu_Main ($com_active, 0, $parent, $cat_class, 0);
			
			/*$out .= $tagsOpen . '<div class="panel panel-default panel-alt">
				<div class="panel-heading">
					<h3 class="txtbrown">'. $box_title .'</h3>
				</div>
				<div class="panel-body">
					<div class="">'. $box_links .'</div>
				</div>
			</div>' . $tagsClose;*/
				
				$out .= "<div class=\"nav_foot_colX\">
						<h5 class=\"foot_col_header\">". $box_title ."</h5>".
						$box_links .
						"</div>";/*$this->buildMenu_Main ($com_active, 0, $parent, '')*/
			
			
		}
		
		$out .= '</div>';
		return $out;
	}
	
	
	
	
	/*
	@BUILD: TAB LINKS
	***********************************************************/
		
	function build_navTabs ( $menu, $com_active, $linkLimit = 4 )
	{
		
		foreach($menu as $key => $valID)
		{
			$swl = $valID; //$this->menuLong[$valID];
			
			if( is_array($swl)) 
			{
			$link 	= $swl['link_menu'];
			$isec    = $swl['id_section'];
			
			if ( $swl['id'] == $com_active ) { $isActive = " current";} else { $isActive = "";}
			
			$linktab = " href=\"#\" data-id=\"".$key."\" data-url=\"contabs.php?com=".$key."&tab=".$key."&isec=".$isec."\" ";
			
			
			$parent = $swl[ 'id' ];$com_active = 0;
			echo "<li><a $linktab  class=\"". $isActive ."\">".$swl['title']."</a></li>";
				
			
			}
		}
		
		//return $out;
	}
	
	
	/*
	@BUILD: other site menus
	***********************************************************/
	
	function build_generalMenu ( $menu, $com, $com_active, $nav_id="", $id_menu_type = 1, $static = 0 )
	{
		$out =  ""; 
		$mcom = 1 ;
		
		$mloops = 0 ;
		
		$ul_identity = "id=\"".$nav_id."\"";
		 	
			if( $nav_id == "nav_side") { $ul_identity = "class=\"".$nav_id."\""; }
			if( $nav_id == "zentabs_ul") { $ul_identity = "class=\"".$nav_id."\""; }
		
		$out = "";
		if( $nav_id <> "treeview") { $out .=  "<ul ".$ul_identity.">";	}
		
		
		
		foreach($menu as $key => $ml)
		{
		if( is_array($ml)) 
		{ 
			if( $nav_id == "treeview") 
			{
				if ( $ml['id_menu_type'] == $id_menu_type  or 
					 $ml['id_menu_type'] == '4'  or
					 $ml['id_menu_type'] == '6' ) 
				{	
					
					$link = $ml['link_menu'];	
					if ( $link == "#")	{ 	$linkb = ""; } else {	$linkb = " href=\"$link?com=".$key." \" ";	} 
					if ( $ml ['id'] == $com ) { $isActive = " selected ";} else { $isActive = "";}
						
					if (array_key_exists('children', $ml) and is_array($ml['children'])) 
					{	$add_class = "expandable"; $add_icons = "<div class=\"hitarea expandable-hitarea\"></div>";
					} else 
					{ 	$add_class = ""; $add_icons = ""; }
					
					//\n 
					$out .=  "<li class=\"".$add_class."\">$add_icons<a class=\"".$isActive."\" $linkb>". $ml[ 'title' ] ."</a>";
					$out .=  $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active ,"treeview", 3);
					$out .=  "</li>";
				}
			}
			
			else
			{
				
				if ( $ml [ 'id_menu_type' ] == $id_menu_type ) 
				{		
						$link = $ml['link_menu'];	
						
					//  *********************************** @beg :: BASIC LINKS ***********************************
						if ( $link == "#")	{ 	$linkb = ""; } else {	$linkb = " href=\"$link?com=".$key." \" ";	} 
						if ( $ml ['id'] == $com ) { $isActive = " class =\"current\" ";} else { $isActive = "";}
						
					//  *********************************** @end :: BASIC LINKS ***********************************
					
						
					//  *********************************** @beg :: TABBED LINKS ***********************************
						if( $nav_id == "zentabs_ul") 
						{
							$link = "_tabs_ajax_content.php"; 
							$linkb 	= " href=\"$link?id=".$key."\" id=\"tab".$key."\" ";
							if($mloops == 0) { $isActive = " class =\"current\" "; }
						}
					// *********************************** @end :: TABBED LINKS ***********************************
					
						$navClass = "";
						if($nav_id=="accountNav"){	$navClass = " account_nav_sec";	}
					
					//  ===========================================================================================								
					
					
				
						
					$out .=   "<li class=\"".$isActive.$navClass."\"><a $linkb class=\"".$isActive."\">". $ml[ 'title' ] ."</a>";
					$out .=  $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active ,$nav_id, 3, $com); 
					$out .=   "</li>";
					
					$mloops += 1 ;
				}
				
			} //for static
			
		}
		
		}
		
		if( $nav_id <> "treeview") 
		{
			$out .=  "</ul>";
		}
		
		return $out;
	}
	
	
	
	
	/*
	@BUILD: side menu
	***********************************************************/
	function build_articlesMenu ( $menu, $com, $com_active, $section_num = 6)
	{
		$out =  ""; 
		$mcom = 1 ;
		
		$mloops = 0 ;
		
		$ul_identity = "id=\"".$nav_id."\"";
		 
			if( $nav_id == "zentabs_ul") { $ul_identity = "class=\"".$nav_id."\""; }
		
		$out = "";
		$out .=  "<ul class=\"nav_side\">";	//".$ul_identity."
		
		foreach($menu as $key => $ml)
		{
			if( is_array($ml)) 
			{ 
			
				if ( $ml['id_section'] == $section_num ) 
				{		
						$link = $ml['link_menu'];	
						
					//  *********************************** @beg :: BASIC LINKS ***********************************
						if ( $link == "#")	{ 	$linkb = ""; } else {	$linkb = " href=\"$link?com=".$key." \" ";	} 
						if ( $ml ['id'] == $com ) { $isActive = " class =\"current\" ";} else { $isActive = "";}
						
					//  *********************************** @end :: BASIC LINKS ***********************************
					
					
					//  *********************************** @beg :: EXTERNAL LINKS ***********************************
						/*if(substr($link,0,4) <> "http") { $link = "http://".$link; }
						if ( $link == "#")	{ 	$linkb = ""; } else {	$linkb = " href=\"$link\" ";	} 
						if ( $ml ['id'] == $com ) { $isActive = " class =\"current\" ";} else { $isActive = "";}*/
						
					//  *********************************** @end :: BASIC LINKS ***********************************
					
					
					//  ===========================================================================================
					
						
					//  *********************************** @beg :: TABBED LINKS ***********************************
					
					// *********************************** @end :: TABBED LINKS ***********************************
					//  ===========================================================================================								
					
						$out .=   "<li><a $linkb $isActive>". $ml[ 'title' ] ."</a>";
						
							if( $nav_id <> "zentabs_ul") 
							{	$out .=  $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active ,"", 3); }
						
						$out .=   "</li>";
					
					$mloops += 1 ;
				}
				
			}
			//else { echo "not array"; }
		}
		$out .=  "</ul>";
		return $out;
	}
	
	
	
	
	function build_SideMenu ( $menu, $parent, $com_active, $path="" )
	{
		
		echo "<div class=\"wside_nav\">";
		foreach($menu as $key => $swl)
		{
		if( is_array($swl)) 
		{
			//echo $key;
			if ( $swl [ 'id' ] == $parent ) 
			{
				if( $this->build_SubMenu ( $menu, $parent, $path, $com_active ,"", 4) == FALSE )
				{	
					//echo "hakuna";
				} 
				else 
				{
				$meStyle= " class=\"\" ";
				echo  "<h4 $meStyle>". $swl[ 'title' ] ."</h4><div>";
				//echo  $this->build_SubMenu ( $menu, $parent, $path, $com_active ,"", 4);
				
				echo $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active , $mainNavClass, 3, $com);
				//build_SubMenu ( $menu, $el_id, $path, $com_active, $nav_cat="", $nav_level="", $com="" )
				
				echo  "</div>";
				}
				
			}
		}
		}
		echo  "</div>";
		//return $out;
	}
	
	
	
	/*
	@BUILD: side menu
	***********************************************************/
	
	//$out .=  $this->build_SubMenu ( $menu, $key, "?com=".$key."&com2=", $com_active , $mainNavClass, 3, $com);
	
	function build_FootMenu ( $menu, $com_active )
	{
		
		echo "<div class=\"pager\">";
		foreach($menu as $key => $swl)
		{
		if( is_array($swl)) 
		{
			//echo $key;
			if ( $swl['id_menu_type'] == 1  and $swl['id'] <> 1 or $swl['id_menu_type'] == 3 ) 
			{
				$meStyle= " class=\"box-title linegray\" ";
				$parent = $swl[ 'id' ];$com_active = 0;
				echo  "<div class=\"nav_foot_col\">";
				echo  "<h3 $meStyle>". $swl[ 'title' ] ."</h3>";
				echo  $this->build_SubMenu ( $menu, $parent, "?com=".$parent."&com2=", $com_active ,"nav_foot", 3);
				echo  "</div>";
			}
		}
		}
		echo  "</div>";
		//return $out;
	}
	
	
	/*
	@BUILD: main menu Select
	***********************************************************/
	
    function build_MenuSelectOne ($sel_this = 0, $sel_array = "", $access = '1')
	{
		$menuList = master::$menusFull;
		array_sort_by_column($menuList, 'id', SORT_ASC);
		
		$optsFields = array();
		$optsKeys = array();
        
        //$show_tag_links = ();
		
		foreach($menuList as $ml)
		{
			$isSel = "";
			
            //if($ml['id_menu_type'] <> 10) 
            //{

                
                if(is_array($sel_array))
                {
                    $optVal = $ml['id'];
                    if(in_array($optVal, $sel_array)) { $isSel = " selected";} else { $isSel = ""; }						
                }

                if ( $sel_this == $ml['id']) {	$isSel .= " disabled=\"disabled\" ";  }


                if (!array_key_exists($ml['id'], $optsKeys))
                {
                    $optsFields[] = "<option value=\"". $ml['id'] ."\" $isSel>". $ml['title'] ."</option>";
                    $optsKeys[$ml['id']] = $ml['id'];
                }



                if(is_array(master::$menusChild) and array_key_exists($ml['id'], master::$menusChild) )
                {
                    $menuKids = master::$menusChild[$ml['id']];
                    $parent = "../";
                    foreach($menuKids as $kkey => $kval)
                    {
                        if(is_array($sel_array) and in_array($kval, $sel_array)) 
                        { $isSel = " selected";} else { $isSel = ""; }
                        if($sel_this == $kval) 
                        {	$isSel .= " disabled=\"disabled\" ";  }

                        if (!array_key_exists($kval, $optsKeys))
                        {
                        $kidArray = master::$menusFull[$kval];
                        $optsFields[] = "<option value=\"". $kval ."\" $isSel>". $parent . $kidArray['title'] ."</option>";
                        $optsKeys[$kval] = $kval;
                        }
                    }
                }
                
                
           //}
				
		}
		
		return implode('',$optsFields);
	}
	
    
    
    
	function build_MenuSelectRage ($sel_this = 0, $sel_array = "", $access = '1')
	{
		$menuList = master::$menusFull;
		array_sort_by_column($menuList, 'id', SORT_ASC);
		
		$optsFields = array();
		$optsKeys = array();
        
        //$show_tag_links = ();
		
		foreach($menuList as $ml)
		{
			$isSel = "";
			
            if($ml['id_menu_type'] <> 10)   // and !array_key_exists($ml['id'], master::$menuBundle['type'][10])
            {

                
                if(is_array($sel_array))
                {
                    $optVal = $ml['id'];
                    if(in_array($optVal, $sel_array)) { $isSel = " selected";} else { $isSel = ""; }						
                }

                if ( $sel_this == $ml['id']) {	$isSel .= " disabled=\"disabled\" ";  }


                if (!array_key_exists($ml['id'], $optsKeys))
                {
                    $optsFields[] = "<option value=\"". $ml['id'] ."\" $isSel>". $ml['title'] ."</option>";
                    $optsKeys[$ml['id']] = $ml['id'];
                }



                if(is_array(master::$menusChild) and array_key_exists($ml['id'], master::$menusChild) )
                {
                    $menuKids = master::$menusChild[$ml['id']];
                    $parent = "../";
                    foreach($menuKids as $kkey => $kval)
                    {
                        if(is_array($sel_array) and in_array($kval, $sel_array)) 
                        { $isSel = " selected";} else { $isSel = ""; }
                        if($sel_this == $kval) 
                        {	$isSel .= " disabled=\"disabled\" ";  }

                        if (!array_key_exists($kval, $optsKeys))
                        {
                        $kidArray = master::$menusFull[$kval];
                        $optsFields[] = "<option value=\"". $kval ."\" $isSel>". $parent . $kidArray['title'] ."</option>";
                        $optsKeys[$kval] = $kval;
                        }
                    }
                }
                
                
           }
				
		}
		//displayArray($optsFields); exit;
		return implode('',$optsFields);
	}
	
	
	
	
	
	
	
	
	/*
	@END -- BUILD: Site Content
	***********************************************************/
	
	
	
	
	
	
	/*
	@BUILD: Accordion
	***********************************************************/
	
	function build_Accordion ( $parent, $sec = 3 )
	{
		//$this->faqMain = "";
		$faqMain = '';
		$faqNum = 1;
		//if(count($this->contLong[$parent][$sec])>0) {
		if(array_key_exists($parent, master::$menuToContents))	
		{	
			//$this->contLong[$parent][$sec]
			//foreach($this->contLong[$parent][$sec] as $key => $swlf)
			asort(master::$menuToContents[$parent]);
			foreach(master::$menuToContents[$parent] as $contkey)
			{
				//if( is_array($swlf))  {}
				$cont_arr 	   		= master::$contMainNew[$contkey]; /*displayArray($cont_arr);*/
				$id_section 	   	= $cont_arr['id_section'];
				
				if($id_section <> 17)
				{
					$faqtitle 	   		= $cont_arr['title'];
					$faqtitle_alias 	= $cont_arr['title_sub'];
					$faqarticle	 		= $cont_arr['article'];

					if($faqtitle_alias <> '') { $faqtitle_alias = ' &nbsp; <span>'. $faqtitle_alias .'</span>'; }

					$faqMain .= '<div class="accordion-header"><a href="javascript:">'. $faqNum .'. '. $faqtitle .' '. $faqtitle_alias .'</a></div>';
					$faqMain .= '<div class="accordion-content">';
					$faqMain .= $faqarticle;
					$faqMain .= '</div>';

					$faqNum += 1;
					
				}
			}
		}
		return $faqMain;
	}
	
	
	
	
	
	
	
	function build_MenuArticles ( $menu , $sel_crit, $sel_this = 0, $sel_array = "", $sel_portal = 1)
	{
		array_sort_by_column($menu, 'parent', SORT_ASC);
		$out = "<option value='' > - Select -</option>";
		foreach($menu as $key => $ml)
		{
			if( is_array($ml)) 
			{
				$isSel = "";
				
				if($sel_crit == $ml['id']) { $isSel = " selected";} else { $isSel = ""; }
				
				if(is_array($sel_array)){
					$optVal = $ml['id'];
					if(in_array($optVal, $sel_array)) { $isSel = " selected";} else { $isSel = ""; }						
				}
				
				if ( $sel_this == $ml['id']) {	$isSel .= " disabled=\"disabled\" ";  }
				
				//echo "<option value=\"\"></option>";
				$out .=   "<option value=\"". $ml[ 'id' ] ."\" $isSel>". $ml['parent'] ." / ". $ml['title'] ."</option>";
				
			}
		}
		return $out;
	}
	
    
    
    
    /* ============================================================================== 
/*	@BUILD: COUNTY 
/* ------------------------------------------------------------------------------ */		

	function get_countyProfile($id = 47)
	{
		$result = array();
		
		if($id) 
		{
			$sq_qry = "SELECT `county_id`, `county` FROM `mrfc_reg_county`  WHERE (`county_id` = ".$this->quote_si($id)."); ";		
			$result = current($this->dbQueryFetch($sq_qry));		
			
			/*$county_name   	= trim($result['county']);
			$county_banner 	= 'images/background/'.$county_name.'_Gen.jpg';
			$county_map 	= 'images/maps/'.$county_name.'_Map.jpg';
			$county_web   	= ($result['website'] == '') ? 'http://'.clean_alphanum($county_name).'.go.ke' : $result['website'];
			
			
			$result['banner'] = $county_banner;
			$result['map'] = $county_map;
			$result['website'] = $county_web;*/
		}
		return $result;
	}
	
	

			
/*
	@END: class
*/	
}
	

$folderPath = substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/"));
$folderPath = substr($folderPath,strrpos($folderPath,"/")+1);

$folderPortal = 1;


$dispData=new data_arrays;
//$dispData->buildMenu_Arr();
//$dispData->buildContent_Arr();

$reqPage = $_SERVER['REQUEST_URI']; 

if(!strpos($reqPage,'sysadm/')  and (substr($this_page,0,5) <> 'poll_') and $this_page <> 'ajforms.php' and $this_page <> 'cart-post.php')
{ 
	$dispData->buildMenu_Arr();
	$dispData->buildContent_Arr();
	$dispData->siteGallery(); 
} 

//echo __DIR__;
?>