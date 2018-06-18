<?php

class data_maarifa extends master
{

	public $barNumbers = array();

    
/* ============================================================================== 
/*	@COMMITTEES TAGS - CONTENT 
/* ------------------------------------------------------------------------------ */	
    
    function get_contentParents($content, $trimmer = 0)
	{
		$result = array();
		
		$sq_qry = "SELECT
    `mrfc_dt_content_parent`.`id_content`
    , `mrfc_dt_content_parent`.`committee_id`
    , `mrfc_app_committee`.`title`
    , `mrfc_app_committee`.`title_seo`
    , `mrfc_reg_county`.`county_id`
    , `mrfc_reg_county`.`county`
FROM
    `mrfc_dt_content_parent`
    LEFT JOIN `mrfc_app_committee` 
        ON (`mrfc_dt_content_parent`.`committee_id` = `mrfc_app_committee`.`committee_id`)
    LEFT JOIN `mrfc_reg_county` 
        ON (`mrfc_dt_content_parent`.`county_id` = `mrfc_reg_county`.`county_id`)
WHERE (`mrfc_dt_content_parent`.`id_content` = ".q_si($content).")
HAVING (`mrfc_dt_content_parent`.`committee_id` > 0) OR (NOT ISNULL(`mrfc_reg_county`.`county_id`));";
		
        $rs_qry = $this->dbQuery($sq_qry);	
        
		while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$committee_id    = $cn_qry['committee_id'];
				$committee_title = $cn_qry['title'];
				$committee_seo	 = $cn_qry['title_seo'];
                $committee_label  = '';
            
                $county_id      = $cn_qry['county_id'];
				$county_title   = $cn_qry['county'];
                $county_seo		= generate_seo_title($county_title, '-');
                $county_label    = '';
            
                if($trimmer == 1){
                    $committee_label    = ' title="'.$committee_title.'" ';
                    $committee_title    = smartTruncateNew($committee_title, 25, '', 0, ''); 
                    
                    //$county_label       = ' title="'.$county_title.'" ';
                    //$county_title       = smartTruncateNew($county_title, 25, '', 0, ''); 
                }
            
                if($county_id <> '') { 
                    //$result['county'][] = '<a href="counties/?cty='.$county_seo.'" class="txtpurple txt11_fx">'.$county_title.'</a>'; 
                    $result['county'][] = '<a href="index.php?fcty='.$county_id.'&fsec=" class="txtpurple txt11_fx">'.$county_title.'</a>'; 
                }
            
                if($committee_id <> '0') { 
                    
                    //$committee_link = ($committee_id <> '33') ? ' href="sectoral-committees/?cmt='.$committee_seo.'#stories" ' : '';
                    //$result['committee'][] = '<a '.$committee_link.' class="linkCmt txtgreen txt11_fx" data-id="'.$committee_id.'">'.$committee_title.'</a>'; 
                    
                    $committee_link = ($committee_id <> '33') ? ' href="index.php?fcty=&fsec='.$committee_id.'" ' : '';
                    $result['committee'][] = '<a '.$committee_link.' class="linkCmt txtgreen txt11_fx" data-id="'.$committee_id.'">'.$committee_title.'</a>'; 
                }
			}		
		
		return $result;
	} 
    
    
    
    function get_resourceParents($resource, $trimmer = 0)
	{
		$result = array();
		
		$sq_qry = "SELECT
    `mrfc_dt_downloads_parent`.`resource_id`
    , `mrfc_dt_downloads_parent`.`committee_id`
    , `mrfc_app_committee`.`title`
    , `mrfc_app_committee`.`title_seo`
    , `mrfc_reg_county`.`county_id`
    , `mrfc_reg_county`.`county`
FROM
    `mrfc_dt_downloads_parent`
    LEFT JOIN `mrfc_app_committee` 
        ON (`mrfc_dt_downloads_parent`.`committee_id` = `mrfc_app_committee`.`committee_id`)
    LEFT JOIN `mrfc_reg_county` 
        ON (`mrfc_dt_downloads_parent`.`county_id` = `mrfc_reg_county`.`county_id`)
WHERE (`mrfc_dt_downloads_parent`.`resource_id` = ".q_si($resource).")
HAVING (`mrfc_dt_downloads_parent`.`committee_id` > 0) OR (NOT ISNULL(`mrfc_reg_county`.`county_id`));";
		
        $rs_qry = $this->dbQuery($sq_qry);	
        
		while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$committee_id    = $cn_qry['committee_id'];
				$committee_title = $cn_qry['title'];
				$committee_seo	 = $cn_qry['title_seo'];
                $committee_label  = '';
            
                $county_id      = $cn_qry['county_id'];
				$county_title   = $cn_qry['county'];
                $county_seo		= generate_seo_title($county_title, '-');
                $county_label    = '';
            
                if($trimmer == 1){
                    $committee_label    = ' title="'.$committee_title.'" ';
                    $committee_title    = smartTruncateNew($committee_title, 25, '', 0, ''); 
                    
                    //$county_label       = ' title="'.$county_title.'" ';
                    //$county_title       = smartTruncateNew($county_title, 25, '', 0, ''); 
                }
            
                if($county_id <> '') { 
                    //$result['county'][] = '<a href="counties/?cty='.$county_seo.'" class="txtpurple txt11_fx">'.$county_title.'</a>'; 
                    $result['county'][] = '<a href="index.php?fcty='.$county_id.'&fsec=#resources" class="txtpurple txt11_fx">'.$county_title.'</a>'; 
                }
            
                if($committee_id <> '0') { 
                    //$committee_link = ($committee_id <> '33') ? ' href="sectoral-committees/?cmt='.$committee_seo.'#resources" ' : '';
                    //$result['committee'][] = '<a '.$committee_link.' class="linkCmt txtgreen txt11_fx" data-id="'.$committee_id.'">'.$committee_title.'</a>'; 
                    
                    $committee_link = ($committee_id <> '33') ? ' href="index.php?fcty=&fsec='.$committee_id.'#resources" ' : '';
                    $result['committee'][] = '<a '.$committee_link.' class="linkCmt txtgreen txt11_fx" data-id="'.$committee_id.'">'.$committee_title.'</a>'; 
                }
			}		
		
		return $result;
	} 
    
    
    
 
