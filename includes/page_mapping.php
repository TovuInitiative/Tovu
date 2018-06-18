

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
			        <div class="col-md-7"><?php echo display_PageTitle('National Projects ', '', ''); ?></div>
			        <div class="col-md-3 pull-right txtright"> </div>
			    </div>
			
			    <iframe src="mapping/index.html" style="width:100%; height:520px;" scrolling="no"></iframe>
			
			</div>
			
		</div>
	</div>
	
	
	
</div>
</div>
</div>







