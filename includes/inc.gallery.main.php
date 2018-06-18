
<?php
if($item or $gal)
{
	echo display_PageTitle($my_header . '');
		
	include("includes/inc.gallery.cont.php"); 
	
	//echo '<h2>'.$my_header.'</h2>';	
	echo '<div class="main-guts">';
	if($item) {
	echo master::$contMain['full'][$item]['article'];
	}
	echo '</div>';	
	?>
		<?php include("includes/nav_social_share.php"); ?>
		<div class="clearfix padd10"></div>

	<?php	
}
else
{ 	//echobr($comMenuSection);
    
	if($comMenuSection == 5)
	{ include("includes/inc.gallery.menu.php"); } else
	{ 
        if(isset($request['op'])){
            include("includes/inc.gallery.menu.php");
        } else {
        include("includes/inc.gallery.list.php"); } 
    }
}











?>