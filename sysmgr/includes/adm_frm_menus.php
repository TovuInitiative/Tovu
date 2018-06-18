<div>



<?php

if(isset($_REQUEST['op'])) { $op=$_REQUEST['op']; } else { $op=NULL; }
if(isset($_REQUEST['id'])) { $id=$_REQUEST['id']; } else { $id=NULL; }
	
if($op=="edit"){ $title_new	= "Edit "; } 
elseif($op=="new") { $title_new	= "New "; }

$image_show = '';
$article = '';
$static = '';
$quicklink = '';
$title_seo = '';

if($op=="edit"){

	if($id){
	
	$sqdata="SELECT       `id`, `title`, `title_alias`, `id_section`, `id_type_menu`, `parent`, `description`, `link`, `target`, `published`, `image`, `id_access`, `id_parent2`, `seq`, `static`, `metawords`, `title_brief`, `parent`, `quicklink`, `image_show`,`id_portal`, `title_seo`   FROM       `".$pdb_prefix."dt_menu`  WHERE  (`id` = ".quote_smart($id).")";
	//echo $sqdata;
	
	$rsdata=$cndb->dbQuery($sqdata);// ;
	$rsdata_count= $cndb->recordCount($rsdata);
		
		if($rsdata_count==1)
		{
		$cndata = $cndb->fetchRow($rsdata);
		
		$pgtitle				="<h2>Edit Menu Details</h2>";
		
		$id					= $cndata[0];
		$title				= html_entity_decode(stripslashes($cndata[1]));
		$title_alias		= html_entity_decode(stripslashes($cndata[2]));
		$id_section			= $cndata[3]; 
		$id_type_menu		= $cndata[4];
		$id_parent1			= $cndata[5];
		$description		= html_entity_decode(stripslashes($cndata[6])); 
		
		$article			= html_entity_decode(stripslashes($cndata[6])); 
		$article	= str_replace(SITE_PATH, '', $article);
		$article	= str_replace(SITE_DOMAIN_LIVE, '', $article);		
		$article 	= str_replace('"image/', '"'.SITE_DOMAIN_LIVE.'image/', $article);
		$article	= remove_special_chars(stripslashes($article));
		
		$link				= $cndata[7];
		$target				= $cndata[8];
		$published			= $cndata[9];
		$image				= $cndata[10];
		$id_access			= $cndata[11];
		$image_show			= $cndata[19];
		$id_portal			= $cndata[20];
		//$metawords			= html_entity_decode(stripslashes($cndata[15]));
		$metawords			= $cndata['metawords'];
		$title_seo			 = $cndata['title_seo'];
		
		$title_brief		= html_entity_decode(stripslashes($cndata[16]));
		$parent				= (array) ''; //unserialize($cndata[17]); 
		
		
		$sq_menu_parent = "SELECT `id_parent` FROM `".$pdb_prefix."dt_menu_parent`  WHERE  (`id_menu` = ".quote_smart($id).")";            
		$rs_menu_parent	= $cndb->dbQueryFetch($sq_menu_parent);
            //displayArray($rs_menu_parent);
		if (is_array($rs_menu_parent)){
			foreach($rs_menu_parent as $par_arr){ 
                $parent[] = $par_arr['id_parent']; 
            }
		}	
		//displayArray($parent);
		
		
		
		if($image <> '') { $image_disp = "<br /><br /><img src=\"".DISP_GALLERY.$image."\" style=\"height:100px\">"; }// 
			
			
		$position			  = $cndata[13];
		$static				= $cndata[14];
		$quicklink				= $cndata[18];
				
		if($published==1) {$published="checked ";} else {$published="";}
		if($static==1) {$static="checked ";} else {$static="";}
		if($quicklink==1) {$quicklink="checked ";} else {$quicklink="";}
		
		
		if($image_show==1) {
			$image_show	=" checked ";
		} else {
			$image_show	="";
		}
		
		$formname			= "menu_edit";
		}
	}
} elseif($op=="new")
	{
	
		$pgtitle				="<h2 style=\"padding:0; margin:0;\">Add New Menu</h2>";
		
		$id					= "";
		$title				= "";
		$title_alias		= "";
		$id_section			= 1;
		$id_type_menu		= 2;
		$id_parent1			= "";
		$description		= "";
		$link				= "";
		$target				= "";
		$published			="checked ";
		$image				="";
		$id_access			=1;
		
		$id_parent2			= "";
		$metawords			= "";
		
		$image				="";
		$image_disp			= "";
		$upload_pic			= " ";
		$upload_picn			= " ";
		
		$position				= "9";
		
		$formname			= "menu_new";
	}
