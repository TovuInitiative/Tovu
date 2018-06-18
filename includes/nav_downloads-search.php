<?php //echo REF_ACTIVE_URL; 
$sRequest = array_map("clean_request", $_REQUEST);
$county = @$sRequest['county']; //displayArray($sRequest);
$dir_year = @$sRequest['dir_year'];

?>
<form class="custom" action="library/" method="get" name="fm_dir_search" id="fm_dir_search" accept-charset="UTF-8">
<div class="errorBox">one required</div>
  
<!--<div class="txtwhiteX txt15 padd10 padd0_b bold txtupper">Search Resources</div>-->
<div class="subcolumns">
	
	<div class="col-md-5 padd2">
	<div class="padd5_t padd0_l">	
	<div>
	<input type="text" id="dir_keywords" name="keyword" maxlength="50" class="form-control dir-groupX requiredX" placeholder="Enter keyword to search resources" value="<?php //echo @$dir_keywords; ?>" />
	</div>
	</div>
	</div>
	
	
	<div class="col-md-2 padd2">
	<div class="padd5_t">	
	<div>
	<select name="county" id="county" class="form-control ">
		  <?php //echo $ddSelect->dropper_conf("county", '', 'Select County') ?>
	</select>
	</div>
	</div>
	</div>

	<div class="col-md-1 padd2">
	<div class="padd5_t">	
	<div>
	<select id="dir_year" name="dir_year" class="form-control dir-group padd0_r"><option value="">Year</option>
		<?php $yy=intval(date('Y'))-15; $yn=intval(date('Y')); for($i=2000; $i <=$yn; $i++){ echo '<option>'.$i.'</option>'; } ?>
	</select>
	</div>
	</div>
	</div>
	
	<div class="col-md-3 padd2">
	<div class="padd5_t">	
	<div>
	<select id="dir_type" name="dir_type" class="form-control Xdir-group">
		<option value="">Category</option>
		<?php echo $ddSelect->dropperResourceCats(); ?>
	</select>
	</div>
	</div>
	</div>
	

	
	<div class="col-md-1 padd2">
	  <div class="padd5_t">
	 
		<div>
			<div class="nomargin">
				<button type="input" name="dir_apply" id="dir_apply" value="Search" class="btn btn-success col-md-12 txt12">Search</button>
				<input type="hidden" name="formname" value="fm_dir_search" /> 
			</div>
		</div>		
	  </div>
	</div>	
	
	
	<!--<div class="col-md-2 padd2">
	  <div class="padd5_t">	  
	  <a href="#" class="btn btn-primary col-md-12 txt12" >Advanced Search</a>
	  </div>
	</div>
	  -->
	  
	  
</div>


</form>


<?php

?>