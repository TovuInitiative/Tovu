


<!-- style="width:100%; max-width:900px; margin:0 auto; border:0px solid"-->
<div class="row">
	
	<div class="col-md-7"> 
		<?php include("includes/vds_forms.php"); ?>	
	</div>
	
	<div class="col-md-5 pull-right">
	
		<?php if($op <> 'new') { ?>
			<div class="row">
			<h3>Add Committee Member(s)</h3>
			<?php //include("includes_prod/adm_product_gallery_add.php"); ?>
			
			<?php include("includes/adm_committee_member_form.php"); ?>
			<?php include("includes/adm_committee_member_list.php"); ?>
			
			<form action="adm_posts_shop.php" method="post">
			<div class="padd10X" id="box_gallery"></div>
			<input type="hidden" name="redirect" value="<?php echo $ref_page; ?>" />
			</form>	
			</div>
		<?php } ?>
		
	</div>
	
	
</div>


<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	$("#upload_y").click(function () { 
		$("#upload_avatar").show();  $("#reg_photo").click();   
	});
	$("#upload_n").click(function () { 
		$("#upload_avatar").hide();   
	});
});

function setFilename(upBox, upField, upKey)
{
 jQuery(document).ready(function($){
  	var fileDefaultText = 'No file selected';
	
  	var filenameTag = $('div#'+upBox+' span.filename');
	var filenameBtn = $('div#'+upBox+' span.action');
	
	var fileLabel = $('input#file_title_'+upKey+'');
	
	
	var $el = $('#'+upField+''); 
	var filename = $el.val();
	var filenameC = $el.val();
	
	filenameC = filenameC.split(".");
	filenameC = filenameC[(filenameC.length-1)].toUpperCase();
	
		if (filename === '') {	filename = fileDefaultText;	}
		else { 	
			filename = filename.split(/[\/\\]+/); filename = filename[(filename.length-1)];		
			filenameTag.html(filename);
			fileLabel.attr("value", filename.substr(0,filename.length-4)).focus();
	
		}
	});
};
</script>