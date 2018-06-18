<?php

class dbAccounts extends master
{
	
	/* ****************************************
	 @Automation  - GET /ADD USER ACCOUNT
	****************************************** */ 
	
	function getAddUserAccount($account_email, $account_arr=array(), $mailing = 0) 
	{
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		$auth_id	= '';
		$auth_code  = strtoupper(uniqid(time()));	
			
		if($account_email <> '')
		{
			//`".$pdb_prefix."reg_users`
			$sq_check = "SELECT `account_id`, `email` FROM `".$pdb_prefix."reg_account` WHERE (`email` = ".quote_smart($account_email).")";
			$rs_check = $this->dbQuery($sq_check);
		
			if($this->recordCount($rs_check)>=1)
			{ 
				$cn_check = $this->fetchRow($rs_check);
				$auth_id  = $cn_check[0];		
				
				if($mailing == 1) { $GLOBALS['EXISTS_MAILING_ACCOUNT'] = true; }
			}
			else
			{	
			
			
			/* ----------------------------------------- */	
				$field_title = "";
				$field_value = "";
			
				if(is_array($account_arr))
				{
					foreach($account_arr as $col=>$value)
					{	
						$field_title .= " `$col`, ";
						$field_value .= " ".quote_smart($value).", ";
					}
				}
			/* ----------------------------------------- */
			
			
				$sqpost = "insert ignore into `".$pdb_prefix."reg_account` ($field_title `email`, `ipaddress`, `published`) values 
				($field_value ".quote_smart($account_email).", ".quote_smart($_SERVER['REMOTE_ADDR']).", '0' ) ";				
				//echo $sqpost ; exit;
				$result = $this->dbQuery($sqpost);
				$auth_id = $this->insertId();				
			}
		
		}
		return $auth_id;	
	}
	
	
	
	
	/* ****************************************
	 @Automation  - GET /ADD ACCOUNT PARTNERS
	****************************************** */ 
	function getAddOrganization($org_name, $org_arr = array()) 
	{
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		//$country_id  	   = $partner_arr['country_id'];
		$org_id	= '';
			
		if($org_name <> '')
		{
			$org_seo 	= $org_arr['organization_seo']; //generate_seo_title($org_name, '-');	
			$sq_check 	= "SELECT `organization_id` FROM `".$pdb_prefix."reg_organizations` WHERE `organization_seo`=".q_si($org_seo).";";
			$rs_check 	= $this->dbQuery($sq_check); 
		
			if($this->recordCount($rs_check)>=1)
			{   $cn_check 	= $this->fetchRow($rs_check);
				$org_id 	= $cn_check['organization_id'];		
			} 
			else 
			{	
				/* ----------------------------------------- */	
				$field_title = ""; $field_value = "";			
				if(is_array($org_arr))
				{   foreach($org_arr as $col=>$value)
					{   $field_title .= " `$col`, ";
						$field_value .= " ".q_si($value).", ";
					}
				}
				/* ----------------------------------------- */	
				
				$is_partner = 0;
				$sqpost = "insert into `".$pdb_prefix."reg_organizations` ($field_title `is_partner`) values 
				($field_value ".quote_smart($is_partner)." ) ";	//echobr($sqpost);			
				$result = $this->dbQuery($sqpost);	
				$org_id = $this->insertId();					
			}
		}
		
		return $org_id;	
	}
	
	
	
