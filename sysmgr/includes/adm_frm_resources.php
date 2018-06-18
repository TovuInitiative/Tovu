
<div>

    
	<!-- content here -->
<?php
if(isset($_REQUEST['op'])) { $op=$_REQUEST['op']; } else { $op=NULL; }
if(isset($_REQUEST['id'])) { $id=$_REQUEST['id']; } else { $id=NULL; }



$GLOBALS['FORM_JWYSWYG'] = true;
$GLOBALS['FORM_KEYTAGS'] = true;
	
$parent_menu = '';
	
if($op=="edit"){ $title_new	= "Edit "; } elseif($op=="new") { $title_new	= "New "; }

$upload_icon_disp = '';
$upload_icon_id   = '';

$access[1] = '';
$access[2] = '';

$id_owner  = '';

$file_box_link	= ' style="display: none"';
$file_box_upload  = '';
	


$showForm = false;

	
$resource_file = '';
$uploadRequire	= '';
$fDataParent	= array();	

$fData = array();
$fData['published'] = 1;
$fData['language'] = 'English';
$fData['resource_description'] = ''; //' County Integrated Development Plan 2013-2017';
    
$upload_icon_disp     ='';    

if($op=="edit"){

	if($id)
	{
	
	//oi_dt_resources
		$sqdata = "SELECT * FROM `mrfc_dt_downloads` WHERE  (`resource_id` = ".quote_smart($id).")";
		$rsdata = $cndb->dbQueryFetch($sqdata);
		$fData = current($rsdata);
		
		$res_attr = @unserialize($fData['resource_attributes']); 

			$formaction			   = "_edit";		
			$upload_picy			= " ";
			$upload_picn			= " checked ";
			
			$file_name 		= $fData['resource_file'];
			$item_protocol  = substr($file_name,0,3);
			$item_ext       = strtolower(substr(strrchr($file_name,"."),1));

            $item_cover     = $fData['resource_image'];
				
			$sq_item_parent = "SELECT * FROM `mrfc_dt_downloads_parent` WHERE (`resource_id` =".quote_smart($id)."); "; 
			$rs_item_parent = $cndb->dbQuery($sq_item_parent);
			if( $cndb->recordCount($rs_item_parent)) {
				while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
				{ 
					if($cn_item_parent['id_menu'] <> 0) { $fDataParent['id_menu'][] = $cn_item_parent['id_menu']; }
					if($cn_item_parent['id_content'] <> 0) { $fDataParent['id_content'][] = $cn_item_parent['id_content']; }
					if($cn_item_parent['county_id'] <> 0) { $fDataParent['county_id'][] = $cn_item_parent['county_id']; }
					if($cn_item_parent['committee_id'] <> 0) { $fDataParent['committee_id'][] = $cn_item_parent['committee_id']; }
					
				}
			}
			
			
			//EXTERNAL
			if($item_protocol == 'htt' or $item_protocol == 'www' or $item_protocol == 'ftp' or $item_protocol == 'ww2') 
			{ $link = ' href="'.$file_name.'" ';  } 
			else 
			{ $link = ' href="'.DISP_FILES.$file_name.'" '; }	
			
			if($fData['resource_file'] <> ''){
				$resource_file = '<div class="col-md-12 padd10_0">View: <a '.$link.' target="_blank">'.$fData['resource_file'].'</a></div>'; 
			}
			$file_box_link	= '';
			$file_box_upload  = ' style="display: none"';
        
        
            if($item_cover <> '' and (file_exists(UPL_COVERS.$item_cover)))
            {
                $icon_box = ' width:70px;';
                $icon_spacer = 'margin-left:80px;';
                
                $upload_icon_disp	  = '<br><div class="carChopa" style="width:170px;max-height:170px;"><img src="'.DISP_COVERS.$item_cover.'" alt="" style="width:170px;max-height:170px;" /></div>';
            }
		
	}
} else
	{
	
		
		$showForm = true;
		$formaction			   = "_new";

		$upload_picy			= " checked ";
		$upload_picn			= "";
		$uploadRequire	= 'required';
		$fData['date_created'] = date('Y-m-d');
		$fData['status'] = 'live';

		$fData['posted_by'] = $us_id;
		//$fData['organization_id'] = $us_org_id;
		$fDataParent['organization_id'] = $us_org_id;
	}
	
	
//displayArray($fData);
    
