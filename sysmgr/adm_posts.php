<?php
include('../classes/cls.constants.php');
include('../classes/cls.functions_misc.php');
require("includes/gal_functions.php");
require("includes/adm_functions.php");


	
if (isset($_REQUEST['signout'])){$signout=$_REQUEST['signout'];} else {$signout='';}
if(isset($_GET['signout']) and ($_GET['signout'] == "on")) 
	{
		unset($_SESSION['sess_mrfc_admin']);
		unset($sys_us_admin);
        $_SESSION['sess_mrfc_admin'] = '';
        $sys_us_admin = array();
		
		?> <script language='javascript'> location.href="index.php?tk=<?php echo time(); ?>"; </script> <?php exit;
	}
	


if($_SERVER['REQUEST_METHOD'] !== 'POST') { 
echo "<script language='javascript'>location.href=\"index.php?qst=401&token=".time()."\"; </script>"; exit; }



function getSalt()
{
	return substr(md5(uniqid(rand(), true)), 0, 6);
}	

echo '<div style="text-align:center; padding-top:50px;"><img src="../assets/image/icons/ajax_loader.gif" /></div>'."\r\n \r\n";


		
	//echo $_POST['published'];
	if(isset($_POST['id'])) {$id=$_POST['id']; } else { $id=NULL; }
	if(isset($_POST['formname'])) {$formname=$_POST['formname']; } else {$formname='';}
	if(isset($_POST['formact'])) {$formact=$_POST['formact']; } else {$formact='';}
	if(isset($_POST['formaction'])) {$formaction=$_POST['formaction']; } else {$formaction='';}
	if (isset($_POST['redirect'])){$redirect=$_POST['redirect'];}  else {$redirect='index.php';}
	if (isset($_POST['published']))	{$published=$_POST['published'];}  else {$published='off';}
	if (isset($_POST['approved']))	{$approved=$_POST['approved'];}  else {$approved='off';}
	
	if (isset($_POST['frontpage']))	{$frontpage=$_POST['frontpage'];}  else {$frontpage='off';}
	if (isset($_POST['featured']))	{$featured=$_POST['featured'];}  else {$featured='off';}
	if (isset($_POST['closed']))	{$closed=$_POST['closed'];} else {$closed= 'off';}
	if (isset($_POST['sidebar']))	{$sidebar=$_POST['sidebar'];}  else {$sidebar= 'off';}
	if (isset($_POST['yn_gallery']))	{$yn_gallery=$_POST['yn_gallery'];}  else {$yn_gallery= 'off';}
	if(isset($_POST['yn_static'])) {$yn_static=$_POST['yn_static']; } else {$yn_static= 'off';}
	if(isset($_POST['yn_quicklink'])) {$yn_quicklink=$_POST['yn_quicklink']; } else {$yn_quicklink= 'off';}
	
	if(isset($_POST['intro_home'])) {$intro_home=$_POST['intro_home']; } else {$intro_home= 'off';}
	if(isset($_POST['gallery'])) {$gallery=$_POST['gallery']; } else {$gallery= 'off';}
	if(isset($_POST['newsletter'])) {$newsletter=$_POST['newsletter']; } else {$newsletter= 'off';}
	if(isset($_POST['confirm'])) {$confirm=$_POST['confirm']; } else {$confirm= 'off';}
	if(isset($_POST['position'])) {$position=intval($_POST['position']); } else { $position="9"; }
	if(isset($_POST['seq'])) {$seq=intval($_POST['seq']); } else { $seq=9; }
	if(isset($_POST['image_show'])) {$image_show=$_POST['image_show']; } else {$image_show= 'off';}
	
	if($newsletter=='on') { $newsletter=1;	} else { $newsletter=0; }
	if($confirm=='on') { $confirm=1;	} else { $confirm=0; }
	if($gallery=='on') { $gallery=1;	} else { $gallery=0; }
	if($closed=='on') { $closed=1;	} else { $closed=0; }
	if($sidebar=='on') { $sidebar=1;	} else { $sidebar=0; }
	if($published=='on') { $published=1;	} else { $published=0; }
	if($approved=='on') { $approved=1;	} else { $approved=0; }
	if($frontpage=='on') { $frontpage=1;	} else { $frontpage=0; }
	if($featured=='on') { $featured=1;	} else { $featured=0; }
	if($yn_gallery=='on') { $yn_gallery=1;	} else { $yn_gallery=0; }
	if($yn_static=='on') { $yn_static=1;	} else { $yn_static=0; }
	if($yn_quicklink=='on') { $yn_quicklink=1;	} else { $yn_quicklink=0; }
	
	if($image_show=='on') { $image_show=1;	} else { $image_show=0; }
	
	if($intro_home=='on') { $intro_home=1;	} else { $intro_home=0; }

	if (!isset($sys_us_admin['adminname']) and $formname<>"admin_log") 
	{ 
	?> <script language="javascript">location.href="index.php";</script> <?php
	}
	
	$userid = '';
	if(isset($sys_us_admin['admin_id'])){
	$userid = $sys_us_admin['admin_id'];
	}






$post		= array_map("filter_data",$_POST);
$postb		= array_map("quote_smart", $post);
$field_names = array_keys($post);


$formLog    = new hitsLog;
$sq_files   = array();

$fields_ignore = array("formname","formaction","formtab","id","redirect","saveform","publishval","post_by","date_post","submit","resource_attr", "change_image", "petitioner_id", "representative_id", "pr_code", "status_old");


$new_contact = yesNoPost(@$post['new_contact']); 

//displayArray($_FILES); 
//displayArray($post); 
//exit;



/* ============================================================================== 
/*	COMMITTEE - MEMBERS
/* ------------------------------------------------------------------------------ */


if($formname=="frm_committee_member")
{		
	$committee_id 		= $post['committee_id'];
	$id_date_record 	= $post['date_record_id'];
	
	if(is_array($post['leader_id']) and count($post['leader_id']) > 0)
	{	
	
		/*$sqdatesclean = "delete from `".$pdb_prefix."dt_content_dates` where id_content = ".q_si($id_content)."; ";
		$cndb->dbQuery($sqdatesclean);*/
		
		$seq_members     = array();		
		$leader_arr 	 = $post['leader_id'];
		
		foreach($leader_arr as $k => $leader_id) 
		{  
		    $leader_role_id   = $post['leader_role_id'][$k];
		    $status_id        = yesNoPost(@$post['status_id'][$k]); //(isset($post['status_id'])) ? yesNoPost($post['status_id'][$k]) : '0'
		    $date_start       = $post['date_start'][$k];
            $date_start        = date("Y-m-d", strtotime($date_start)); 
            
			if($leader_id <> '') 
			{ 
				if($formact=="_add")
				{	
					$seq_members[]  = " insert IGNORE into `".$pdb_prefix."app_committee_members` (`committee_id`, `leader_id`, `leader_role_id`) values (".q_si($committee_id).", ".q_si($leader_id).", ".q_si($leader_role_id)."); ";
				} 
				elseif($formact=="_edit")
				{
					$seq_members[]  = " UPDATE `".$pdb_prefix."app_committee_members` SET `date_start` = ".q_si($date_start).", `leader_id` = ".q_si($leader_id).", `leader_role_id` = ".q_si($leader_role_id).", `status_id` = ".q_si($status_id)." WHERE `record_id` = ".q_si($post['record_id'])."; ";
				}
			  
			} 
	
		} 
		
		if(count($seq_members)>0) { $cndb->dbQueryMulti($seq_members); }
		
	}
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk=<?php echo rand(); ?>"; </script><?php exit;	
	
}




/* ============================================================================== 
/*	DYNAMIC FORMS
/* ------------------------------------------------------------------------------ */



if ($formname=="fm_vds" ) 
{
	$tabDir 		= $post['formtab'];
	$formtable 	    = $adTabProps[$tabDir]['tbn'];
	$formpkey 	    = $adTabProps[$tabDir]['tbk'];
	
    if($tabDir == 'committee'){ 
        $title_seo 	        = generate_seo_title($post['title'], '-');
        $post['title_seo']  = $title_seo; 
    }
    
	
	if(!isset($_POST['published']) and isset($_POST['publishval'])) {
		$pub = array("published" => "off");
		$post = array_merge_recursive($post, $pub );	
	}/**/
	
	$field_names = array_keys($post); 
	$mySql  = "";	
	$myCols = array();
	$myDats = array();
	
	
	
	$fields_ignore = array("formname","formaction","formtab","id","redirect","submit","publishval");
	
	foreach($field_names as $field)
	{
		$field = strtolower($field);
		
		if(!in_array($field, $fields_ignore))
		{
			$fieldNam	= $field;
			$fieldVal	= $post[''.$field.''];
			
			if( $field == "published") { 
				$fieldVal = yesNoPost($post[''.$field.'']); 
			} 
			
			if ($formaction == "_edit" ) { 
				$myCols[] = " `$fieldNam` = ".quote_smart($fieldVal).""; 
			}		
				
			elseif ($formaction == "_new" ) {
				$myCols[] = "`$fieldNam`";	
				$myDats[] = "".quote_smart($fieldVal)."";
			}
			
		}
	}
	
	if ($formaction == "_edit" ) {	
		$sqpost = "UPDATE `$formtable` set  ".implode($myCols, ', ')." where (`$formpkey` = ".quote_smart($post['id'])." )" ;		
	}
	
	if ($formaction == "_new" ) {	
		$sqpost = "insert into `$formtable` (".implode($myCols, ', ').") values (".implode($myDats, ', ')."); ";		
	}
	
	//echobr($sqpost); exit;
	
	$rspost = $cndb->dbQuery($sqpost);
	
	if 		( $formaction=="_new")  { $post_id = $cndb->insertId();  }
	elseif 	( $formaction=="_edit") { $post_id = $post['id']; }
	
		
	//exit;	
	?> <script language='javascript'>location.href="<?php echo $redirect; ?>&tk=<?php echo rand(); ?>"; </script> <?php exit;
}


/* ============================================================================== 
/*	RESOURCES
/* ------------------------------------------------------------------------------ */

