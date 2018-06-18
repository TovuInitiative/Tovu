<?php

$item_box 		= '';
$items_per_page  = 10;


/*define('QRY_MENUCONTENTSBXX', "SELECT 
      `".$pdb_prefix."dt_content`.`id`, `".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dd_sections`.`title` AS `section`, `".$pdb_prefix."dt_content_parent`.`id_parent`, `".$pdb_prefix."dt_menu`.`title` AS `parent`, `".$pdb_prefix."dt_content`.`article`, DATE_FORMAT(`".$pdb_prefix."dt_content`.`date_modified`,'%b %d, %Y') AS `modified`, `".$pdb_prefix."dt_content`.`published`, `".$pdb_prefix."dt_content`.`id_section`, `".$pdb_prefix."dd_sections`.`link` AS `link_section`, `".$pdb_prefix."dt_menu`.`link` AS `link_menu`, `".$pdb_prefix."dt_content`.`title_sub`, `".$pdb_prefix."dt_content`.`frontpage`, `".$pdb_prefix."dt_content`.`seq`, DATE_FORMAT(`".$pdb_prefix."dt_content`.`date_created`,'%b %d, %Y') AS `created`, `".$pdb_prefix."dt_menu`.`title_brief`
   FROM 
      (((`".$pdb_prefix."dt_content` INNER JOIN `".$pdb_prefix."dd_sections` ON `".$pdb_prefix."dt_content`.`id_section`=`".$pdb_prefix."dd_sections`.`id`) INNER JOIN `".$pdb_prefix."dt_content_parent` ON `".$pdb_prefix."dt_content`.`id`=`".$pdb_prefix."dt_content_parent`.`id_content`) INNER JOIN `".$pdb_prefix."dt_menu` ON `".$pdb_prefix."dt_content_parent`.`id_parent`=`".$pdb_prefix."dt_menu`.`id`)");*/

$limit = "";

$resSearch_num = 0;

