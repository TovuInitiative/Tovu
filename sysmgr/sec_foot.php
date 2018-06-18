




<!-- JavaScript -->
<script type="text/javascript" src="../assets/scripts/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../assets/scripts/jquery-ui-1.10.2.min.js"></script>
<script type="text/javascript" src="../assets/scripts/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/scripts/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="../assets/scripts/misc/jquery.cookie.min.js"></script>

<script type="text/javascript" src="js/adm_validation.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/articles.js"></script>



<script type="text/javascript" src="../assets/scripts/validate/jquery.validate-1.14.min.js"></script>	

	
<script type="text/javascript" src="../assets/scripts/multiselect/jquery.multiselect.js"></script>
<script type="text/javascript" src="../assets/scripts/multiselect/jquery.multiselect.filter.js"></script>

<script type="text/javascript" src="../assets/scripts/datepick/jquery.plugin.js"></script>
<script type="text/javascript" src="../assets/scripts/datepick/jquery.datepick.js"></script>
<script type="text/javascript" src="../assets/scripts/misc/jquery.print.js"></script>

<link rel="stylesheet" type="text/css" href="../assets/scripts/toggles/toggles.css" />
<script type="text/javascript" src="../assets/scripts/toggles/toggles.min.js"></script>

<link rel="stylesheet" type="text/css" href="../assets/scripts/jwysiwyg/jquery.wysiwyg.css" />
<script type="text/javascript" src="../assets/scripts/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="../assets/scripts/jwysiwyg/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="../assets/scripts/jwysiwyg/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="../assets/scripts/jwysiwyg/controls/wysiwyg.table.js"></script>

<link rel="stylesheet" type="text/css" href="../assets/scripts/tagsinput/jquery.tagsinput.css" />
<script type="text/javascript" src="../assets/scripts/tagsinput/jquery.tagsinput.js"></script>

<link rel="stylesheet" type="text/css" href="../assets/scripts/modal/jquery.modal.css" />
<script type="text/javascript" src="../assets/scripts/modal/jquery.modal.js" charset="utf-8"></script>



<!-- page specific scripts -->
<script type="text/javascript" charset="utf-8">	
jQuery(document).ready(function($) {	 

	if($('label.required').length) { $('label.required').append('&nbsp;<span class="rq">*</span>&nbsp;'); }
	if($('.hasDatePicker').length) { $('.hasDatePicker').datepick(); }  
	if($('select.multiple').length) { $("select.multiple").multiselect().multiselectfilter(); }
	
	if($('#adm_download_form').length) 
	{
		$("#upload_on").click(function () { $("#file_box_upload").show(); $("#file_box_link").hide(); });
		$("#upload_off").click(function () { $("#file_box_upload").hide(); $("#file_box_link").show(); });		
		$("#adm_download_form").validate();
	}
	
	
	$.validator.addMethod("wysi_required", function (value, element) { return $('.wysi-required').val() !== ''; })
	
	
	if($('.hasDatePicker').length){ 
		$('.hasDatePicker').datepick();
	}
	
	if($('.tags-field').length){ 
		$('.tags-field').tagsInput({width:'auto'});
	}
	
	if($('.wysiwyg').length){ 
		$('.wysiwyg').wysiwyg({autoGrow: true,maxHeight: 400, resizeOptions: {},controls: {html: { visible: true }} }); 
	}
	
	
	
	if($('.rwdform').length){ 
		$('.rwdform').validate({errorPlacement: function(error, element) { }}); 
	}
	
	if($('.rwdvalid').length){ 
		$('.rwdvalid').validate({errorPlacement: function(error, element) { }}); 
	}
	
	if( $('.form_events').length ) 
	{ 
		//chgDate(); 
		/* ============= @@ additional toggles ======================== */

		var template_doc = jQuery.validator.format($.trim($("#date_filler").val()));
		function addRow_doc() { $(template_doc(j++)).appendTo("#event_dates_table tbody");  }
		function delRow_doc() { j= j-1; $(".tr_date_row_"+j).remove();  }

		var j = 1;  addRow_doc();  
		$("#add_date").click(addRow_doc);
		$("#del_date").click(delRow_doc);

		/* ============= @@ validations ======================== */

		var validator = $(".form_events").validate({ ignore: '' });

		$('input.date-pick').live('click', function() {
			$(this).datepick('destroy').datepick({showOn:'focus'}).focus();
		});	
	}	
	
	
	if($('#wrap_staff_access_logs').length) 
	{
		$("#cat_docs").click(function () { $("#cat_docs_list").show(); $("#cat_cont_list").hide(); });
		$("#cat_cont").click(function () { $("#cat_cont_list").show(); $("#cat_docs_list").hide(); });
		
		$("a#access_list_print").click(function(){
		   $("#wrap_staff_access_box").print();
		   return( false );
		});
	}
	
    
    $(".frmNoEdit :input").prop("disabled", true).css({"border":"1px solid #ddd", "background":"none"}).removeClass("wysiwyg").removeClass("tags-field");
	$(".frmNoEdit").prop("action", "#");
	$(".frmNoEdit").find(":submit, .hideable").css("display", "none");
	
});