/* ============================================================================== 
/*	@COMMITTEES ARRAY
/* ------------------------------------------------------------------------------ */		

    function get_commiteeItems($type='select', $item_selected = '', $hide_option_all = '')
	{
		
		$sq_crit = " WHERE `mrfc_app_committee`.`published` =1 ";
        
		if($type == 'single' && $item_selected <> ''){
			$sq_crit .= " and `mrfc_app_committee`.`committee_id` = ".q_si($item_selected)." ";
		}
        
        if($type == 'multi' && $item_selected <> ''){
			$sq_crit .= " and `mrfc_app_committee`.`committee_id` IN (".implode(',',$item_selected).") ";
		}
        
        if($type == 'detail' ){
			$sq_crit .= " and `mrfc_app_committee`.`title_seo` = ".q_si($item_selected)." ";
		}
		
		
		
		$sq_qry = "SELECT `committee_id` as `id`
                , `title`
                , `title_seo`
                , `description`
                , `published` as `visible`
                , `is_widget`
            FROM `mrfc_app_committee`
            ".$sq_crit."
	        ";		
        //echobr($sq_qry);
        
		if($type == 'select'){
			
			$rs_qry = $this->dbQuery($sq_qry . " ORDER BY  `mrfc_app_committee`.`title`");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= ''; //'<option value=""  '.$defaultSelected.'></option>';	
			
			while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$id			= $cn_qry['id'];
				$title		= $cn_qry['title'];
				$title_seo		= $cn_qry['title_seo'];
				$description	= $cn_qry['description'];
				//$code		= ($cn_qry['code'] <> '') ? $cn_qry['code'].' ' : ''; 
				$published	= $cn_qry['visible'];
				
				if($hide_option_all <> '' and $id == '33') { $published = 0; }
                
				if($published == 1){
					
					$selected	= '';
					if(is_array($item_selected)) { if(in_array($id, $item_selected)) { $selected = ' selected'; }  }
					elseif($item_selected <> "") { if($id == $item_selected) { $selected = ' selected'; } } 

					//$out .= '<option value="'.$id.'" data="'.$title.'" '.$selected.'>'.$title.''.$balance.'</option>';
					$out .= '<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
				}
			
			}

			return $out;
			
		} 
        
        elseif($type == 'widgets') {
			
			$rs_qry = $this->dbQuery($sq_qry . " ORDER BY  `mrfc_app_committee`.`title`");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= '';	
            $loop   = 1;
			
			while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc')) {
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$id			= $cn_qry['id'];
				$title		= $cn_qry['title'];
				$title_seo		= $cn_qry['title_seo'];
				$description_plain		= strip_tags_clean($cn_qry['description']);
				$description    = smartTruncateNew($description_plain, 200); 
				$published	    = $cn_qry['visible'];
				$is_widget	    = $cn_qry['is_widget'];
				
				
				if($published == 1 and $is_widget == 1) {
                    
                     //$title_link = 'sectoral-committees/?cmt='.$title_seo.'';
                     $title_link = 'index.php?fcty=&fsec='.$id.'';
                     $head_link = '<a href="'.$title_link.'" class=""><i class="fa fa-chain animated shake"></i> &nbsp;'.$title.'</a>'; 
                     $more_link = (strlen($description_plain) > 200) ? '<a href="'.$title_link.'" class="btn btn-default btn-sm ">Read More</a>' : ''; 
					
                    $cmt_stories = $this->get_commiteeStats($id, 'stories');
                    $cmt_events = $this->get_commiteeStats($id, 'events');
                    $cmt_members = $this->get_commiteeStats($id, 'members');
                    $cmt_resources = $this->get_commiteeStats($id, 'resources');
                    
                    $out .= '<div class="grid-item">
                                <div class="panel panel-default panel-home-guts panel-wrap-'.$loop.'">
                                    <div class="panel-heading clearfix txtleft bg-white">
                                       <div class="nopadd"><h3 class="grid-head">'.$head_link.'</h3></div>
                                    </div>
                                    
                                    <div class="panel-body">
                                        <div class="cardContent mymd">
                                        
                                              <div class="col-md-8 col-sm-8 col-xs-8 txtjustifyX">   
                                                <p> '.$description.'  <br>'.$more_link.'</p>

                                              </div>                               
                                              <div class="col-md-4 col-sm-4 col-xs-4 tStats">
                                                <table cellspacing="0" cellpadding="0" class="txt12">
                                                    <tr>
                                                        <td><i class="fa fa-briefcase txt12"></i></td>
                                                        <td><a href="'.$title_link.'#stories">Articles:</a></td>
                                                        <td class="txtright">'.$cmt_stories.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-calendar"></i></td>
                                                        <td><a href="'.$title_link.'#news">Events:</a></td>
                                                        <td class="txtright">'.$cmt_events.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-users"></i></td>
                                                        <td><a href="'.$title_link.'#members">Members:</a></td>
                                                        <td class="txtright">'.$cmt_members.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-book"></i></td>
                                                        <td><a href="'.$title_link.'#resources">Resources:</a></td>
                                                        <td class="txtright">'.$cmt_resources.'</td>
                                                    </tr>
                                                </table>
                                              </div> 
                                              


                                        </div>
                                    </div>
                                    
                                    <div class="panel-footer">
                                            <a href="committee-forums/">
                                                <div class="col-md-12 cardFooter">
                                                    <p>Go to forum page <i class="fa fa-chevron-right"></i></p>
                                                </div>
                                              </a>
                                     </div>         
                                </div>
                            </div>';
                    
                     $loop   += 1;
                    
                    if($loop == 10){
                         $loop  = 1;
                    }
				}
			
			}

			return $out;
			
		} 
        
        elseif($type == 'list') {
			
			return $sq_qry;
			
		} 
        
        elseif($type == 'single' or $type == 'detail') {
			
			$out = '';
			
			$rs_qry = $this->dbQueryFetch($sq_qry);	
			
			if(count($rs_qry)){
				$cn_qry 	= current($rs_qry);
				$cn_qry['title'] = $cn_qry['title'].' Sector';
				$out 		= $cn_qry; //$title.''.$balance; 
			}
			return $out;
			
		}			
        
        elseif($type == 'multi') {
			
			$out = '';
			
			$out = $this->dbQueryFetch($sq_qry);	
			
			/*if(count($rs_qry)){
				$cn_qry 	= current($rs_qry);
				$cn_qry['title'] = $cn_qry['title'].' Committee';
				$out 		= $cn_qry; //$title.''.$balance; 
			}*/
			return $out;
			
		}	
		
	}	
    
    
    
