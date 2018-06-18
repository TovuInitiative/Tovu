
<!-- @begin :: content area -->
<div>


<?php
if(isset($_REQUEST['sec'])) {$newsec=$_REQUEST['sec'];} else {$newsec='basic';}

//$id_portal = $adm_portal_id;

$sector_id = '';
$project_id = '';

	$ths_page="?d=$dir&op=$op";
	
	if($op=="edit"){ $title_new	= "Edit "; } 
elseif($op=="new") { $title_new	= "New "; }


$date_start = array();
$book_form = 0;
$section[6] = '';
$section[7] = '';
	
if($op=="edit"){

	if($id)
	{
	
	$sqdata="SELECT   `id`, `id_menu`, `id_section`, `title`, `article`, `date_modified`, `published`, `frontpage`, `sidebar`, `id_menu2`, `yn_static`, `seq`, `title_sub`, `intro_home`, `yn_gallery`, DATE_FORMAT(`date_created`, '%m/%d/%Y') as `date_created`, `parent`, `id_portal`, `approved`, `id_owner`,  `arr_extras`   FROM `".$pdb_prefix."dt_content`  WHERE  (`id` = ".quote_smart($id).")";
	
	//echo $sqdata;
	$rsdata=$cndb->dbQuery($sqdata);// ;
	$rsdata_count= $cndb->recordCount($rsdata);
		
		if($rsdata_count==1)
		{
		$cndata=$cndb->fetchRow($rsdata);
		
		$pgtitle				="<h2 style='padding:0; margin:0;'>Edit Event</h2>";
		
		$id					= $cndata[0];
		$id_menu			= $cndata[1];
		$id_menu2			= $cndata[9];
		$id_section			= $cndata[2];
		$section[$id_section] = ' selected ';
		$title				= html_entity_decode(stripslashes($cndata[3]));
		$title_sub			= html_entity_decode(stripslashes($cndata[12]));
		$article			= html_entity_decode(stripslashes($cndata[4]));//nl2br()
		
		//$article 			= ereg_replace(SITE_PATH, '', $article);
		//$article 			= ereg_replace(SITE_DOMAIN_LIVE, '', $article);
		
		$article	= str_replace(SITE_PATH, '', $article);
		$article	= str_replace(SITE_DOMAIN_LIVE, '', $article);		
		$article 	= str_replace('"image/', '"'.SITE_DOMAIN_LIVE.'image/', $article);
		//$article 	= ereg_replace('image/', ''.SITE_DOMAIN_LIVE.'image/', $article); //'image/'
		$article	= remove_special_chars(stripslashes($article));
				
		//echo SITE_DOMAIN_LIVE;
		$published			= $cndata[6]; 
		$frontpage			= $cndata[7]; 
		$sidebar			= $cndata[8]; 
		$yn_gallery		= $cndata[10]; 
		$yn_static		= $cndata[11]; 
		$position			= $cndata[11];
		$intro_home			= $cndata[13];
		$hasgallery			= $cndata[14];
		
		$created			= $cndata[15];
		//$parent				= unserialize($cndata[16]); 
		
		$approved			= $cndata[18];
		if($approved==1) {$approved="checked ";} else {$approved="";}
		
		$id_owner			= $cndata[19];
		$link_static			= $cndata[20];
		
				
		if($published==1) {$published="checked ";} else {$published="";}
		if($frontpage==1) {$frontpage="checked ";} else {$frontpage="";}
		if($sidebar==1) {$sidebar="checked ";} else {$sidebar="";}
		if($intro_home==1) {$intro_home="checked ";} else {$intro_home="";}
		
		if($hasgallery==1) {$gallery="checked ";} else {$gallery="";}
		
		if($yn_gallery==1) {$yn_gallery="checked ";} else {$yn_gallery="";}
		
			$upload_picy	="";
			$upload_picn	=" checked ";
		
		
		
		$arr_extras			= @unserialize($cndata['arr_extras']); 
		//displayArray($arr_extras);
		if(is_array($arr_extras)) {
			$ev_location 	= @$arr_extras['location'];
			$book_form 		= @$arr_extras['book_form'];
			$book_amount 	= @$arr_extras['book_amount'];
		}
		
		$sq_item_parent = "SELECT `id_parent`,`id_content` FROM `mrfc_dt_content_parent` WHERE (`id_content`=".quote_smart($id)."); ";
		$rs_item_parent = $cndb->dbQuery($sq_item_parent);
		if( $cndb->recordCount($rs_item_parent)) {
			while($cn_item_parent = $cndb->fetchRow($rs_item_parent))
			{ if($cn_item_parent[0] <> 0) { $parent[] = $cn_item_parent[0]; } }
		}
		
		/* ============================================================================================= */
		/* GET -- PROJECT >>> LINKS
		/* --------------------------------------------------------------------------------------------- */	
		//$pLinks = $ddSelect->getProjectLinks('id_content', $id);
		//if(is_array($pLinks)){ $sector_id = $pLinks['sector_id']; $project_id = $pLinks['project_id']; }
		/* ============================================================================================= */
		
		
		$sq_item_dates = "SELECT date, end_date FROM `mrfc_dt_content_dates` WHERE (`id_content` = ".quote_smart($id).") order by date ASC; ";
		$rs_item_dates = $cndb->dbQuery($sq_item_dates);
		if( $cndb->recordCount($rs_item_dates)) 
		{
			$loop = 55;
			while($cn_item_dates = $cndb->fetchRow($rs_item_dates))
			{
				$date_start[$loop] = datePickerFormat($cn_item_dates['date']); 
				$time_start[$loop] = date("H:i:s",strtotime($cn_item_dates['date']));
				$time_end[$loop] = date("H:i:s",strtotime($cn_item_dates['end_date']));
				
				$loop += 1;
			}
		}
		
		
		//echo $id_menu2;
		$formname			= "adm_event_edit";
		}
	}


} 
elseif($op=="new")
	{
	
		$pgtitle				="<h2 style='padding:0; margin:0;'>Add New Event</h2>";
		
		$id					= "";
		$id_menu			= "";
		$id_menu2			= "";
		
		$title				= "";
		$ev_location		= '';
		$article			= "";
		$created			= date("m/d/Y");
		
		$parent = "";  	//array('7','54'); //
		$id_section = 6; //1
		$section[$id_section] = ' selected ';
		
		$published			= "checked ";
		$approved			 = "checked ";
		$frontpage			= "";
		$yn_gallery		= ""; 
		$yn_static		= "";
		$position			= "9";
		
		$book_amount	= 0;
		
		$upload_picn	="";
		$upload_picy	=" checked ";
			
		$photo_box = "none";
		$video_box = "block";
		$video = "checked "; $photo = "";
		
		$hasgallery="";
		$gallery="";
		$sidebar="";	
		$formname			= "adm_event_new";
	}
 //$dispData->siteMenu(); 
 //print_r($dispData->menuMain);
 
 //echo getcwd().DIRECTORY_SEPARATOR;
 ?>






