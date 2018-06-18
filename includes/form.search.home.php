<?php
$search_inside_page = 'mast-inner';
$searchinput_home = '';
$searchlabel_hide = ' hidden';
$searchbutton_size = ' txt15 nopadd';

if($my_redirect == 'index.php' and $this_page <> 'search.php'){
    $search_inside_page = '';
    $searchinput_home = ' mdgov_home';
    $searchlabel_hide = '';
    $searchbutton_size = ' fa-3x';
}

$searchsector = (isset($request['searchsector'])) ? $request['searchsector'] : ''; 

?>
<div class="subcolumns clearfix padd10_bX">
<div id="mastWrap" class="<?php echo $search_inside_page; ?>">
    <form action="search.php" method="get" class="">
    <div id="mdgov_mastheadLeft" class="col-md-5 col-sm-5">
        <div id="ctl00_mdgov_searchInputWrapFake" class="mdgov_searchInputWrap mdgov_searchInputWrapFake">
           <!-- <label for="mdgov_searchInputStart" class="sr-only">Maarifa Search</label>-->
            <input id="mdgov_searchInputStart" name="searchtext" type="text" autocomplete="off" placeholder="Search Maarifa..." class="mdgov_searchInputStart <?php echo $searchinput_home; ?>" maxlength="50" value="<?php echo @$request['searchtext']; ?>">
        </div>
        
    </div>
    <div id="mdgov_mastheadRight" class="col-md-6 col-sm-9">
        <div id="mdgov_myMaryland">
            <div id="mdgov_myMDNav" data-component="mymaryland-nav">
                
                <!-- Search County Dropdown -->
                <div class=" col-md-4 col-xs-12 col-lg-4">
                    <h3 class="txtwhite txt15 <?php echo $searchlabel_hide; ?>">Filter by County</h3>
                    <div class="mdgov_userLocation">
                       
                          <select class="form-control" id="searchcounty" name="searchcounty">
                          <option value=""> - Select County -</option>
                           <?php echo $ddSelect->dropper_select("mrfc_reg_county", "county_id", "county", @$request['searchcounty']) ?>
                          </select>
                    </div>

                </div>
                <!-- End of search County dropdown -->

                <!-- Search topic dropdown -->
                <div class=" col-md-8 col-xs-12 col-lg-8">
                    <h3 class="txtwhite txt15 <?php echo $searchlabel_hide; ?>">Filter by Topic</h3>
                    <div class="mdgov_userLocation">
                          
                          <select name="searchsector[]" id="searchsector" multiple class="form-control multiple" style="height:34px !important">
                              <?php  echo $dispDt->get_commiteeItems('select', @$searchsector , 'y');
                              //echo $ddSelect->dropper_select("mrfc_app_committee", "committee_id", "title", @$parent['committee_id']) ?>
                        </select>
                        
                    </div>

                </div>
                <!-- End of search topic dropdown -->

               
                
            </div>
        </div>
    </div>
    <!-- Search button -->
     <div class=" col-md-1 col-xs-12 col-lg-1 qQ nopadd  txtcenter">
         <button class="btn btn-clear btn-icon col-md-12 <?php echo $searchbutton_size; ?>"> <i class="fa fa-search"></i></button>
     </div>
    <!-- Search button -->
    </form>
</div>
</div>