/* ============================================================================== 
/*	@COMMITTEES STATS
/* ------------------------------------------------------------------------------ */		
	function get_commiteeStats($cmt_id, $cmt_sec = 'stories')
	{
		$result = '';
        $cmt_id_arr = array(33, $cmt_id);
		
        if($cmt_sec == 'news'){
            
            $sq_qry = "SELECT count(*) as `records`
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`committee_id` = ".$cmt_id." AND `mrfc_dt_content`.`published` ='1' AND `mrfc_dt_content`.`id_section` = '2');"; 
            $rs_qry = $this->dbQueryFetch($sq_qry);	
            $result = current($rs_qry)['records'];	
        }
        
        if($cmt_sec == 'events'){
            
            
            $sq_qry = "SELECT count(*) as `records`
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`committee_id` = ".$cmt_id." AND `mrfc_dt_content`.`published` ='1' AND `mrfc_dt_content`.`id_section` = '6');";
            //echobr($sq_qry);
            $rs_qry = $this->dbQueryFetch($sq_qry);	
            $result = current($rs_qry)['records'];	
        }
        
        
        if($cmt_sec == 'stories'){
            
            $sq_qry = "SELECT count(*) as `records`
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`committee_id` = ".$cmt_id." AND `mrfc_dt_content`.`published` ='1' AND `mrfc_dt_content`.`id_section` <> '6');";
            //echobr($sq_qry);
            $rs_qry = $this->dbQueryFetch($sq_qry);	
            $result = current($rs_qry)['records'];	
        }
        
        
        if($cmt_sec == 'members'){            
            
            $sq_qry = "SELECT count(*) as `records`
                        FROM
                        `mrfc_app_committee_members`
                        INNER JOIN `mrfc_app_profiles`  ON (`mrfc_app_committee_members`.`leader_id` = `mrfc_app_profiles`.`leader_id`)
                    WHERE (`mrfc_app_committee_members`.`committee_id` = ".$cmt_id." AND `mrfc_app_profiles`.`published` ='1');";
            //echobr($sq_qry);
            $rs_qry = $this->dbQueryFetch($sq_qry);	
            $result = current($rs_qry)['records'];	
        }
        
        if($cmt_sec == 'resources'){
            
            
             $sq_qry = "SELECT count(*) as `records`
                        FROM
    `mrfc_dt_downloads_parent`
    INNER JOIN `mrfc_dt_downloads` 
        ON (`mrfc_dt_downloads_parent`.`resource_id` = `mrfc_dt_downloads`.`resource_id`)
WHERE (`mrfc_dt_downloads_parent`.`committee_id` = ".$cmt_id." AND `mrfc_dt_downloads`.`published` ='1');";
            //if($cmt_id == 4){ echobr($sq_qry); }
            $rs_qry = $this->dbQueryFetch($sq_qry);	
            $result = current($rs_qry)['records'];	
            
        }
        	
		
		return $result;
	}       
    
    
