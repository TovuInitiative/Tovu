<div class="clearfix padd10"></div>

<?php
if($GLOBALS['SOCIAL_CONNECT'] == true)
{
?>
<div class="clearfix curvy" style="border:1px solid #C7D0DF; border-width:1px 0; padding:10px; margin-bottom:20px;">
	
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	<a class="addthis_button_tweet"></a>
	<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
	<a class="addthis_button_linkedin_counter"></a>
	<a class="addthis_counter addthis_pill_style"></a>
	</div>
	
	<!-- AddThis Button END -->

</div>

<?php 
	/*if($this_page == 'events.php' or  $this_page == 'gallery.php' or 
   	   $this_page == 'videos.php' or  $this_page == 'news.php') 
    {*/  
?>



<div class="clearfix">
	<?php /*<div><h4><fb:comments-count href="<?php echo SITE_DOMAIN_LIVE.$ref_page; ?>"></fb:comments-count> Comments </h4></div>*/  ?>
	<div class="fb-comments clearfix" data-href="<?php echo SITE_DOMAIN_LIVE.$ref_page; ?>" data-width="550" data-num-posts="10"></div>
</div>


<div class="clearfix padd10"></div>
<?php 
	//} 
}
?>