function del_date_row(row_id) { 
	$(document).ready(function(){ 
		$(".tr_date_row_"+row_id).remove();
	});
}


	
function kbModalLoaded() {
	jQuery(document).ready(function($) {		
		
		$('a[href^="out.php"], a[href^="http://"], a[href^="https://"], a[href^="mailto:"]').attr({ target: "_blank" });	
		
		if( $('.modal-body').length ) 
		{  var _self = $('.modal-body'); if (_self.outerHeight() > 400){  _self.addClass('modal-scroll'); } }
		
		if( $('.rwdvalid').length ) { 
			$(".rwdvalid").validate({errorPlacement: function(error, element) { }}); }
				
		if( $('#fm_showcase').length ) 	{
			var template = $.validator.format($("#party_filler").val());
			function addRow_ed() { if(j<10){ j= i++;  $(template(j)).appendTo("#party tbody"); } }
			function delRow_ed() { $(".tr_party_"+j).remove(); j= j-1; }
			var j = 1; 	var i = 1; 	addRow_ed(); 
			$("#add_party").click(addRow_ed); $("#del_party").click(delRow_ed); 
			
			$("#fm_showcase").validate({errorPlacement: function(error, element) { }});
		}
		
		if( $('.modal-long').length ) 	{
			$(window).resize(function () {
				$('.modal-long').css({ 'height': ($(window).height() - 200), 'padding-bottom': '100px' });
				$('.modal.current').css({ 'top':'5%', 'bottom': '5%', 'margin-top': '0px' });
			}).resize();			
		}
		
		if( $('.nano').length ){ $(".nano").nanoScroller(); }
	});
}
	
	
	
	

function showStaffAccessLog(log_cat)
{ 	
	jQuery(document).ready(function($) {
		if(log_cat === 'cont') {
		   item_id = $('#id_log_cont option:selected').val(); 
		   item_val = 'Article Access Log: '+$("#id_log_cont option:selected").text()+'';
		}
		else {
		   item_id = $('#id_log_docs option:selected').val(); 
		   item_val = 'Document Access Log: '+$("#id_log_docs option:selected").text()+'';
		  // item_val = $("#id_log_docs option:selected").text();
		}
		
		
		if(item_id !== '')
		{
			$.ajax({
				type: 'GET',
				url: 'adm_operations.php', 
				data: 'log_cat=' + log_cat + '&log_item='+ item_id + '&tk=1482469758',
				dataType: 'html',
				beforeSend: function() {
					$('#wrap_staff_access_list').html('<img src="../images/loader.gif" alt="loading..."  />');
				},
				success: function(response) {
					$('#wrap_staff_access_list').html(response);
					$('#access_list_print').show();
				}
			});
			$('#access_list_label').html(item_val);
			
		}
			
	});
}

function urlTitle(text) {       
    text = text.replace(/[^a-zA-Z0-9]/g,"-").replace(/[-]+/g,"-").toLowerCase();
    return text;
}
    
