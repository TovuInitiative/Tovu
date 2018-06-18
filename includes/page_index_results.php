

<?php
    //displayArray($request);
$sj_county_links = false;
$sj_sector_links = false;

    $cont_county    = array(); /*$cty_seo = '';*/
    $cont_county_id = (array_key_exists('fcty', $request)) ? $request['fcty'] : '';
    
    $cont_sector_id = (array_key_exists('fsec', $request)) ? $request['fsec'] : '';
    
    if($cont_county_id <> ''){
        $sj_county_links = true;
        //$cont_county    = $dispDt->get_countyItems('single', $cont_county_id); 
        //$cty_seo        = $cont_county['title_seo'];
    }
    //displayArray($cont_county);
    //displayArray(explode(',', $cont_sector_id));
    
    //$cont_sector    = array(); $sec_seo = '';
    
    if($cont_sector_id <> ''){  
        $sj_sector_links = true;
        /*$cont_sector    = $dispDt->get_commiteeItems('multi', explode(',', $cont_sector_id)); 
        //$cty_seo        = $cont_county['title_seo'];
        
        $title_fsec_arr = array();
        
        if(count($cont_sector) > 0){
            foreach($cont_sector as $sec_arr){
                $title_fsec_arr[] = $sec_arr['title'];
            }
        }
        
        $title_fsec = ' &rsaquo; '. implode(', ', $title_fsec_arr);*/
    }
    //displayArray($title_fsec);
   // echobr("county: ".$cont_county_id);
   // echobr("sector: ".$cont_sector_id);


$link_stories = '<li data-id="stories" data-url="ajcont.php?cty_sec=stories&fcty='.$cont_county_id.'&fsec='.$cont_sector_id.'&page='.@$request['page'].'">Experiences &amp; Innovations</li>';
    ?>
<div class="page_width">
<div class="padd5_t">
<div class="subcolumns clearfix" style="overflow:visible;">

<div class="section-title nomargin nopadd noline">
    <h2 class="nomargin nopadd"><span>
<?php    
    if($fcty <> '') { echo '<span class="txtmaroon">'.$title_fcty.'</span>'; }
    if($cont_sector_id <> '') { echo $title_fsec; }
?>
    </span></h2>
</div>


<!--vertical Tabs-->
        <div id="verticalTab">
            <ul class="resp-tabs-list">
              
              <?php echo $link_stories; ?>
              
              <li data-id="news" data-url="ajcont.php?cty_sec=news&fcty=<?php echo $cont_county_id; ?>&fsec=<?php echo $cont_sector_id; ?>&page=<?php echo @$request['page']; ?>">Events and Activities</li>  
                      
                <li data-id="resources" data-url="ajcont.php?cty_sec=resources&fcty=<?php echo $cont_county_id; ?>&fsec=<?php echo $cont_sector_id; ?>&page=<?php echo @$request['page']; ?>">Documents</li>
              
               <?php if($sj_county_links == true and $cont_county_id <> 48){ ?>
                    <li data-id="indicators" data-url="ajcty.php?cty=<?php echo $cty_seo; ?>&cty_sec=indicators">County Performance Data</li>
                    <li data-id="budgets" data-url="ajcty.php?cty=<?php echo $cty_seo; ?>&cty_sec=budgets">County Budget Data</li>
                    <li data-id="factsheets" data-url="ajcty.php?cty=<?php echo $cty_seo; ?>&cty_sec=factsheets">County Factsheet</li>
               <?php } ?>
               
               
                
                
                
                <?php if($sj_sector_links == true){ ?>
                     <li data-id="forums" data-url="ajtabs.php?fsec=<?php echo $cont_sector_id; ?>&cmt_sec=forums">Sector Forums</li>
                     <!--<li data-id="about" data-url="ajtabs.php?cmt=<?php echo $cmt_seo; ?>&cmt_sec=about">Sector Profile</li>-->
                <?php } ?>
                
                
                <?php if($sj_county_links == true and $cont_county_id <> 48){ ?>
                    <!--<li data-id="about" data-url="ajcty.php?cty=<?php echo $cty_seo; ?>&cty_sec=about">County Profile</li> -->   
               <?php } ?>
               
               
                <?php if($sj_county_links == true and $cont_county_id == 48){ ?>
                    <li data-id="mapping" data-url="ajcty.php?cty=<?php echo $cty_seo; ?>&cty_sec=mapping">National Projects</li>  
               <?php } ?>
               
                <!--<li data-id="stories" data-url="ajcont.php?cty_sec=stories&fcty=<?php //echo $cont_county_id; ?>&fsec=<?php //echo $cont_sector_id; ?>&page=<?php //echo @$request['page']; ?>">Experiences &amp; Innovations</li>-->
            
               
                <!--<li data-id="stories" data-url="ajtabs.php?cmt=<?php echo $cmt_seo; ?>&cmt_sec=stories&page=<?php echo @$request['page']; ?>">Good Practices &amp; Innovations</li>-->
                <!--<li data-id="about" data-url="ajtabs.php?cmt=<?php //echo $cmt_seo; ?>&cmt_sec=about">About Committee</li>
                <li data-id="members" data-url="ajtabs.php?cmt=<?php //echo $cmt_seo; ?>&cmt_sec=members">Members</li>-->
            </ul>
            <div class="resp-tabs-container">
                
            </div>
        </div>
        <br />



</div>
</div>
</div>