<div id="event_dates_row" style="display:none;">
<textarea style="display:none" id="date_filler">

<tr class="tr_date_row_{0}">
<td><input type="text" name="date_add[{0}]" id="date_add_{0}" value=""  class="form-control  date-pick hasDatePicker required" ></td>
<td><select name="time_start[{0}]" id="time_start_{0}" class="form-control"><?php echo displayTime(); ?></select></td>
<td><select name="time_end[{0}]" id="time_end_{0}" class="form-control"><?php echo displayTime('','p'); ?></select></td>
<td><a href="#" onclick="del_date_row({0});return false;"></a></td>
</tr>

</textarea>
</div>


<?php
$itemDates = '';
if($op=='edit')
{
if(count($date_start) > 0)
{
	foreach($date_start as $row => $rowval)
	{
		
$itemDates .= '<tr class="tr_date_row_'.$row.'">
<td><input type="text" name="date_add['.$row.']" id="date_add_'.$row.'" value="'.$rowval.'"  class="form-control date-pick required" ></td>
<td><select name="time_start['.$row.']" id="time_start_'.$row.'" class="form-control">'.displayTime(''.$time_start[$row].'').'</select></td>
<td><select name="time_end['.$row.']" id="time_end_'.$row.'" class="form-control">'.displayTime(''.$time_end[$row].'').'</select></td>
<td><a href="#" onclick="del_date_row('.$row.');return false;"></a></td>
</tr>';

	}
}
}
?>



<div style="width:100%;margin:0 auto; border:0px solid">
	
<div style="padding:10px;">

<form class="rwdform rwdfull rwdstripes rwdvalid" id="cont_basic" name="rage" method="post" action="adm_posts.php"  enctype="multipart/form-data">
<input type="hidden" name="sidebar" value="0"/>
<input type="hidden" name="id_portal" value="1" />
<input type="hidden" name="id_section" value="<?php echo $id_section; ?>" />
<!--<input type="hidden" name="approved" value="1" />-->

