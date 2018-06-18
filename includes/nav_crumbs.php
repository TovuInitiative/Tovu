<?php //echo $my_redirect;
$crumbpadd = 'breadcrumbpadd';
//$my_redirect == 'index.php'
if(  ($has_results == false and $my_redirect == 'index.php')  or  $my_redirect == 'mailing.php' or $my_redirect == 'search.php' or $my_redirect == '404.php') 
{ $my_breadcrumb = ''; $crumbpadd = 'padd0';}
if($my_breadcrumb <> '') {
 ?>	
	
	<div class="page_width nopadd"> <div class="breadcrumb">
	<!-- @beg:: bcrumbs -->
		<div class="subcolumns">
			<div class="col-md-12 nopadd"><div class="<?php  echo $crumbpadd;  ?>"><?php  echo $my_breadcrumb;  ?></div></div>					
		</div>
	
	
	<!-- @end:: bcrumbs -->	
	</div>
	</div>
<?php } ?>
<!-- @beg:: alert -->	
<?php //if($this_page <> 'result.php') {  include("includes/wrap_alert.box.php"); } ?>
<!-- @end :: alert -->

