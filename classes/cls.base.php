<?php
	$configTime 	= '2018-05-17';
	
	$s_title 		= "infohub-platfom";
	$s_site 		= "infohub-platfom.com";

	$adminConfig = array(		
		'SITE_ALIAS' 	  		=> "",
		'SITE_FOLDER' 	  		=> "/infohub-platfom",
		'SITE_TITLE_LONG'  		=> $s_title,	
		'SITE_TITLE_SHORT' 		=> $s_title,
		'SITE_DOMAIN_URI'  		=> $s_site,
		'SITE_MAIL_SENDER' 		=> $s_title,
		'SITE_MAIL_TO_BASIC' 	=> "info@".$s_site,
		'SITE_MAIL_FROM_BASIC' 	=> "noreply@".$s_site,
		'SITE_LOGO' 			=> "assets/image/logo.png",
		'SITE_LOGO_B' 			=> "assets/image/logo.png",
		'SITE_FAVICON' 			=> "assets/image/favi.png",
		'COLOR_BG_SITE' 		=> "#FBF2DF",
		'COLOR_BG_HEADER' 		=> "#FFF",
		'UPLOAD_MAX_SIZE' 		=> "5000000",
		'GALLTHMB_WIDTH' 		=> "250",
		'GALLTHMB_HEIGHT' 		=> "150",
		'GALLIMG_WIDTH' 		=> "1200",
		'GALLIMG_HEIGHT' 		=> "900",
		
		'SOCIAL_ID_FACEBOOK' 	    => "#",
        'SOCIAL_ID_FACEBOOK_WIDGET' => "#",
		'SOCIAL_ID_TWITTER' 	    => "#",
		'SOCIAL_ID_TWITTER_WIDGET'  => "#",		
		'SOCIAL_ID_YOUTUBE' 	    => "#",
		'SOCIAL_ID_LINKEDIN' 	=> "#",
		'SOCIAL_ID_GOOGLE' 		=> "#",
		'SOCIAL_ID_ADDTHIS' 		=> "#",
		
		'_lists_date_format' 	=> "%b %e %Y",
		'_lists_time_format' 	=> "%l:%i %p",
		'MySQLDateFormat' 		=> "%m/%d/%Y",
		'PHPDateFormat' 		=> "n/j/Y",
		'PHPDateTimeFormat' 	=> "m/d/Y, h:i a"
		
		,'ADM_STYLE_BG' 		=> '#00C0CC'
		,'DB_PREFIX' 			=> 'mrfc_'
	);
	
	if($_SERVER['HTTP_HOST'] == "localhost") { 
		$adminConfig['SITE_FOLDER'] = "infohub-platfom";
	}
