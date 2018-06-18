

    <!--<div class="page_width">
    <div class="padd5_0">
    <div class="subcolumns clearfix">
        &nbsp;
    </div>
    </div>
    </div>-->






<div class="clearfix">
   <?php if($my_redirect <> 'index.php') { echo '<div class="padd15_t"></div>'; } ?>
    
	<div class="" style="background:#F8D5AF; border-top:1px solid #ddd;">
	<div class="head_width">
		
		<div class="subcolumns txt95 padd15_t padd15_b">
			
			<div class="col-md-6">		
				<div class="padd10 txt12">
				&copy; <?php echo date('Y'); ?>. <?php echo SITE_TITLE_LONG; ?> - A Initiative of <a href="http://cog.go.ke" class="txtgray" target="_blank">The Council of Governors (CoG)</a>.
				</div>
			</div>
			
			<div class="col-md-6">
			<div>
				<div class="nav_foot_sml padd10">
				<ul id="nav_foot"> 
				
				<?php echo $dispData->buildMenu_Main($com_active, 5, 0, 'nav_foot'); //$nav_FootLinks; ?> 
				<li><a href="contribute.php?tk=<?php echo time(); ?>">CONTRIBUTE</a></li>
				</ul>				
				</div>	
			</div>
			</div>
			
			
			
		</div>
		
		
		
		
		
	</div>
	</div>
</div>



<!-- @end:: page-container -->
</div>



<!-- off-canvas -->
<div id="offcanvas" class="uk-offcanvas">
	<div class="uk-offcanvas-bar">
		<div class="canvas-menu padd5">
			<!--<div class="padd15"><img src="<?php echo SITE_LOGO; ?>" style="width:100%" ></div>-->
			<div class="padd10"><a class=" btn block txtcenter txtyellow" style="text-align:center" onclick="javascript: responsiveMenuClose();">Close</a> </div>
			<div class="canvas-search padd5"><a class="btn" id="canvas-search-btn">Search</a> <?php //include("includes/inc.cont.search.form.php"); ?></div>
			
			<?php echo '<ul class="uk-nav-offcanvas">'/*.$nav_head_main*/; /*.$nav_head_side*/
				//include("includes/nav_head_small.php");
			echo '</ul>'; ?>
			
			<div class="canvas-nav-right padd10_5"></div>
			
		</div>			
	</div>
</div>