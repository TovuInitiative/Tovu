

<div>
<?php include("includes/nav_crumbs.php"); ?>
</div>

<style type="text/css">
    .tableContainer { width: 100%; height: auto; min-height: 300px; overflow: hidden;  }
</style>
<div class="page_width">
<div class="padd15_t">
<div class="subcolumns clearfix bg-white" style="overflow:visible;">

	<div class="col-md-1"></div>
	
	<div class="col-md-10">
		<div class="padd20_t" style="min-height:300px;">
		
			<div id="wrapper" class="">
			
				
	<?php 
	//displayArray($request);
	$highlite_img = $highlite_cls = $highlite_flash = '';
				
	//$dispData->siteDocuments();
			
	$file_arr 	    = master::$listResources['full'][$file_id]; 
	//displayArray($file_arr);
	$file_id         = $file_arr['cont_id'];
	$file_title      = $file_arr['cont_title'];
	//$file_type 	   = $file_arr['filetype'];
	$file_name       = $file_arr['cont_name'];
	$file_date       = $file_arr['cont_date'];	
	$file_desc		= $file_arr['cont_brief'];
	//$file_desc	   = string_truncate(strip_tags_clean($file_arr['cont_brief']), 150);	

	$file_cat        = $file_arr['cont_parent_type'];
	$file_cat_id     = $file_arr['cont_parent_id'];
	$file_seo        = $file_arr['cont_seo'];
    $item_cover	      = clean_output($file_arr['cont_cover']);
	
	$file_tags        = ($file_arr['resource_tags'] <> '') ? explode(',',$file_arr['resource_tags']): array() ;//.','.$file_arr['devolved_functions'];
	
	//$file_tags[]     = $file_arr['devolved_functions'];			
	
	$file_tag_links = array();
	if(count($file_tags)>0){
		foreach($file_tags as $tag_val){
			if($tag_val <> ''){
				$file_tag_links[] = '<a href="library/?keyword='.$tag_val.'&county=&dir_year=&dir_type=&dir_apply=Search&formname=fm_dir_search"><em>'.$tag_val.'</em></a>';
			}
		}
	}
		
	$file_video        = ''; //$file_arr['cont_video'];

	if($file_video <> '') { 

			$v_insert 		= strrpos($file_video, '/');
			$v_pic			= substr($file_video, $v_insert);
			$v_code			= substr($file_video, $v_insert+1);

		$file_video = ' <span class="padd15_lX postDate nocaps txt12"> | <a data-href="ajforms.php?d=vida&vw='.$v_code.'&parent='.$file_title.'" rel="modal:open"><i class="fa fa-video-camera"></i></a> </span>'; 
	}

	if($file_cat == '_link') { 
		$parent_name   = master::$menusFull[$file_cat_id]['title'];				
	}

	if($file_cat == '_cont') { 
		$parent_name   = master::$contMain['full'][$file_cat_id]['title'];				
	}

	$item_cat 	  = ' &nbsp;<span class="postDate nocaps txt12"> '.$parent_name.' </span>'; 

	$date_spotlite = 0;
	if($file_date > $date_spotlite) 
	{   //$highlite_img = " <span style=\"background:url(image/icons/icon-newb.png) no-repeat 50% 100%; width:27px;height:16px;display:inline-block;\">&nbsp;</span> "; 
		//$highlite_cls = ""; 
		//$highlite_flash = " rel=\"flashfg[red]\""; 
	}

	$item_protocol = substr($file_name,0,3);
	//$item_ext      = strtolower(substr(strrchr($file_name,"."),1));
	$item_ext = pathinfo($file_name, PATHINFO_EXTENSION);				
				
	$cont_type = ($file_arr['cont_type'] <> '') ? $file_arr['cont_type'] : strtoupper($item_ext);
			
	//EXTERNAL
	if($item_protocol == 'htt' or $item_protocol == 'www' or $item_protocol == 'ftp' or $item_protocol == 'ww2') 
	{ $link = ' href="'.$file_name.'" ';  } else 
	{ 
		$link = ' href="'.CONF_LINK_DOWNLOAD.'?f='.$file_seo.'" '; //"?res_id=".$file_id; 
		//$link = ' data-href="ajforms.php?d=docfetch&vw='.$file_seo.'&parent='.$file_title.'" rel="modal:open" ';
		
		if($us_signed_in == true) { $link = ' href="'.CONF_LINK_DOWNLOAD.'?f='.$file_seo.'" ';  }
	}	

	$item_link = "<a $link class=\"$item_ext $highlite_cls\" $highlite_flash target=\"_blank\" title=\"Click to download\">".$highlite_img.$file_title.$item_cat."</a> ".$file_video;

	if($us_signed_in == true) {
	$item_fetch = "<a $link class=\"btn btn-primary $item_ext\" target=\"_blank\" title=\"Click to download\">Download</a> ";
	} else {
	$item_fetch = '<p><a data-href="ajforms.php?d=docfetch&vw='.$file_seo.'&parent='.$file_title.'" rel="modal:open"><i class="fa fa-file"></i>  Send Download link to my Email</a>  &nbsp; | &nbsp; <a data-href="ajforms.php?d=account" id="header-login" title="Sign In / Sign Up" rel="modal:open"><i class="fa fa-user"></i>&nbsp; Login / Signup to Download</a></p>';
		
	}
	//<a href="viewer.php?d=docfetch&vw='.$file_seo.'&parent='.$file_title.'" class="btn btn-primary"> View Resource</a>  &nbsp; | &nbsp;
	$item_fetch = '<p> <a '.$link.' target="_blank" class=" btn btn-primary"> Download</a></p>';
	
	$file_cover = '';	
	if($item_cover <> '' and (file_exists(UPL_COVERS.$item_cover)))
	{
		
		$file_cover	  = '<tr>
					<td >Cover Image</td>
					<td><span class="carChopa" style="width:70px;max-height:70px;"><img src="'.DISP_COVERS.$item_cover.'" alt="" /></span></td>
				</tr>';
		
	}		
	//$fcontent .=  "<li>".$item_link."</li>";
    //echo $item_ext;
                
                