$access_y = $access_n = "";
if($id_access==1) {$access_y="checked ";} else {$access_n="checked";}	
?>

  <div style="width:100%; margin:0 auto">
  <!--onSubmit="javascript:return valid_menu()"-->
	<form class="admform rwdform rwdfull rwdstripes rwdvalid" name="frm_menus" method="post" action="adm_posts.php" enctype="multipart/form-data" onSubmit="javascript:return valid_menu()">
    <?php echo $pgtitle; ?>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3" align="center" class="tims">
         
        <tr>
          <td><label>Title</label></td>
          <td colspan="4"><input type="text" name="title" id="menu_title" value="<?php echo $title; ?>" class="form-control required" maxlength="100"/></td>
          
        </tr>
		<tr>
          <td><label>Title Alias </label></td>
          <td colspan="4"><input type="text" name="title_alias" id="title_alias"  value="<?php echo $title_alias; ?>" class="form-control" maxlength="100" /></td>
        </tr>
		
		<tr>
          <td><label>Menu Reference </label></td>
          <td colspan="4"><input type="text" name="title_seo" id="title_seo"  value="<?php echo $title_seo; ?>" class="form-control" maxlength="100" /></td>
        </tr>
		
        <tr>
		  <td><label>Menu Type </label></td>
          <td><select name="id_type_menu" id="id_type_menu" class="form-control required">
           <?php echo $ddSelect->dropper_select("".$pdb_prefix."dd_menu_type", "id", "title", $id_type_menu) ?>
		   </select>          </td>
          <td>&nbsp;</td>
          <td><label>Section</label></td>
          <td><select name="id_section">
            <?php echo $ddSelect->dropperSection($id_section); ?>
          </select></td>
        </tr>
        
        
        <tr>
          <td nowrap="nowrap"><label> Menu Parent</label></td>
          <td>
           <select name="id_parent1[]" id="id_parent" multiple="multiple" class="form-control multiple">
            <?php echo $dispData->build_MenuSelectOne($id, $parent); ?>
			
          </select></td>
		  <td>&nbsp;</td>
           <td><label>Manual Link</label></td>
		  <td><input type="text" name="link" id="link" class="form-control "  value="<?php echo $link; ?>" maxlength="150" /></td>
          
        </tr>
          
        <tr>
          <td><label>Menu Keywords: </label></td>
          <td><input type="text" id="metawords" name="metawords"  value="<?php echo $metawords; ?>" class="form-control " /></td>
		  <td></td>
		  <td><label>Access</label></td>
          <td>
		  <div class="radio_group">
	<label>Public: <input type="radio" name="id_access" value="1" <?php echo $access_y; ?> class="radio"/></label>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Private: <input type="radio" name="id_access" value="2" <?php echo $access_n; ?> class="radio"/></label>
          </div>
		  </td>		 
        </tr>
        
        <tr>
		  <td nowrap="nowrap"><label>Position:</label></td>
		  <td colspan="4"><input type="number" name="position" id="position" value="<?php echo $position; ?>" class="form-control col-md-1" maxlength="2"/></td>
	    </tr>
	    
		<tr>
          <td nowrap="nowrap"><label>Menu Options:</label></td>
          <td colspan="4">
          <div class="radio_group">
	<label>Add to Header: <input type="checkbox" name="yn_quicklink" <?php echo $quicklink; ?> class="radio"/></label>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Add to Footer: <input type="checkbox" name="yn_static" <?php echo $static; ?> class="radio"/></label>
	
	&nbsp;&nbsp;&nbsp;&nbsp;
	<label><strong>Is Active:</strong> <input type="checkbox" name="published" <?php echo $published; ?> class="radio"/>
<em>(Yes / No)</em></label>
          </div>
          </td>
        </tr>
        <!--<tr>
        	<td>&nbsp;</td>
        	<td>&nbsp;</td>
        	<td>&nbsp;</td>
        	<td colspan="2">&nbsp;</td>
        	</tr>-->
			
		<?php if($op=="new") { ?>	
        <tr>
          <td></td>
          <td><label><input type="checkbox" id="add_content" name="add_content" class="radio"/>
Add Menu Content</label></td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
		
		
        <tr id="tr_menu_content_label" style="display: none">
        	<td nowrap="nowrap"> <label>Menu Content Title</label></td>
        	<td colspan="4"><input type="text" name="article_title" id="article_title" class="form-control"></td>
        </tr>
		
		<tr id="tr_menu_content_text" style="display: none">
        	<td nowrap="nowrap"><label>Menu Content</label></td>
        	<td colspan="4"><?php include("fck_rage/article.php"); ?></td>
        </tr>
        	
		<?php } ?>
		
		
		
        <tr>
          <td>&nbsp;</td>
          <td colspan="4">
		  <input type="hidden" name="id_portal" value="1" />
          <input type="hidden" name="formname" value="<?php echo $formname; ?>" />
          <input type="hidden" name="pagebanner_current" value="<?php echo $image; ?>" />
		  <input type="hidden" name="id" value="<?php echo $id; ?>" />
		  <input type="hidden" name="redirect" value="<?php echo "home.php?d=".$dir."&op=list"; ?>" />		  
		  <input type="submit" name="Submit" value="Submit Menu" id="in_big" style="height:30px;"/>
         
         </td>
          </tr>
      </table>
	</form>	
	</div>
	
</div>
</div>




<script type="text/javascript">
jQuery(document).ready(function($) 
{ 
	$("#add_content").click(function () { 
		if($("#add_content").is(':checked')) {
			$("#tr_menu_content_label").show();  $("#tr_menu_content_text").show();  
			$("#article_title").attr('value', $("input#menu_title").val());  
		} else {
			$("#tr_menu_content_label").hide(); $("#tr_menu_content_text").hide();  
		}
	});	
	
	$("#menu_title").blur(function () {
	  var valTitle 	= $(this).val();
	  var hyphenated  = urlTitle(valTitle);             
	  $('#title_seo').val(hyphenated);       
	  
	  var valKeywords = $("#metawords").val();
	  var valMeta 	  = valTitle.replace(/[^a-zA-Z0-9]/g,",").replace(/[,]+/g,",").toLowerCase();
	  if(valKeywords == "") {  $("#metawords").val(valMeta); }
	});
});


</script>