@$access[$fData['access_id']] = ' selected ';	
$published = yesNoChecked($fData['published']);	

	$pub_y = $pub_n = '';
	if($fData['published'] == 1) { $pub_y = ' checked'; } else { $pub_n = ' checked'; }
	
	echo '<h2>'.$title_new.' Resources</h2>';
    
$col_1_class = 'col-md-2';    
$col_2_class = 'col-md-9';
    
?>




<form class="rwdform rwdfull rwdstripes rwdvalid " name="fm_resources" id="adm_download_form" method="post" action="adm_posts.php" enctype="multipart/form-data">
<input type="hidden" name="formtab" value="_documents" />
<input type="hidden" name="formaction" value="<?php echo $formaction; ?>" />
<input type="hidden" name="formname" value="fm_resources" />
<input type="hidden" name="id" value="<?php echo @$fData['resource_id']; ?>" />
<input type="hidden" name="redirect" value="home.php?d=resource library" />
<input type="hidden" name="posted_by" value="<?php echo @$fData['posted_by']; ?>" />
<input type="hidden" name="resource_key" value="<?php echo @$fData['resource_key']; ?>" />
<input type="hidden" name="status_old" value="<?php echo @$fData['status']; ?>" />
<div class=""></div>


<div class="form-group form-row">
	<label for="id_parent" class="<?php echo $col_1_class; ?>">Parent Menu: </label>
	<div class="col-md-9 nopadd">
	<select name="id_parent[]" id="id_parent" multiple="multiple" class="form-control multiple" style="">
	<?php echo  $dispData->build_MenuSelectRage(0, @$fDataParent['id_menu']);?>
	</select>
	</div>
</div>


<div class="form-group form-row">
	<label for="id_content" class="<?php echo $col_1_class; ?>">Parent Content: </label>
	<div class="col-md-9 nopadd">
	<select name="id_content[]" id="id_content" multiple="multiple" class="form-control multiple col-md-12" style="">
      <?php echo $dispData->build_MenuArticles(master::$contMain['full'], $parent_content, 0 , @$fDataParent['id_content']);  ?>
     </select>
	</div>
</div>

<div class="form-group form-row"><label for="resource_title" class="<?php echo $col_1_class; ?>">Resource Title: </label>
<input type="text" name="resource_title" id="resource_title" class="form-control col-md-9 required" value="<?php echo @$fData['resource_title']; ?>"  />
</div>

<div class="form-group form-row"><label for="resource_slug" class="<?php echo $col_1_class; ?>">Resource Slug: </label>
<input type="text" name="resource_slug" id="resource_slug" class="form-control col-md-9 required" value="<?php echo @$fData['resource_slug']; ?>"  />
</div>

<div class="form-group form-row">
	<label for="resource_description" class="<?php echo $col_1_class; ?>">Resource Description: </label>
	<div class="col-md-9 padd0_l padd0_r">
	<textarea name="resource_description" id="resource_description" class="form-controlX requiredX wysiwyg" ><?php echo @$fData['resource_description']; ?></textarea>
	<?php //include("fck_rage/article_sm.php");  ?>
	</div>
</div>






<div class="form-group form-row">
<label for="resource_file" class="<?php echo $col_1_class; ?>">Resource File: </label>
<div class="col-md-9">
	<table align="left" width="100%"  class="table nopadd nomargin noborder">
	<tr>
		<td style="width:;" class="col-md-3">
		<label style="display:inline-block;"><input name="change_image" id="upload_on" type="radio" value="Yes" <?php echo $upload_picy; ?>  class="radio"/>&nbsp; Upload New</label>&nbsp;
		<label style="display:inline-block;"><input name="change_image" id="upload_off" type="radio" value="No" <?php echo $upload_picn; ?>  class="radio"/> Resource Name</label> 
		</td>
		<td class="col-md-9 nopadd">
	<div id="file_box_upload" class="col-md-12 padd0_l" <?php echo $file_box_upload; ?>>
	<input type="file" name="fupload" id="fupload"  class="form-control required"  accept="<?php echo $uploadMime; ?>" />
	</div>
	
	<div id="file_box_link" class="col-md-12 padd0_l" <?php echo $file_box_link; ?>>
	<input type="text" name="resource_file" id="resource_file" value="<?php echo @$fData['resource_file']; ?>" class="form-control" placeholder="Enter File link:" />
	</div>
	</td>
	</tr>
	<?php if($op=="edit"){ ?>
	<tr><td></td><td><?php echo $resource_file; ?></td></tr>
	<?php } ?>
	</table>
