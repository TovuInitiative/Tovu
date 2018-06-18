
<div>



<?php

$sector_id = '';
$project_id = '';
	
	//displayArray(master::$menusFull);
	
if(isset($_REQUEST['op'])) { $op=$_REQUEST['op']; } else { $op=NULL; }
if(isset($_REQUEST['id'])) { $id=$_REQUEST['id']; } else { $id=NULL; }


	
	if($op=="edit"){ $title_new	= "Edit "; } 
elseif($op=="new") { $title_new	= "New "; $id = 60;}
	
if($op=="edit")
{

// ############################################################
	include("includes/adm_form_gallery_edit.php");
// ############################################################		
	
} 
elseif($op=="new")
{
	$article_title = '';
	$file_caption = '';
	$id					= "";
		$id_parent1			= "";
		$id_parent2			= "";
		$title				= "";
		$description			= "";
		$published			="checked ";		
		$formname			= "gallery_album_new";
		$file_name_v	     = "https://www.youtube.com/watch?v=";
		
		
		$checked_vid = "";
		$checked_pic = "";
		
		$checked_vid_box = '  style="display: none; " ';
		$checked_pic_box = ''; //'  style="display: none; " ';
		$require_pic_title = '';
		$require_vid_title = '';
		
	if($dir == "video gallery") { $checked_vid = " checked "; $checked_vid_box = ''; $require_vid_title = 'required'; }
	if($dir == "photo gallery") {} $checked_pic = " checked "; $checked_pic_box = ''; $require_pic_title = 'required'; 


include("includes/adm_form_gallery_add.php");

}

	?>


	
</div>






<script type="text/javascript">
jQuery(document).ready(function($) 
{
	$('label.required').append('&nbsp;<span class="rq">*</span>&nbsp;');
	//$('textarea').autoResize({extraSpace : 10 });
	
	
	$("#add_video").click(function () { 
		$("#file_box_video").show(); $("#file_box_photo").hide(); 
		$("#video_title").addClass("required"); $("#photo_title").removeClass("required");   });
	$("#add_photo").click(function () { $("#file_box_video").hide(); $("#file_box_photo").show();   });
	
	$("#adm_gallery_form").validate();
	
	$("select#id_parent").change(function () {
	  var valTitle = $("input#photo_title").val();
	  var valSlash = /(.+)(\/)/g; 
	  var valClean, str = "";
	  $("select#id_parent option:selected").each(function () { str += $(this).text() + " ";  });	  
	  if(str.search(valSlash) == 0) { valClean = str.replace(valSlash,""); } else { valClean = str; }	  
	  if(valTitle == "") { $("input#photo_title").attr("value", valClean); }
	});	
	
});


</script>