/* ============================================================================== 
/*	@COMMITTEES TABS - CONTENT 
/* ------------------------------------------------------------------------------ */		
	function get_commiteeTabContent($cmt_id, $cmt_sec = 'news', $cmt_param = '')
	{
		$result = array();
        $cmt_id_arr = array(33, $cmt_id);
		
        if($cmt_sec == 'news'){
            
            
            $sq_qry = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$cmt_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` =2)
                            OR (`mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$cmt_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` =6);";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['id_content'];
			}	
        }
        
        if($cmt_sec == 'stories'){
            
            
            $sq_qry = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$cmt_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` = 1);";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['id_content'];
			}	
        }
        
        if($cmt_sec == 'resources'){
            
            $sq_qry = "SELECT
                    `mrfc_dt_downloads_parent`.`committee_id`
                    , `mrfc_dt_downloads_parent`.`resource_id`
                FROM
                    `mrfc_dt_downloads_parent` INNER JOIN `mrfc_dt_downloads` ON (`mrfc_dt_downloads_parent`.`resource_id` = `mrfc_dt_downloads`.`resource_id`)
                WHERE  (`committee_id` IN (".implode(',',$cmt_id_arr).")  AND `mrfc_dt_downloads`.`published` =1 );";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['resource_id'];
			}	
        }
        	
		
		return $result;
	}       
	
 
    
    

/* ============================================================================== 
/*	@DAT STATS - INDICATORS
/* ------------------------------------------------------------------------------ */
	
	function build_dat_indicators ($function_id="", $unit = "")
	{
		
		$out 	 = '';
		$sq_crit = ""; //" WHERE `rems_property_leases`.`id` > 1 ";
		
		if($function_id <> "") {
			$sq_crit = " WHERE (`function_id` = ".quote_smart($function_id).") ";
		}
		
		
		$sq_mainlinks = "SELECT `indicator_id`, `indicator` FROM `mrfc_dat_indicator`
	$sq_crit
	ORDER BY `indicator`;"; 
		
		$rs_mainlinks = $this->dbQuery($sq_mainlinks);
		$rs_mainlinks_count = $this->recordCount($rs_mainlinks);
		
		if($rs_mainlinks_count>=1)
		{
			$menu_loop=1;
			while($cn_mainlinks = $this->fetchRow($rs_mainlinks))
			{				
				$id_unit 		= $cn_mainlinks['indicator_id'];
				$unit_name 		= $cn_mainlinks['indicator'];
								
				if($id_unit == $unit) { $sel = " selected ";}  else { $sel = ""; }				
				$out .=  "<option value=\"".$id_unit."\" ".$sel.">".$unit_name."</option>";						
			}
			
		}
				
		return $out;
	}
		
	
    