</div></div>


<div class="form-group form-row">
    &nbsp;
</div>




<div class="form-group form-row">
    <label for="related_committee" class="<?php echo $col_1_class; ?>">Related Committee(s): </label>
    <div class="col-md-9">
        
        <div class="col-md-5 nopadd">
            <select name="related_committee[]" id="related_committee" multiple class="form-control required multiple">
                  <?php echo $ddSelect->dropper_select("mrfc_app_committee", "committee_id", "title", @$fDataParent['committee_id']) ?>
            </select>
        </div>

        <label for="county" class="col-md-2 nobold">Related County(s): </label>
        <div class="col-md-5 nopadd">
        <select name="county[]" id="county" multiple class="form-control multiple ">
              <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county", @$fDataParent['county_id']) ?>
        </select>
        </div>
        
    </div>

</div>





<div class="form-group form-row">
    <label for="resource_tags" class="<?php echo $col_1_class; ?>">Related Knowledge Area:</label>
    <div class="col-md-9">
        
        <div class="col-md-5 nopadd">
            <select name="related_tag[]" id="related_tag" multiple class="form-control required multiple">
                  <?php echo $ddSelect->dropper_confTags(master::$menuBundle, @$fDataParent['content_type']) ?>
            </select>
        </div>

        <label for="publisher" class="col-md-2">Publisher/Author: </label>
        <div class="col-md-5 nopadd">
            <input type="text" name="publisher" id="publisher" class="form-control" value="<?php echo @$fData['publisher']; ?>"  />
        </div>         
        
    </div>

</div>

<div class="form-group form-row">
    &nbsp;
</div>


<div class="form-group form-row">
    <label for="resource_tags" class="<?php echo $col_1_class; ?>">Meta Tags: </label>
    <div class="col-md-9">        
        <input type="text" name="resource_tags" id="resource_tags" class="form-control col-md-12 tags-field" style="width:100% !important" value="<?php echo @$fData['resource_tags']; ?>"  />        
    </div>

</div>


<div class="form-group form-row">
    &nbsp;
</div>

<div class="form-group form-row">
<label for="year_published" class="<?php echo $col_1_class; ?>">&nbsp; </label>

<div class="col-md-9">
    <div class="col-md-2">
        <label for="year_published" class="col-md-12 nobold nopadd">Year of Publication: </label>
        <select name="year_published" id="year_published" class="form-control col-md-12">
             <option selected><?php echo @$fData['year_published']; ?></option>
             <?php for($d=date("Y"); $d>=(date("Y")-20); $d--) { ?>   <option><?php echo $d; ?></option><?php } ?> 
        </select>
    </div>
    
    
    <div class="col-md-2">
        <label for="language" class="col-md-12 nobold nopadd">Language: </label>
        <select name="language" id="language" class="form-control col-md-12"><option><?php echo @$fData['language']; ?></option><option>English</option><option>Swahili</option><option>French</option></select>
    </div>
    

    <div class="col-md-3">
        <label for="access_id" class="col-md-12 nobold nopadd">Access Level: </label>
        <select name="access_id" id="access_id" class="form-control col-md-12">
               <option value='1' <?php echo $access[1]; ?>>Public Access</option> 
               <option value='2' <?php echo $access[2]; ?> >Private (Members Only) Access</option>
        </select>
    </div>
    
    
    <div class="col-md-2">
        <label for="date_created" class="col-md-12 nobold nopadd">Date Uploaded: </label>
        <input type="text" name="date_created" id="date_created" class="form-control col-md-12 hasDatePicker" value="<?php echo @$fData['date_created']; ?>"  />
    </div>
    
    
    <div class="col-md-2">
        <label for="access_id" class="col-md-12 nobold nopadd">Publish to Web: </label>
        <div class="col-md-12">

            <label class="col-md-6 nopadd"><input name="published" id="pub_y" type="radio" value="1" <?php echo $pub_y; ?>  class="radio"/> Yes</label> 
            <label class="col-md-6 nopadd"><input name="published" id="pub_n" type="radio" value="0" <?php echo $pub_n; ?>  class="radio"/> No</label> 

        </div>
    </div>
   

</div>
</div>

