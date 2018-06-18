<div id="event_dates_row" style="display:none;">
<textarea style="display:none" id="date_filler">

<tr class="tr_date_row_{0}">
<td>
	<div class="form-group">
		<label class="col-md-3">Date and Time</label>
		<div class="col-md-9">
			<div class="col-md-6 nopadd"><input type="text" name="date_add[{0}]" id="date_add_{0}" value=""  class="form-control  date-pick hasDatePicker required" ></div>
			<div class="col-md-3 nopadd"><select name="time_start[{0}]" id="time_start_{0}" class="form-control"><?php echo displayTime(); ?></select></div>
			<div class="col-md-3 nopadd"><select name="time_end[{0}]" id="time_end_{0}" class="form-control"><?php echo displayTime('','p'); ?></select></div>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3">Location &amp; Venues</label>
		<div class="col-md-9">
			<div class="col-md-6 nopadd"><input type="text" name="location[{0}]" id="date_location_{0}"  class="form-control required" placeholder="Location" ></div>
			<div class="col-md-6 nopadd"><input type="text" name="venue[{0}]" id="date_venue_{0}"  class="form-control required" placeholder="Venue(s)" ></div>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3">Status</label>
		<div class="col-md-9">
			<div class="col-md-6 nopadd"><input type="text" name="status[{0}]" id="status_{0}"  class="form-control required" placeholder="Status" ></div>
		</div>
	</div>
	
	<div class="form-group" style="height:5px"></div>

</td>
<td><a href="#" onclick="del_date_row({0});return false;"><i class="fa fa-times"></i></a></td>
</tr>

</textarea>
</div>



<?php
$show_addrow		= true;
$formaction			= '_add';
$fredirect			= $ref_page;
$date_start 		= array();
$itemDates			= '';
$date_record_id		= (isset($request['date_id'])) ? $request['date_id'] : '';


if($date_record_id <> '')
{
	$course_id		= (isset($request['crs_id'])) ? $request['crs_id'] : '';
	$fredirect		= 'hforms.php?d=courses&op=edit&id='.$course_id;
	$formaction		= '_edit';
	
	$sq_item_dates = "SELECT * FROM `mrfc_dt_content_dates` WHERE (`date_record_id` = ".q_si($date_record_id)."); ";
	$rs_item_dates = $cndb->dbQuery($sq_item_dates);
	if( $cndb->recordCount($rs_item_dates)) 
	{
		
		$show_addrow		= false;
		$loop 		= 55;
		$row  		= $date_record_id;
		
		while($cn_item_dates = $cndb->fetchRow($rs_item_dates))
		{
			$date_start = datePickerFormat($cn_item_dates['date']); 
			$time_start = date("H:i:s",strtotime($cn_item_dates['date']));
			$time_end 	= date("H:i:s",strtotime($cn_item_dates['end_date']));
			$location	= $cn_item_dates['location'];
			$venue		= $cn_item_dates['venue'];
			$status		= $cn_item_dates['status'];
			$loop += 1;
			
			$itemDates = '<div class="form-group">
		<label class="col-md-3">Date and Time</label>
		<div class="col-md-9">
			<div class="col-md-6"><input type="text" name="date_add['.$row.']" id="date_add_'.$row.'" value="'.$date_start.'"  class="form-control  date-pick hasDatePicker required" ></div>
			<div class="col-md-3"><select name="time_start['.$row.']" id="time_start_'.$row.'" class="form-control">'.displayTime(''.$time_start.'').'</select></div>
			<div class="col-md-3"><select name="time_end['.$row.']" id="time_end_'.$row.'" class="form-control">'.displayTime(''.$time_end.'').'</select></div>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3">Location &amp; Venues</label>
		<div class="col-md-9">
			<div class="col-md-6"><input type="text" name="location['.$row.']" id="date_location_'.$row.'"  class="form-control required" placeholder="Location" value="'.$location.'"  ></div>
			<div class="col-md-6"><input type="text" name="venue['.$row.']" id="date_venue_'.$row.'"  class="form-control required" placeholder="Venue(s)" value="'.$venue.'"></div>			
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-md-3">Status</label>
		<div class="col-md-9">
			<div class="col-md-6"><input type="text" name="status['.$row.']" id="status_'.$row.'"  class="form-control required" placeholder="Status" value="'.$status.'"></div>
		</div>
	</div>';
		}
	}
}
?>

<div>
	<form name="course_dates" id="course_dates" class="rwdform rwdfull rwdstripes rwdvalid" method="post" action="adm_posts.php">
	<input type="hidden" name="content_id" id="content_id" value="<?php echo @$fData['id']; ?>">
	<input type="hidden" name="date_record_id" id="date_record_id" value="<?php echo $date_record_id; ?>">
	<input type="hidden" name="formname" value="frm_courses_date_add" />
	<input type="hidden" name="formact" value="<?php echo $formaction; ?>" />
	<input type="hidden" name="redirect" value="<?php echo $fredirect; ?>" />
		
	<div>
		<table style="margin:0;" id="event_dates_table" border="0" class="full nopadd">
		<tbody>
		<?php echo @$itemDates; ?>
		</tbody>
		</table>
	</div>	
	<div class="form-group">
		<div class="col-md-3"></div>
		<div class="col-md-3">
			<?php if($show_addrow) { ?>
			<a id="add_date" class="btn btn-sm btn-warning col-md-12 txt13">Add Date [+]</a>
			<?php } ?>
		</div>
		<div class="col-md-3 pull-right">
		<button type="submit" class="btn btn-sm btn-primary col-md-12" id="f_submit" name="submit" value="1">Submit</button>
		</div>
	</div>
	</form>
</div>




	
<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	<?php if($show_addrow) { ?>
		if( $('#course_dates').length ) 
		{ 

			/* ============= @@ additional toggles ======================== */

			var template_doc = jQuery.validator.format($.trim($("#date_filler").val()));

			//function addRow_doc() { $(template_doc(j++)).appendTo("#event_dates_table tbody"); }
			function addRow_doc() { 
				var newDate;
				if(j > 1)
				{   var pd = $("#date_add_"+(j-1)).attr('value'); 
					if(pd != ""){
						/*var d1 = new Date(pd);
						newDate = addDays(d1, 2); */
					}
				}
				$(template_doc(j++)).appendTo("#event_dates_table tbody"); 
				$("#date_add_" + (j-1)).attr("value", newDate);

			}
			function delRow_doc() { j= j-1; $(".tr_date_row_"+j).remove();  }

			var j = 1; <?php if(count($date_start) == 0){ ?> addRow_doc(); <?php } ?> 
			$("#add_date").click(addRow_doc);
			$("#del_date").click(delRow_doc);

			/* ============= @@ validations ======================== */

			var validator = $("#course_dates").validate({ ignore: '' });

			$('input.date-pick').live('click', function() {
				$(this).datepick('destroy').datepick({dateFormat: 'mm/dd/yyyy', showOn:'focus'}).focus();
			});

		}	
	<?php } ?>	
		
	
		
});

function addDays(theDate, days) 
{	
	var ndate = new Date(theDate.getTime() + days*24*60*60*1000);
	var dd = ndate.toISOString().substr(8,2); //ndate.getDate();
    var mm = ('0' + (ndate.getMonth() + 1)).slice(-2);
    var y = ndate.getFullYear();
	
	var someFDate = mm + '/' + dd + '/' + y;
    return someFDate;
}


function del_date_row(row_id) { 
	$(document).ready(function(){ 
		$(".tr_date_row_"+row_id).remove();
	});
}

</script>
		