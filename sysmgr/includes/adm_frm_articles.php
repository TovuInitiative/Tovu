
<div>


<?php
if(isset($_REQUEST['sec'])) {$newsec=$_REQUEST['sec'];} else {$newsec='basic';}
//$rageDrop = $dispData->build_MenuSelectRage();
//displayArray($rageDrop);

//displayArray($dispData->menuMain_portal);
//$id_portal = $adm_portal_id;

/*$fData 		   	        = array();
$fData['published']  	= 1;
$fData['id_section']  	= 7;
$fData['arr_images'] 	= 'no_image.png';
$article 				= "";   */ 

$parent	= array();

$url_title_article = '';
$other_link = '';	

	$ths_page="?d=$dir&op=$op";
	
	if($op=="edit"){ $title_new	= "Edit "; } 
elseif($op=="new") { $title_new	= "New "; }
	
if($op=="edit"){

	if($id)
	{
	
	$sqdata="SELECT   `id`, `id_menu`, `id_section`, `title`, `article`, `date_modified`, `published`, `frontpage`, `sidebar`, `id_menu2`, `yn_static`, `seq`, `title_sub`, `intro_home`, `yn_gallery`, DATE_FORMAT(`date_created`, '%m/%d/%Y') as `date_created`, `parent`, `id_portal`, `approved`, `id_owner`,  `link_static`,  `article_keywords`, `url_title_article`,  `arr_extras`   FROM `".$pdb_prefix."dt_content`  WHERE  (`id` = ".quote_smart($id).")";
	
	//echo $sqdata;
	$rsdata=$cndb->dbQuery($sqdata);// ;
	$rsdata_count= $cndb->recordCount($rsdata);
		
    if($rsdata_count==1)
    {
		$cndata_a       = $cndb->fetchRow($rsdata);
        
		$cndata  	    = array_map("clean_output", $cndata_a); //displayArray($fData);
		
		$pgtitle				="<h2 class='nopadd nomargin'>Edit Content</h2>";
		
		$id					= $cndata['id'];
		$id_section			= $cndata['id_section'];
		$title				= $cndata['title']; 
		$title_sub			= $cndata['title_sub']; 
		$article			= $cndata['article']; //html_entity_decode(stripslashes($cndata['article']));
		
		$article	= str_replace(SITE_PATH, '', $article);
		$article	= str_replace(SITE_DOMAIN_LIVE, '', $article);		
		$article 	= str_replace('"assets/image/', '"'.SITE_DOMAIN_LIVE.'assets/image/', $article);
		$article	= remove_special_chars(stripslashes($article));
				
		$article_keywords     = $cndata['article_keywords'];
		
		//echo SITE_DOMAIN_LIVE;
		$published			= $cndata['published']; 
		$frontpage			= $cndata['frontpage']; 
		$sidebar			= $cndata['sidebar']; 
		/*$yn_gallery		= $cndata['10']; */
		$yn_static		    = $cndata['yn_static']; 
		$position			= $cndata['seq'];
		$intro_home			= $cndata['intro_home'];
		$hasgallery			= $cndata['yn_gallery'];
		
		$url_title_article  = $cndata['url_title_article'];
		
		$created			= $cndata['date_created'];
		
			
		$arr_extras			= @unserialize($cndata_a['arr_extras']); 
		
		if(is_array($arr_extras)) {
			$ev_location = @$arr_extras['location'];
			$book_form = @$arr_extras['book_form'];
			$book_amount = @$arr_extras['book_amount'];
			$other_link = @$arr_extras['other_link'];
		}
			
		$sq_item_parent = "SELECT `id_parent`, `county_id`, `committee_id` FROM `mrfc_dt_content_parent` WHERE (`id_content` = ".quote_smart($id)."); "; 
		$rs_item_parent = $cndb->dbQuery($sq_item_parent);
		if( $cndb->recordCount($rs_item_parent)) {
			while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
			{ 
                if($cn_item_parent['id_parent'] <> 0) { $parent['id_parent'][] = $cn_item_parent['id_parent']; }
                if($cn_item_parent['county_id'] <> 0) { $parent['county_id'][] = $cn_item_parent['county_id']; }
                if($cn_item_parent['committee_id'] <> 0) { $parent['committee_id'][] = $cn_item_parent['committee_id']; }
            }
		}
		
		
		$approved			= $cndata['approved'];
		if($approved==1) {$approved="checked ";} else {$approved="";}
		
		$id_owner			= $cndata['id_owner'];
		$link_static			= $cndata['link_static'];
		
				
		if($published==1) {$published="checked ";} else {$published="";}
		if($frontpage==1) {$frontpage="checked ";} else {$frontpage="";}
		if($sidebar==1) {$sidebar="checked ";} else {$sidebar="";}
		if($intro_home==1) {$intro_home="checked ";} else {$intro_home="";}
		
		
			$upload_picy	="";
			$upload_picn	=" checked ";
		
		//echo $id_menu2;
		$formname			= "article_basic_edit";
		}
	}


} 
elseif($op=="new")
	{
	
		$pgtitle				="<h2 class='nopadd nomargin'>Add New Content</h2>";
		
		$id					= "";
		$id_menu			= "";
		$id_menu2			= "";
		
		$title				= "";
		$title_sub	= '';
		$article			= "";
		$created			= date("m/d/Y");
		
		//$parent = "";  	//array('7','54'); //
		$id_section = 1; //1
		
		if($newsec == "news") { $parent['id_parent'][0] = 64; $id_section = 2; }
		
		$published			= "checked ";
		$approved			 = "checked ";
		$frontpage			= "";
		$yn_gallery		= ""; 
		$yn_static		= "";
		$position			= "9";
		
		$upload_picn	="";
		$upload_picy	=" checked ";
			
		$photo_box = "none";
		$video_box = "block";
		$video = "checked "; $photo = "";
		
		$hasgallery="";
		$gallery="";
		$sidebar="";	
		$formname			= "article_basic_new";
	}
 //$dispData->siteMenu(); 
 //displayArray($parent);
 
 //echo getcwd().DIRECTORY_SEPARATOR;
 ?>

