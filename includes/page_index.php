<?php if ($has_results == true) { ?>
<div class="bg-lightgray">
<?php include("includes/nav_crumbs.php"); ?>
</div>
<?php } ?>

<!-- Banner container -->
<div class="containerX clearfix">
	<div class="col-md-12 col-xs-12 bannerX" <?php if ($has_results == false) { ?>id="banner"<?php } ?>>
	    
	    <?php if ($has_results == false) { ?>
	    <div class="subcolumns clearfix">
	    <div class="txtcenter padd20 container txt19">
	        <h1 class="txt35">What is Maarifa Platform</h1>
	        <p>Maarifa Centre is a knowledge sharing and learning platform for capturing of lessons and experiences from the 47 County Governments. The vision of the centre is <strong><em>"To be Kenya's Premier Knowledge sharing and learning Platform for Effective Governance and Service Delivery for Sustainable Development"</em></strong>.</p>
	    </div>
	    </div>
	    <?php } ?>
	    
	    
		<!-- Search -->
		<?php if ($has_results == false) { include 'includes/form.search.new.php'; } ?>
		<!-- Search -->

		
		<!-- Banner cards -->
		<?php if ($has_results == true) { ?>
		<?php include 'page_index_results.php'; ?>
		<?php } ?>
		<!-- Banner cards -->
	</div>
</div>
<!-- Banner container --> 