<?php echo $pgtitle; ?>
  <table  border="0" cellspacing="1" cellpadding="5" align="center" class="tims" style="width:100%" >
   
	<tr>
      <td nowrap="nowrap" class="col-md-2"><label for="id_parent">Parent Menu:</label></td>
      <td colspan="3" class="col-md-10">
        <select name="id_parent[]" id="id_parent" multiple="multiple" class="form-control multiple" style="">
          <?php echo  $dispData->build_MenuSelectRage(0, $parent); ?>
          </select>      </td>
      </tr>
    <tr>
    	<td nowrap="nowrap"><label for="article_title">Title:</label></td>
    	<td colspan="3">
		<input type="text" name="title" id="article_title" value="<?php echo $title; ?>" class="form-control required"></td>
    </tr>
    
	
    <tr>
    	<td nowrap="nowrap"><label>Event Dates:</label></td>
    	<td colspan="3">
		<!-- DATES -->
		
		
            <table style="margin:0;" id="event_dates_table" border="0" class="full">
                    <thead>
                    <tr>

                    <th><strong>Date <em>(mm/dd/yyyy)</em></strong></th>
                    <th><strong>Start Time</strong></th>
                    <th><strong>End Time</strong></th>
                    <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php echo $itemDates; ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <th><a id="del_date" class="nav_button">Remove Date [-]</a> </th>
                        <th colspan="3" style="text-align:right"><a id="add_date" class="nav_button">Add Date [+]</a> </th>
                      </tr>  
                    </tfoot>

            </table>


            <hr />
				
		<!-- END: DATES -->
		</td>
    </tr>
    
    
    <tr>
    	<td>
    		<label>Event Description</label>			  </td>
    	<td colspan="3">
    	<textarea name="article" id="article" class="form-control wysiwyg" style="height:200px;" ><?php echo @$article; ?></textarea>
    	</td>
    </tr>
	
	
    <tr>
      <td nowrap="nowrap"><label for="ev_location">Event Venue</label></td>
      <td colspan="3">
      <div class="col-md-6 nopadd"> 
      		<input type="text" name="ev_location" id="ev_location" value="<?php echo $ev_location; ?>" class="required form-control" />
      </div>
      
      <div class="col-md-3">
      		<label class="inline" style="color:#900"><input type="checkbox" name="published" id="published" <?php echo $published; ?> class="radio"/> <strong>Is Published</strong></label>
      </div>
      <div class="col-md-3">
      		<label class="inline" style="color:#900"><input type="checkbox" name="approved" id="approved" <?php echo $approved; ?> class="radio"/> <strong>Is Approved</strong></label>
      </div>
	 
	  </td>
	</tr>	
	
	<input type="hidden" name="booking_form" value="off" />
	<input type="hidden" name="booking_amount" value="0" />
	<?php /*?>
    <tr>
      <td nowrap="nowrap"><label>Options</label></td>
      <td>
	  
<label class="inline">
<input type="checkbox" id="booking_form" name="booking_form" <?php echo yesNoChecked($book_form); ?>  class="radio"/>	<strong>Show Registration Form </strong>
</label>

		</td>
		<td><label><strong>Registration Amount</strong></label></td>
		<td><input type="text" name="booking_amount" id="booking_amount" value="<?php echo $book_amount; ?>" class="number"></td>
    </tr>
    <?php */?>
	
	<tr>
      <td nowrap="nowrap"></td>
      <td>
	  
	  </td>
	  <td colspan="2">
	  
	  </td>
	</tr>
	
		
    <tr>
      
      <td>&nbsp;</td>
      <td>
       <button type="submit" class="btn btn-small btn-success col-md-3" id="Submit" name="Submit">Submit</button>
       <!--<input type="submit" name="Submit" value="Submit"/>-->
        <input type="hidden" name="formname" value="<?php echo $formname; ?>" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="redirect" value="<?php echo "home.php?d=".$dir; ?>" /></td>
        <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>	

</div>
</div>
	
	

</div>
<!-- @end :: content area -->
	


	
<script type="text/javascript">
jQuery(document).ready(function($)
{ 
	$('label.required').append('&nbsp;<span class="rq">*</span>&nbsp;');
	
	
	$("select#id_parent").change(function () {
	  var valTitle = $("input#article_title").val();
	  var valSlash = /(.+)(\/)/g; 
	  var valClean, str = "";
	  $("select#id_parent option:selected").each(function () { str += $(this).text() + " ";  });	  
	  if(str.search(valSlash) == 0) { valClean = str.replace(valSlash,""); } else { valClean = str; }	  
	  if(valTitle == "") { $("input#article_title").attr("value", valClean); }
	});	


	if( $('#cont_basic').length ) 
	{ 
	 
	/* ============= @@ additional toggles ======================== */
	
	var template_doc = jQuery.validator.format($.trim($("#date_filler").val()));
	
	//function addRow_doc() { $(template_doc(j++)).appendTo("#event_dates_table tbody"); }
	function addRow_doc() { 
		var newDate;
		if(j > 1)
		{   var pd = $("#date_add_"+(j-1)).attr('value');
			//var d1 = new Date(pd);
			//newDate = addDays(d1, 2); 
		}
		$(template_doc(j++)).appendTo("#event_dates_table tbody"); 
		//$("#date_add_" + (j-1)).attr("value", newDate);
		
	}
	function delRow_doc() { j= j-1; $(".tr_date_row_"+j).remove();  }
	
	var j = 1; <?php if(count($date_start) == 0){ ?> addRow_doc(); <?php } ?> 
	$("#add_date").click(addRow_doc);
	$("#del_date").click(delRow_doc);
	
	/* ============= @@ validations ======================== */
	
	var validator = $("#cont_basic").validate({ ignore: '' });
	
	$('input.date-pick').live('click', function() {
		$(this).datepick('destroy').datepick({dateFormat: 'mm/dd/yyyy', showOn:'focus'}).focus();
	});
	
	}	
		
		
	
		
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
		