<div style="width:100%;  margin:0 auto; border:0px solid">
	
<div style="padding:10px;">


<form class="rwdform rwdfull rwdstripes rwdvalid" id="cont_basic" name="rage" method="post" action="adm_posts.php" onsubmit="javascript:return valid_article()"   enctype="multipart/form-data">
<input type="hidden" name="sidebar" value="0"/>
<input type="hidden" name="id_portal" value="1" />
<input type="hidden" name="approved" value="on" />
<input type="hidden" name="link_static" value=""/>
<input type="hidden" name="title_sub" value=""/>

<?php echo $pgtitle; ?>
<table style="margin-top:0; padding-top:0;width:100%;">
	<tr>
	<td>
	
	
  <table  border="0" cellspacing="0" cellpadding="5" align="center" style="width:100%; "  class="tims">
    
    <tr>
    	<td nowrap="nowrap"></td>
    	<td colspan="3"> </td>
    	</tr>
	<tr>
      <td nowrap="nowrap"><label for="id_parent">Parent Menu:</label></td>
      <td colspan="3">
        <select name="id_parent[]" id="id_parent" multiple="multiple" class="multiple" >
          <?php echo $dispData->build_MenuSelectRage(0, @$parent['id_parent']); ?>
          </select>      
       </td>
      </tr>
    <tr>
    	<td nowrap="nowrap"><label for="article_title">Title:</label></td>
    	<td colspan="3">
			<input type="text" name="title" id="article_title" value="<?php echo $title; ?>" class="form-control required">
			<?php if($op=="edit"){ 
			echo 'Page Link: <a href="'.SITE_DOMAIN_LIVE.$id.'/'.$url_title_article.'" target="_blank">'.$id.'/'.$url_title_article.'</a>'; } 			
			?>
		</td>
    	</tr>
		
	
    
    <tr>
      <td nowrap="nowrap"><label for="id_section">Template: </label></td>
      <td colspan="3">
      
<table border="0" cellspacing="0" cellpadding="2" style="margin:0;width:100%; " class="">
<tr>
		
    	<td><select name="id_section" id="id_section" class="form-control">
    		<?php echo $ddSelect->dropperSection($id_section, "cont"); ?>
    		</select></td>
    	<td nowrap><label for="created">Dated: </label></td>
		<td nowrap style=""><input type="text" name="created" id="created" value="<?php echo $created; ?>" class="form-control hasDatePicker required" style="width: "></td>
		<td nowrap><label for="position">Position: </label></td>
		<td><input type="number" id="position" name="position" value="<?php echo $position; ?>" class="txtright form-control padd0_r" style="width:50px !important;" maxlength="2"/></td>
		<td nowrap><label><input type="checkbox" name="frontpage" id="frontpage" <?php echo $frontpage; ?> class="radio"/> Featured </label></td>

		<?php /*?><td nowrap><label style="color:#900" class="labelleft"><input type="checkbox" name="approved" id="approved" <?php echo $approved; ?> class="radio"/>	<strong>Is Approved</strong></label></td><?php */?>