function wordInString(s, words, replacement){ 
    var re = new RegExp( '\\b' + words.join('|') + '\\b','gi');
    return s.replace(re, replacement);
}    
</script>



<!--<script type="text/javascript" src="../assets/scripts/datatable/stringMonthYear.js"></script>-->
<script type="text/javascript" src="../assets/scripts/datatable/jquery.dataTables-1.10.12.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var current = $(".children").find("a").filter(function() { 
		return this.href.toLowerCase() == location.href.toLowerCase(); });
	
	if ( current.length ) {
		current.addClass("selected"); 
		$('ul.children li:has(a.selected)').addClass("active"); 
		$('ul.children:has(li.active)').css("display", "block"); 
	}
	
});



$(document).ready(function(){
	
	if( $('#frm_delete').length )
	{
	 	$('#frm_delete').submit( function() {
			var sData = oTable.$('input').serialize();
			//alert( "The following data would have been submitted to the server: \n\n"+sData );
			//return false;
     	});
		
	 	var oTable = $('#frm_delete_list').dataTable({
			"bJQueryUI": true 
			,"sPaginationType": "full_numbers"
			,"iDisplayLength": 50 
			,"aLengthMenu": [[50, 100, -1], [50, 100, "All"]]	
				 	});
	 
	}
	
	
	if( $('#example').length )
	{
		var oTable = $('#example').dataTable({
			"bProcessing": true
			,"bJQueryUI": true 
			,"sPaginationType": "full_numbers"			
			,"bStateSave": true
			,"iDisplayLength": 25 
			,"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
			, "aaSorting" : []
			/*,"bPaginate": true
			,*/
			 //, "sDom": '<"toolbar">lfrtip'
			
		});
	}
	
$("div.toolbar").html('<div class="bulk-action"> <div class="row"><div class="col-sm-7 col-md-7 col-lg-7 mb5 xs-width100p xs-center pull-right"><input type="hidden" name="action_for" id="action_for" value="articles" /><div class="pull-right"><div class="form-group xs-width100p"><div class="input-group"><select name="bulk_action_id" id="bulk_action_id" class="form-control"><option value="">Select Bulk Action</option><option value="Disapprove Selected">Disapprove Selected</option><option value="Mark Featured">Mark Featured</option><option value="Delete Revisions">Delete Revisions</option><option value="Show Selected">Show Selected</option><option value="Hide Selected">Hide Selected</option><option value="Enable Comments">Enable Comments</option><option value="Disable Comments">Disable Comments</option><option value="Enable Ratings">Enable Ratings</option><option value="Disable Ratings">Disable Ratings</option><option value="Reset Ratings">Reset Ratings</option><option value="Remove Comments">Remove Comments</option><option value="Reset Hits">Reset Hits</option><option value="Delete Selected">Delete Selected</option></select><span class="input-group-btn"><input type="submit" name="bulk_action" id="bulk_action" value="Apply" class="btn btn-danger bulkaction"><input type="hidden" name="bulk_action_alt" id="bulk_action_alt" value="Apply"></span></div></div></div></div>									</div></div>');
});
</script>					



	<script src="js/custom.js"></script>
	


					
	<!-- LOGOUT MODAL - STARTS -->
	<div class="modal fadeX modal-dialogX" id="logout_mdl" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content modal-no-shadow modal-no-border">
				<div class="modal-header">
					<h4 class="modal-titleX">Are you sure?</h4>
				</div>
				<div class="modal-body">
					You want to log out now! Any unsaved changes will be lost.
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-default" data-dismiss="modal" rel="modal:close">Cancel</button>-->
					<a class="btn btn-default" data-dismiss="modal" rel="modal:close">Cancel</a>
					<button type="button" class="btn btn-warning" data-dismiss="modal" onclick="window.location='adm_posts.php?signout=on';">Yes, log me out!</button>
				</div>
			</div>
		</div>
	</div>
	<!-- LOGOUT MODAL - ENDS -->		

			

					
</body>
</html>					