/* ============================================================================== 
/*	@COUNTY TAGS - CONTENT 
/* ------------------------------------------------------------------------------ */
    
	function get_countyToContent($content, $trimmer = 0)
	{
		$result = array();
		
		$sq_qry = "SELECT
    `mrfc_reg_county`.`county_id`
    , `mrfc_reg_county`.`county`
    , `mrfc_dt_content_parent`.`id_content`
FROM
    `mrfc_reg_county`
    INNER JOIN `mrfc_dt_content_parent` 
        ON (`mrfc_reg_county`.`county_id` = `mrfc_dt_content_parent`.`county_id`)
WHERE `mrfc_dt_content_parent`.`id_content` =  ".q_si($content)." ;";
		
        $rs_qry = $this->dbQuery($sq_qry);	
        
		while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	    = array_map("clean_output", $cn_qry_a);
				
				$committee_id   = $cn_qry['county_id'];
				$title		    = $cn_qry['county'];
				$title_seo		= generate_seo_title($title, '-');
                $title_label    = '';
            
                if($trimmer == 1){
                    $title_label    = ' title="'.$title.'" ';
                    $title          = smartTruncateNew($title, 25, '', 0, ''); /*, '', 0, ''*/
                }
				$comm_link		= '<a href="./?cty='.$title_seo.'" class="txtblue italicX" '.$title_label.'>'.$title.'</a>';
        				
				$result[] 	     = $comm_link;
                    /*array('cmt_link' => $comm_link            );*/
			}		
		
		return $result;
	}    
    
 
    
/* ============================================================================== 
/*	@COMMITTEE Members
/* ------------------------------------------------------------------------------ */
	
	function get_commiteeMembers($type='select', $item_selected = '', $cmt_id = '')
	{
		
		$sq_crit = " WHERE `mrfc_app_profiles`.`published` =1 ";
        
		if($type == 'single' && $item_selected <> ''){
			$sq_crit .= " and `mrfc_app_profiles`.`leader_id` = ".q_si($item_selected)." ";
		}
        
        if($type == 'members' ){
            //$cmt_id_arr = array(33, $cmt_id);
			$sq_crit .= " and `mrfc_app_committee_members`.`committee_id` = ".q_si($cmt_id)." ";
		}
		
		
		
		$sq_qry = "SELECT
            `mrfc_app_committee_members`.*
            , `mrfc_app_profiles`.*
            , `mrfc_app_profiles`.`leader_name` as `title`
            , `mrfc_app_profiles`.`leader_seo` as `title_seo`
            , `mrfc_app_profiles`.`leader_blurb` as `description`
            , `mrfc_app_profiles`.`published` as `visible`
            , `mrfc_app_profiles`.`leader_extras` as `extras`
            , `mrfc_conf_choices`.`choice_item` as `leader_role`
        FROM
            `mrfc_app_committee_members`
            INNER JOIN `mrfc_app_profiles` 
        ON (`mrfc_app_committee_members`.`leader_id` = `mrfc_app_profiles`.`leader_id`)
            LEFT JOIN `mrfc_conf_choices` 
        ON (`mrfc_app_committee_members`.`leader_role_id` = `mrfc_conf_choices`.`choice_id`)
            ".$sq_crit."
	        ";		

		if($type == 'select'){
			
			$rs_qry = $this->dbQuery($sq_qry . " ORDER BY  `mrfc_app_committee`.`title`");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= '<option value="0" ucost="" '.$defaultSelected.'></option>';	
			
			while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$id			= $cn_qry['id'];
				$title		= $cn_qry['title'];
				$title_seo		= $cn_qry['title_seo'];
				$description	= $cn_qry['description'];
				//$code		= ($cn_qry['code'] <> '') ? $cn_qry['code'].' ' : ''; 
				$published	= $cn_qry['visible'];
				
				
				if($published == 1){
					
					$selected	= '';
					if(is_array($item_selected)) { if(in_array($id, $item_selected)) { $selected = ' selected';}  }
					elseif($item_selected <> "") { if($id == $item_selected) { $selected = ' selected'; } } 

					//$out .= '<option value="'.$id.'" data="'.$title.'" '.$selected.'>'.$title.''.$balance.'</option>';
					$out .= '<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
				}
			
			}

			return $out;
			
		} 
        
        elseif($type == 'members') {
			
			$rs_qry = $this->dbQueryFetch($sq_qry . " ORDER BY `mrfc_app_committee_members`.`leader_role_id`, `mrfc_app_profiles`.`leader_name`");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= '';	
            $loop   = 1;
			
			

			return $rs_qry;
			
		} 
        
        elseif($type == 'list') {
			
			return $sq_qry;
			
		} 
        elseif($type == 'single' or $type == 'detail') {
			
			$out = '';
			
			$rs_qry = $this->dbQueryFetch($sq_qry);	
			
			if(count($rs_qry)){
				$cn_qry 	= current($rs_qry);
                
				$out 		= $cn_qry; 
			}
			return $out;
			
		}			
		
	}	  
    
    
    
    
    
    
/* ============================================================================================================================================================ 
/* ------------------------------------------------------------------------------------------------------------------------------------------------------------ */	
    
    
    