<td>&nbsp;</td>
		<td nowrap="nowrap"><label style="color:#900"><input type="checkbox" name="published" id="published" <?php echo $published; ?> class="radio"/>	<strong>Is Published</strong></label></td>

</tr>
</table>			  </td>
    </tr>
    
    
    <!--<tr style="background:#EFEFDE;">
      <td colspan="4">Article Data </td>
      </tr>-->
    
    <tr>
      <td>
      <label>Content:</label>			  </td>
      <td colspan="3"><?php include("fck_rage/article.php"); ?></td>
    </tr>
    
    
     
    
    
    <tr>
        <td nowrap="nowrap"><label> Related Committee(s):</label></td>
    	<td colspan="3">
    		
            <div class="form-group form-row">
                <div class="col-md-5 nopadd">
                <select name="related_committee[]" id="related_committee" multiple class="form-control required multiple">
                      <?php echo $ddSelect->dropper_select("mrfc_app_committee", "committee_id", "title", @$parent['committee_id']) ?>
                </select>
                </div>

                <label for="county" class="col-md-2">Related County(s): </label>
                <div class="col-md-5 nopadd">
                <select name="county[]" id="county" multiple class="form-control multiple ">
                      <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county", @$parent['county_id']) ?>
                </select>
                </div>
            </div>
       
    	</td>
     </tr>
     
     
     
     <tr>
    	<td nowrap="nowrap"><label> Keywords:</label></td>
    	<td colspan="3">
    	    
    	    
    	    <div class="form-group form-row">
                <div class="col-md-5 nopadd">
                    <input type="text" id="article_keywords" name="article_keywords"  value="<?php echo @$article_keywords; ?>" class="form-control tags-field" />
                </div>

                <label for="related_tag" class="col-md-2">Related Knowledge Area: </label>
                <div class="col-md-5 nopadd">
                    <select name="related_tag[]" id="related_tag" multiple class="form-control required multiple">
                          <?php echo $ddSelect->dropper_confTags(master::$menuBundle, @$parent['id_parent']) ?>
                    </select>
                </div>
            </div>
            
        </td>
    </tr>
    
    
     	
    	
    	
     <tr>
      <td colspan="4">&nbsp; </td>
     </tr>
    			
     <tr>
    	<td><label>Gallery: </label></td>
    	<td colspan="3">
		
		<div class="radio_group">
		
	<label><input type="radio" name="file_type" id="no_gallery" class="radio" checked="checked"  /> No Action</label>	&nbsp;	
	<label><input type="radio" name="file_type" id="add_photo" value="p" class="radio"  /> Upload Image (Browse)</label>	&nbsp;
	<label><input type="radio" name="file_type" id="add_photo_url" value="u" class="radio"  /> Attach Image (Enter Name)</label>	&nbsp;
	<label><input type="radio" name="file_type" id="add_video" value="v" class="radio" />Link Video </label>  	
	</div>
	
		</td>
    	</tr>
	
	<tr>
     	<td colspan="4">
		
	
	<div id="file_box_video" style="display: none; ">
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td style="width:130px;"> <label for="video_name"><strong>Video URL:</strong></label> </td>
		<td><input type="text" name="video_name" id="video_name" value="" class="form-control" > &nbsp; <span class="hint">e.g. http://www.youtube.com/embed/xxxxxxxxxx</span></td>
		</tr>
		
		<tr>
		<td><label for="video_caption"><strong>Video Caption:</strong></label> </td>
		<td><textarea name="video_caption" id="video_caption" class="form-control" ></textarea> </td>
		</tr>
		
		</table>
	</div>
	
	
	<div id="file_box_photo_url" style="display: none; ">
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td style="width:130px;"> <label for="photo_url_name"><strong>Image URL:</strong></label> </td>
		<td><input type="text" name="photo_url_name" id="photo_url_name" value=""  class="form-control"> </td>
		</tr>
		
		<tr>
		<td><label for="photo_url_caption"><strong>Image Caption:</strong></label> </td>
		<td><textarea name="photo_url_caption" id="photo_url_caption" class="form-control" ></textarea> </td>
		</tr>
		<tr>
		<td><label for="id_gallery_cat"><strong>Category:</strong></label></td>
			<td><select name="id_gallery_cat_u" id="id_gallery_cat_u" class="form-control">
				<?php echo $ddSelect->dropper_select("mrfc_dt_gallery_category", "id", "title", 2) ?>
				</select></td>
		</tr>
		</table>
	</div>
		
		
	<div id="file_box_photo" style="display: none;">
		<table width="100%" border="0" cellspacing="3" cellpadding="3">
		<tr>
		<td style="width:130px;"> <label for="photo_name"><strong>Select Image:</strong>: </label> </td>
		<td><input type="file" name="myfile" id="photo_name" size="57"  class="form-control"  /></td>
		<td><label for="id_gallery_cat"><strong>Category:</strong></label></td>
			<td><select name="id_gallery_cat" id="id_gallery_cat" class="form-control">
				<?php echo $ddSelect->dropper_select("mrfc_dt_gallery_category", "id", "title", 2) ?>
				</select></td>
		</tr>
		<tr>
		<td><label for="photo_caption"> <strong>Image Caption:</strong> </label></td>
		<td colspan="3"><textarea name="photo_caption" id="photo_caption" class="form-control"></textarea> </td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</div>	
		
		</td>
     </tr>
		
     <tr>
     	<td>&nbsp;</td>
     	<td colspan="3">&nbsp;</td>
     	</tr>
		
		
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><input type="submit" name="Submit" value="Submit" style="width:270px;" />
        <input type="hidden" name="formname" value="<?php echo $formname; ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="redirect" value="<?php echo "home.php?d=".$dir; ?>" /></td>
    </tr>
  </table>
  
  
	</td>
	<td style="max-width:90px;">
			
    		<div style="padding-left:10px">
			<ul id="files" ></ul>
			</div>
	</td>
	</tr>
