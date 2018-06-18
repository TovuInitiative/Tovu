<?php //if($my_redirect <> 'me-members.php' and $my_redirect <> 'signin.php') 
//{ 
	$btns_social = '';
	if(SOCIAL_ID_FACEBOOK <> '#')
	{ $btns_social .= '<a href="https://www.facebook.com/'.SOCIAL_ID_FACEBOOK.'" title="Facebook" class="fb_icon"><i class="fa fa-facebook"></i></a>';
	}
	if(SOCIAL_ID_TWITTER <> '#')
	{ $btns_social .= '<a href="https://twitter.com/'.SOCIAL_ID_TWITTER.'" title="Twitter" class="tw_icon"><i class="fa fa-twitter"></i></a>'; 
	}
	if(SOCIAL_ID_GOOGLE <> '#')
	{ $btns_social .= '<a href="https://plus.google.com/'.SOCIAL_ID_GOOGLE.'" title="Google Plus" class="gplus_icon"><i class="fa fa-google-plus"></i></a>'; 
	}
	if(SOCIAL_ID_YOUTUBE <> '#')
	{ $btns_social .= '<a href="https://www.youtube.com/'.SOCIAL_ID_YOUTUBE.'" title="YouTube" class="yt_icon"><i class="fa fa-youtube-play"></i></a>'; 
	}
	
	if($btns_social <> '')
	{ $btns_social .= '<a href="mailto:'.SITE_MAIL_TO_BASIC.'" title="Mail us" class="mail_icon"><i class="fa fa-envelope"></i></a>';
	echo '<div align="center" class="btns_social">'.$btns_social.'</div>'; }
//} ?>



<script type="text/javascript" src="assets/scripts/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/scripts/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="assets/scripts/jquery-ui-1.10.2.min.js"></script>

<script type="text/javascript" src="assets/scripts/misc/jquery.once.js"></script>
<script type="text/javascript" src="assets/scripts/misc/jquery.browserdetect.js"></script>
<script type='text/javascript' src='assets/scripts/misc/jquery.hoverIntent.minified.js'></script>

<script type="text/javascript" src="assets/scripts/validate/jquery.validate-1.14.min.js"></script>
<script type="text/javascript" src="assets/scripts/validate/jquery.validate-1.14.additional.min.js"></script>

<script type="text/javascript" src="assets/scripts/modal/jquery.modal.js" charset="utf-8"></script>
<script type="text/javascript" src="assets/scripts/misc/jquery.addcaptions-0.2.js"></script>
<script type="text/javascript" src="assets/captchajx/ajax_captcha.js"></script>
<script type="text/javascript" src="assets/scripts/accordion/jquery.accordion.js"></script>

<!-- Masonry --> 
<script type="text/javascript" src="assets/scripts/masonry/masonry.pkgd.min.js"></script>

<!-- Autocomplete --> 
<script type="text/javascript" src="assets/scripts/autocomplete/jquery.auto-complete.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/scripts/autocomplete/jquery.auto-complete.css" />

<!-- Responsive-Tabs -->
<link rel="stylesheet" href="assets/scripts/tabsresponsive/easyresponsivetabs.css" type="text/css" />
<script src="assets/scripts/tabsresponsive/easyresponsivetabs.js"></script>

<!-- Slider --> 
<link rel="stylesheet" href="assets/scripts/bxslider/jquery.bxslider.carousel.css" type="text/css" />
<script src="assets/scripts/bxslider/jquery.bxslider.min.js"></script>


<div class="modal fade" style="display:none;"></div>
<div id="dynaScript"></div>
<script type="text/javascript" src="zscript_site.js"></script>



<script type="text/javascript">
jQuery(document).ready(function($) {
	var windowWidth = window.innerWidth;
    var menu_opt = (windowWidth > 1024) ?  "main" : "canvas";
    responsiveContent(menu_opt);
});	
</script>



<?php if($GLOBALS['CONTENT_SHOW_CALENDAR'] == true) {  ?> 
<link rel="stylesheet" href="includes/calendar/eventCalendar.css">
<link rel="stylesheet" href="includes/calendar/eventCalendar_theme_responsive.css">
<script src="includes/calendar/moment.js" type="text/javascript"></script>
<script src="includes/calendar/jquery.eventCalendar.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function($) {
	if($("#eventCalendarMember").length){
		$("#eventCalendarMember").eventCalendar({
			eventsjson: 'includes/calendar/events.member.php',jsonDateFormat: 'human',dateFormat: 'dddd, MMM DD, YYYY',showDescription: true ,openEventInNewWindow: true,eventsScrollable: true
		});
	}
	if($("#eventCalendarAll").length){
		$("#eventCalendarAll").eventCalendar({
			eventsjson: 'includes/calendar/events.all.php',jsonDateFormat: 'human',dateFormat: 'dddd, MMM DD, YYYY',showDescription: true ,openEventInNewWindow: false,eventsScrollable: false
		});
	}
});
</script>
<?php } ?>


<?php if($GLOBALS['FORM_KEYTAGS'] == true) {  ?> 
<link rel="stylesheet" type="text/css" href="assets/scripts/tagsinput/jquery.tagsinput.css" />
<script type="text/javascript" src="assets/scripts/tagsinput/jquery.tagsinput.js"></script>
<script type="text/javascript">
jQuery(document).ready(function ($) { if( $('.tags-field').length ) { $('.tags-field').tagsInput({width:'100%'}); }	}); 
</script>
<?php } ?>



<?php if($GLOBALS['SOCIAL_CONNECT'] == true) { ?> 
<!-- #GOOGLE TRANSLATE -->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,sw,de,es,fr,ja,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<?php if($my_redirect <> "contacc.php"){ ?>
<!-- #ADDTHIS -->
<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo SOCIAL_ID_ADDTHIS; ?>"></script>
<?php } ?>
<!-- #FACEBOOK CONNECT + COMMENTS -->
<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=<?php echo $adminConfig['SOCIAL_ID_FACEBOOK_WIDGET']; ?>&autoLogAppEvents=1';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>


<!-- ANALYTICS CODES -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109500412-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-109500412-1');
</script>


<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<script type="text/javascript">window.cookieconsent_options = {"message":"<?php echo SITE_TITLE_LONG; ?> uses cookies to ensure you get the best experience on our website.","dismiss":"Got it!","learnMore":"More info","link":"terms-of-use/","theme":"dark-top"};</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->

<?php } ?>