if($formname=="fm_resources")
{
	
	$file_seo 	 = generate_seo_title($post['resource_title'], '-');	
	
	
	if($post['resource_key'] == ''){ $post['resource_key'] = hash("ripemd128", $file_seo); }
	//if($post['status'] == 'live' and $post['status_old'] <> $post['status']){ $post['admin_approve'] = $sys_us_admin['admin_id']; }
	//if($post['status'] == 'live'){ $post['published'] = 1; } else { $post['published'] = 0; }
    
    if(is_array($post['related_tag']))
    {
         $post['id_parent'] = array_merge($post['id_parent'], $post['related_tag']);
    }
	
	$fields_ignore[] = 'county';
	$fields_ignore[] = 'content_type';
	$fields_ignore[] = 'id_parent';
	$fields_ignore[] = 'id_content';
	$fields_ignore[] = 'related_tag';
	$fields_ignore[] = 'related_committee';
	
	$col_names = array(); $col_values = array();
		
	foreach($post as $b_key => $b_val)  {
		$field = strtolower($b_key);		
		if(!in_array($field, $fields_ignore)) {
			if($formaction=="_new") 
			{
				$col_names[] = "`$field`";	
				$col_values[] = "".q_si($b_val)."";
			} 
			elseif($formaction=="_edit") 
			{
				$col_names[] = " `$field` = ".q_si($b_val).""; 
			}
		}			
	}
		
	if($formaction=="_new")  
	{ 
		$sq_post = "INSERT IGNORE INTO `".$pdb_prefix."dt_downloads` (".implode($col_names, ', ').") values (".implode($col_values, ', ')."); "; 
		$log_detail = 'Name: '.$post['resource_title'].' [Status: '.yesNoText($post['published']).']';
	} 
	elseif($formaction=="_edit") 
	{ 
		$post_id = $post['id'];
		$sq_post = "UPDATE `".$pdb_prefix."dt_downloads` set  ".implode($col_names, ', ')." where (`resource_id` = ".q_si($post_id)." )" ;
		$log_detail = 'Name: '.$post['resource_title'].' [Status: '.yesNoText($post['published']).']';
	}
	
	//echobr($sq_post); exit;		
	$rs_post = $cndb->dbQuery($sq_post);
	
	if($formaction=="_new") { 
		$post_id = $cndb->insertId($rs_post);  
	} 

	
/* ************************************************************** 
@ update download-to-parent 
****************************************************************/

   
    /* ===  @@ RESOURCE-TO-PARENT CLEAN-UP === */
    $sq_parent_clean = " delete from `mrfc_dt_downloads_parent` where `resource_id` = ".q_si($post_id)."; "; //echobr($sq_parent_clean);
    $rs_parent_clean = $cndb->dbQuery($sq_parent_clean); 
    //exit;
    /* ===  @@ RESOURCE-TO-MENU === */
	if(array_key_exists('id_parent', $post) and is_array($post['id_parent'])) {
         $ddSelect->populateResourceParent($post_id, $post['id_parent'], 'id_menu');
    }
	
    /* ===  @@ RESOURCE-TO-CONTENT === */    
    if(array_key_exists('id_content', $post) and is_array($post['id_content'])) {
         $ddSelect->populateResourceParent($post_id, $post['id_content'], 'id_content');
    }    
    
    /* ===  @@ RESOURCE-TO-COUNTY === */    
    if(array_key_exists('county', $post) and is_array($post['county'])) {
         $ddSelect->populateResourceParent($post_id, $post['county'], 'county_id');
    }    
    
    /* ===  @@ RESOURCE-TO-COMMITTEE === */    
    if(array_key_exists('related_committee', $post) and is_array($post['related_committee'])) {
         $ddSelect->populateResourceParent($post_id, $post['related_committee'], 'committee_id');
    }
	
	//exit;

/* ************************************************************** 
@ upload process
****************************************************************/	
	
	if(isset($_FILES['fupload']) and strlen($_FILES['fupload']['name']) > 4) 
	{
		$file_key 	 = hash("crc32", $post_id);
		$res_upload   = $_FILES['fupload'];	
		$dfile 		  = $res_upload['name'];
		$doc_ext      = ".".strtolower(substr(strrchr($dfile,"."),1));
		
		$doc_newname  = substr($file_key.'-'.$file_seo,0,45).$doc_ext;
		$doc_temp     = $res_upload['tmp_name'];		
		$doc_target   = UPL_FILES . $doc_newname;
		//echobr($doc_target); exit;
		$ures = array();
		if(move_uploaded_file($doc_temp, $doc_target)) { 
			$ures['file'] = $doc_newname; 
			$ures['mime'] = $res_upload['type'];
			$ures['size'] = $res_upload['size'];
					
		
			$sq_file = "UPDATE `".$pdb_prefix."dt_downloads` set  `resource_file` = ".q_si($ures['file']).", `resource_mime` = ".q_si($ures['mime']).", `resource_size` = ".q_si($ures['size'])." where (`resource_id` = ".q_si($post_id)." )" ;
			//echobr($sq_file); //exit;		
			$rs_file = $cndb->dbQuery($sq_file);
		}
		
	}
    
    
    /* ************************************************************** 
	@ update image
	****************************************************************/
    
	if(isset($_FILES['resource_image']) and strlen($_FILES['resource_image']['name']) > 4) 
	{
		//$post_id		  = $id_download;
		$post_title   	  = $post['resource_title'];
		
		$filename_cat	  = 5;
		$filename_prefix  = 'rs'.str_pad($post_id, 4, "0", STR_PAD_LEFT).'-';
		$filename_new  	  = $filename_prefix.substr(clean_alphanum($post_title),0,30);
		
			//echobr(UPL_COVERS);
		$the_image 	      = imageUpload($_FILES['resource_image'], $filename_new, UPL_COVERS, 0 );	
		$result 	      = $the_image['result'];
		$the_file 	      = $the_image['thumb'];
		
		
		
		if($the_image['result'] == 1)
		{
			/*$sq_upload = "insert into `".$pdb_prefix."dt_gallery_photos`  "
			."( `title`, `filename`,  `id_gallery_cat`, `date_posted`)   values "
			."(".quote_smart($post_title).", '".$the_image['name']."', 5, CURRENT_TIMESTAMP())";
			$cndb->dbQuery($sq_upload);
			$id_photo = $cndb->insertId();
			
			$sq_upload_parent = " REPLACE into `".$pdb_prefix."dt_gallery_photos_parent` " 
			."(`id_photo`,`id_resource`,`rec_stamp`) values "
			."(".quote_smart($id_photo).", ".quote_smart($post_id).", '".time()."')  ";		
			$cndb->dbQuery($sq_upload_parent);*/
			
			$sq_upload = "update `".$pdb_prefix."dt_downloads` set `resource_image`='".$the_image['name']."' where " 
			." `resource_id` =  ".quote_smart($post_id)."; ";	
            //echobr($sq_upload); //exit;
			$cndb->dbQuery($sq_upload);/**/
	
		}	
	}
    
    if(isset($_FILES['resource_imageX']) and strlen($_FILES['resource_imageX']['name']) > 4) 
	{
		
		$file_id 		=  str_pad($post_id, 4, "0", STR_PAD_LEFT); 
		$newTitle 	    = $file_id.'_'.uniqid();
		$result         = 0;
		
		
		$the_file       = basename($_FILES['resource_image']['name']);
		
		if(trim($_FILES['resource_image']['name']) <> '') 
		{
			$prefix 		= str_pad($id_content, 4, "0", STR_PAD_LEFT);
			$myfilename 	= trim($_FILES['resource_image']['name']);
			
			$checksum1      = getChecksum($prefix);	
			$checksum2      = getChecksum($the_file);
			$pos 		    = strrpos($myfilename,"."); 
            
			if ($pos === false) { $pos = strlen($myfilename); }  
			
			
			//if($post["id_gallery_cat"] == 3){} /* @member */
			$post["id_gallery_cat"] = 5;
                
			$img_cry_name = $prefix. '_'.$checksum1 . '_'.$checksum2; //strtotime(date('d F Y'))
						
			$the_image 	  = imageUpload($_FILES['resource_image'], $img_cry_name, UPL_GALLERY, 1 );	
			$result 	  = $the_image['result'];
			$the_file 	  = $the_image['thumb'];			
					
			if($the_image['result'] == 1)
			{
				$seq_post_a = "insert into `".$pdb_prefix."dt_gallery_photos`  "
				."(`title`, `filename`,  `id_gallery_cat`, `date_posted`, `filesize`) values "
				."(".$post["resource_title"].", '".$the_image['name']."', '5', CURRENT_TIMESTAMP(), '".$the_image['size']."'); ";
				
				$cndb->dbQuery($seq_post_a);
				$id_gall_item = $cndb->insertId();
                
                $seq_pic_parent  = " insert IGNORE into `".$pdb_prefix."dt_gallery_photos_parent` ( `id_photo`,`id_resource`,`rec_stamp` ) values (".q_si($id_gall_item).", ".q_si($post_id).", CURRENT_TIMESTAMP() );  ";			
		        $cndb->dbQuery($seq_pic_parent);
                
                saveJsonGallery();
			}	
			
		}
		
	}
	
	
	
	
	
	
	/* --------- @@ Populate Tags --------------- */	
	$tag_names 	= explode("," , $post['resource_tags']);
	$formLog->tagsPopulate($tag_names, 'resource' , $post_id );
	/* =============================================== */	
	
	
	/* ======= @@ Activity Log ======================= */
	$formLog->formsUserLogs('resource_adm', $formaction, $post_id, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
	/* =============================================== */
	
	saveJsonResources();
	
	//exit;
	$redirect 	= 'home.php?d=resources&tk='.time();
	?><script>location.href="<?php echo $redirect; ?>";</script> <?php exit;
}





/* ============================================================================== 
/*	COURSES - MAIN
/* ------------------------------------------------------------------------------ */


if($formname=="frm_courses_date_add")
{		
	$id_content 		= $post['content_id'];
	$id_date_record 	= $post['date_record_id'];
	
	if(is_array($post['date_add']) and count($post['date_add']) > 0)
	{	
	
		/*$sqdatesclean = "delete from `".$pdb_prefix."dt_content_dates` where id_content = ".q_si($id_content)."; ";
		$cndb->dbQuery($sqdatesclean);*/
		
		$seq_cont_dates  = array();		
		$content_date 	= $post['date_add'];
		
		foreach($content_date as $k => $datev) 
		{  
		
			if($datev <> '') 
			{ 
			  $dateStart = date("Y-m-d", strtotime($datev))." ".$post['time_start'][$k]; 
			  $dateEnd   = date("Y-m-d", strtotime($datev))." ".$post['time_end'][$k]; 
			
				if($formact=="_add")
				{	
					$seq_cont_dates[]  = " insert IGNORE into `".$pdb_prefix."dt_content_dates` (`id_content`, `date`, `end_date`, `location`, `venue`, `status`) values (".q_si($id_content).", ".q_si($dateStart).", ".q_si($dateEnd).", ".q_si($post['location'][$k]).", ".q_si($post['venue'][$k]).", ".q_si($post['status'][$k])."); ";
				} 
				elseif($formact=="_edit")
				{
					$seq_cont_dates[]  = " UPDATE `".$pdb_prefix."dt_content_dates` SET `date` = ".q_si($dateStart).", `end_date` = ".q_si($dateEnd).", `location` = ".q_si($post['location'][$k]).", `venue` = ".q_si($post['venue'][$k]).", `status` = ".q_si($post['status'][$k])." WHERE `date_record_id` = ".q_si($id_date_record)."; ";
				}
			  
			} 
	
		} 
        
 		if(count($seq_cont_dates)>0) { $cndb->dbQueryMulti($seq_cont_dates); }
		
	}
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php exit;	
	
}




/* ============================================================================== 
/*	COURSES - MAIN
/* ------------------------------------------------------------------------------ */


if($formname=="fm_courses_main")
{		
	
	$article = $post['article']; 
	if($article == '') { $article = cleanSimplex($_POST['article']); }	
	
	$seo_title  = generate_seo_link($post['title'], '-');
	$arr_extras 	= serialize($post['profile']);
	$dateCreated = "CURRENT_TIMESTAMP()";
	
	
	
	
	//$myCols[] = " `arr_images` = ".quote_smart($the_image_name).""; 
		
	if($formact=="_add")
	{
		$sqpost = "insert into `".$pdb_prefix."dt_content`  (`id_section`, `title`, `article`, `published`,`arr_extras`, `date_created`, `url_title_article`, `seq`, `approved`) values (".$postb['id_section'].", ".$postb['title'].", ".quote_smart($article).",  ".quote_smart($published).",  ".quote_smart($arr_extras).",  $dateCreated,  ".quote_smart($seo_title).", ".q_si($seq).", ".$postb['approved']." )";
	}
	elseif($formact=="_edit")
	{
		$sqpost="update `".$pdb_prefix."dt_content`  set `id_section`=".$postb['id_section'].", `title`=".q_si($post['title']).", `article`=".q_si($article).", `published`='".$published."', `url_title_article` = ".q_si($seo_title).", `arr_extras` = ".quote_smart($arr_extras).", `seq`=".q_si($seq).", `approved`=".$postb['approved']." WHERE `id` = ".q_si($post['id'])." ";
	// `article_keywords`=".quote_smart($article_keywords).",	
	}
	
	//echobr($sqpost); exit;
	$rspost = $cndb->dbQuery($sqpost);
	
	
	
	$id_content	= ( $formact == "_add") ? $cndb->insertId() : $post['id']; 
	
	
	/* ====================================== 
	@ update content-to-parent 
	****************************************/
		$content_parent 	= $post['id_parent'];
		$ddSelect->populateContentParent($id_content, $content_parent);
		//$ddSelect->populateKeywords('id_content',$id_content, $array_keywords );
		saveJsonContent();
	/* ====================================== */
	
	
	/******************************************************************
	@begin :: IMAGE UPLOAD
	********************************************************************/	
	$change_image = $post['change_image']; 
	//$image_old    = $post['image_old']; $the_image_name = "";
		
	/*if( $change_image== "Yes") 
	{
		$newTitle    = 'crs-'.strtolower($seo_title); //strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post['title']));
			
		if(isset($_FILES['reg_photo'])) 
		{   $the_image = imageUpload($_FILES['reg_photo'], $newTitle, UPL_GALLERY, 0 );	
			$the_image_name = $the_image['name'];				
		}			
	}
	
		$the_image_arr = array("filename"  =>"".$the_image['name']."",
								  "namefirst"      	 =>"".$the_image['name']."",
								  "namelast"   	   	 =>"".$ac_namelast."",
								  "phone"    	  	 =>"".$ac_phone."",
								  "group_id"      	 =>"".$ac_group_id."",
								  "usersalt"   	     =>"".$ac_salt."",
								  "userpass"         =>"".$ac_password."",
								  "userauth"    	 =>"".$auth_code."",
								  "uservalid"    	 =>"".$ac_uservalid.""
								  );	
		$account_id  = $ddSelect->getAddGallery($ac_email, $account_user_arr);	*/
	
	/*else
	{
		//if($image_old == '') { $image_old = "no_image.png"; }
		$the_image_name = $image_old; 
	}*/
	
	
	
//$redirect = 'hforms.php?d=profiles&op=new'; //&id='.$id_content

?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php
exit;	

	
}


/* ============================================================================== 
/*	ORGANIZATION
/* ------------------------------------------------------------------------------ */


if($formname=="fm_organization")
{	
	/*$ac_email 		= @$post['user']['email'];
	$ac_phone 		= @$post['user']['phone']; 
	$ac_namefirst	= @$post['user']['namefirst'];
	$ac_namelast	= @$post['user']['namelast'];
	$ac_group_id	= @$post['user']['group_id'];
	$ac_uservalid	= yesNoPost(@$post['user']['uservalid']); 
	$ac_published	= yesNoPost(@$post['user']['published']); 
	*/
	
	$org_d 		= $post['org']; 
	$org_seo	= generate_seo_title($org_d['organization'], '-');	
	//$org_id		= $post['organization_id'];
	
	$published 	= yesNoPost(@$org_d['published']);
	$is_partner = yesNoPost(@$org_d['is_partner']);
	
	
	if($formaction == "_new")
	{
		$sq_check = "SELECT `organization` FROM `".$pdb_prefix."reg_organizations` WHERE (`organization` = ".q_si($org_d['organization']).")";
		$rs_check = $cndb->dbQuery($sq_check);
		if($cndb->recordCount($rs_check)>=1)
		{ echo '<script>alert("Organization exists."); history.back(-1);</script>'; exit; }
		
		
		$sq_post = "insert into `".$pdb_prefix."reg_organizations`  (`organization`, `organization_seo`, `organization_website`, `organization_email`, `organization_phone`, `organization_profile`, `is_partner`, `published`) values (".q_si($org_d['organization']).", ".q_si($org_seo).", ".q_si($org_d['organization_website']).",  ".q_si($org_d['organization_email']).",  ".q_si($org_d['organization_phone']).",  ".q_si($org_d['organization_profile']).",  ".q_si($is_partner).",  ".q_si($published).")";
	}
	elseif($formaction == "_edit")
	{
		$org_id		= $post['organization_id'];
		$sq_post 	= "update `".$pdb_prefix."reg_organizations` set `organization`=".q_si($org_d['organization']).", `organization_seo`=".q_si($org_seo).", `organization_website`=".q_si($org_d['organization_website']).", `organization_email`=".q_si($org_d['organization_email']).", `organization_phone`=".q_si($org_d['organization_phone']).", `organization_profile`=".q_si($org_d['organization_profile']).", `published` = ".q_si($published).", `is_partner` = ".q_si($is_partner)."  where `organization_id` = ".q_si($org_id).";  "; 
	}
	//echobr($sq_post); exit;
	$rs_post = $cndb->dbQuery($sq_post);	
	
	if($formaction == "_new") { $org_id = $cndb->insertId(); }
	
	
	if(isset($_FILES['uplogo']) and strlen($_FILES['uplogo']['name']) > 0) 
	{
		$file_key 	 	= '-'.hash("crc32", $org_id);
		$file_name 	 	= $org_seo; //strtolower(substr(preg_replace('/[^a-zA-Z0-9.]+/', '_', $val),0,38));
		$file_name_new	= $file_name.$file_key;		

		$file_temp 		= $_FILES['uplogo']['tmp_name'];					
		$file_target  	= UPL_LOGOS . $file_name_new; 

		if(move_uploaded_file($file_temp, $file_target))
		{
			$sq_file  = "UPDATE `".$pdb_prefix."reg_organizations` set `logo` = ".q_si($file_name_new)."  where `organization_id` = ".q_si($org_id)."; "; 
			$cndb->dbQuery($sq_file);					
		}
	}
	
	
	
	//exit;	
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php exit;	
}





/******************************************************************
@begin :: ACCOUNTS
********************************************************************/	


if($formname=="fm_member_account")
{	
	$ac_email 		= @$post['user']['email'];
	$ac_phone 		= @$post['user']['phone']; 
	$ac_namefirst	= @$post['user']['namefirst'];
	$ac_namelast	= @$post['user']['namelast'];
	$ac_group_id	= @$post['user']['group_id'];
	$ac_org_id		= @$post['user']['organization_id'];
	$ac_uservalid	= yesNoPost(@$post['user']['uservalid']); 
	$ac_published	= yesNoPost(@$post['user']['published']); 
	
	
	
		if($ac_email == '' or $ac_namefirst == '' or $ac_namelast == '' or $ac_group_id == ''){
			echo '<script>alert("Contact details required"); history.back(-1);</script>'; exit;
		}
	
		/*if($post['ac_password'] <> $post['ac_passconfirm']) {
			echo '<script>alert("Passwords dont match"); history.back(-1);</script>'; exit;
		}*/
		
		
		$sq_pass = "";
		if($post['ac_password'] <> '') {
			if($post['ac_password'] <> $post['ac_passconfirm']) {
				echo '<script>alert("Passwords dont match"); history.back(-1);</script>'; exit;
			}
			$ac_salt 		= getSalt();
			$ac_password 	= sha1($_POST['ac_password'] . $ac_salt);		
			$sq_pass 		= ", `usersalt`=".q_si($ac_salt).", `userpass`= ".q_si($ac_password)." ";
		}
		


	
		if($formaction == "_new")
		{			
			//$ac_salt 		= getSalt();
			//$ac_password 	= sha1($_POST['ac_password'] . $ac_salt);	
			$auth_code	    = 'SGN'.strtoupper(md5(uniqid(rand() . $ac_email)));

			$seqpost		= array();
			

			$sq_check = "SELECT `email` FROM `".$pdb_prefix."reg_account` WHERE (`email` = ".q_si($ac_email).")";
			$rs_check = $cndb->dbQuery($sq_check);
			if($cndb->recordCount($rs_check)>=1)
			{ echo '<script>alert("Email exists."); history.back(-1);</script>'; exit; }
			
			/* =============================================== */	
			/* get Account, Category | Link Account to Category */
			$account_user_arr = array("organization_id"  =>"".$ac_org_id."",
									  "namefirst"      	 =>"".$ac_namefirst."",
									  "namelast"   	   	 =>"".$ac_namelast."",
									  "phone"    	  	 =>"".$ac_phone."",
									  "group_id"      	 =>"".$ac_group_id."",
									  "usersalt"   	     =>"".$ac_salt."",
									  "userpass"         =>"".$ac_password."",
									  "userauth"    	 =>"".$auth_code."",
									  "uservalid"    	 =>"".$ac_uservalid.""
									  );	
			$account_id  = $ddSelect->getAddUserAccount($ac_email, $account_user_arr);	
			
			$sq_upd  = "update `".$pdb_prefix."reg_account` set `published` = ".q_si($ac_published)." WHERE `account_id` = ".q_si($account_id)."; ";
			$cndb->dbQuery($sq_upd);
			
		}
			
		elseif($formaction == "_edit")
		{
			$account_id 	= $post['account_id'];
			
			
			$sq_post 		= "update `".$pdb_prefix."reg_account` set `role_id` = ".q_si($ac_group_id).", `organization_id` = ".q_si($ac_org_id).", `namefirst`=".q_si($ac_namefirst).",`namelast`=".q_si($ac_namelast).",`email`=".q_si($ac_email).",`phone`=".q_si($ac_phone).", `uservalid`=".q_si($ac_uservalid).",`published`=".q_si($ac_published)." ".$sq_pass." where `account_id` = ".q_si($post['account_id']).";  "; 
			//echobr($sq_post); exit;
			$cndb->dbQuery($sq_post);
			
		}
	
	
	
	
	if(isset($_FILES['upavatar']) and is_array($_FILES['upavatar']['name'])) 
	{
		$email_name  = explode('@', $ac_email); 
		$doc_newname = cleanFileName(crc32($account_id).'_'.$email_name[0]); 
		
		$doc_result   = fileUpload($_FILES['upavatar'], 0, $doc_newname, UPL_AVATARS);
		
		if($doc_result['result'] == 1) {
			$sq_files  = "UPDATE `".$pdb_prefix."reg_account` SET `avatar`= ".q_si($doc_result['name'])." WHERE `account_id` = ".q_si($account_id)."; ";
			$cndb->dbQuery($sq_files);
		}
	}
	
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk="+Math.random(); </script><?php exit;	
}





if ($formname=="conf_account" or $formname=="account_edit" or $formname=="account_new") 
{
 	
	$post['newsletter'] = yesNoPost($post['newsletter']);
	$post['published']  = yesNoPost($post['published']);
	
	$account_user_id = $post['account_id'];
	
	$account_email   = $post['email'];
	$ac_email = filter_var($account_email, FILTER_SANITIZE_EMAIL);
	if (!filter_var($ac_email, FILTER_VALIDATE_EMAIL)) {
		echo "<script language='javascript'>alert('Invalid Email'); history.back(); </script>"; exit;
	}
	
	//echo $formact; exit;
	
	if ($formact == "_edit" )
	{
		foreach($field_names as $field)
		{
			if(	 $field == "formname"     or $field == "submit"      or $field == "formact" or $field == "id_category" or
					$field == "command"      or $field == "redirect"    or $field == "id"  or $field == "account_id" or
					$field == "image_old"    or $field == "change_image"   or $field == "email" )
			{ }
			else
			{
				
				$fieldVal	= $post[''.$field.''];			
				$myCols[] = " `$field` = ".quote_smart($fieldVal).""; 
			}
		}
		$sqpost = "UPDATE `".$pdb_prefix."reg_account` set  ".implode($myCols, ', ')." where (`account_id` = ".quote_smart($account_user_id)." )" ;
		//echo $sqpost; exit;
		
		$cndb->dbQuery($sqpost);
		
	}
	elseif ($formact == "_new" )
	{
		
		/* =============================================== */
		$account_staff   = checkIfStaff($account_email);
		$account_user_arr = array("namefirst"      =>"".$post['namefirst']."",
								  "namelast"   	   =>"".$post['namelast']."",						  
								  "phone"    	  =>"".$post['phone']."",
								  "country"        =>"".$post['country']."",
								  "staff"    	  =>"".$account_staff."",
								  "newsletter"     =>"".$newsletter."",
								  );	 
		$account_user_id  = $ddSelect->getAddUserAccount($account_email, $account_user_arr);		
		/* =============================================== */
	}
	
	
	foreach ($post['id_category'] as $key => $value) {
		$ddSelect->addUserToCategory($value, $account_user_id);
	}
	//exit;
	?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php
	
} // @end :: ACCOUNTS












if($formname=="vds_profiles")
{		
	
	$article = $post['article']; 
	if($article == '') { $article = cleanSimplex($_POST['article']); }	
	
	$seo_title  = generate_seo_link($post['title'], '-');
	$arr_extras 	= serialize($post['profile']);
	$dateCreated = "CURRENT_TIMESTAMP()";
	
	
	/******************************************************************
	@begin :: IMAGE UPLOAD
	********************************************************************/	
	$change_image = $post['change_image']; 
	$image_old    = $post['image_old']; $the_image_name = "";
		
	if( $change_image== "Yes") 
	{
		$newTitle    = 'ppl-'.strtolower($seo_title); //strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post['title']));
			
		if(isset($_FILES['reg_photo'])) 
		{   $the_image = imageUpload($_FILES['reg_photo'], $newTitle, UPL_AVATARS, 0 );	
			$the_image_name = $the_image['name'];				
		}			
	}
	else
	{
		//if($image_old == '') { $image_old = "no_image.png"; }
		$the_image_name = $image_old; 
	}
	
	$myCols[] = " `arr_images` = ".quote_smart($the_image_name).""; 
		
	if($formact=="_add")
	{
	$sqpost = "insert into `".$pdb_prefix."dt_content`  (`id_section`, `title`, `article`, `published`,`arr_extras`, `date_created`, `url_title_article`, `arr_images`, `seq`) values (".$postb['id_section'].", ".$postb['title'].", ".quote_smart($article).",  ".quote_smart($published).",  ".quote_smart($arr_extras).",  $dateCreated,  ".quote_smart($seo_title).",  ".quote_smart($the_image_name).", ".$postb['seq']." )";
	}
	elseif($formact=="_edit")
	{
		
	$sqpost="update `".$pdb_prefix."dt_content`   set `id_section`=".$postb['id_section'].", `title`=".$postb['title'].", `article`=".quote_smart($article).", `published`='".$published."', `url_title_article` = ".quote_smart($seo_title).", `arr_extras` = ".quote_smart($arr_extras).", `arr_images` = ".quote_smart($the_image_name).", `seq`=".$postb['seq']." WHERE `id` = ".$postb['id']." ";
	// `article_keywords`=".quote_smart($article_keywords).",	
	}
	
	$rspost = $cndb->dbQuery($sqpost);
				
	//echobr($sqpost); exit;	
	
	
	
	
	if 		( $formact=="_add") 	 { $id_content = $cndb->insertId();  }
	elseif 	( $formact=="_edit") 	{ $id_content = $post['id']; }
	
	
	
//exit;
/* ====================================== 
@ update content-to-parent 
****************************************/
	$content_parent 	= $post['id_parent'];
	$ddSelect->populateContentParent($id_content, $content_parent);
	//$ddSelect->populateKeywords('id_content',$id_content, $array_keywords );
	saveJsonContent();
/* ====================================== */

?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php
exit;	

	
}







/******************************************************************
@begin :: MULTI-CONTENT ADDER
********************************************************************/	

if($formname=="article_multi_new")
{		
	
	$postTitle 	  = $post["title"];
	$postTitleSub   = $post["title_sub"];
	$postDate       = $post["created"];
	$postPub        = $post["published"];
	$postArticle    = $post["article"];
	$postImage      = $post["image"];
	
	 
	
	$docUpData  	  = array();
	$sqpost_pics    = array();
	$datePublish 	= "CURRENT_DATE()";
	$timePublish 	= "CURRENT_TIMESTAMP()";
	
	if(is_array($postTitle)) 
	{
		
		foreach($postTitle as $aKey => $aVal) 
		{
            if($aVal <> '') 
			{
	
				if($postDate[$aKey] <> '') {
					$datePublish = "'".date("Y-m-d", strtotime($postDate[$aKey]))."'";  } 			
				
				$article    = $postArticle[$aKey];
				if($article == '') { 
					$article = cleanSimplex($_POST['article'][$aKey]);  }
	
				$title 	  = $postTitle[$aKey];
				$title_sub  = $postTitleSub[$aKey];				
				$title_seo  = generate_seo_link($title, '-');
				$cont_pub   = yesNoPost($postPub[$aKey]);
				
				
				
				/* =============================================
				@@ content to table
				================================================ */
				
				$sqpost = "insert into `".$pdb_prefix."dt_content`  (`id_section`, `title`, `article`, `published`,`title_sub`, `date_created`, `url_title_article`) values (".$postb['id_section'].", ".quote_smart($title).", ".quote_smart($article).",  ".quote_smart($cont_pub).",  ".quote_smart($title_sub).",  $datePublish,  ".quote_smart($title_seo)." )";
				
				$rspost = $cndb->dbQuery($sqpost);
				$id_content = $cndb->insertId(); 
				
				
				$sqpost_menus = "insert IGNORE into `".$pdb_prefix."dt_content_parent` (`id_content`,`id_parent`) values "
				." ('".$id_content."', '".$post['id_parent'][0]."')  ";
				
				//echobr($sqpost_menus);
				$cndb->dbQuery($sqpost_menus);
				
				
				if($postImage[$aKey] <> '') 
				{
					$filename 	  = $postImage[$aKey];
					$sqpost_image  = "insert ignore into `".$pdb_prefix."dt_gallery_photos`  "
					."( `title`, `filename`, `id_gallery_cat`, `date_posted`) values "
					."(".quote_smart($title).", ".quote_smart($filename).", '2', ".$timePublish.")";
					
					$rspost_image = $cndb->dbQuery($sqpost_image);
					$id_image = $cndb->insertId(); 
					
					$sqpost_pics[] = " insert IGNORE into `".$pdb_prefix."dt_gallery_photos_parent` ( `id_photo`,`id_content`,`rec_stamp` ) values (".quote_smart($id_image).", ".quote_smart($id_content).", ".$timePublish." );  ";			
		
				}
	
			}	// if title <> ''
		}	// for each
		
		saveJsonContent();
		
		if(count($sqpost_pics) > 0){
			$cndb->dbQueryMulti($sqpost_pics);
			saveJsonGallery();	
		}
	}
//exit;
	
?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php
exit;
}









if($formname=="fm_usercat_edit" or $formname=="fm_usercat_new")
{
	
	
	if($formname=="fm_usercat_new") 
	{
		$account_cat = $ddSelect->getAddUserCat($post['title']);
	
	} 
	elseif($formname=="fm_usercat_edit") 
	{	
		$account_cat = $post['id'];
	}
	
	$sqpost="UPDATE `".$pdb_prefix."reg_cats` SET "
		." `title`= ".$postb['title'].", `description`= ".$postb['description'].", "
		." `published`= '".$published."'  "
		." where (`id_category` = ".quote_smart($account_cat).")";
		
	//echo $sqpost; //exit;
	
	$cndb->dbQuery($sqpost);
	
	?> <script language='javascript'>location.href="<?php echo $redirect; ?>"; </script> 
	<?php exit;
}






if($_POST['formname'] == 'forum_edit_posts')
{
		
		$post_id = $_POST['post_id'];
		
		$sq_post = "UPDATE `".$pdb_prefix."forum_posts` SET `post_content` = '" . sanitizor($_POST['post_content']) . "', `post_published` = '".$published."'  WHERE `post_id` = '" . sanitizor($_POST['post_id']) . "' "; 
		 //echo $sq_post; exit;
		$rs_post = $cndb->dbQuery($sq_post);
	
	
		if(!$rs_post)
		{
			echo 'An error occured while updating your post. Please try again later.<br /><br />' . mysql_error();
			$sql = "ROLLBACK;";
			$result = $cndb->dbQuery($sql);
		}
		else
		{
			$sql = "COMMIT;";
			$result = $cndb->dbQuery($sql);	
			$redirect = 'manager.php?fitm=posts&fopt=list&fpost='. $post_id . '';		
			echo 'You have succesfully updated the member post. <a href="'. $redirect . '">Back to list</a>.';
			
			
			?>
<script language="javascript">	
function resultRedirect(){ location.href="<?php echo $redirect; ?>"; } window.setTimeout("resultRedirect()", 3000);
</script>			
			<?php
		}
	
}	




/******************************************************************
@begin :: GALLERIES - SINGLE FILE
********************************************************************/	

if ($formname=="edit_file_single") 
{
	
	$formaction    = '_edit';
	$status_image_update = 0;
	$id_photo 		 = $post['id_photo'];
	$record_stamp	 = time();
	$parent_menu 	  = $post['id_parent'];
	
	$parent_cont	  = array();
	$parent_title	 = '';
	
	
	
	
	$images = count($post['image']);
	
	$qry_delete = "";
	
	
	
		foreach ($post['image'] as $key => $value) 
		{
			//$id_link = $post['id_link'];
			//$id_content = $post['id_content'];
			
			$caption 		= $post['caption'][$key];
			$desc 		   = $post['desc'][$key];
			$id_gallery_cat = $post['id_gallery_cat'][$key];
			if($id_gallery_cat == '') {$id_gallery_cat=2;}
			
			$ca_section_tags   = '';
			//$ca_tags 		   = $post['tags'][$key];
			//if(count($ca_tags) > 0){ $ca_section_tags = serialize($ca_tags); }
			
			
			$image_name 	 = $post['image'][$key];
			
			if($post['video_name'] <> $image_name)
			{$image_name 	= $post['video_name']; }
			
			$pos 		   = strrpos($image_name,"="); 		
			if ($pos === false) {  }  
			else { $image_name     = "http://www.youtube.com/embed/".substr($image_name,($pos+1)); }
		
			if($post['show'][$key] == "on") { $published = 1; } else { $published = 0; }
			
			$seq_pic_update[] = "update `".$pdb_prefix."dt_gallery_photos` set "
				  . "`title` = ".quote_smart($caption).", "
				  . "`description` = ".quote_smart($desc).", "
				  . "`filename` = ".quote_smart($image_name).", "
				  . "`id_gallery_cat` = '".$id_gallery_cat."', "
				  . "`tags` = ".quote_smart($ca_section_tags).", "
				  . "`published` = '".$published."' "
				  . " where `id` = '".$key."'; ";
				  
				  //. "`id_content` = '".$id_content."', "
			//$id_photo   = $key;	  
		}
	
	
	/* ============================================================================================= */
	/* POPULATE -- PROJECT >>> LINKS */
	//$ddSelect->populateProjectLinks('id_gallery', $id_photo, $post['sector_id'], $post['project_id']);
	/* --------------------------------------------------------------------------------------------- */
		
	$seq_pic_clean = " delete from `".$pdb_prefix."dt_gallery_photos_parent` where `id_photo` = ".quote_smart($id_photo)." ";
	$cndb->dbQuery($seq_pic_clean);
	
	
	if(is_array($parent_menu) and count($parent_menu)> 0 )
	{	
		for($i=0; $i <= (count($parent_menu)-1); $i++) 
		{  
	       $seq_pic_update[]  = " insert into `".$pdb_prefix."dt_gallery_photos_parent` ( `id_photo`, `id_link`, `rec_stamp` ) values  (".quote_smart($id_photo).", '".$parent_menu[$i]."', '".$record_stamp."'); ";
		} 
	}
	
	
	if(isset($post['id_content'])) { $parent_cont   = $post['id_content'][$id_photo]; $parent_title = '`id_content`'; }
	/*if(isset($post['id_equipment'])) { $parent_cont = $post['id_equipment'][$id_photo]; $parent_title = '`id_equipment`'; }
	if(isset($post['id_resource'])) { $parent_cont 	= $post['id_resource'][$id_photo]; $parent_title = '`id_resource`'; }*/
	
	
	if(is_array($parent_cont) and count($parent_cont)> 0 )
	{	
		foreach($parent_cont as $ckey => $cval) 
		{  
	           $seq_pic_update[]  = " insert into `".$pdb_prefix."dt_gallery_photos_parent` ( `id_photo`, ".$parent_title.", `rec_stamp` ) values  (".quote_smart($id_photo).", ".quote_smart($cval).", '".$record_stamp."'); ";
		} 
	}

        
    
		
    
	if(count($seq_pic_update) > 0) {
		$cndb->dbQueryMulti($seq_pic_update);

        /* ======= @@ Activity Log ======================= */
        $log_detail = 'Name: '.$caption.' [Status: '.yesNoText($published).']'; $post_id = $id_photo;
        $formLog->formsUserLogs('gallery_adm', $formaction, $post_id, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
        /* =============================================== */
        
        saveJsonGallery();
	}
	
	?>
	<script type="text/javascript"> location.href = "<?php echo $redirect; ?>&qst=1&tk=<?php echo time(); ?>"; </script>
	<?php
		

}



/******************************************************************
@begin :: POLLS
********************************************************************/	

if($formname == 'poll_edit' or $formname == 'poll_new') 
{

	
	$cur 		= ($_POST['current']=='on')? '1':'0';
	$pub 		= ($_POST['published']=='on')? '1':'0';
	
	$subject	= trim(htmlentities(addslashes($_POST['subject'])));
	$question	= trim(htmlentities(addslashes($_POST['question'])));
	
	if($cur>0) $cndb->dbQuery("UPDATE `".$pdb_prefix."poll_questions` SET `show`=0");
	if(mysql_errno>0) $err .= mysql_errno().": ".mysql_error()."<br />";
	
	
	if($formname == 'poll_new'){
		$query = "INSERT INTO `".$pdb_prefix."poll_questions` (`subject`,`question`,`date`,`show`,`published`) VALUES ('".$subject."','".$question."',NOW(),'".$cur."','".$pub."')";
		//echo $query; exit;
		$cndb->dbQuery($query);
		if($cndb->errorNo()>0) $err .= $cndb->errorNo().": ".$cndb->error()."<br />";
		$qid = $cndb->insertId();
		
		$n = $_POST['next'];	
		for($i=0;$i<$n;$i++) {
			$name = "ans$i";
			if(isset($_POST[$name]) && $_POST[$name]!='') {
				$query2 = "INSERT INTO `".$pdb_prefix."poll_responses` (`qid`,`response`) VALUES ('".$qid."','".$_POST[$name]."')";
				$cndb->dbQuery($query2);
				if($cndb->errorNo()>0) $err .= $cndb->errorNo().": ".$cndb->error()."<br />";
			}
		}
	}
	
	
	if($formname == 'poll_edit'){	
		$query = "UPDATE `".$pdb_prefix."poll_questions` SET `subject`='".$subject."',`question`='".$question."',`show`=".$cur.", `published`=".$pub." WHERE `qid`=".$_POST['qid'];
		//echo $query; exit;
		$cndb->dbQuery($query);
		if($cndb->errorNo()>0) $err .= $cndb->errorNo().": ".$cndb->error()."<br />";
			
		$n = $_POST['next'];	
		for($i=0;$i<$n;$i++) {
			$name = "ans$i";
			if(isset($_POST[$name]) && $_POST[$name]!='') {
				$query2 = "SELECT `rid` FROM `".$pdb_prefix."poll_responses` WHERE `rid`=".$i." AND `qid`=".$_POST['qid'];
				$result2 = $cndb->dbQuery($query2);
				if( $cndb->recordCount($result2)>0) {
					$query3 = "UPDATE `".$pdb_prefix."poll_responses` SET `response`='".$_POST[$name]."' WHERE `rid`=".$i;
					$cndb->dbQuery($query3);
					if($cndb->errorNo()>0) $err .= $cndb->errorNo().": ".$cndb->error()."<br />";
					
				} else {
					$query3 = "INSERT INTO `".$pdb_prefix."poll_responses` (`qid`,`response`) VALUES ('".$_POST['qid']."','".$_POST[$name]."')";
					$cndb->dbQuery($query3);
					if($cndb->errorNo()>0) $err .= $cndb->errorNo().": ".$cndb->error()."<br />";
				}
			}
		}
	}
	
	
	$redirect = "home.php?d=online polls";
	?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk=<?php echo time(); ?>"; </script><?php
}	










if ($formname=="edit_photo") 
{
	
	
	
	$images = count($post['image']);
	
	$qry_delete = "";
	
		foreach ($post['image'] as $key => $value) {
		//if(is_array($post['show']))
		//{
			
		
			$caption = $post['caption'][$key];
			$desc = $post['desc'][$key];
			$id_gallery_cat = $post['id_gallery_cat'][$key];
			
			if($post['show'][$key] == "on") { $published = 1; } else { $published = 0; }
			if($post['galtype'][$key] == "v") {
				$id_gallery_cat = $post['id_gallery_cat'];
				if($id_gallery_cat == $key) {$id_gallery_cat=1;} else { $id_gallery_cat = 0;}
			}
			
			$sqpost[] = "update `".$pdb_prefix."dt_gallery_photos` set "
				  . "`title` = ".quote_smart($caption).", "
				  . "`description` = ".quote_smart($desc).", "
				  . "`id_gallery_cat` = '".$id_gallery_cat."', "
				  . "`published` = '".$published."' "
				  . " where `id` = '".$key."'; ";
		//}
		
		//echo "Value: $value<br />\n";
		}
		
		
		if(count($sqpost) > 0) {
			
			$cndb->dbQueryMulti($sqpost); 
		}
			?>
			<script type="text/javascript"> location.href = "<?php echo $redirect; ?>&qst=1&tk=<?php echo time(); ?>"; </script>
			<?php
		

}

	


/*********************************************************************************************
@begin :: DOWNLOADS
***********************************************************************************************/	
function itemUploadArr ($file, $uploadname, $uploadtarget, $loopNum) //, $fileoption = ""
{
	$do_upload		= NULL;
	$max_size 		= "3000000";
	
	$item_arr 		= array();
	$item_source 	= $file['tmp_name'][$loopNum];
	
	$item_type 		= $file['type'][$loopNum];
	$item_size 		= $file['size'][$loopNum];	
	
	$mimetypes = array("application/pdf","application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/jpeg", "image/jpe", "image/jpg", "image/pjpeg", "image/gif", "image/png", "image/x-png", "text/plain");
	
	if(in_array($item_type, $mimetypes))
	{
	
		$item_ext_a		= getFileExtension(strtolower($file['name'][$loopNum]));
		
		$item_ext 		= "." . $item_ext_a;
		$item_new 		=  $uploadname . $item_ext;  
		$item_target 	=  $uploadtarget . $item_new;
		
		$isUploaded = move_uploaded_file($item_source, $item_target);
		
		if($isUploaded)
		{
			echo ' <hr> File <strong>' . $item_new .'</strong> has been uploaded! <br>';
			$item_arr 	= array('name' => ''.$item_new.'', 'size' => ''.intval($item_size).'', 'type' => ''.$item_type.''); //
		}
		else
		{
			?> <script>alert("File NOT uploaded.\n\nEnsure destination folder exists and you are allowed access.");</script>  
			<?php 
			exit;  		
		}
	}
	else
	{
		?> <script>alert("Invalid File Type selected.");</script>  
			<?php 
	}	
	
	return $item_arr;
}



if($formname=="frm_download_multi")
{		
	
	//exit;
	
	$docUpData  	  = array();
	$datePublish 	= "CURRENT_DATE()";
	
	if(isset($_FILES['s_card']) and is_array($_FILES['s_card']['name'])) 
	{
		
		foreach($_FILES['s_card']['name'] as $doc_key => $val) 
		{
            if(strlen($_FILES['s_card']['name'][$doc_key]) > 4) 
			{
	
				if($post["created"][$doc_key] <> '') {
					$datePublish = "'".date("Y-m-d", strtotime($_POST["created"][$doc_key]))."'"; 
				} 			
				
				/* =============================================
				@@ downloads to table
				================================================ */
							
				$sqpost = "insert into `".$pdb_prefix."dt_downloads` (`title`, `description`, `date_posted`, `published`, `language`, `approved`, `id_portal`) values (".quote_smart($post['file_title'][$doc_key]).", ".quote_smart($post['file_desc'][$doc_key]).", $datePublish, ".quote_smart($post['published'][$doc_key]).", ".quote_smart($post['language'][$doc_key]).", '1', ".$postb['id_portal']." ) ";
				
				echo $sqpost . '<br>';exit;
				
				
				$cndb->dbQuery($sqpost);
				
				$img_cry_name	= "";
				$rec_id_str	  = "";
				$seq_update_menu = array();
				
				$id_download 	 = $cndb->insertId();	
				$rec_id_str 	  = str_pad($id_download, 4, "0", STR_PAD_LEFT); 
				
				if($post['id_portal'] <> 1) { $rec_id_str = $post['id_portal']."_".$rec_id_str; }
				
				$img_cry_name    = preg_replace('/[\'"]/', '', strtolower($_POST['file_title'][$doc_key])); // No quotes
				$img_cry_name    = substr(preg_replace('/[^a-zA-Z0-9]+/', '_', $img_cry_name),0,50);// No spaces
				$img_cry_name    = $rec_id_str."_".date("Ymd")."_".$img_cry_name; 
				
				
				$ufile_name 		= $_FILES['s_card']['name'][$doc_key];
				$ufile_size 		= $_FILES['s_card']['size'][$doc_key];
				$ufile_type 		= $_FILES['s_card']['type'][$doc_key];
				$ufile_temp 		= $_FILES['s_card']['tmp_name'][$doc_key];
				
				$ufile_ext    	 = ".".strtolower(substr(strrchr($ufile_name,"."),1));	
				$ufile_name_new	= $img_cry_name.$ufile_ext;		
				
				
				
				/* =============================================
				@@ downloads to menus
				================================================ */
				if(array_key_exists('id_parent', $post) and  is_array($post['id_parent']))
				{
					$menu_parent 	= $post['id_parent'];
					if(count($menu_parent)>0)
					{
						for($i=0; $i <= (count($menu_parent)-1); $i++) 
						{  
						  if($menu_parent[$i] <> '') {
							$seq_update_menu[]  = " insert IGNORE into `".$pdb_prefix."dt_downloads_to_menus` ( `id_portal`, `id_menu`, `id_download` ) values "
							." (".$postb['id_portal'].", '".$menu_parent[$i]."', '".$id_download."')  ";
						  }
						} 
						$cndb->dbQueryMulti($seq_update_menu);
						unset($seq_update_menu);
					}
				}
				
				
				/* =============================================
				@@ downloads to content
				================================================ */
				if(array_key_exists('id_content', $post) and  is_array($post['id_content']))
				{
					$content_parent 	= $post['id_content'];
					if(count($content_parent)>0)
					{
						for($i=0; $i <= (count($content_parent)-1); $i++) 
						{  
							if($content_parent[$i] <> '') {
							$seq_update_content[]  = " insert IGNORE into `".$pdb_prefix."dt_downloads_to_contents` (`id_portal`, `id_content`, `id_download` ) values "
							." (".$postb['id_portal'].", '".$content_parent[$i]."', '".$id_download."')  ";
							}
						} 
						$cndb->dbQueryMulti($seq_update_content);
						unset($seq_update_content);
					}						
				
				}
				
				
				/* =============================================
				@@ downloads uploads
				================================================ */
				$ufile_mimetypes = array("application/pdf","application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
				
				if(in_array($ufile_type, $ufile_mimetypes))
				{
					$ufile_target = UPL_FILES . $ufile_name_new;
					
					if(move_uploaded_file($ufile_temp, $ufile_target))
					{
						echo ' <hr> File <strong>' . $ufile_name .'</strong> has been uploaded! <br>';
							 
				$sq_update_file  = "update `".$pdb_prefix."dt_downloads`  set  `link` = ".quote_smart($ufile_name_new).", `dtype` = ".quote_smart($ufile_type).", `dsize` = ".quote_smart($ufile_size)." where `id` = '".$id_download."' ";
				//echo $sq_update_file . '<br>'; //exit;
				$cndb->dbQuery($sq_update_file);
				
					}
					else
					{
						echo ' <hr> File <strong>' . $ufile_name .'</strong> NOT uploaded! <br>';		
					}
				}
	
	
	
	
	
	
			}	// if file-name
		}	// for each
	}
echo ' <br><br><br><hr> <a href="home.php?d=resource library" style="color:blue"> # Back to Resource List</a> <br> <a href="adm_downloads_multi.php?d=resource library&op=new" style="color:red"> # Upload More Resources</a><br>';	
exit;
}



if ($formname=="download_edit" or $formname=="download_new") 
{
	
	$trans = get_html_translation_table(HTML_ENTITIES);
	//displayArray($trans);
	//$rage = "L'évolution du conseil agricole au Nord Cameroun, source d'incertitudes pour les conseillers ";
	//echo '<hr>a - '.strtr($rage, $trans);
	//echo '<hr>x - '.strtr($_POST['title'], $trans);
	//echo '<hr>b - '.cleanInput($_POST['title']);
		
	if($post['title'] == '') {
		echo '<script>alert("Title is empty"); history.back();</script>'; exit;
	}
	
	if(isset($_POST['id_file'])) {$id_file=$_POST['id_file']; } else { $id_file=NULL; }
	if(isset($_POST['id_cat'])) {$id_cat=$_POST['id_cat']; } else { $id_cat=NULL; }
	if(isset($_POST['id_menu'])) {$id_menu=$_POST['id_menu']; } else { $id_menu=NULL; }
	if(isset($_POST['id_menu2'])) {$id_menu2=$_POST['id_menu2']; } else { $id_menu2=NULL; }
	if(isset($_POST['doc_id_owner'])) {$doc_id_owner=$_POST['doc_id_owner']; } else { $doc_id_owner=NULL; }	
	if(isset($_POST['position'])) {$position=intval($_POST['position']); } else { $position="9"; }
	if(isset($_POST['id_access'])) {$id_access=$_POST['id_access']; } else { $id_access=1; }
	
	
	$link_seo = generate_seo_link($post['title'], '-');
	
	if($post["created"] <> '') {
		$datePublish = "'".date("Y-m-d", strtotime($_POST["created"]))."'"; // ".date("H:i:s")."
	} else {
		$datePublish = "CURRENT_DATE()";
	}
	
	
	$arr_attach	= NULL;
	/*if(array_key_exists('id_content', $post) and  is_array($post['id_content']))
	{	$arr_attach 	= serialize($post['id_content']); } else 
	{		}	*/
	
	
	$filename = ""; $file_query = "";
	
	if (isset($_POST['change_image']))	{$change_image=$_POST['change_image'];} else {$change_image=NULL;}
	
	if($change_image <> 'Yes')
	{
		if($post['resource_name'] <> $post['filename']){
				$filename = $post['resource_name']; $file_query = ", `link` = ".quote_smart($filename)." ";
			}		
	}
	
	
	
	$userid=$sys_us_admin['admin_id'];
	
	if ($formname=="download_new") 
	{
		
	$sqpost = "insert into `".$pdb_prefix."dt_downloads` (`title`, `description`, `date_posted`, `published`, `posted_by`, `seq`, `hlight`, `language`, `author`,  `approved`, `id_access`, `link`, `link_seo`) values (".quote_smart($post['title']).", ".quote_smart($post['description']).", $datePublish, '".$published."', '".$userid."', '".$position."', '".$sidebar."',  ".quote_smart(@$post['language']).", ".quote_smart(@$post['author']).",  
	'".$approved."', ".$postb['id_access'].", ".quote_smart($filename).", ".quote_smart($link_seo)." ) ";
	
	$redirect = "adm_downloads.php?d=resource library&op=new";
	
	}
	elseif ($formname=="download_edit") 
	{
	
	$sqpost = "update `".$pdb_prefix."dt_downloads`  set  `title` = ".quote_smart($post['title']).", `description` = ".quote_smart($post['description']).", `posted_by` = '".$userid."', `published` = '".$published."', `seq` = '".$position."' , `hlight` = '".$sidebar."', `date_posted` = $datePublish,   `link_seo` = ".quote_smart($link_seo).", `approved` = '".$approved."', `id_access` = ".$postb['id_access']."  $file_query "
		." where `id` = '".$id_file."' ";
	//`language` = ".quote_smart($post['language']).", `author` = ".quote_smart($post['author']).",
	}
	echobr($sqpost);  exit;
	
	
	$cndb->dbQuery($sqpost);
	
	if 		( $formname=="download_new") 		{ $id_download = $cndb->insertId(); }
	elseif 	( $formname=="download_edit") 		{ $id_download = $post['id_file']; }
	//echobr($id_download); 
	
	
		
	
	
/* ************************************************************** 
@ update download-to-parent 
****************************************************************/

	/* ==========  download-to-menu  =========== */	

	$seq_update_parent = array();
	
	if(array_key_exists('id_parent', $post) and  is_array($post['id_parent']))
	{	
	
		$menu_parent 	= $post['id_parent'];
		if(count($menu_parent)>0)
		{
			for($i=0; $i <= (count($menu_parent)-1); $i++) 
			{  
			  if($menu_parent[$i] <> '') {
				
	$seq_update_parent[]  = " insert IGNORE into `".$pdb_prefix."dt_downloads_parent` ( `id_download`, `id_menu` ) values "
	." ('".$id_download."', '".$menu_parent[$i]."');  ";
	
			  }
			} 
		}
	}

	/* ==========  download-to-content  =========== */	
	if(array_key_exists('id_content', $post) and  is_array($post['id_content']))
	{
		if(array_key_exists('id_content', $post) and  is_array($post['id_content']))
		{	
			$content_parent 	= $post['id_content'];
			if(count($content_parent)>0)
			{
				for($i=0; $i <= (count($content_parent)-1); $i++) 
				{  
					if($content_parent[$i] <> '') {
		 
		
		$seq_update_parent[]  = " insert IGNORE into `".$pdb_prefix."dt_downloads_parent` ( `id_download`, `id_content` ) values "
." ('".$id_download."', '".$content_parent[$i]."');  ";	
					}
				} 
			}
		}	
	}
	
	
	if(count($seq_update_parent))
	{
		$sq_par_clean = " delete from `".$pdb_prefix."dt_downloads_parent` where `id_download` = '".$id_download."'; ";
		$cndb->dbQuery($sq_par_clean);
		
		$cndb->dbQueryMulti($seq_update_parent);
		unset($seq_update_parent);
		
		
	}

/******************************************************************
@FILE UPLOAD
********************************************************************/
	
	
	$rec_id_str = str_pad($id_download, 4, "0", STR_PAD_LEFT); 
	
	if($post['id_portal'] <> 1) { $rec_id_str = $post['id_portal']."_".$rec_id_str; }
	
	$img_cry_name    = preg_replace('/[\'"]/', '', strtolower($_POST['title'])); // No quotes
	$img_cry_name    = substr(preg_replace('/[^a-zA-Z0-9]+/', '_', $img_cry_name),0,50);// No spaces
	$img_cry_name    = $rec_id_str."_".date("Ymd")."_".$img_cry_name; 
				
	$image_0="";
	$filename="";
	$max_size = "5000000";
	$file_query = "";
	$iml=0;
	
	$upload_error = 0;
	$upload_error_redirect = 'adm_downloads.php?d=resource library&op=edit&id='.$id_download.'';
		
	if($change_image=='Yes')
	{
		if(isset($_FILES['fupload']) and trim($_FILES['fupload']['name']) <> '') 
		{
	
			$img_mimetypes = array("application/pdf","application/msword","text/plain","application/vnd.ms-excel", "application/vnd.ms-powerpoint", "application/zip", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.openxmlformats-officedocument.presentationml.presentation");
			$file_size = $_FILES['fupload']['size'];
			$file_type = $_FILES['fupload']['type'];
			
			$img_ext = ".".getFileExtension(strtolower($_FILES['fupload']['name']));
			$img_new_name =  $img_cry_name.$img_ext;  
			
			
			if(in_array($file_type, $img_mimetypes))
			{
				$filename = $img_new_name; 
				
				$source = $_FILES['fupload']['tmp_name'];	
				$target = UPL_FILES . $filename;
				//echo $target; exit;
				if(move_uploaded_file($source, $target))
				{
					echo "<script>alert(\"File successfully uploaded.\"); </script>";
					$file_0 = $filename; 
					$do_file="'".$image_0."'";
					
		$sq_update_file  = "update `".$pdb_prefix."dt_downloads`  set  `link` = '".$filename."', `dtype` = '".$file_type."', `dsize` = '".$file_size."' where `id` = '".$id_download."' ";
		//echo $sq_update_file; exit;
		$cndb->dbQuery($sq_update_file);
		
				}
				else
				{
					$upload_error = 310;
					/*echo "<script> alert(\"File Not uploaded.\");
							location.href = 'adm_downloads.php?d=resource library&op=edit&id=$id_download';
						  </script>";  
					exit;  */
				}
		
			}else{
					$upload_error = 311;
				/*echo "<script>alert(\"File selected for upload is not Valid.\");</script>";  exit; */  
				}
		}
	}
	
	
	
	/******************************************************************
	@END FILE UPLOAD
	********************************************************************/

	
	/* ************************************************************** 
	@ update image
	****************************************************************/
	
		
	if(trim($_FILES['upload_icon']['name']) <> '') 
	{
		$post_id		 = $id_download;
		$post_title   	  = $post['title'];
		
		$filename_cat	= 5;
		$filename_prefix = 'rs'.str_pad($post_id, 4, "0", STR_PAD_LEFT).'-';
		$filename_new  	= $filename_prefix.substr(clean_alphanum($post_title),0,30);
		
			
		$the_image 	= imageUpload($_FILES['upload_icon'], $filename_new, UPL_COVERS, 0 );	
		$result 	   = $the_image['result'];
		$the_file 	 = $the_image['thumb'];
		
		
		if($the_image['result'] == 1)
		{
			/*$sq_upload = "insert into `".$pdb_prefix."dt_gallery_photos`  "
			."( `title`, `filename`,  `id_gallery_cat`, `date_posted`)   values "
			."(".quote_smart($post_title).", '".$the_image['name']."', 5, CURRENT_TIMESTAMP())";
			$cndb->dbQuery($sq_upload);
			$id_photo = $cndb->insertId();
			
			$sq_upload_parent = " REPLACE into `".$pdb_prefix."dt_gallery_photos_parent` " 
			."(`id_photo`,`id_resource`,`rec_stamp`) values "
			."(".quote_smart($id_photo).", ".quote_smart($post_id).", '".time()."')  ";		
			$cndb->dbQuery($sq_upload_parent);*/
			
			$sq_update_parent = "update `".$pdb_prefix."dt_downloads` set `attachment`='".$the_image['name']."' where " 
			." `id` =  ".quote_smart($post_id)."; ";		
			$cndb->dbQuery($sq_update_parent);/**/
	
		}	
	}
	
	
	saveJsonResources();
	
	if($upload_error <> 0) {
	  echo "<script>alert(\"".$msge_array[$upload_error]."\"); location.href = '".$upload_error_redirect."'; </script>";
	}
		
		
?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk=<?php echo time(); ?>"; </script><?php
exit;

} // @end :: downloads
	
	


	

/*********************************************************************************************
@begin :: ARTICLES
***********************************************************************************************/	

function process_table($match) {
		$out = str_replace('<br />', '', $match[0]);
		$out = preg_replace('/<p[^>]*?>/', '', $out);
		$out = str_replace('</p>', '', $out);
		$out = preg_replace('/<div[^>]*?>/', '', $out);
		$out = str_replace('</div>', '', $out);
        return $out;

}



if ($formname=="article_basic_edit" or $formname=="article_basic_new") 
{
	//exit;
	
	$article = $post['article']; 
	if($article == '') { $article = cleanSimplex($_POST['article']); }
	
	$arr_extras = '';
	/*if(isset(@$_POST['other_link'])) {
		$arr_extras_raw = array(
			'other_link' => ''.$post['other_link'].''
		);
		
		$arr_extras = serialize($arr_extras_raw);
	}*/
    
    $applicType = substr($formname,-9);
	
	if($applicType == "_training")
	{
		$arr_extras_raw = array(
			'location' => ''.$post['ev_location'].''
			,'training_cat' => ''.$post['training_cat'].''
			,'training_session' => ''.$post['training_session'].''
			,'training_duration' => ''.$post['training_duration'].''
			,'date_deadline' => $post['date_deadline']
			,'book_form' => ''.$booking_post.''
			,'book_amount' => ''.$post['booking_amount'].''
		);

	}
	else
	{
		$arr_extras_raw = array(
			'location' => ''.$post['ev_location'].''
			,'book_form' => ''.$booking_post.''
			,'book_amount' => ''.$post['booking_amount'].''
		);
	}
	$arr_extras = serialize($arr_extras_raw);
	
	
	$url_title_article = generate_seo_link($post['title'], '-');
	$article_keywords  = generate_seo_link($post['article_keywords'], ',');
	$array_keywords    = explode(',',$article_keywords);
	
	
    
    if(is_array($post['related_tag']))
    {
         $post['id_parent'] = array_merge($post['id_parent'], $post['related_tag']);
    }
    
    
	if(is_array($post['id_parent']))
	{	$arr_parent 	= serialize($post['id_parent']); } else 
	{	$arr_parent		= NULL;	}	
	
    
	if(isset($_POST['id_section'])) 
    {$id_section=$_POST['id_section']; } else 
    { $id_section=NULL;  }
	
    
	
	if($post["created"] <> '') 
    { $dateCreated = "'".date("Y-m-d", strtotime($_POST["created"]))." ".date("H:i:s")."'"; }  else 
    { $dateCreated = "CURRENT_TIMESTAMP()"; }
	
	if($post['id_section']=='') { $id_section=1; }
	
	
	if ($formname=="article_basic_new")
	{
        $formaction = '_new';
        // `parent`,  ".quote_smart($arr_parent).",
        $sqpost="insert into `".$pdb_prefix."dt_content`  (`id_section`, `title`, `article`, `published`, `frontpage`, `sidebar`, `intro_home`, `seq`, `title_sub`, `date_created`, `id_portal`, `approved`, `link_static`, `url_title_article`, `article_keywords`, `arr_extras`) values ('".$id_section."', ".quote_smart($post['title']).", ".quote_smart($article).",  '".$published."',  '".$frontpage."',  '".$sidebar."',  '".$intro_home."',  ".quote_smart($post['position']).", ".quote_smart($post['title_sub']).", ".$dateCreated.", ".$postb['id_portal'].",  '".$approved."',  ".quote_smart($post['link_static']).", ".quote_smart($url_title_article).", ".quote_smart($article_keywords).", ".quote_smart($arr_extras)." )";

	//$redirect = "adm_articles.php?d=contents&op=new";
	
	}
	elseif ($formname=="article_basic_edit" )
	{	
        $formaction = '_edit';
        //`parent`=".quote_smart($arr_parent).", 
	   $sqpost="update `".$pdb_prefix."dt_content`   set `id_section`=".quote_smart($post['id_section']).", `title`=".quote_smart($post['title']).", `article`=".quote_smart($article).", `published`='".$published."', `frontpage`='".$frontpage."', `sidebar`='".$sidebar."', `intro_home`='".$intro_home."', `seq`=".quote_smart($post['position']).", `title_sub`=".quote_smart($post['title_sub']).", `date_created` =".$dateCreated.", `id_portal`= ".$postb['id_portal'].", `approved` = '".$approved."', `link_static` = ".quote_smart($post['link_static']).", `url_title_article` = ".quote_smart($url_title_article).", `article_keywords`=".quote_smart($article_keywords).", `arr_extras`=".quote_smart($arr_extras)." WHERE `id` = '".$id."' ";
	}
	
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
	
	if 		( $formname=="article_basic_new") 		{ $id_content = $cndb->insertId(); }
	elseif 	( $formname=="article_basic_edit") 		{ $id_content = $post['id']; }
	
	
	
   
    
    
    
    /* ===  @CONTENT-TO-PARENT CLEAN-UP === */
    $sq_parent_clean = " delete from `mrfc_dt_content_parent` where `id_content` = ".q_si($id_content)."; ";
    $rs_parent_clean = $cndb->dbQuery($sq_parent_clean); 
    
    /* ===  @CONTENT-TO-PARENT === */
	$content_parent 	= $post['id_parent'];
	$ddSelect->populateContentParent($id_content, $content_parent);
	
    /* ===  @CONTENT-TO-COMMITTEE === */    
    if(array_key_exists('related_committee', $post) and is_array($post['related_committee'])) {
         $ddSelect->populateContentParent($id_content, $post['related_committee'], 'committee_id');
    }    
    
    /* ===  @CONTENT-TO-COUNTY === */    
    if(array_key_exists('county', $post) and is_array($post['county'])) {
         $ddSelect->populateContentParent($id_content, $post['county'], 'county_id');
    }
    
    
    
    
    /* --------- @@ Populate Tags --------------- */	
	$tag_names 	= explode("," , $post['article_keywords']);
	$formLog->tagsPopulate($tag_names, 'article' , $id_content );
	/* =============================================== */	
    
    /* ************************************************************** 
    @BEG :: update-content-dates
    ****************************************************************/

	
	if(is_array($post['date_add']) and count($post['date_add']) > 0)
	{	
	
		$sqdatesclean = "delete from mrfc_dt_content_dates where id_content = ".q_si($id_content)."; ";
		$cndb->dbQuery($sqdatesclean);
		
		$seq_cont_dates  = array();		
		$content_date 	= $post['date_add'];
		
		foreach($content_date as $k => $datev) 
		{  		
			if($datev <> '') 
			{ 
			  $dateStart = "'".date("Y-m-d", strtotime($datev))." ".$post['time_start'][$k]."'"; 
			  $dateEnd   = "'".date("Y-m-d", strtotime($datev))." ".$post['time_end'][$k]."'"; 
			
			  $seq_cont_dates[]  = " insert IGNORE into mrfc_dt_content_dates (id_content, date, end_date) values ('".$id_content."', ".$dateStart.", ".$dateEnd."); ";
			} 
	
		} 
		 
		if(count($seq_cont_dates)>0) { $cndb->dbQueryMulti($seq_cont_dates); }
		
	}
    
    /* ======= @@ Activity Log ======================= */
    $log_detail = 'Name: '.$post['title'].' [Status: '.yesNoText($post['published']).']';
	$formLog->formsUserLogs('articles_adm', $formaction, $id_content, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
	/* =============================================== */
    
	saveJsonContent();
	
	
/* ************************************************************** 
@ ADD GALLERY ITEM 
****************************************************************/
	
	$id_gall_item = '';
	
	if($post['file_type'] == 'v')
	{
		if(strlen($post['video_name']) > 5) 
		{	
			$video_name 	   = $post['video_name'];
			$pos 		      = strrpos($video_name,"="); 		
			if ($pos === false) { $myvidname = $video_name; }  
			else { $myvidname     = "http://www.youtube.com/embed/".substr($video_name,($pos+1)); }
		
		//`id_content` ,".quote_smart($id_content).", 
			$seq_post_a = "insert into `".$pdb_prefix."dt_gallery_photos`  "
			."( `title`, `filename`, `filetype`, `id_gallery_cat`, `date_posted`)  values "
			."(".$postb["video_caption"].", ".quote_smart($myvidname).", ".$postb['file_type'].", '2',".$dateCreated.")";
			
			$cndb->dbQuery($seq_post_a);
			$id_gall_item = $cndb->insertId();
			
		}
	}
	
	
	if($post['file_type'] == 'u')
	{
		if(strlen($post['photo_url_name']) > 3) 
		{	
			$prefix 		  = str_pad($id_content, 5, "0", STR_PAD_LEFT);
			$imageURL 		= $post['photo_url_name'];	
			//echo $imageURL;
			
						
			$sq_pic_rec = " select id from `".$pdb_prefix."dt_gallery_photos` where `filename` = ".quote_smart($post['photo_url_name'])."   limit 0, 1  ";
			
			$rs_pic_rec = $cndb->dbQuery($sq_pic_rec);
			if( $cndb->recordCount($rs_pic_rec) == 1)
			{
				$cn_pic_rec = $cndb->fetchRow($rs_pic_rec);
				$id_gall_item   = $cn_pic_rec[0];
			}
			else
			{
				$sqpost="insert into `".$pdb_prefix."dt_gallery_photos`  "
				."( `title`, `filename`,  `description`, `id_gallery_cat`, `date_posted`) "
				." values "
				."(".quote_smart($post['photo_url_caption']).", ".quote_smart($post['photo_url_name']).",  ".quote_smart($post['photo_url_caption']).",  ".$postb["id_gallery_cat_u"].", ".$dateCreated.")";
				//echo $sqpost; exit;
				$cndb->dbQuery($sqpost);	
				$id_gall_item = $cndb->insertId();
			}
			

			
		}
	}
	
	
	if($post['file_type'] == 'p')
	{
		
		$file_id 		=  str_pad($id_content, 4, "0", STR_PAD_LEFT); 
		$newTitle 	   = $file_id.'_'.uniqid();
		$result         = 0;
		
		
		$the_file       = basename($_FILES['myfile']['name']);
		
		if(trim($_FILES['myfile']['name']) <> '') 
		{
			$prefix 		= str_pad($id_content, 5, "0", STR_PAD_LEFT);
			$myfilename 	= trim($_FILES['myfile']['name']);
			
			$checksum1 = getChecksum($prefix);	
			$checksum2 = getChecksum($the_file);
			

			$pos 		   = strrpos($myfilename,"."); 
			if ($pos === false) { $pos = strlen($myfilename); }  
			
			
			if($post["id_gallery_cat"] == 3){} /* @member */
			
			$img_cry_name = strtotime(date('d F Y')). '_'.$checksum1 . '_'.$checksum2;
						
			$the_image 	  = imageUpload($_FILES['myfile'], $img_cry_name, UPL_GALLERY, 1 );	
			$result 	  = $the_image['result'];
			$the_file 	  = $the_image['thumb'];
			
					
			if($the_image['result'] == 1)
			{
				$seq_post_a = "insert into `".$pdb_prefix."dt_gallery_photos`  "
				."(`title`, `filename`,  `id_gallery_cat`, `date_posted`, `filesize`) values "
				."(".$postb["photo_caption"].", ".q_si($the_image['name']).", ".$postb["id_gallery_cat"].", ".$dateCreated.", ".q_si($the_image['size'])."); ";
				
				$cndb->dbQuery($seq_post_a);
				$id_gall_item = $cndb->insertId();
			}	
			
		}
		
	}

	
	if($id_gall_item <> '')
	{
		$record_stamp	 = time();
			
		$seq_pic_parent[]  = " insert IGNORE into `".$pdb_prefix."dt_gallery_photos_parent` ( `id_photo`,`id_content`,`rec_stamp` ) values (".q_si($id_gall_item).", ".quote_smart($id_content).", CURRENT_TIMESTAMP() );  ";			
		$cndb->dbQueryMulti($seq_pic_parent);
		
		/* ============================================================================================= */
		/* POPULATE -- PROJECT >>> LINKS */
		//$ddSelect->populateProjectLinks('id_gallery', $id_gall_item, $post['sector_id'], $post['project_id']);
		/* --------------------------------------------------------------------------------------------- */
		saveJsonGallery();
	}
	
/* ************************************************************** 
@ end ::: ADD GALLERY ITEM 
****************************************************************/	
//exit;
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk=<?php echo time(); ?>"; </script><?php
	
} 
	
	
	
	
	
	
	





/*********************************************************************************************
@begin :: MENUS
***********************************************************************************************/	


if ($formname=="menu_edit" or $formname=="menu_new") 
{
	
	
	
	if(isset($post['title_seo'])) 
	{ $title_seo = generate_seo_link($post['title_seo']); } else
	{ $title_seo = generate_seo_link($post['title'], '-'); }
	
	$metawords = generate_seo_link($post['metawords'], ',');
	
	
	if(isset($post['id_parent1']) and is_array($post['id_parent1']))
	{	$arr_parent 	= serialize($post['id_parent1']); 
        
        if(array_key_exists(current($post['id_parent1']), master::$menuBundle['type'][10])){            
            $post['id_type_menu'] = 10;
        }
    
    } else 
	{	$arr_parent		= NULL;	}	
	
    
	if(isset($post['article'])) {	$article=$post['article']; } else { $article=NULL; }
	
	if(isset($_POST['title'])) {$title=trim(htmlentities(addslashes($_POST['title']))); } else { $title=NULL; }
	if(isset($_POST['title_alias'])) {$title_alias=trim(htmlentities(addslashes($_POST['title_alias']))); } else { $title_alias=NULL; }
	
	//if(isset($_POST['id_type_menu'])) {$id_type_menu=$_POST['id_type_menu']; } else { $id_type_menu=NULL; }
	//if(isset($_POST['id_section'])) {$id_section=$_POST['id_section']; } else { $id_section=NULL; }
	if(isset($_POST['id_parent1'])) {$id_parent1=$_POST['id_parent1']; } else { $id_parent1=NULL; }
	if(isset($_POST['id_parent2'])) {$id_parent2=$_POST['id_parent2']; } else { $id_parent2=NULL; }
	if(isset($_POST['id_access'])) {$id_access=$_POST['id_access']; } else { $id_access=1; }
	
	
		
	if(isset($_POST['link'])) {$link=trim(htmlentities(addslashes($_POST['link']))); } else { $link=NULL; }
	if(isset($_POST['target'])) {$target=$_POST['target']; } else { $target="_self"; }
	if(isset($_POST['position'])) {$position=intval($_POST['position']); } else { $position="1"; }
			
			if(count($id_parent1)==0) { $id_parent1 = NULL; }
			if($id_access=="") { $id_access =1; }
			if($target=="") { $target ="_self"; }
	
	$title_options = '';
	if(array_key_exists('title_icon', $post))
	{ $title_options_arr = array('title_icon' => ''.$post['title_icon'].''); $title_options = serialize($title_options_arr); }
	
	$pagebanner = ""; $image_query = ""; 
	
	if ($formname=="menu_edit")
	{
        $formaction = '_edit';
		//if($pagebanner <> "") {$image_query = " `image` = '".$pagebanner."', "; }
		
		
        /*`parent`=".quote_smart($arr_parent).", `id_parent2`='".$id_parent2."', */
        
	$sqpost="update `".$pdb_prefix."dt_menu`  set `title`=".quote_smart($post['title']).", `title_alias`= ".q_si($post['title_alias']).", `id_type_menu`= ".q_si($post['id_type_menu']).", `id_section`=".q_si($post['id_section']).", `description`=".quote_smart($article).", `link`='".$link."', `target`='".$target."', `published`='".$published."',  `id_access`='".$id_access."', `seq`='".$position."', `static`='".$yn_static."', `metawords`=".quote_smart($metawords).", `quicklink`='".$yn_quicklink."', `title_seo` = ".quote_smart($title_seo)." , $image_query  `image_show`='".$image_show."', `id_portal`= ".$postb['id_portal'].", `date_update`= '".time()."' where `id`= $id";
	
	}
	elseif ($formname=="menu_new")
	{
        $formaction = '_new';
		$pagebanner = "";
		//, `description` - ".quote_smart($post['article'])."
	$sqpost="insert ignore into `".$pdb_prefix."dt_menu`  (`title`, `title_alias`, `id_type_menu`, `id_section`,  `link`, `image`, `target`, `published`, `id_access`, `seq`, `static`, `metawords`, `quicklink`, `image_show`, `id_portal`, `title_seo`, `title_options`, `date_update`, `title_brief`, `hits`) values (".quote_smart($post['title']).",  ".quote_smart($post['title_alias']).", ".q_si($post['id_type_menu']).", ".q_si($post['id_section']).", ".q_si($post['link']).", '".$pagebanner."',  '".$target."',  '".$published."',  '".$id_access."',  '".$position."', '".$yn_static."', ".quote_smart($metawords).", '".$yn_quicklink."' , '".$image_show."', ".$postb['id_portal'].", ".quote_smart($title_seo).", ".quote_smart($title_options).", '".time()."', ".quote_smart($post['title']).", '0')";
	
	//$redirect = "adm_menus.php?d=menus&op=new";
	
	}
	
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
	
	if 		( $formname=="menu_new") 		{ $id_menu = $cndb->insertId(); }
	elseif 	( $formname=="menu_edit") 		{ $id_menu = $post['id']; }
		

/* ************************************************************** 
@ update menu-to-parent 
****************************************************************/
	$sq_par_clean = " delete from `".$pdb_prefix."dt_menu_parent` where `id_menu` = '".$id_menu."' and `id_portal` = ".$postb['id_portal']." ";
	$cndb->dbQuery($sq_par_clean);
	
	if(isset($post['id_parent1']) and is_array($post['id_parent1']))
	{	
		$menu_parent 	= $post['id_parent1'];
		if(count($menu_parent)>0)
		{
			for($i=0; $i <= (count($menu_parent)-1); $i++) 
			{  
				$seq_update_menu[]  = " insert ignore into `".$pdb_prefix."dt_menu_parent` ( `id_portal`, `id_menu`, `id_parent` ) values "
				." (".$postb['id_portal'].", '".$id_menu."', '".$menu_parent[$i]."')  ";
			} 
			
			
			$cndb->dbQueryMulti($seq_update_menu);
		}
	}	

    /* ======= @@ Activity Log ======================= */
    $log_detail = 'Name: '.$post['title'].' [Status: '.yesNoText($post['published']).']';
	$formLog->formsUserLogs('menus_adm', $formaction, $id_menu, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
	/* =============================================== */
    
	saveJsonMenu();


/* ************************************************************** 
@ add menu-content 
****************************************************************/
	if(isset($post['add_content']) and $post['add_content'] == 'on') 
	{
		$url_article_link = generate_seo_link($post['article_title'], '-');
		
		$article = $post['article']; 
		if($article == '') { $article = cleanSimplex($_POST['article']); }
	
		$sqpost_cont = "insert into `".$pdb_prefix."dt_content`  
		(`id_section`, `title`, `article`, `published`, `date_created`, `approved`, `url_title_article`) values 
		(".q_si($post['id_section']).", ".q_si($post['article_title']).", ".q_si($article).", '".$published."', CURRENT_TIMESTAMP(), '1',  ".quote_smart($url_article_link)." )";
		
		
		$cndb->dbQuery($sqpost_cont);
		$id_content = $cndb->insertId();
		
		$sqpost_cont_parent = " insert IGNORE into `".$pdb_prefix."dt_content_parent` ( `id_content`, `id_parent` ) values "
				." ('".$id_content."', '".$id_menu."')  ";
		$cndb->dbQuery($sqpost_cont_parent);
		
        
        /* ======= @@ Activity Log ======================= */
        $log_detail = 'Name: '.$post['article_title'].' [Status: Yes]';
        $formLog->formsUserLogs('articles_adm', '_new', $id_content, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
        /* =============================================== */
        
		saveJsonContent();	
	}
	
	
	
	//exit;
	$redirect .= "&token=".uniqid();
	?><script language="javascript">location.href = "<?php echo $redirect; ?>&tk=<?php echo time(); ?>"; </script><?php
	
} // @end :: menus








/*
@begin: Photo Galleries
*******************************************************************************************/

if ($formname=="gal_category_new" or $formname=="gal_category_edit") 
{
	
	if(isset($_POST['id_type'])) {$id_type=$_POST['id_type']; } else { $id_type=1; }
	if(isset($_POST['id_parent1'])) {$id_parent1=$_POST['id_parent1']; } else { $id_parent1=NULL; }
	if(isset($_POST['id_parent2'])) {$id_parent2=$_POST['id_parent2']; } else { $id_parent2=NULL; }
	if(isset($_POST['title'])) {$title=htmlentities(addslashes($_POST['title'])); } else { $title=NULL; }
	if(isset($_POST['description'])) {$description=htmlentities(addslashes($_POST['description'])); } else { $description=NULL; }
	
	
	if ($formname=="gal_category_new")
	{
		$sqpost="insert into `".$pdb_prefix."dt_gallery_albums`  (`id_type`,`id_parent1`, `id_parent2`, `title`, `description`, `published`) values
		 ('".$id_type."', '".$id_parent1."', '".$id_parent2."', '".$title."', '".$description."', '".$published."')";
	}
	elseif ($formname=="gal_category_edit") 
	{
		$sqpost="update `".$pdb_prefix."dt_gallery_albums` set  `id_type` ='".$id_type."', `id_parent1` ='".$id_parent1."', `id_parent2` ='".$id_parent2."', `title` ='".$title."', `description` ='".$description."', `published` ='".$published."'  where `id`='".$id."'"; 
	}
	//echo $sqpost; exit;
	
	
	$cndb->dbQuery($sqpost);
		?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php
}



/******************************************************************
@begin :: ADMIN ACCOUNTS
********************************************************************/	


if ($formname=="admins_edit" or $formname=="admins_new") 
{
	
	
	if(isset($_POST['admintype_id'])) {$admintype_id=$_POST['admintype_id']; } else { $admintype_id=NULL; }
	if(isset($_POST['admin_fname'])) {$admin_fname=trim(htmlentities(addslashes($_POST['admin_fname']))); } else { $admin_fname=NULL; }
	if(isset($_POST['admin_email'])) {$admin_email=trim(htmlentities(addslashes($_POST['admin_email']))); } else { $admin_email=NULL; }
	if(isset($_POST['admin_uname'])) {$admin_uname=trim(htmlentities(addslashes($_POST['admin_uname']))); } else { $admin_uname=NULL; }
	if(isset($_POST['admin_pass'])) {$admin_pass=$_POST['admin_pass']; } else { $admin_pass=NULL; }
	if(isset($_POST['admin_pass_c'])) {$admin_pass_c=$_POST['admin_pass_c']; } else { $admin_pass_c=NULL; }
	
	
	
	if($admin_pass) {$md5_pword = md5($admin_pass); }
	
	
	if ($formname=="admins_new")
	{
        $formaction = '_new';
		$sqpost="insert ignore into `".$pdb_prefix."admin_accounts`  (`admin_uname`, `admin_email`, `admin_fname`, `admin_pword`, `admintype_id`, `published`) values
		 ('".$admin_uname."', '".$admin_email."', '".$admin_fname."', '".$md5_pword."', '".$admintype_id."', '".$published."')";
	}
	elseif ($formname=="admins_edit") 
	{
        $formaction = '_edit';
		if($admin_pass_c) {$change_pass = " , `admin_pword` ='".$md5_pword."'"; } else { $change_pass = ""; }
		
		$sqpost="update `".$pdb_prefix."admin_accounts` set  `admintype_id` ='".$admintype_id."', `admin_uname` ='".$admin_uname."', `admin_email` ='".$admin_email."', `admin_fname` ='".$admin_fname."',  `published` ='".$published."' $change_pass  where `admin_id`='".$id."'"; 
	}
	//echo $sqpost; exit;
	
    $cndb->dbQuery($sqpost);
    
    if 		( $formname=="admins_new") 		{ $post_id = $cndb->insertId(); }
	elseif 	( $formname=="admins_edit") 	{ $post_id = $post['id']; }
    
     /* ======= @@ Activity Log ======================= */
    $log_detail = 'Name: '.$admin_email.' [Status: '.yesNoText($published).']';
	$formLog->formsUserLogs(''.$formname.'_adm', $formaction, $post_id, $log_detail . ' [By: '.$sys_us_admin['adminemail'].']' );
	/* =============================================== */
	
	
	
	?><script language="javascript">location.href = "<?php echo $redirect; ?>"; </script><?php exit;	

}


	
if ($formname=="admin_log") 
{
	
	if(isset($_POST['admin_fname'])) {$admin_fname=$_POST['admin_fname']; } else { $admin_fname=NULL; }
	if(isset($_POST['admin_email'])) {$admin_email=$_POST['admin_email']; } else { $admin_email=NULL; }
	if(isset($_POST['admin_uname'])) {$admin_uname=$_POST['admin_uname']; } else { $admin_uname=NULL; }
	if(isset($_POST['admin_pword'])) {$admin_pword=$_POST['admin_pword']; } else { $admin_pword=NULL; }
	
	if(isset($_POST['admin_pword'])) {$md5_pword=md5($_POST['admin_pword']); }
	
	
	//echo $md5_pword; exit;
	
	/*$sqpost= "SELECT mrfc_admin_accounts.admin_uname, mrfc_admin_accounts.admin_pword, mrfc_admin_accounts.admin_fname,  "; 
	$sqpost.= "mrfc_admin_accounts.admintype_id, mrfc_admin_accounts.admin_id, mrfc_admin_types.title, "
		." mrfc_admin_accounts.admin_email  FROM mrfc_admin_accounts  "; 
	$sqpost.= "INNER JOIN mrfc_admin_types ON mrfc_admin_types.admintype_id=mrfc_admin_accounts.admintype_id  "; 
	$sqpost.= " where  mrfc_admin_accounts.admin_uname=".quote_smart($admin_uname)." and mrfc_admin_accounts.admin_pword='".$md5_pword."' and mrfc_admin_accounts.published = 1";*/
	
	$sqpost= "SELECT `".$pdb_prefix."admin_accounts`.*, `".$pdb_prefix."admin_types`.`title` FROM `".$pdb_prefix."admin_accounts` INNER JOIN `".$pdb_prefix."admin_types` ON (`".$pdb_prefix."admin_accounts`.`admintype_id` = `".$pdb_prefix."admin_types`.`admintype_id`) WHERE (`".$pdb_prefix."admin_accounts`.`admin_email` =".quote_smart($admin_uname)." AND `".$pdb_prefix."admin_accounts`.`admin_pword` = '".$md5_pword."' AND `".$pdb_prefix."admin_accounts`.`published` =1);"; 
	//echo $sqpost; exit;
	
	$cncheck= $cndb->dbQuery($sqpost);
	$cnCnt= $cndb->recordCount($cncheck);
	
	if ($cnCnt==1) {//$username= substr($rscheck['email'], 0, stripos($rscheck['email'],"@"));
		$rscheck = $cndb->fetchRow($cncheck, 'assoc');
		
		
		$admin_id 	= $rscheck['admin_id'];
		$adminname 	= $rscheck['admin_fname'];
		$adminuser 	= $rscheck['admin_uname'];
		$actype 	= $rscheck['title'];
		$actype_id 	= $rscheck['admintype_id'];
		
		$adm_sess['adminname'] 	= $adminname;
		$adm_sess['adminemail'] = $rscheck['admin_email'];
		$adm_sess['adminuser'] 	= $adminuser;
		$adm_sess['actype_id'] 	= $actype_id;
		$adm_sess['actype'] 	= $actype;
		$adm_sess['admin_id'] 	= $admin_id;
		$adm_sess['admin_lastlog'] = $rscheck['date_lastlog'];
		
		/*$sq_datelog	= "update `".$pdb_prefix."admin_accounts`  set `date_lastlog` = '".time()."' where `admin_id` = ".quote_smart($admin_id)." ";
		$cndb->dbQuery($sq_datelog);*/
		
		$_SESSION['sess_mrfc_admin'] = $adm_sess;
		
		echo "<script language=\"javascript\">location.href=\"home.php\"; </script>";
		
	} else {
		//exit;
		echo "<script language=\"javascript\">history.back(-1); alert(\"Please confirm your login details.\");</script>";
	}
}
	
	
	

?>