</table>
</form>	

</div>
</div>
	
	

</div>





<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
		
		
<script type="text/javascript">
$(document).ready(function()
{ 
	$('label.required').append('&nbsp;<span class="rq">*</span>&nbsp;');
	
	$("#no_gallery").click(function () { 
		$("#file_box_video").hide(); $("#file_box_photo").hide(); $("#file_box_photo_url").hide();   
	});
	$("#add_video").click(function () { 
		$("#file_box_video").show(); $("#file_box_photo").hide(); $("#file_box_photo_url").hide();  
		$("#video_caption").text($("input#article_title").val());    
	});
	$("#add_photo").click(function () { 
		$("#file_box_video").hide(); $("#file_box_photo").show(); $("#file_box_photo_url").hide(); 
		$("#photo_caption").text($("input#article_title").val());    
	});
	$("#add_photo_url").click(function () { 
		$("#file_box_video").hide(); $("#file_box_photo").hide(); $("#file_box_photo_url").show(); 
		$("#photo_url_caption").text($("input#article_title").val());    
	});
	
	
	$("select#id_parent").change(function () {
	  var valTitle = $("input#article_title").val();
	  var valSlash = /(.+)(\/)/g; 
	  var valClean, str = "";
	  $("select#id_parent option:selected").each(function () { str += $(this).text() + " ";  });	  
	  if(str.search(valSlash) == 0) { valClean = str.replace(valSlash,""); } else { valClean = str; }	  
	  if(valTitle == "") { $("input#article_title").attr("value", valClean); }
	});	
	
	
	$("#article_title").blur(function () {
	  var valTitlek 	= $("#article_title").val().toLowerCase();
	  var valKeywords = $("#article_keywords").val(); 
	  var valSlashk 	= /(the)/g; //(and)(for)
	  var valCleank, valStr = "";
	  valStr = valTitlek; //$(this).text();
	 
	 valCleank =  valStr.replace(/\bthe\b/g, "").replace(/\band\b/g, '').replace(/\bfor\b/g, '').replace(/\bfrom\b/g, ''); 
	 $("#article_keywords").attr("value", valCleank);
	  
	});
	
	
});

</script>
		
