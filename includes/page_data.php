

<div class="bg-lightgray">
<?php include("includes/nav_crumbs.php"); ?>
</div>


<div class="page_width">
<div class="padd5_t">
<div class="subcolumns clearfix" style="overflow:visible;">

	
	
	<div class="col-md-12 bg-white panel-home-guts">
		<div class="padd15" style="min-height:700px;">
		
		<?php
            $datacounty_id  = (isset($_REQUEST['cid']) and is_numeric($_REQUEST['cid'])) ? $_REQUEST['cid'] : 47;
            $county_profile = $dispData->get_countyProfile($datacounty_id); //displayArray($county_profile);
            $datacounty     = $county_profile['county']; //'Nairobi';
        ?>
			<div id="wrapper" class="">
			    <div class="row">
			        <div class="col-md-7"><?php echo display_PageTitle('County Data: <span class="txtmaroon">'.$datacounty.'</span> ', '', ''); ?></div>
			        <div class="col-md-3 pull-right txtright">
			            <select class="form-controlX" id="datacounty" name="datacounty" style="font-size:16px;padding:8px 15px;width:250px;">
                          <option value=""> - Select County -</option>
                           <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county", @$datacounty_id) ?>
                          </select>
			        </div>
			    </div>
			
			    <iframe src="<?php echo DOMAIN_OPENCOUNTY; ?>budget_mrc.php?cid=<?php echo $datacounty_id; ?>" style="width:100%; height:2700px;" scrolling="yes"></iframe>
			
			</div>
			
		</div>
	</div>
	
	
	
</div>
</div>
</div>

<script>
jQuery(document).ready(function($) {	
	$("#datacounty").change(function() {		 
		var cid = $("select#datacounty option:selected").val();		
		location.href = "county-data/?cid="+cid+"&tk="+Math.random();		
    });
});
</script>