/* ============================================================================== 
/*	@COUNTIES ARRAY
/* ------------------------------------------------------------------------------ */			

    function get_countyItems($type='select', $item_selected = '', $hide_option_all = '')
	{
		
		$sq_crit = " WHERE `mrfc_reg_county`.`published` =1 ";
        
		if($type == 'single' && $item_selected <> ''){
			$sq_crit .= " and `mrfc_reg_county`.`county_id` = ".q_si($item_selected)." ";
		}
        
        if($type == 'detail' ){
			$sq_crit .= " and `mrfc_reg_county`.`county_seo` = ".q_si($item_selected)." ";
		}
		
		
		
		$sq_qry = "SELECT `county_id` as `id`
                , `county` as `title`
                , `county_seo` as `title_seo`
                , `blurb` as `description`
                , `published` as `visible`
                , `is_widget`
            FROM `mrfc_reg_county`
            ".$sq_crit."
	        ";		

		if($type == 'select'){
			
			$rs_qry = $this->dbQuery($sq_qry . " ORDER BY  `mrfc_reg_county`.`county`");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= ''; //'<option value=""  '.$defaultSelected.'></option>';	
			
			while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc'))
			{
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$id			    = $cn_qry['id'];
				$title		    = $cn_qry['title'];
				$title_seo		= $cn_qry['title_seo'];
				$description	= $cn_qry['description'];
				
				$published	    = $cn_qry['visible'];
				
				if($hide_option_all <> '' and $id == '48') { $published = 0; }
                
				if($published == 1){
					
					$selected	= '';
					if(is_array($item_selected)) { if(in_array($id, $item_selected)) { $selected = ' selected';}  }
					elseif($item_selected <> "") { if($id == $item_selected) { $selected = ' selected'; } } 

					//$out .= '<option value="'.$id.'" data="'.$title.'" '.$selected.'>'.$title.''.$balance.'</option>';
					$out .= '<option value="'.$id.'" '.$selected.'>'.$title.'</option>';
				}
			
			}

			return $out;
			
		} 
        
        elseif($type == 'widgets') {
			
			$rs_qry = $this->dbQuery($sq_qry . " ORDER BY  `mrfc_reg_county`.`county` ");	
			
			$defaultSelected = ($item_selected == '0' or $item_selected == '') ? ' selected ' : '';	//
				
			$out 	= '';	
            $loop   = 1;
			
			while($cn_qry_a = $this->fetchRow($rs_qry, 'assoc')) {
				$cn_qry  	= array_map("clean_output", $cn_qry_a);
				
				$id			= $cn_qry['id'];
				$title		= $cn_qry['title'];
				$title_seo		= $cn_qry['title_seo'];
				$description_plain		= strip_tags_clean($cn_qry['description']);
				$description    = smartTruncateNew($description_plain, 200); 
				$published	    = $cn_qry['visible'];
				$is_widget	    = $cn_qry['is_widget'];
				
				
				if($published == 1 and $is_widget == 1) {
                    
                     $title_link = 'counties/?cty='.$title_seo.'';
                     $head_link = '<a href="'.$title_link.'" class=""><i class="fa fa-chain animated shake"></i> &nbsp;'.$title.'</a>'; 
                     $more_link = (strlen($description_plain) > 200) ? '<a href="'.$title_link.'" class="btn btn-default btn-sm ">Read More</a>' : ''; 
					
                    $cmt_stories = $this->get_commiteeStats($id, 'stories');
                    $cmt_events = $this->get_commiteeStats($id, 'events');
                    $cmt_members = $this->get_commiteeStats($id, 'members');
                    $cmt_resources = $this->get_commiteeStats($id, 'resources');
                    
                    $out .= '<div class="grid-item">
                                <div class="panel panel-default panel-home-guts panel-wrap-'.$loop.'">
                                    <div class="panel-heading clearfix txtleft bg-white">
                                       <div class="nopadd"><h3 class="grid-head">'.$head_link.'</h3></div>
                                    </div>
                                    
                                    <div class="panel-body">
                                        <div class="cardContent mymd">
                                        
                                              <div class="col-md-8 col-sm-8 col-xs-8 txtjustifyX">   
                                                <p> '.$description.'  <br>'.$more_link.'</p>

                                              </div>                               
                                              <div class="col-md-4 col-sm-4 col-xs-4 tStats">
                                                <table cellspacing="0" cellpadding="0" class="txt12">
                                                    <tr>
                                                        <td><i class="fa fa-briefcase txt12"></i></td>
                                                        <td><a href="'.$title_link.'#stories">Articles:</a></td>
                                                        <td class="txtright">'.$cmt_stories.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-calendar"></i></td>
                                                        <td><a href="'.$title_link.'#news">Events:</a></td>
                                                        <td class="txtright">'.$cmt_events.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-users"></i></td>
                                                        <td><a href="'.$title_link.'#members">Members:</a></td>
                                                        <td class="txtright">'.$cmt_members.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td><i class="fa fa-book"></i></td>
                                                        <td><a href="'.$title_link.'#resources">Resources:</a></td>
                                                        <td class="txtright">'.$cmt_resources.'</td>
                                                    </tr>
                                                </table>
                                              </div> 
                                              


                                        </div>
                                    </div>
                                    
                                    <div class="panel-footer">
                                            <a href="committee-forums/">
                                                <div class="col-md-12 cardFooter">
                                                    <p>Go to forum page <i class="fa fa-chevron-right"></i></p>
                                                </div>
                                              </a>
                                     </div>         
                                </div>
                            </div>';
                    
                     $loop   += 1;
                    
                    if($loop == 10){
                         $loop  = 1;
                    }
				}
			
			}

			return $out;
			
		} 
        
        elseif($type == 'list') {
			
			return $sq_qry;
			
		} 
        
        elseif($type == 'single' or $type == 'detail') {
			
			$out = '';
			
			$rs_qry = $this->dbQueryFetch($sq_qry);	
			
			if(count($rs_qry)){
				$cn_qry 	= current($rs_qry);
				$cn_qry['title'] = $cn_qry['title']. (($cn_qry['id'] <> 48) ? ' County' : '');
				$out 		= $cn_qry; //$title.''.$balance; 
			}
			return $out;
			
		}			
		
	}	
    
    
