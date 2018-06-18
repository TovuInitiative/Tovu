<?php
$dispData->siteDocuments();

$item_box 		= '';
$items_per_page  = 10;
$truncLength    = 250;


$resSearch_cont = array();
$resSearch_docs = array();

$limit = "";

$resSearch_num = 0;

define('QRY_MENUCONTENTSB', "SELECT DISTINCT `mrfc_dt_content`.*, `mrfc_dt_menu`.`title` AS `menu`, `mrfc_dt_content`.`date_created` , `mrfc_dt_content_parent`.`county_id`
    , `mrfc_dt_content_parent`.`committee_id`
    FROM `mrfc_dt_content`
    LEFT JOIN `mrfc_dt_content_parent`  ON (`mrfc_dt_content`.`id` = `mrfc_dt_content_parent`.`id_content`)
    LEFT JOIN `mrfc_dt_menu` ON (`mrfc_dt_content_parent`.`id_parent` = `mrfc_dt_menu`.`id`)
    LEFT JOIN `mrfc_reg_county`  ON (`mrfc_dt_content_parent`.`county_id` = `mrfc_reg_county`.`county_id`)
    LEFT JOIN `mrfc_app_committee`  ON (`mrfc_dt_content_parent`.`committee_id` = `mrfc_app_committee`.`committee_id`) ");


$sqSearch_cont_crit_arr = array();
$sqSearch_cont_crit_one = "";


/*$sqSearch_cont_crit_flat = " CONVERT(CONCAT(`".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`article`, `".$pdb_prefix."dt_content`.`article_keywords`,  `".$pdb_prefix."dt_menu`.`title`, `".$pdb_prefix."reg_county`.`county`, `".$pdb_prefix."app_committee`.`title`) USING latin1) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_content`.`published` = '1' and  `".$pdb_prefix."dt_content`.`approved` = '1' ";*/

$sqSearch_cont_crit_flat = " CONCAT_WS(' ', `".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`article`, `".$pdb_prefix."dt_content`.`article_keywords`,  `".$pdb_prefix."dt_menu`.`title`, `".$pdb_prefix."reg_county`.`county`, `".$pdb_prefix."app_committee`.`title`)  like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_content`.`published` = '1' and  `".$pdb_prefix."dt_content`.`approved` = '1' ";


/*if($request['searchcounty'] == '' and !isset($request['searchsector'])){
    $sqSearch_cont_crit_one  = $sqSearch_cont_crit_flat;
}

if($request['searchcounty'] <> '' and !isset($request['searchsector'])){ 
    $sqSearch_cont_crit_one =   $sqSearch_cont_crit_flat . " and  `mrfc_dt_content_parent`.`county_id` = ".q_si($request['searchcounty'])." ";
}

if(isset($request['searchsector']) and $request['searchcounty'] == ''){
    $sqSearch_cont_crit_one =   $sqSearch_cont_crit_flat . " and  `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}