/* ============================================================================== 
/*	@RATING SCRIPT
/* ------------------------------------------------------------------------------ */			
	//require('assets/ajaxrating/ratingdraw.php'); 			
	$item_rating  = '<span class="btn btn-infoX txt11 noborder nohover">'. rating_bar($file_id) . '</span>';	
                
                
	echo display_PageTitle($file_title . '');

                
                
/* ============================================================================== 
/*	DISPLAY IMAGE FILE 
/* ------------------------------------------------------------------------------ */	               
    if(in_array($item_ext, $imageMime))
	{           
        $res_link	  = DISP_FILES.''.$file_name;			
		$res_result = '<div class="padd15_0 txtcenter"><object data="'.$res_link.'" type="image/'.$item_ext.'" style="width:auto; height:auto; max-width:100%;">
		<embed src="'.$res_link.'" type="image/'.$item_ext.'" style="width:auto; height:auto; max-width:100%;"/>
		<p>It appears you do not have IMG support in this web browser. <a '.$link.'>Click here to download the document.</a></p>
		</object> </div>';
		echo $res_result;	        
    }

/* ============================================================================== 
/*	DISPLAY PDF FILE 
/* ------------------------------------------------------------------------------ */				
	if($item_ext == 'pdf')
	{				
		$res_link	  = DISP_FILES.''.$file_name;			
		$res_result = '<div class="padd15_0"><object data="'.$res_link.'#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" style="width:100%; height:100%; min-height:500px;">
		<!-- support older browsers  width="900" height="800"-->
		<embed src="'.$res_link.'" type="application/pdf" style="width:100%;  height:100%; min-height:500px;"/>
		<!-- For those without native support, no pdf plugin, or no js -->
		<p>It appears you do not have PDF support in this web browser. <a '.$link.'>Click here to download the document.</a></p>
		</object> </div>';
		echo $res_result;	
	}

		//echobr($item_ext);		
/* ============================================================================== 
/*	DISPLAY EXCEL FILE CONTENT
/* ------------------------------------------------------------------------------ */				
	if($item_ext == "csv" or $item_ext == "ods")
	{
		include 'classes/PHPExcel/IOFactory.php';
		$inputFileName    = 'assets/file/'.$file_name; 
		$readFile         = false;
		//  Read your Excel workbook
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			$readFile = true;
		} catch (Exception $e) {
			
		}

		if($readFile)
		{
		$rowLimit = '';
		/*Table used to display the contents of the file*/
		echo '<div class="tableContainer padd20_b">';
		
		//  Get worksheet dimensions
		$sheet            = $objPHPExcel->getSheet(0);
		$highestRow       = $sheet->getHighestRow();
		$highestColumn    = $sheet->getHighestColumn();
		if($highestRow > 100) { $highestRow = 100; $rowLimit = '<div class="note">Showing only top 100 records.</div>'; }	
		 
        $highestColumn = 'AZ';
		
		echo $rowLimit . '<table class="table table-collapse display nowrap">';	
		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row ++) {
			if($row == 1) { echo '<thead>'; }
			/*Read a row of data into an array*/
			$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, false, false, true);
            
			echo '<tr>';
			$v_td = ($row == 1) ? 'th' : 'td';
			
			foreach(current($rowData) as $k=>$v){
                $cellval = (strlen(trim($v)) > 0) ? trim($v) : '';
				//if(strlen(trim($v)) > 0){
					echo '<'.$v_td.'>'.$cellval.'</'.$v_td.'>';
				//}				
			}
			echo '</tr>';
			if($row == 1) { echo '</thead><tbody>'; }
		}
		
		echo '</tbody></table></div>';
		}
	}			
				
	