define('QRY_MENUCONTENTSB', "SELECT `mrfc_dt_content`.`id`, `mrfc_dt_content`.`date_created` 
    FROM `mrfc_dt_content`
    INNER JOIN `mrfc_dt_content_parent`  ON (`mrfc_dt_content`.`id` = `mrfc_dt_content_parent`.`id_content`)
    LEFT JOIN `mrfc_dt_menu` ON (`mrfc_dt_content_parent`.`id_parent` = `mrfc_dt_menu`.`id`)");


$sqSearch_cont_crit = "";
if($request['searchcounty'] <> ''){
    $sqSearch_cont_crit .= " and  `mrfc_dt_content_parent`.`county_id` = ".q_si($request['searchcounty'])." ";
}

if(isset($request['searchsector']) and count($request['searchsector']) > 0){
    $sqSearch_cont_crit .= " and  `mrfc_dt_content_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}

$sqSearch_cont = QRY_MENUCONTENTSB . "  WHERE "
			." CONVERT(CONCAT(`".$pdb_prefix."dt_content`.`title`, `".$pdb_prefix."dt_content`.`article`, `".$pdb_prefix."dt_content`.`article_keywords`, `".$pdb_prefix."dt_menu`.`title`) USING latin1) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_content`.`published` = '1' and  `".$pdb_prefix."dt_content`.`approved` = '1'  ".$sqSearch_cont_crit."  " 
			. $limit;
echobr($sqSearch_cont);
$rsSearch_cont = $cndb->dbQuery($sqSearch_cont);	//displayArray($result_Cont);
    while($cnSearch_cont = $cndb->fetchRow($rsSearch_cont, 'assoc'))
        {
            
        
            //$rec_date   = date('Y-m-d', strtotime($cnSearch_cont['date_created'])); //
            $rec_date   = strtotime($cnSearch_cont['date_created']); //
            $rec_id     = $cnSearch_cont['id'];
            //$resSearch[$resSearch_num][$rec_date]['cont'][$rec_id] 	= $rec_id;
            $resSearch[]    = array(
                                'date' => $rec_date,
                                'type' => 'cont',
                                'id' => $rec_id
                            ); //[$rec_date]['cont'][$rec_id] 	= $rec_id;
        
            $resSearch_num += 1;
        }

//displayArray($resSearch);

$sqSearch_docs_crit = "";
if($request['searchcounty'] <> ''){
    $sqSearch_docs_crit .= " and  `mrfc_dt_downloads_parent`.`county_id` = ".q_si($request['searchcounty'])." ";
}

if(isset($request['searchsector']) and count($request['searchsector']) > 0){
    $sqSearch_docs_crit .= " and  `mrfc_dt_downloads_parent`.`committee_id` IN (".implode(',',$request['searchsector']).") ";
}

$sqSearch_docs = " SELECT `mrfc_dt_downloads`.`resource_id` , `mrfc_dt_downloads`.`date_created` FROM `mrfc_dt_downloads`
    INNER JOIN `mrfc_dt_downloads_parent`  ON (`mrfc_dt_downloads`.`resource_id` = `mrfc_dt_downloads_parent`.`resource_id`) WHERE "
			." CONVERT(CONCAT(`".$pdb_prefix."dt_downloads`.`resource_title`, `".$pdb_prefix."dt_downloads`.`resource_description`) USING latin1) like ".q_si($request['searchtext'], 1)."  and `".$pdb_prefix."dt_downloads`.`published` = '1' ".$sqSearch_docs_crit."  " 
			. $limit;
echobr($sqSearch_docs);
$rsSearch_docs = $cndb->dbQuery($sqSearch_docs);	//displayArray($result_Cont);
    while($cnSearch_docs = $cndb->fetchRow($rsSearch_docs, 'assoc'))
        {
            //$rec_date   = date('Y-m-d', strtotime($cnSearch_docs['date_created'])); //
            $rec_date   = strtotime($cnSearch_docs['date_created']); //
            $rec_id     = $cnSearch_docs['resource_id'];
            //$resSearch[$resSearch_num][$rec_date]['docs'][$rec_id] 	= $rec_id;
            $resSearch[]    = array(
                                'date' => $rec_date,
                                'type' => 'docs',
                                'id' => $rec_id
                            );
            $resSearch_num += 1;
        }

array_sort_by_column($resSearch, 'date', SORT_DESC);
//echobr($resSearch_num);
//displayArray($resSearch);


/*$dispData->siteContent('','','','y', $searchtext);
$resultSite = master::$contMainSummary;

$url 	= DOMAIN_ACT.'json.news.search.php?s='.$searchtext.'';
$resultJson = json_decode(file_get_contents($url), true);

$searchResults  = array_merge_recursive($resultSite, $resultJson['content']);	//$result;
array_sort_by_column($searchResults, 'cont_date', SORT_DESC);

$numrows = count($searchResults);*/

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

$numrows = count($searchResults);

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



	foreach ($contPages as $contArray) 						
	{	//displayArray($contArray);
			$cont_id			= $contArray['id'];
			
			$cont_date	 	  = date("M d Y", $contArray['dated']);
			$cont_title		 = clean_output($contArray['title']);
			
			$cont_article 		= clean_text($contArray['article']);
			
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
		
		$item_box .= '<li>
			<div class="padd10_0">'.$image_disp .'<a href="'.$cont_link.'" class="'.$headLinkIcon.' txt15 bold">'.$cont_title.'</a><br>
			'.$cont_section.'
			'.$res_text.' &nbsp; &nbsp;</div>
		</li>';
		
	}
	
	}

}
?>
<div class="note-search txtgray">Search Keyword: <b class="txtblack"><?php echo $searchtext; ?></b> &nbsp; &nbsp; | &nbsp; &nbsp; Results: <b><?php echo $numrows; ?></b><br></div>

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