if($request['searchcounty'] <> '' and count($request['searchsector']) > 0){
    $sqSearch_cont_crit_one =   $sqSearch_cont_crit_flat . " and  `mrfc_dt_content_parent`.`county_id` = ".q_si($request['searchcounty'])
                      ." OR " . $sqSearch_cont_crit_flat . " and  `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}*/





$sqSearch_cont_crit_one  = $sqSearch_cont_crit_flat;
$sqSearch_cont_crit = "";
//$sqSearch_cont_crit_arr[] = " `".$pdb_prefix."dt_menu`.`title` like ".q_si($request['searchtext'], 1)." ";

/*if($request['searchcounty'] <> ''){
    $sqSearch_cont_crit_arr[] = "  `mrfc_dt_content_parent`.`county_id` = ".q_si($request['searchcounty'])." ";
}

if(isset($request['searchsector']) and isset($request['searchsector'])){
    $sqSearch_cont_crit_arr[] = "  `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}

if(count($sqSearch_cont_crit_arr) > 0 ) {
    $sqSearch_cont_crit .= " HAVING  ". implode(' AND ', $sqSearch_cont_crit_arr);
}*/
    
/*
$sqSearch_cont = QRY_MENUCONTENTSB . "  WHERE "
			." CONVERT(CONCAT(`".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`article`, `".$pdb_prefix."dt_content`.`article_keywords`, `".$pdb_prefix."dt_menu`.`title`) USING latin1) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_content`.`published` = '1' and  `".$pdb_prefix."dt_content`.`approved` = '1'  ".$sqSearch_cont_crit."   " //GROUP BY `mrfc_dt_content`.`id`
			. $limit;
*/


$sqSearch_cont = QRY_MENUCONTENTSB . "  WHERE "
			."  ".$sqSearch_cont_crit_one." ".$sqSearch_cont_crit."  " //GROUP BY `mrfc_dt_content`.`id`
			. $limit;
//echobr($sqSearch_cont);
$rsSearch_cont = $cndb->dbQuery($sqSearch_cont);	//displayArray($result_Cont);
    while($cnSearch_cont = $cndb->fetchRow($rsSearch_cont, 'assoc'))
        {
            
        
            //$rec_date   = date('Y-m-d', strtotime($cnSearch_cont['date_created'])); //
            $rec_date   = strtotime($cnSearch_cont['date_created']); //
            $rec_id     = $cnSearch_cont['id'];
            //$resSearch[$resSearch_num][$rec_date]['cont'][$rec_id] 	= $rec_id;
        
            //if(!array_key_exists($rec_id, $resSearch_cont)) {
                
                $resSearch_cont[$rec_id] = $rec_id;

                $resSearch['cont_'.$rec_id]    = array(
                                    'date' => $rec_date,
                                    'type' => 'cont',
                                    'id' => $rec_id
                                ); //[$rec_date]['cont'][$rec_id] 	= $rec_id;

                //
                $resSearch_num += 1;
            //}
        }

//displayArray($resSearch_cont);






$sqSearch_docs_crit_arr = array();
$sqSearch_docs_county = "";
$sqSearch_docs_sector = "";

//$sqSearch_docs_crit_flat = " CONVERT(CONCAT(`".$pdb_prefix."dt_downloads`.`resource_title`, `".$pdb_prefix."dt_downloads`.`resource_description`) USING latin1) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_downloads`.`published` = '1' ";
$sqSearch_docs_crit_flat = " CONCAT_WS(`".$pdb_prefix."dt_downloads`.`resource_title`, `".$pdb_prefix."dt_downloads`.`resource_description`, `".$pdb_prefix."dt_downloads`.`resource_file`, `".$pdb_prefix."dt_downloads`.`resource_tags` , `".$pdb_prefix."dt_menu`.`title` , `".$pdb_prefix."dt_content`.`title` , `".$pdb_prefix."reg_county`.`county`, `".$pdb_prefix."app_committee`.`title`) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_downloads`.`published` = '1' ";
$sqSearch_docs_crit_one = "";
$sqSearch_docs_crit_two = "";
$sqSearch_docs_crit = "";
$add_or = false;

//$sqSearch_docs_crit = " HAVING   ";
//$sqSearch_docs_crit_arr[] = " `".$pdb_prefix."dt_menu`.`title` like ".q_si($request['searchtext'], 1)." ";

$sqSearch_docs_crit_one  = $sqSearch_docs_crit_flat;

/*if($request['searchcounty'] == '' and !isset($request['searchsector'])){
    $sqSearch_docs_crit_one  = $sqSearch_docs_crit_flat;
}*/

/*if($request['searchcounty'] <> '' and !isset($request['searchsector'])){ //
    $sqSearch_docs_crit_one =   $sqSearch_docs_crit_flat . " and  `mrfc_dt_downloads_parent`.`county_id` = ".q_si($request['searchcounty'])." ";
    $sqSearch_docs_crit     .= " `mrfc_dt_downloads_parent`.`county_id` = ".q_si($request['searchcounty'])." "; 
}

if(isset($request['searchsector']) and $request['searchcounty'] == ''){
    $sqSearch_docs_crit_one =   $sqSearch_docs_crit_flat . " and  `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
    $sqSearch_docs_crit_arr[] = "  `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}

if($request['searchcounty'] <> '' and isset($request['searchsector'])){
    $sqSearch_docs_crit_one =   $sqSearch_docs_crit_flat . " and  `mrfc_dt_downloads_parent`.`county_id` = ".q_si($request['searchcounty'])
                      ." OR " . $sqSearch_docs_crit_flat . " and  `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
    
    
    $sqSearch_docs_crit_two = " OR " . $sqSearch_docs_crit_one . $sqSearch_docs_sector;
}*/

if(count($sqSearch_docs_crit_arr) > 0 ) {
    $sqSearch_docs_crit = " HAVING ". implode(' AND ', $sqSearch_docs_crit_arr);
}


$sqSearch_docs = " SELECT `mrfc_dt_downloads`.`resource_id` , `mrfc_dt_downloads`.`date_created`, `mrfc_dt_downloads_parent`.`county_id`, `mrfc_dt_downloads_parent`.`committee_id` FROM `mrfc_dt_downloads`
    INNER JOIN `mrfc_dt_downloads_parent`  ON (`mrfc_dt_downloads`.`resource_id` = `mrfc_dt_downloads_parent`.`resource_id`) 
    LEFT JOIN `mrfc_dt_menu` ON (`mrfc_dt_downloads_parent`.`id_menu` = `mrfc_dt_menu`.`id`)
    LEFT JOIN `mrfc_dt_content` ON (`mrfc_dt_downloads_parent`.`id_content` = `mrfc_dt_content`.`id`)
    LEFT JOIN `mrfc_reg_county` ON (`mrfc_dt_downloads_parent`.`county_id` = `mrfc_reg_county`.`county_id`)
    LEFT JOIN `mrfc_app_committee` ON (`mrfc_dt_downloads_parent`.`committee_id` = `mrfc_app_committee`.`committee_id`)
        WHERE "
			." ".$sqSearch_docs_crit_one."  " 
			. $limit;
//echobr($sqSearch_docs);

$rsSearch_docs = $cndb->dbQuery($sqSearch_docs);	//displayArray($result_Cont);
    while($cnSearch_docs = $cndb->fetchRow($rsSearch_docs, 'assoc'))
        {
            //$rec_date   = date('Y-m-d', strtotime($cnSearch_docs['date_created'])); //
            $rec_date   = strtotime($cnSearch_docs['date_created']); //
            $rec_id     = $cnSearch_docs['resource_id'];
            //$resSearch[$resSearch_num][$rec_date]['docs'][$rec_id] 	= $rec_id;
        
            if(!array_key_exists($rec_id, $resSearch_docs)) {
                
                $resSearch_docs[$rec_id] = $rec_id;
                
                $resSearch['docs_'.$rec_id]    = array(
                                    'date' => $rec_date,
                                    'type' => 'docs',
                                    'id' => $rec_id
                                );
                //$resSearch_docs[$rec_id] = $rec_id;
                $resSearch_num += 1;
            }
        }



array_sort_by_column($resSearch, 'date', SORT_DESC);
//echobr($resSearch_num);



/*$dispData->siteContent('','','','y', $searchtext);
$resultSite = master::$contMainSummary;

$url 	= DOMAIN_ACT.'json.news.search.php?s='.$searchtext.'';
$resultJson = json_decode(file_get_contents($url), true);

$searchResults  = array_merge_recursive($resultSite, $resultJson['content']);	//$result;
array_sort_by_column($searchResults, 'cont_date', SORT_DESC);

$numrows = count($searchResults);*/




/*
$jsonContArray  = master::$contMain['full'];

$terms   		= explode(" ", $searchtext);

$searchResults = array_filter($jsonContArray, function ($x) use ($terms){
	foreach($terms as $term){
		if (stripos($x["title"], $term) ||
			stripos($x["article"], $term) )
		{
			return true;
		}
	}
	return false;
});


*/


//displayArray($resSearch);

$searchResults   = $resSearch;


$numrows = count($searchResults);
$numrows = count($resSearch_cont) + count($resSearch_docs);

if($numrows > 0)
{

/*******************************************************
  @@ PAGINATOR
====================================================== */	
$pages = new Paginator;
$pages->items_total = $numrows;
$pages->mid_range = 7; 
$pages->custom_ipp = $items_per_page;
$pages->paginate();

$pages_head="<div class=\"paginator\" style=\"margin-top:20px;\">".$pages->display_pages()."<span class=\"pagejump\">".$pages->display_jump_menu()."</span></div>";

/* ====================================================== */


$page_to_display  = $pages->current_page - 1;
$section_pages 	= array_chunk($searchResults, $items_per_page, true);

if(count($section_pages))
{
	$contPages 		= $section_pages[$page_to_display];



	foreach ($contPages as $contSource) 						
	{	
        //displayArray($contSource); exit;
        if($contSource['type'] == 'cont') 
        {
            if(array_key_exists($contSource['id'], $resSearch_cont)) {
                //$resSearch_cont[$contSource['id']] = $contSource['id'];
               // echobr($contSource['id']);
                $contArray      = master::$contMain['full'][$contSource['id']];


                $cont_id			= $contArray['id'];

                $cont_date	 	  = date("M d Y", $contArray['dated']);
                $cont_title		 = clean_output($contArray['title']);

                $cont_article 		= clean_output($contArray['article']);
                //$cont_brief 	= smartTruncateNew(strip_tags_clean($cont_article),$truncLength); 

                $cont_brief	 	  = strip_tags_clean($cont_article);
                $cont_type		  = ucwords(clean_output($contArray['parent']));

                $cont_seo_url	 = $contArray['link_seo']; 
                $cont_section	 = $contArray['id_section'];
                $cont_location	= $contArray['location'];


                $res_text = $cont_brief;	 	

                if($cont_brief <> '')
                { 
                    $search_text_position = strripos($cont_brief, html_entity_decode($searchtext));
                    $dis_start = ( $search_text_position > 150) ? $search_text_position - 50  : 0;

                    //$res_text  = smartTruncateNew($res_text, 150, " ", $dis_start, " ...", "yes");
                    $res_text  = string_truncate($res_text, 250, " ", " ...", "yes", 0, $dis_start);
                    $res_text  = '<span class="scrollDate">'.$cont_date.' -&nbsp;</span>'. preg_replace("/($searchtext)/i","<span style='font-weight:normal;background-color:#CCFF00'>\${1}</span>", $res_text);
                }


                if($cont_section == 12 and $cont_location <> '') {
                    $cont_link	  = $contArray['location'];
                    $res_text 	= '<div class="trunc400" style="display:none"><span class="scrollDate">'.$cont_date.' -&nbsp;</span> '.$cont_brief.' &nbsp;</div>'; 
                } else {
                    //$cont_link		  = display_linkArticle($cont_id, $cont_seo_url);
                    $cont_link		  = SITE_DOMAIN_LIVE . $cont_id . '/' .$cont_seo_url. '/'; 
                    //$cont_brief_plain 	= smartTruncateNew(strip_tags_clean($cont_article),$truncLength); 
                }


                //$cont_link		  = SITE_DOMAIN_LIVE . $cont_id . '/' .$article_seo_url. '/'; 




                $headLinkIcon       = '';

                $cont_section 	   = "<div class='txtorange txt11'>(<em>$cont_type</em>) </div>";


    /*-------------------------------------------------------------------------------------------------------
    @CONTENT IMAGE
    -------------------------------------------------------------------------------------------------------*/

    $image_disp = ''; $image_link = '';

    if(preg_match('/<img[^>]+\>/i',$cont_article,$regs)) { 
        $image_item = $regs[0];  $pic_small  = autoThumbnail($image_item); 	
        if($pic_small <> '')  { $image_link		= '<img src="'.$pic_small.'" alt="'.$cont_title.'" />'; } 
    } 
    else { $image_link  = getContGalleryPic($cont_id, $cont_title); }

    if($image_link <> '') 
    { $image_disp		= '<span class="bitChopaWrap" style="display:none">'.$image_link.'</span>'; } 

    /*-------------------------------------------------------------------------------------------------------
    @@ END: CONTENT IMAGE
    -------------------------------------------------------------------------------------------------------*/ 

                 /* @@ CONTENT COMMITTEE && COUNTY */    
                $contTags_arr           = $dispDt->get_contentParents($cont_id, 1); //displayArray($contTags_arr);
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
        
                
                $item_box .= '<li>
                <div class="padd10_0">'.$image_disp .'<a href="'.$cont_link.'" class="'.$headLinkIcon.' txt15X bold" target="_blank">'.$cont_title.'</a><br>
                    '.$cont_section.'
                    '.$res_text.'
                    '.$contTags_committee.'
                    '.$contTags_county.'
                    &nbsp; &nbsp;</div>
                </li>';
            
            }
            
        }   
        
        elseif($contSource['type'] == 'docs') {
            
            if(array_key_exists($contSource['id'], $resSearch_docs)) {
               // $resSearch_docs[$contSource['id']] = $contSource['id'];
            
                $contArray = master::$listResources['full'][$contSource['id']];
            
                $item_id			= $contArray['cont_id'];
                $item_title		 = clean_output($contArray['cont_title']);
                $item_brief		 = strip_tags_clean(clean_output($contArray['cont_brief']));
                $item_brief	     = string_truncate($item_brief, 200, ' ', '...'); 
                $item_author	    = clean_output($contArray['cont_author']);
                $item_lang	      = clean_output($contArray['cont_language']);
                $item_parent_type		  = $contArray['cont_parent_type']; 
                $item_parent_id		  = $contArray['cont_parent_id']; 
                $item_county         = '';
                //$item_county	      = clean_output($contArray['county']);
                //$item_county	      = ($contArray['county'] <> '') ? ' ('.clean_output($contArray['county']).')' : '';
                $item_pub_year	      = clean_output($contArray['year_published']);

                $item_cover	      = clean_output($contArray['cont_cover']);

                if($item_parent_type == '_link') { 
                    $parent_name   = master::$menusFull[$item_parent_id]['title'];		
                    $parent_seo   = master::$menusFull[$item_parent_id]['menu_seo_name'];
                }

                if($item_parent_type == '_cont') { 
                    $parent_name   = master::$contMain['full'][$item_parent_id]['title'];	
                    $parent_seo   = master::$contMain['full'][$item_parent_id]['link_seo'];			
                }
                //echobr($parent_name);
                $item_parent	    = clean_output($parent_name);
                $item_parent_label = '<span class="txtgreen txt12" title="Section">'. $item_parent . '</span>';

                $item_cat 	       = ' &nbsp;<span class="postDate nocaps txt12">('.$parent_name.')</span> ';


                $item_date		  = date("Y, M d", strtotime($contArray['cont_date']));
                $item_url		  = $contArray['cont_seo']; 

                $item_name		  = $contArray['cont_name']; 

                //$item_link 		  = '<a href="lib.php?f='.$item_url.'" target="_blank" class="'.$item_ext.'">'.$item_title.'</a>';

                $file_name       = $contArray['cont_name'];
                $item_protocol   = substr($file_name,0,3);
                $item_ext        = strtolower(substr(strrchr($file_name,"."),1));

                /* EXTERNAL */
                if($item_protocol == 'htt' or $item_protocol == 'www' or $item_protocol == 'ftp' or $item_protocol == 'ww2') 
                { $link = ' href="'.$file_name.'" ';  } else 
                { 
                    //$link = ' href="'.CONF_LINK_DOWNLOAD.'?f='.$item_url.'" '; 
                    $link = ' data-href="ajforms.php?d=docfetch&vw='.$item_url.'&parent='.$item_title.'" rel="modal:open" ';
                    $link = ' href="resource.php?com='.$seo_name.'&id='.$item_id.'" ';
                    $link = ' href="resource/'.$item_url.'" ';

                }	
            
                $item_extX = '';

                $highlite_cls = $highlite_img = $file_video = '';
                //('.$item_ext.') 
                $item_link = '<a '.$link.' class="linkRes '.$item_ext . $highlite_cls.' bold"  data-id="'.$item_id.'" target="_blank">'.$highlite_img . $item_title .'</a> '.$file_video;



                if($item_author <> '') 
                { 
                    $author_link = '<a class="txtorange" href="#publishers.php?com=5&formname=tag&dir_type='.$item_author.'&organization='.$item_author.'">'.$item_author.'</a>';
                    $item_author = "&nbsp; | &nbsp;<span class='txtorange' title='Publisher'>".$author_link." ".$item_county."</span>"; }

                if($item_lang <> '') 
                { $item_lang = "&nbsp; | &nbsp;<span class='txtgraylight' title='language'><strong></strong> ".$item_lang."</span>"; }

                if($item_pub_year <> '') 
                { $item_pub_year = "&nbsp; | &nbsp;<span class='txtgraylight' title='Published'><strong></strong> ".$item_pub_year."</span>"; }


                $item_desc = "<div class=\"trunc400\"><em class='txt11'>".$item_parent_label . $item_author . $item_lang . $item_pub_year ."</em><br>". $item_brief."</div>";




                /* @@ CONTENT COMMITTEE && COUNTY */    
                $contTags_arr           = $dispDt->get_resourceParents($item_id, 1); //displayArray($contTags_arr);
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


                //echobr(UPL_COVERS.$item_cover);

                $upload_icon_disp = ''; //'<span class="carChopa no-image" style="width:70px; max-height:70px;"></span>';
                $icon_box = '';
                $icon_spacer = '';
                if($item_cover <> '' and (file_exists(UPL_COVERS.$item_cover)))
                {
                    $icon_box = ' width:70px;';
                    $icon_spacer = 'margin-left:80px;';
                    $upload_icon_disp	  = '<span class="carChopa" style="width:70px;max-height:70px;"><img src="'.DISP_COVERS.$item_cover.'" alt="" /></span>';
                }

               /* $fcontent .=  '<li><div class="block equalizedX" style=""><div style="float:left;'.$icon_box.'">'.$upload_icon_disp.'</div>
                <div style="width:auto;'.$icon_spacer.'"><div class="padd5">'.$item_link.'' . $item_desc . '
                '.$contTags_committee.'
                '.$contTags_county.'
                </div></div></div></li>';*/
            
            
            
                $item_box .= '<li>
                    <div class="padd10_0">'.$upload_icon_disp .''.$item_link.'<br>
                        '.$item_desc.'
                        '.$contTags_committee.'
                        '.$contTags_county.'
                        </div>
                    </li>';
            
            
            }
            
        }
        
		
		
	}
	
	}

}
?>
<div class="note-search txtgray">
    Search Keyword: <b class="txtblack"><?php echo $searchtext; ?></b> &nbsp; &nbsp; | &nbsp; &nbsp; 
    Results: <b><?php echo $numrows; ?></b> &nbsp; &nbsp; | &nbsp; &nbsp; 
    Articles: <b><?php echo count($resSearch_cont); ?></b> &nbsp; &nbsp; | &nbsp; &nbsp; 
    Resources: <b><?php echo count($resSearch_docs); ?></b>
    <br></div>

<div class="article-tabs">
	<div class="articles-list long-bits">
		<ol class="news-display">

		<?php echo $item_box; ?>

		</ol>
	</div>				
</div>

<?php


/* ======== @@ PAGINATOR @@ ====== */	
if($numrows > $pages->custom_ipp) {
	echo $pages_head;
}
/* =============================== */


?>