/* ============================================================================== 
/*	DISPLAY VIDEO FILE
/* ------------------------------------------------------------------------------ */			
	if($item_ext == "mp4")
	{ 
	$res_vid	  = SITE_DOMAIN_LIVE.'image/video/'.$file_name;			
	?>
		<div class="padd15_0">
			<div class="vid">
				<video style="width:100%;" controls>
				  <source src="<?php echo $res_vid; ?>" type="video/mp4">
				  Your browser does not support HTML5 video.
				</video>
			</div>
		</div>
<?php } 
                
                
                
/* ============================================================================== 
/*	DISPLAY PPT FILE 
/* ------------------------------------------------------------------------------ */				
	if($item_ext == "xlsx" or $item_ext == "xls" or $item_ext == 'ppt' or $item_ext == "pptx" or $item_ext == "pps" or $item_ext == "ppsx" or $item_ext == "doc" or $item_ext == "docx")
	{				
		$res_link	  = urlencode(DISP_FILES.''.$file_name);        
        
		$res_result = '<div class="padd15_0"><iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.$res_link.'" width="100%" height="565px" frameborder="0"></iframe>
 </div>';
		echo $res_result;	
	}                
                
       /* @@ CONTENT COMMITTEE && COUNTY */    
        $contTags_arr           = $dispDt->get_resourceParents($file_id); //displayArray($contTags_arr);
        $contTags_committee     = (array_key_exists('committee', $contTags_arr)) ? implode($contTags_arr['committee'], '; ') : '';    
        $contTags_county        = (array_key_exists('county', $contTags_arr)) ? implode($contTags_arr['county'], '; ') : '';    

        /* @@ COMMITTEE TO CONTENT*/     
            if($contTags_committee <> ''){
                $contTags_committee = '<div class="txtgraylight txt11_fx">Sector: '.$contTags_committee.'</div>';
            }
        /* -------------------- */

        /* @@ COUNTY TO CONTENT*/  
            if($contTags_county <> ''){
                $contTags_county = '<div class="txtgraylight txt11_fx">County: '.$contTags_county.'</div>';
            }    
        /* -------------------- */         
                
?>
			
			<div class="padd15_t">
			
			<div class="row padd5_t marg0_5" style="background: #f5f5f5">
                <div class="col-md-6"><span class="postDate nocaps"><i class="fa fa-clock-o"></i> Updated on: <?php echo date('M d, Y', $file_date); ?></span></div>
                <div class="col-md-6 txtright"><?php echo $item_rating; ?></div>
            </div>	
		
			<table class="table">
				<!--<tr>
					<td >Publisher</td>
					<td><?php //echo $file_arr['cont_author']; ?></td>
				</tr>-->
				<tr>
					<td style="width:150px;">Year of Publication</td>
					<td><?php echo $file_arr['year_published']; ?></td>
				</tr>
				<!--<tr>
					<td >Category</td>
					<td><?php //echo $file_arr['cont_type']; ?></td>
				</tr>
				<tr>
					<td >County</td>
					<td><?php //echo $file_arr['county']; ?></td>
				</tr>-->
				
				<tr>
					<td >Description</td>
					<td><?php echo clean_output($file_arr['cont_brief']); ?></td>
				</tr>
				<tr>
					<td >Tags</td>
					<td>
                       <?php                         
                        echo $contTags_committee;
                        echo $contTags_county;
                        echo implode(', ', $file_tag_links); 
                        ?>					
					</td>
				</tr>
				<?php 
				echo $file_cover;
				if($file_video <> '') { ?>
				<tr>
					<td ></td>
					<td><?php //echo '<iframe src="http://www.youtube.com/v/'.$v_code.'?fs=1&amp;autoplay=0" style="width:100%; height:250px;"></iframe>'; ?></td>
				</tr>
				<?php } ?>
				<tr>
					<td ></td>
					<td><?php echo $item_fetch; ?></td>
				</tr>
			</table>
			</div>
			
			<?php include("includes/nav_social_share.php"); ?>
		
				
				
			</div>
			
		</div>
	</div>
	
	<div class="col-md-1">
		<div class="padd15_l">
				
		<?php //echo display_PageTitle('Right Bar', 'h3'); ?>
		<?php //include("includes/nav_downloads-box.php"); ?>		
		<?php //include("includes/nav_social_feeds_tabs.php"); ?>			
			
		</div>		
	</div>
	
</div>
</div>
</div>







