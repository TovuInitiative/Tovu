<?php require("classes/cls.constants.php"); include("classes/cls.paths.php"); ?>
<?php include("zscript_meta.php"); ?>

<body>
<?php include("includes/wrap_head.php"); ?>


<?php
 //echo '<div class="clearfix padd20_l">'.REF_ACTIVE_URL.' => '.$my_redirect .' id: '.$com_active .' sec: '.$comMenuSection.' type:'.$comMenuType.' seo:'.$seo_name.'</div>';
	
	//displayArray($_SESSION['sess_mrfc_member']);
?>

<div class="page_width">




<div class="subcolumns clearfix">

	<div class="col-md-1">
		<div class="padd20_t"></div>
		
	</div>
	
	
	
	<div class="col-md-10">
		<div class="padd15_r padd15_l padd20_t" style="min-height:300px;">
		
			<div id="wrapper" class="row">
            
            <h1>Contribute County Story</h1>
            
            <?php 
             
                if(isset($_SESSION['sess_mrfc_member'])) {
                    include("includes/form.contribute.php");
                } else {
                    
                    include($GLOBALS['MODULAR_ACCOUNTS_ROOT']."php/form.account.login.php");
                }
                ?>
            
            </div>
			
		</div>
	</div>
	
	
	
</div>
</div>

<div class="subcolumns clearfix">
&nbsp;
</div>


<?php include("includes/wrap_foot.php"); ?>
<?php include("zscript_vary.php"); ?>

</body>
</html>
