<div class="box-cont noborder" id="sf_social_media">
	<!--<div class="box-cont-title">Social Media</div>-->
	<?php echo display_PageTitle('Social Media', 'h4', ''); ?>
	<div class="subcolumns clearfix">
	<div class="tabscontainer" style="position:relative;">
			
		<div class="navcontainer">
		<ul>
			<li><a id="tab2" class="sftab active" data-id="sf_twitter">Twitter</a></li>
			<li><a id="tab1" class="sftab" data-id="sf_facebook">Facebook</a></li>
		</ul>
		</div>
	
		<div class="tabsloader sftabloader">
				<div class="txtcenter"><img src="assets/image/icons/a-loader.gif" alt="loading..." /></div>			
		</div>
		
		<div class="tabscontent" id="wrap_feeds">
			<div id="feed_sf_twitter" class="sftabcontent"></div>
			<div id="feed_sf_facebook" class="sftabcontent" style="display:none"></div>						
		</div>
				
	</div>
	</div>
	
<script type="text/javascript">
<?php
if($GLOBALS['SOCIAL_CONNECT'] == true){  
    /*https://www.facebook.com/search/top/?q=<?php //echo SOCIAL_ID_FACEBOOK; ?>*/
    /*<div class="fb-page" data-href="https://www.facebook.com/<?php echo SOCIAL_ID_FACEBOOK; ?>"  data-height="400" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-border-color="#FFFFFF" >*/
?>
var feed_sf_twitter = '<a class="twitter-timeline" href="https://twitter.com/<?php echo SOCIAL_ID_TWITTER; ?>" data-chrome="noborders transparent" data-height="400">#<?php echo SOCIAL_ID_TWITTER; ?> Tweets</a>';

var feed_sf_facebook = '<div class="fb-page" data-href="https://www.facebook.com/<?php echo SOCIAL_ID_FACEBOOK; ?>/" data-tabs="timeline" data-height="400" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>';
<?php } else { ?>
var feed_sf_twitter = '<a>Tweets on <?php echo SOCIAL_ID_TWITTER; ?></a>';
var feed_sf_facebook = '<a>Feeds on <?php echo SOCIAL_ID_FACEBOOK; ?></a>';
<?php } ?>	

jQuery(document).ready(function($){
	
	jQuery(".sftab").click(function()
	{	
		jQuery(".sftabloader").show();
		tabId = jQuery(this).attr("data-id");		
		jQuery(".sftab").removeClass("active");
		$(this).addClass("active");		
		jQuery(".sftabcontent").css("display","none");
		jQuery("#feed_"+tabId).css("display","block");		
		jQuery(".sftabloader").hide();	
		return false;
	});

});

</script>

</div>
