
<!-- @beg:: page-container -->
<div class="<?php if($my_redirect == 'index.php') { echo "page_margins home"; } else { echo "page_margins pg-inside";} ?>">

<div class="w3ls_header_top" >
   
    <div class="page_width" >
    <div class="row" >
        <div class="col-md-8 nopadd">
             <ul class="sf-menu sf-small sf-arrows" style="height:;">
                 <?php 
                    /*$nav_header = $dispData->buildMenu_Main($com_active, 6, 0, 'nav_top'); 
                    echo $nav_header; */
                 ?>
            </ul>
        </div>

        <div class="col-md-4 nopadd">				
            <?php /*include("includes/wrap_nav_profile.php"); */
            //include("includes/nav_head.php"); ?>
        </div>

    </div>
    </div>
    
         
</div>


<div class="wrap_head" style="">
	
			
    <div class="head_width" >
		<div class="subcolumns clearfix showall" style="">
			
				<div class="col-md-4 header_logo nopadd">
					
					<div class="logo_wrapX">
						<a href="./?tk=<?php echo time(); ?>" title="<?php echo SITE_TITLE_LONG; ?>">
						<div class="logo_box" style="height:; overflow:hidden ">
						<img src="<?php echo SITE_LOGO; ?>" alt="<?php echo SITE_TITLE_LONG; ?>" id="logo-img"  />
						</div>
						</a>
					</div>
					
				</div>
			
			
				<div class=" col-md-8 header_links pull-right" style="">	
				
                    <div class="col-md-12 nopadd">
                        <?php  include("includes/nav_head.php"); ?>
                    </div>
                    
                    <div class="col-md-12 nopadd">
										
                        <div class="padd15_t" style="position:relative;">						
                            <?php include("includes/nav_head_mega.php"); ?>	
                            <a href="#offcanvas" id="at-navbar" class="uk-navbar-toggle float-right"></a>					
                        </div>
					</div>
				</div>
			
		</div>			
		
    </div>	
    
    	<?php  ?>
        <!-- Start Top Search -->
        <div class="top-search"  <?php if($this_page == 'search.php') { echo 'style="display:block"'; } ?> >
           <div class="page_width" >
           <?php include("includes/inc.cont.search.form.php"); ?>
            
            </div>
        </div>
        <!-- End Top Search -->	
        <?php  ?>  	
		
</div>
	



<div style="position:relative">
<!-- @beg:: alert -->	
<?php if($this_page <> 'result.php') {  include("includes/wrap_alert.box.php"); } ?>
<!-- @end :: alert -->
</div>

<?php //include("includes/nav_crumbs.php"); ?>

<?php /* if(($my_redirect <> 'index.php' and $my_redirect <> 'data.php' and $my_redirect <> 'factsheet.php')  or $this_page =='search.php') { 
    echo '<div class="subcolumns clearfix padd10_0" style="background:url(assets/image/gallery/wildebeast.jpg) no-repeat 50% 50%; background-size:cover ">';
    include 'includes/form.search.home.php';
    echo '</div>';
}*/ ?>







