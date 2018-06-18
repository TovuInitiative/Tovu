<?php
$search_inside_page = 'mast-inner';
$searchinput_home = '';
$searchlabel_hide = ' hidden';
$searchbutton_size = ' txt15 nopadd';
$searchmulti_size = '';

if($my_redirect == 'index.php' and $this_page <> 'search.php' and !isset($request['fcty'])){
    ?>
    <style type="text/css">.pg-home .ui-multiselect.ui-state-default {height: 70px;font-size: 20px;}</style>
    <?php
    $search_inside_page = '';
    $searchinput_home = ' mdgov_home';
    $searchlabel_hide = '';
    $searchbutton_size = ' fa-3x';
    $searchmulti_size = ' height:70px !important ';
}

$searchsector = (isset($request['fsec'])) ? explode(',', $request['fsec']) : ''; 

?>
<div class="subcolumns clearfix">
<div class="container">

<div id="mastWrap" class="<?php echo $search_inside_page; ?>">
   
   <?php if ($has_results == false) { ?>
   <div class="txtcenter padd15 txt19 txtwhite">Select a County, Sector or both options to proceed. </div>
   <?php } ?>
   
    <div action="search.php" method="get" class="subcolumns">
    
    <div id="mdgov_mastheadRight" class="col-md-11">
        <div id="mdgov_myMaryland">
            <div id="mdgov_myMDNav" data-component="mymaryland-nav">
                
                <!-- Search County Dropdown -->
                <div class=" col-md-6 col-xs-12 col-lg-6">
                    <div class="mdgov_userLocation">                       
                          <select class="form-controlX  <?php echo $searchinput_home; ?>" id="filter_county" name="searchcounty">
                          <option value=""> - Select County -</option>
                           <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county", @$request['fcty']) ?>
                          </select>
                    </div>

                </div>
                <!-- End of search County dropdown -->

                <!-- Search topic dropdown -->
                <div class=" col-md-6 col-xs-12 col-lg-6">
                    <div class="mdgov_userLocation">                          
                          <select name="searchsector[]" id="filter_sector" multiple class="form-controlX  <?php echo $searchinput_home; ?> multiple multi_sector" style="<?php echo $searchmulti_size; ?>">
                              <?php  echo $dispDt->get_commiteeItems('select', @$searchsector , 'y'); ?>
                        </select>
                        
                    </div>

                </div>
                <!-- End of search topic dropdown -->

               
                
            </div>
        </div>
    </div>
    
    
    <!-- Search button -->
     <div class=" col-md-1 col-xs-12 col-lg-1 qQ nopadd  txtcenter">
         <button class="btn btn-clear btn-icon col-md-12 <?php echo $searchbutton_size; ?>" id="filter_go"> <i class="fa fa-arrow-right"></i></button>
     </div>
    <!-- Search button -->
    </div>
    <!--<div id="callback" class="txtcenter txtwhite"></div>-->
</div>

<?php if ($has_results == false) { ?>
<?php include 'includes/home_cards_banner_sj.php'; ?>
<?php } ?>

</div>


<!--<div class="padd20"></div>-->
</div>

