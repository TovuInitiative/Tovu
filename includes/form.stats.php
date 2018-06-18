

<div class="row">&nbsp;</div>

<?php $redirect = $_SERVER['REQUEST_URI'];  ?>

<?php echo display_PageTitle('Devolved Functions: County Statistics Reporting', '', 'nocapsx'); ?>
<p>Fill in the details below:-</p><br>


<div >
<form class="rwdform rwdvalid"  action="postsX.php" method="post" name="feedback" id="feedback">

  <div>
    <label class="required col-md-3"  for="county_id">Select County</label>
    <div class="col-md-9">
      <select name="county_id" id="county_id" class="form-control required">
          <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county") ?>
    </select>
    </div>
  </div>
  
  <div>
    <label class="required col-md-3"  for="stats_year" >Select Period</label>
    <div class="col-md-9">
       <select name="stats_year" id="stats_year" class="form-control required">
        <option value="">Select</option>
          <?php for($d=date("Y"); $d>=(date("Y")-20); $d--) { ?>   <option><?php echo $d; ?></option><?php } ?> 
        </select>
    </div>
  </div>
  
  <div>
    <label class="required col-md-3"  for="function_id">Select Function</label>
    <div class="col-md-9">
      <select name="function_id" id="function_id" class="form-control required" onchange="javascript: show_indicators()">
          <?php echo $ddSelect->dropper_select("mrfc_dat_functions", "function_id", "function") ?>
    </select>
    </div>
  </div>
  

  <div>
    <label class="required col-md-3"  for="indicator_id">Select Indicator</label>
    <div class="col-md-9" id="indicator_box">
      <input type="text" class="form-control required" id="indicator_id" readonly placeholder="Select function first">
    </div>
  </div>
  
  <div>
    <label class="required col-md-3"  for="value">Indicator Value</label>
    <div class="col-md-9">
        <div class="col-md-6 nopadd">
          <input type="text" id="value" name="value" class="form-control required number" placeholder="Enter Value">
        </div>
        <div class="col-md-6 nopadd">
          <input type="text" id="value_label" name="value_label" placeholder="Value Label" class="required">
        </div>
    </div>
  </div>

  <div>
    <label class="col-md-3"  for="comments">Comments</label>
    <div class="col-md-9">
      <textarea id="comments" name="comments"  class="" spellcheck="true" placeholder="Enter comments if any"></textarea>
    </div>
  </div>
  
  
  
  <div>   
    <label class="col-md-3"  >&nbsp;</label>
    <div class="col-md-9">
		<?php ?><?php ?>
		<button type="submit" name="submit" value="Submit" class="btn btn-primary btn-icon col-md-4"> Submit</button> 
		
		<input type="reset" name="reset" id="reset" class="btn col-md-4 pull-right " value="Reset">
		<input name="formname" type="hidden" value="dat_stats" />
		<input name="nah_snd" id="nah_snd" type="text" />  
    </div>
  </div>
  
<div>
	
</div>
</form>


</div>
<div class="clearfix padd10"></div>
<?php
//$aLoader    = '<div class="txtcenter"><img src="image/layout/a-loader.gif" alt="loading..." /></div>'; 
$aLoader    = 'loading'; 
?>

<script type="text/javascript">
function show_indicators()
{ 
	//if(isRequired === undefined) { isRequired = 1; } else { isRequired = 'off'; }	
	
	jQuery(document).ready(function($) {
		function_key = $('#function_id option:selected').val(); 
		
		//alert(isReq);
		if(function_key !== '')
		{
			$.ajax({
				type: 'GET',
				url: 'ajforms.php', 
				data: 'd=dat_stats&parent='+ function_key + '',
				dataType: 'html',
				beforeSend: function() {
					$('#indicator_box').html('<?php echo $aLoader; ?>');
				},
				success: function(response) {
					$('#indicator_box').html(response);
				}
			});
		}
		else
		{
			$('#indicator_box').html('<input type="text" class="form-control required" id="indicator_id" readonly placeholder="Select function first">');
		}
			
	});
}
</script>