<?php
function membersSelect($leader = ''){
    $ddSelect=new drop_downs;
    $member_select = $ddSelect->dropper_select("mrfc_app_profiles", "leader_id", "leader_name", $leader);
    return $member_select;
}
?>

<div id="event_dates_row" style="display:none;">
<textarea style="display:none" id="date_filler">

<tr class="tr_date_row_{0}">
<td>
	<div class="form-group">
		<label class="col-md-3">Member</label>
		<div class="col-md-9">
			<div class="col-md-6 nopadd">
			    <select name="leader_id[{0}]" id="leader_id_{0}"  class="form-control  ">
                      <?php echo membersSelect(); ?>
                </select>
			</div>
			<label class="col-md-3 nopadd txtright">Position:</label>	
			<div class="col-md-3 nopadd">
               <select name="leader_role_id[{0}]" id="leader_role_id_{0}" class="form-control">
                <option value="2" selected>Member</option><option value="1">Chair</option>
                </select>
            </div>
					
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
$record_id		    = (isset($request['rec_id'])) ? $request['rec_id'] : '';


if($record_id <> '')
{
	$committee_id		= (isset($request['comm_id'])) ? $request['comm_id'] : '';
	$fredirect		= 'hforms.php?d=committee&op=edit&id='.$committee_id;
	$formaction		= '_edit';
	
	$sq_item_dates = "SELECT * FROM `mrfc_app_committee_members` WHERE (`record_id` = ".q_si($record_id)."); ";
	$rs_item_dates = $cndb->dbQuery($sq_item_dates);
	if( $cndb->recordCount($rs_item_dates)) 
	{
		
		$show_addrow		= false;
		$loop 		= 55;
		$row  		= $date_record_id;
		
		while($cn_item_dates = $cndb->fetchRow($rs_item_dates))
		{
			$date_start = datePickerFormat($cn_item_dates['date_start']); 
			//$time_start = date("H:i:s",strtotime($cn_item_dates['date']));
			//$time_end 	= date("H:i:s",strtotime($cn_item_dates['end_date']));
			$leader_id	        = $cn_item_dates['leader_id'];
			$leader_role_id		= $cn_item_dates['leader_role_id'];
			$status_id		    = yesNoChecked($cn_item_dates['status_id']);
			$loop += 1;
            
            $mem_select     = ($leader_role_id == 2) ? 'selected' : '';
            $chair_select   = ($leader_role_id == 1) ? 'selected' : '';
            
			
			$itemDates = '
            <div class="form-group">
                <label class="col-md-3">Member</label>
                <div class="col-md-9">
                    <div class="col-md-5">
                        <select name="leader_id['.$row.']" id="leader_id_'.$row.'"  class="form-control  ">
                              '. membersSelect($leader_id) .'
                        </select>
                    </div>
                    <label class="col-md-3 txtrightx">Position:</label>	
                    <div class="col-md-4 ">
                       <select name="leader_role_id['.$row.']" id="leader_role_id_'.$row.'" class="form-control">
                        <option value="2" '.$mem_select.'>Member</option><option value="1" '.$chair_select.'>Chair</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3">Date Start</label>
                <div class="col-md-9">
                    <div class="col-md-5">
                            <input type="text" name="date_start['.$row.']" id="date_add_'.$row.'" value="'.$date_start.'"  class="form-control  date-pick hasDatePicker required" >
                    </div>
                    <label class="col-md-3">Active</label>
                    <div class="col-md-4">
                        <label class="radiolabel control-labelx" for="status_id">
                            <input type="checkbox" name="status_id" id="status_id" '.$status_id.' class="radio-inline"/>  
                         Yes / No</label>
                     </div>
                </div>
            </div>
            ';
    
            /*$row = '
	
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
	</div>';*/
		}
	}
}
?>

<div>
	<form name="frm_committee_member" id="frm_committee_member" class="rwdform rwdfull rwdstripes rwdvalid" method="post" action="adm_posts.php">
	<input type="hidden" name="committee_id" id="committee_id" value="<?php echo @$fData['id']; ?>">
	<input type="hidden" name="record_id" id="record_id" value="<?php echo $record_id; ?>">
	<input type="hidden" name="formname" value="frm_committee_member" />
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
		<div class="col-md-3">&nbsp;</div>
		<div class="col-md-3">
			<?php if($show_addrow) { ?>
			<a id="add_date" class="btn btn-sm btn-plain col-md-12 txt13">Add Item [+]</a>
			<?php } ?>
		</div>
		<div class="col-md-3 pull-right">
		    <button type="submit" class="btn btn-sm btn-warning col-md-12" id="f_submit" name="submit" value="1">Submit</button>
		</div>
	</div>
	</form>
</div>




	
<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	<?php if($show_addrow) { ?>
		if( $('#frm_committee_member').length ) 
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

			var validator = $("#frm_committee_member").validate({ ignore: '' });

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
		