/* ============================================================================== 
/*	@COMMITTEES TABS - CONTENT 
/* ------------------------------------------------------------------------------ */		
	function get_countyTabContent($cty_id = '', $sec_id = '', $cty_sec = 'news')
	{
		$result         = array();
        $cty_id_arr     = array();
        $sec_id_arr     = array();
        //$cont_sector_id_arr = explode(',', $cont_sector_id);
        //if($cty_id == '') { $cty_id_arr[] = 48; }
        if($cty_id <> '') { $cty_id_arr[] = $cty_id; }
        if($sec_id <> '') { $sec_id_arr[] = explode(',', $sec_id); }
		/*displayArray($sec_id_arr);*/
        
        /*echobr($cty_id);
        echobr($sec_id);*/
        
        if($cty_sec == 'news'){            
            
            $sq_qry = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`county_id` IN (".implode(',',$cty_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` =2)
                            OR (`mrfc_dt_content_parent`.`county_id` IN (".implode(',',$cty_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` =6);";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['id_content'];
			}	
        }
        
        if($cty_sec == 'stories'){
            
            
            $sq_qry = "SELECT `mrfc_dt_content_parent`.`id_content` 
                        FROM
                            `mrfc_dt_content_parent`
                            INNER JOIN `mrfc_dt_content` 
                                ON (`mrfc_dt_content_parent`.`id_content` = `mrfc_dt_content`.`id`)
                        WHERE (`mrfc_dt_content_parent`.`county_id` IN (".implode(',',$cty_id_arr).") AND `mrfc_dt_content`.`published` =1 AND `mrfc_dt_content`.`id_section` = 1);";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['id_content'];
			}	
        }
        
        if($cty_sec == 'resources'){
            
           
            
            $dispData=new data_arrays;
            $dispData->siteDocuments();
            //displayArray(master::$listResources);
            //echobr($sec_id);
            if($cty_id <> '') {
                 $keydd = recursive_array_search($cty_id, master::$listResources['fcounty_id']); 
                 $result = $keydd;
            }
            $keygg = array();
             
        
            if($sec_id <> '') {      
                
                foreach($sec_id_arr[0] as $sid => $sec_val){ 
                   $keyff = recursive_array_search($sec_val, master::$listResources['fsector_id']); 
                    
                    foreach($keyff as $keyff_v){
                        //array_push($keygg[$keyff_v], $keyff_v); 
                        $keygg[$keyff_v] = $keyff_v;
                    }
                }
                
                $result = $keygg;
            }
            if($cty_id <> '' and $sec_id <> '') {
                 $result = array_intersect_key($keydd, $keygg );
            }
            /*echobr('$keydd');
            displayArray($keydd);
            echobr('$keygg');
            displayArray($keygg);
            displayArray($result);*/
            
           // exit;
            
            /*$sq_crit     = array();
            $sq_crit_full = " WHERE `mrfc_dt_downloads`.`published` =1 ";
            $sq_crit_sec = "";
            
            if($cty_id <> '' and $sec_id == '') {
                 $keydd = recursive_array_search('7', master::$listResources['fcounty_id']); 
                 $sq_crit[] = " `mrfc_dt_downloads_parent`.`county_id` IN (".implode(',',$cty_id_arr).")  AND  `mrfc_dt_downloads`.`published` =1 ";
            }
            if($cty_id == '' and $sec_id <> '') {
                 $sq_crit[] = " `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$sec_id_arr[0]).") AND `mrfc_dt_downloads`.`published` =1  ";
            }
            if($cty_id <> '' and $sec_id <> '') {
                 $sq_crit[] = " `mrfc_dt_downloads_parent`.`county_id` IN (".implode(',',$cty_id_arr).")  AND  `mrfc_dt_downloads`.`published` =1  and `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$sec_id_arr[0]).") AND `mrfc_dt_downloads`.`published` =1  ";
            }
            if(count($sq_crit)){
                $sq_crit_full = " WHERE ".implode(' OR ',$sq_crit)." ";
            }
            
            $sq_qry = "SELECT
                    `mrfc_dt_downloads_parent`.`county_id`
                    , `mrfc_dt_downloads_parent`.`resource_id`
                FROM
                    `mrfc_dt_downloads_parent` INNER JOIN `mrfc_dt_downloads` ON (`mrfc_dt_downloads_parent`.`resource_id` = `mrfc_dt_downloads`.`resource_id`)
                ".$sq_crit_full." ;";
            //echobr($sq_qry);
            $rs_qry = $this->dbQuery($sq_qry);	
            while($cn_qry = $this->fetchRow($rs_qry, 'assoc'))
			{
				$result[] 	     = $cn_qry['resource_id'];
			}	*/
        }
        	
		
		return $result;
	}  
    
    
    
    
    
    
	function get_resCountiesXXX($county = '')
	{
		$result = array();
		
		$sq_qry = "SELECT
    `mrfc_conf_county`.`county_id`
    , `mrfc_conf_county`.`county`
    , `mrfc_conf_county`.`county_seo`
    , COUNT(`mrfc_dt_downloads_parent`.`resource_id`) AS `num_resources`
FROM
    `mrfc_conf_county`
    LEFT JOIN `mrfc_dt_downloads_parent` 
        ON (`mrfc_conf_county`.`county_id` = `mrfc_dt_downloads_parent`.`county_id`)
GROUP BY `mrfc_conf_county`.`county_id`
ORDER BY `mrfc_conf_county`.`county` ASC;";
		
		$result = $this->dbQueryFetch($sq_qry);		
		
		return $result;
	}
	
    
    
    
    
	
/* ============================================================================== 
/*	@DOWNLOAD TYPES ARRAY
/* ------------------------------------------------------------------------------ */		
	function get_resTypes($res_type = '')
	{
		$result = array();
		
		/*$sq_qry = "SELECT
    `mrfc_dt_downloads_type`.`download_type`
    , `mrfc_dt_downloads_type`.`res_type_seo`
    , COUNT(`mrfc_dt_downloads_parent`.`resource_id`) AS `num_resources`
FROM
    `mrfc_dt_downloads_type`
    LEFT JOIN `mrfc_dt_downloads_parent` 
        ON (`mrfc_dt_downloads_type`.`res_type_id` = `mrfc_dt_downloads_parent`.`res_type_id`)
GROUP BY `mrfc_dt_downloads_type`.`res_type_id` order by `mrfc_dt_downloads_type`.`download_type` ASC;";*/
		
		$sq_qry = "select mrfc_dt_downloads_type.download_type, count(mrfc_dt_downloads_type.download_type) as `num_resources` , `mrfc_dt_downloads_type`.`res_type_seo`, ROUND( (count(mrfc_dt_downloads_type.download_type)* 100 / (select count(*) from `mrfc_dt_downloads_parent`) ), 2) as `perc_resources` from `mrfc_dt_downloads_parent` INNER JOIN mrfc_dt_downloads_type ON mrfc_dt_downloads_parent.res_type_id = mrfc_dt_downloads_type.res_type_id GROUP BY mrfc_dt_downloads_type.download_type";
		
		
		$result = $this->dbQueryFetch($sq_qry);		
		
		return $result;
	}
	
	

/* ============================================================================== 
/*	@Member Details
/* ------------------------------------------------------------------------------ */
	
	function get_userProfile($acc_id, $org_id = '')
	{
		$result = array();		
		/* and `organization_id` = ".q_si($org_id).") */
		$sq_dta = "SELECT * FROM `mrfc_reg_account` WHERE `account_id` = ".q_si($acc_id)."; ";
		$result = current($this->dbQueryFetch($sq_dta));
		
		return $result;
	}
	
	
	
	
/* ============================================================================== 
/*	@GET COLUMN NAMES
/* ------------------------------------------------------------------------------ */	
	
	function get_boostColumns($table)
	{
		$result = array();
		
		$sq_qry = "SELECT * FROM ".$table." limit 0, 1";
		$rs_qry = $this->dbQuery($sq_qry);		
		
		$comms = '';
		while ($fieldinfo= mysqli_fetch_field($rs_qry))
		{
			$result[] = $fieldinfo->name; 
		}

		return $result;
	}
	
	
	

/*
* END CLASS
*/	
}


$dispDt = new data_maarifa;


?>