	function getAddUserOrganization($ac_domain, $contact_id) 
	{
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		$org_seo 	 = generate_seo_title($ac_domain, '-');	
		
		$ac_org_id	= '';
			
		if($ac_domain <> '')
		{
		$sq_check = "SELECT `organization_id` FROM `".$pdb_prefix."reg_organizations` WHERE `organization`=".q_si($ac_domain)." limit 1;";
		$rs_check = $this->dbQuery($sq_check);
		
			if($this->recordCount($rs_check) == 1 )
			{ 
				$cn_check = $this->fetchRow($rs_check);
				$ac_org_id = $cn_check['organization_id'];		
			}
			else
			{	
				$sqpost = "insert into `".$pdb_prefix."reg_organizations` (`organization`, `organization_seo`, `contact_id`) values 
				(".q_si($ac_domain)." , ".q_si($org_seo).", ".q_si($contact_id).") ";
			
				$result = $this->dbQuery($sqpost);
				$ac_org_id = $this->insertId();				
			}
		
		}
		return $ac_org_id;	
	}
	
	
	
	
	/* ****************************************
	 @Automation  - GET /ADD USER CATEGORY
	****************************************** */ 
	
	function getAddUserCat($account_cat) {
		
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		
		$ac_cat_id	= '';
			
		if($account_cat <> '')
		{
			$ac_cat_clean = generate_seo_title($account_cat);
			$sq_check = "SELECT `id_category` FROM `".$pdb_prefix."reg_cats` WHERE `title` = ".quote_smart($account_cat)."; ";
			$rs_check = $this->dbQuery($sq_check);
		
			if($this->recordCount($rs_check)>=1)
			{ 
				$cn_check = $this->fetchRow($rs_check);
				$ac_cat_id = $cn_check[0];		
			}
			else
			{	
				$sqpost = "insert into `".$pdb_prefix."reg_cats` (`title`, `title_url`) values 
				(".quote_smart($account_cat)." ,
				".quote_smart($ac_cat_clean).") ";
			
				$result = $this->dbQuery($sqpost);
				$ac_cat_id = $this->insertId();				
			}
		
		}
		return $ac_cat_id;	
	}
	
	
	
	/* ****************************************
	 @Automation  - ADD USER TO CATEGORY
	****************************************** */ 
	
	function addUserToCategory($cat_id, $account_id, $pref_arr = array()) {
		
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		
		/* ----------------------------------------- */	
			$pref_title = ""; $pref_value = "";
			if(is_array($pref_arr)) {
				foreach($pref_arr as $col=>$value) 
				{ $pref_title .= " `$col`, "; $pref_value .= " ".quote_smart($value).", "; }
			}
		/* ----------------------------------------- */
		
		if($cat_id <> '' and $account_id <> '')
		{
			$sqpost = "replace into `".$pdb_prefix."reg_cats_links` ($pref_title `id_category`, `account_id`) values 
			($pref_value ".quote_smart($cat_id)." , ".quote_smart($account_id).") ";	//echo $sqpost ; exit;	
			$result = $this->dbQuery($sqpost);		
		}	
	}
	
	
	
	
	function selectUserCat($multi = "y", $crit = "") { 
		
		$pdb_prefix = $GLOBALS['SYS_CONF']['DB_PREFIX'];
		
		$out = '';	
		$qry_links ="SELECT `id_category`, `title`, `published` FROM `".$pdb_prefix."reg_cats` WHERE  `published` =1 ORDER BY   `title` ASC ";
		
		$i = 0;
		$con_links2=$this->dbQuery($qry_links);
			
			while($res_links2 = $this->fetchRow($con_links2))
			{
				$st='';
				$link_id2	   = $res_links2['id_category'];
				$link_name2	 = html_entity_decode(stripslashes($res_links2['title']));				
				
				$selected = "";
				if(is_array($crit)){
					if(in_array($link_id2, $crit)) { $selected = " selected checked ";} 						
				}
				elseif($crit <> "") { 
					if($link_id2 == $crit) { $selected = " selected checked "; }
				} 
				
				if($multi == "y") 
				{
				$out .= '<label><input type="checkbox" name="user_cat[]" id="user_cat_'.$link_id2.'" '.$selected.' value="'.$link_id2.'" />&nbsp; '.$link_name2.' </label>';
				}
				else
				{
				$out .= '<option value="'.$link_id2.'" '.$selected.'>'.$link_name2.'</option>';
				}
				
			}
			
		return $out;
	}
	
}


$dbAcc = new dbAccounts;


?>