<?php /*  ?>
<div class="form-group form-row">
<label for="publisher" class="<?php echo $col_1_class; ?>">Publisher/Author: </label>
<input type="text" name="publisher" id="publisher" class="form-control col-md-3" value="<?php echo @$fData['publisher']; ?>"  />
</div>


<div class="form-group form-row"><label for="related_tag" class="<?php echo $col_1_class; ?>">Related Tags: </label>
<div class="col-md-3 nopadd">
<select name="related_tag[]" id="related_tag" multiple class="form-control required multiple">
	  <?php echo $ddSelect->dropper_confTags(master::$menuBundle, @$fData['content_type']) ?>
</select>
</div>

<label for="county" class="<?php echo $col_1_class; ?>">Related County: </label>
<div class="col-md-3 nopadd">

</div>
</div>



<div class="form-group form-row">
<label for="published" class="<?php echo $col_1_class; ?>">Is Published: </label>
<div class="col-md-9">

	<label style="display:inline-block;"><input name="published" id="pub_y" type="radio" value="1" <?php echo $pub_y; ?>  class="radio"/> Yes</label>&nbsp;
	<label style="display:inline-block;"><input name="published" id="pub_n" type="radio" value="0" <?php echo $pub_n; ?>  class="radio"/> No</label> 
		
</div>
</div>
<?php  */ ?>


<div class="form-group form-row">
    <hr>
</div>
<?php  ?>
<div class="form-group form-row">
<label for="resource_image" class="<?php echo $col_1_class; ?>">Resource Image: </label>
<div class="col-md-9">
<input type="file" name="resource_image" id="resource_image" class="form-control" style=""  />
<?php echo @$upload_icon_disp; ?>

</div>
</div>
<?php  ?>


<div class="form-group form-row">
<label class="<?php echo $col_1_class; ?>">&nbsp;</label>
<button type="input" name="submit" id="submit" value="submit" class="btn btn-success btn-icon col-md-3">Submit </button>
</div>


</form>

</div>

<script type="text/javascript">
jQuery(document).ready(function($) 
{
	$('label.required').append('&nbsp;<span class="rq">*</span>&nbsp;');
	//$('textarea').autoResize({extraSpace : 10 });
	
	
	$("#upload_on").click(function () { $("#file_box_upload").show(); $("#file_box_link").hide(); });
	$("#upload_off").click(function () { $("#file_box_upload").hide(); $("#file_box_link").show(); });
	
	
	$("select#id_content").change(function () {
	  var valTitle = $("input#title").val();
	  var valSlash = /(.+)(\/)/g; 
	  var valClean, str = "";
	  $("select#id_content option:selected").each(function () { str += $(this).text() + " ";  });	  
	  if(str.search(valSlash) == 0) { valClean = str.replace(valSlash,""); } else { valClean = str; }	  
	  if(valTitle == "") { $("input#title").attr("value", valClean); }
	});	
	
	
	$("#resource_title").blur(function () {
	  var valTitle 	= $(this).val();
	  var hyphenated  = urlTitle(valTitle);             
	  $('#resource_slug').val(hyphenated);       
	  
	  var valKeywords = $("#resource_tags").val();
	  //var valMeta 	  = valTitle.replace(/[^a-zA-Z0-9]/g,",").replace(/[,]+/g,",").toLowerCase();	  
	  var valMeta = wordInString(valTitle, ['of','the','this'], '');
		  valMeta = valMeta.trim().replace(/[^a-zA-Z0-9]/ig,",").replace(/[,]+/ig,",").toLowerCase();
	  if(valKeywords == "") {  $("#resource_tags").val(valMeta); }
	});
	
	$("#adm_download_form").validate({errorPlacement: function(error, element) { }});
	
	/*if( $('.wysiwyg').length ) { 
			$('.wysiwyg').wysiwyg(); 
	}*/
	
    
    
      var elem = $("#resource_file");
	  $.ajaxSetup({context: elem});
	  elem.autocomplete({
		  minLength: 1,
		  source: function(request, response) {
			$.getJSON("../assets/file/acdir.php")
			  .then(function success(data) {
				var searchField = elem.val();
				var myExp = new RegExp(searchField, "i");
				var res = [];
				 var output = '';
				$.each(data, function(key, val) {
				  /*if ((val.iata.search(myExp) !== -1) || (val.name.search(myExp) !== -1)) {*/
				  if ((val.search(myExp) !== -1)) {	  
						res.push("" + val + "");
				  }
				});
				response(res);

			  }, function error(jqxhr, textStatus, errorThrown) {
				console.log(textStatus, errorThrown) // log `$.ajax` errors
			  })
		  }
		});
});
</script>