

<div class="bg-lightgray">
<?php include("includes/nav_crumbs.php"); ?>
</div>


<div class="page_width">
<div class="padd5_t">
<div class="subcolumns clearfix" style="overflow:visible;">

<?php
    $cmt_seo = (isset($request['cmt'])) ? $request['cmt'] : '';
?>
	
	<div class="col-md-12 bg-whiteX panel-home-gutsX">
		<div class="padd15X" style="min-height:700px;">
		
			<div id="wrapper" class="">
			    <div class="row">
			        <div class="col-md-9"><?php echo display_PageTitle($my_page_head . ': <span class="txtblack" id="titleExtra"></span>', '', ''); ?></div>
			        <!--<div class="col-md-3 pull-right txtright"></div>-->
			    </div>
			
			</div>
			
			
			<div>
           <?php
                if($GLOBALS['COMMITTEE_SHOW_DETAIL'] == false) {
            ?>
                <div class="grid">
                    <?php
                    $committee_widgets = $dispDt->get_commiteeItems('widgets');
                    echo $committee_widgets;
                    ?>			    
                </div>
            <?php
                } else {
            ?>
                
                <div class="col-md-12 col-sm-10 col-xs-12 panelX panel-home-gutsX ">
                   <div class="padd20X">
                    <?php include('includes/committee/commitee-detail.php'); ?>
                    </div>
                </div>
                
            <?php
                }
            ?>
			    <?php //include 'includes/committee/committees-about.php'; ?>
			</div>
			
		</div>
	</div>
	
	
	
</div>
</div>
</div>








