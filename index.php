<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); require('assets/ajaxrating/ratingdraw.php'); ?>
<?php include("zscript_meta.php"); ?>

<body class="<?php if($my_redirect == 'index.php') { echo "pg-home"; } else { echo "pg-inside";} ?>">
<?php include("includes/wrap_head.php"); ?>

<?php
   
//echo '<div class="clearfix padd20_l">'.REF_ACTIVE_URL.' => '.$my_redirect .' id: '.$com_active .' sec: '.$comMenuSection.' type:'.$comMenuType.' seo:'.$seo_name.'</div>';
    
//displayArray($request);  
    
$has_results = false;

if((array_key_exists('fcty', $request) and $request['fcty'] <> '') or (array_key_exists('fsec', $request) and $request['fsec'] <> '')){
    $has_results = true;
    if($request['fcty'] == '' and $request['fsec'] == ''){ $has_results = false; }
}    
    
switch($my_redirect)
{ 
	case "index.php":
		include("includes/page_index.php");
		break;
	
	case "content.php":
	case "contact.php":	
	case "events.php":
	case "contacc.php":
	case "news.php":
	case "library.php":
	case "sitemap.php":
	case "policies.php":
	case "result.php":
	case "pillars.php":
	case "profiles.php":	
	case "404.php":
	case "calendar.php":	
	case "partners.php":
	case "gallery.php":
	case "register.php":
	case "places.php":
		include("includes/page_content.php");
		break;
	
	
    case "forums.php":
		include("includes/page_forums.php");
		break;	
			    
    case "mapping.php":
		include("includes/page_mapping.php");
		break;	
			    
    case "data.php":
		include("includes/page_data.php");
		break;	
        
    case "factsheet.php":
		include("includes/page_data_factsheet.php");
		break;		
        
    case "committees.php":
		include("includes/page_committees.php");
		break;		
        
    case "counties.php":
        //$cty_seo = (isset($request['cty'])) ? $request['cty'] : 'nairobi';
		include("includes/page_counties.php");
		break;	    
			    
        
	case "program.php":
		include("includes/page_program.php");
		break;	
	
	case "course.php":
		include("includes/page_course.php");
		break;	
		
	case "portal.php":
		include("includes/page_portal.php");
		break;		
		
	case "resource.php":
		include("includes/page_resource.php");
		break;	
		
	case "rescat.php":
		include("includes/page_resource_cats.php");
		break;	
	
	case "organizations.php":
		include("includes/page_resource_orgs.php");
		break;	
		
	case "county.php":
		include("includes/page_resource_county.php");
		break;	
		
	case "polls.php":
		include("poll_arch.php");
		break;
		
	
	/*case "contacc.php":
		include("includes/page_contacc.php");
		break;
	
	
	case "gallery.php":
		include("includes/page_gallery.php");
		break;*/
        
	
	case "directory.php":
		include("includes/page_directory.php");
		break;
		
		
}
?>



<?php include("includes/wrap_foot.php"); ?>
<?php include("zscript_vary.php"); ?>

<script type="text/javascript">
    var msec = []; var msec_name = []; var mcty = ""; 
jQuery(document).ready(function ($) { 
    
    var $callback = $("#callback");
    
    $("select#filter_county").change(function () {
	  mcty = $("select#filter_county option:selected").val();		
	});	
    
    
    $("input.chk_fsec").live('click', function () {
        var $thisi = $(this); 
       var id_i = $thisi.prop('id'); 
       var inamei = $thisi.attr('title'); 
        var ivali = $thisi.attr('value'); 
        var icheck = $("#"+id_i).is(':checked'); 
            //alert(icheck);
        
        //$("#"+id_i).prop("checked", !$("#"+id_i).prop("checked"));
        
        if (icheck === false) 
        {
            $("#"+id_i).removeAttr('checked');
            $("#"+id_i).removeClass('checked');
           //msec.push(ivali);
            //msec_name.push(iname);
        } else if (icheck === true) { 
            $("#"+id_i).prop("checked", true);
            $("#"+id_i).addClass('checked');
                    //msec.splice($.inArray(ivali, msec),1);
                    //msec_name.splice($.inArray(iname, msec_name),1);
        }
        
	});	
    
    
    
    $(".filter_fsec_go").live('click', function () {
            mcty = '<?php echo $GLOBALS['FCTY']; ?>';
            msec.length = 0; 
            
            if(msec.length == 0){
                $("input.chk_fsec").each(function() {                
                    var $this = $(this); 
                    var iid = $this.prop('id'); 
                    var icheck = $("#"+iid).is(':checked'); 
                    var iname = $this.prop('title'); 
                    var ival = $this.prop('value'); 
                    
                    if (icheck === true) {                         
                        msec.push( ival );
                    } 
                });
                
            }
        
                var sec_unique = msec.filter( onlyUnique ); 
                var _link = "index.php?fcty="+ mcty +"&fsec="+ sec_unique;
                
                if(sec_unique.length > 3){
                    alert('Select a maximum of 3.'); return false;
                } else {
                    location.href=(_link);
                }
                
	});
    
    
        $("#filter_go").on('click', function () {
            mcty = $("select#filter_county option:selected").val();
            
            $(".ui-multiselect-menu .ui-multiselect-checkboxes input").each(function() {
                
                var $this = $(this); 
                if ($this.is(':checked')) {
                    var iname = $this.attr('title'); var ival = $this.attr('value'); 
                    msec.push(ival);
                    msec_name.push(iname);
                }
            });
                var sec_unique = msec.filter( onlyUnique ); 
                var _link = "index.php?fcty="+ mcty +"&fsec="+ sec_unique;
                //alert(_link);
                location.href=(_link);
	     });	
    
}); 
    
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}
</script>


<?php if ($my_redirect == "index.php") { ?>

<link rel="stylesheet" href="assets/scripts/tabsresponsive/easyresponsivetabs.css" type="text/css" />
<script src="assets/scripts/tabsresponsive/easyresponsivetabs.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>   

<?php } ?>

</body>
</html>
